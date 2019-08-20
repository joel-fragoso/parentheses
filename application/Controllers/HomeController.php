<?php

namespace App\Controllers;

use Parentheses\Core\Controller;

class HomeController extends Controller
{
	public function index($params = [])
	{
		var_dump($params);
		$this->view('home/index');
	}
	
	public function edit($params = [])
	{
		echo 'Edit';
	}
}
