<?php

namespace Parentheses\Core;

class Controller
{
	public function view($view, $data = [])
	{
		if (! file_exists(VIEWPATH . $view . '.php')) {
			echo "O arquivo {$view}.php não existe.";
			exit(3); //EXIT_CONFIG
		}

		extract($data);
		require_once VIEWPATH . $view . '.php';
	}
}
