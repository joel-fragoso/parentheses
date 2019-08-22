<?php

/**
 * Parentheses
 *
 * Copyright 2019 Parentheses, Inc.
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the
 * Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the
 * Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall
 * be included in all copies or substantial portions of the
 * Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY
 * KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
 * OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT
 * OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @package 	Parentheses
 * @subpackage 	Core
 * @author 		Parentheses, Inc.
 * @link		https://parentheses.io
 * @license		https://opensource.org/licenses/MIT (MIT) 
 * @version		1.0.0-beta
 **/

namespace Parentheses\Core;

/**
 * Parentheses Class 
 **/ 
class Parentheses
{
	public $configs;

	public $baseURL;

	public $namespace;

	public $controller;

	public $action;

	public $params;

	public $request;

	public $response;

	/**
	 * PAT_VERSION
	 *
	 * @var string
	 **/
	const PAT_VERSION = '1.0.0-beta';

	public function __construct($configs)
	{
		$this->configs = $configs;
		$this->configs->patVersion = self::PAT_VERSION;

		$this->baseURL = (! empty($this->configs->base_url))
			? $this->configs->base_url
			: 'http://localhost/';

		$this->namespace = '\App\Controllers\\';
		$this->controller = 'Home';
		$this->action = 'index';
		$this->params = [];
	}

	public function run()
	{
		$segments = $this->getSegments();

		if (count($segments) > 0) {

			for ($i = 0; $i < count($segments); $i++) {
				
				if (basename(ROOTPATH) === $segments[$i]) {

					$this->baseURL .= $segments[$i] . '/';
				} elseif (is_dir(ROOTPATH . $segments[$i])) {

					$this->baseURL .= $segments[$i] . '/';
				} elseif (
					class_exists($class = $this->getClassFullyName($segments[$i]))
				) {

					$controller = new $class();

					$action = isset($segments[$i + 1]) ? $segments[$i + 1] : $this->action;
					if (method_exists($controller, $action)) {

						$controller->{$action}($segments);
						break;
					} else {

						$controller = new \App\Controllers\Errors\Error404Controller();

						$params = [
							'msg' => htmlspecialchars("O método <b>{$action}</b> não foi encontrado.")
						];

						$controller->index($params);
					}
				} else {

					$controller = new \App\Controllers\Errors\Error404Controller();

					$params = [
						'msg' => htmlspecialchars("A classe <b>{$segments[$i]}</b> não foi encontrada.")
					];

					$controller->index($params);
				}
			}
		} else {
			if (class_exists($class = $this->getClassFullyName($this->controller))) {

				$controller = new $class();

				if (method_exists($controller, $this->action)) {

					$controller->{$this->action}();
				} else {

					$controller = new \App\Controllers\Errors\Error404Controller();

					$params = [
						'msg' => htmlspecialchars("O método <b>{$this->action}</b> não foi encontrado.")
					];

					$controller->index($params);
				}
			} else {

				$controller = new \App\Controllers\Errors\Error404Controller();
				$controller->index();
			}

		}		
	}

	protected function getClassFullyName($classname)
	{
		return $this->namespace . ucfirst($classname) . 'Controller';
	}

	protected function getSegments()
	{
		return array_values(array_filter(explode('/', $this->parseURL(
			(! empty($this->configs->request_uri))
				? strtoupper($this->configs->request_uri)
				: 'REQUEST_URI'
		))));
	}

	protected function parseURL($key)
	{
		return parse_url($_SERVER[$key], PHP_URL_PATH);
	}
}
