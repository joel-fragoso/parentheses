<?php

namespace App\Controllers\Errors;

use Parentheses\Core\Controller;

class Error404Controller extends Controller
{
	public function index($params = [])
	{
		$this->view('errors/404', $params);
	}
}
