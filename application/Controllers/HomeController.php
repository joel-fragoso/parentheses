<?php

namespace App\Controllers;

use Parentheses\Core\Controller;

class HomeController extends Controller
{
	public function index()
	{
		$this->view('home/index');
	}
}
