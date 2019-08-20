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
 * @subpackage 	Config
 * @author 		Parentheses, Inc.
 * @link		https://parentheses.io
 * @license		https://opensource.org/licenses/MIT (MIT) 
 * @version		1.0.0-beta
 **/

namespace Parentheses\Config;

/**
 * Config Class 
 **/ 
class Config
{
	/**
	 * $configs
	 *
	 * @var array
	 **/
	public $configs;

	/**
	 * Class construct
	 *
	 * @return void
	 **/
	public function __construct()
	{
		$this->configs = [];
	}

	/**
	 * __set magic
	 *
	 * @param string $key 
	 * @param string $value
	 *
	 * @return void
	 **/
	public function __set($key, $value)
	{
		$this->configs[$key] = $value;
	}

	/**
	 * __get magic
	 *
	 * @param string $key 
	 *
	 * @return mixed
	 **/
	public function __get($key)
	{
		return $this->configs[$key];
	}

	/**
	 * __isset magic
	 *
	 * @param string $key
	 *
	 * @return mixed 
	 **/
	public function __isset($key)
	{
		return isset($this->configs[$key]);
	}

	/**
	 * load
	 *
	 * Responsável por realizar o carregamento
	 * dos arquivos de configuração
	 *
	 * @param string $file 
	 * @param string $folder
	 *
	 * @return void
	 **/
	public function load($file, $folder = '')
	{
		if ($folder) {
			if (! file_exists(APPPATH . $folder . DS . $file . '.php')) {
				echo "A pasta {$folder} e/ou o arquivo {$file}.php não existe.";
				exit(3); // EXIT_CONFIG
			}

			require_once APPPATH . $folder . DS . $file . '.php';
		} else {
			if (! file_exists(APPPATH . 'Config' . DS . $file . '.php')) {
				echo "O arquivo {$file}.php não existe na pasta application/Config.";
				exit(3); // EXIT_CONFIG
			}

			require_once APPPATH . 'Config' . DS . $file . '.php';
		}

		if (isset($config) && is_array($config)) {
			foreach ($config  as $key => $value) {
				$this->configs[$key] = $value;
			}
		}
	}

	/**
	 * reset
	 *
	 * @return void
	 **/
	public function reset()
	{
		$this->configs = [];
	}
}
