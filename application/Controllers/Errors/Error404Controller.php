<?php

namespace App\Controllers\Errors;

use Parentheses\Core\Controller;

class Error404Controller extends Controller
{
	public function index($params = [])
	{
		header('HTTP/1.1 404 Page Not Found', 404);
		$this->view('errors/404', $params);
	}
}
