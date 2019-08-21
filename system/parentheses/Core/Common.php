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

/**
 * Common functions 
 **/
if (! function_exists('is_https')) {

	function is_https()
	{
		if (isset($_SERVER['HTTPS']) === 'on') {
			return true;
		}

		return false;
	}
}

if (! function_exists('get_hostname')) {

	function get_hostname()
	{
		return isset($_SERVER['HTTP_HOST'])
			? $_SERVER['HTTP_HOST']
			: 'localhost';
	}
}

if (! function_exists('base_url')) {

	function base_url($path = '')
	{
		global $config;
		
		$uri = '';
		
		if (! $config->base_url) {

			$protocol = is_https() ? 'https' : 'http';
			$hostname = get_hostname();

			$uri = "{$protocol}://{$hostname}/";			
		} else {

			$uri = $config->base_url;
		}

		if ($path) {
			$uri .= $path;
		}

		return $uri;
	}
}
