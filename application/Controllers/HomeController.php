<?php

namespace App\Controllers;

use Parentheses\Core\Controller;

class HomeController extends Controller
{
	public function index($params = [])
	{
		$this->view('home/index', $params);
	}
	
	public function edit($params = [])
	{
		$id = isset($params[2]) ? $params[2] : '';

		$data = [
			'id' => $id
		];

		$this->view('home/edit', $data);
	}
}
