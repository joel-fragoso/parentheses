<?php

/*
 *-------------------------------------------------------
 * Front-Controller
 *-------------------------------------------------------
 * 
 * Ponto de partida da aplicação
 *
 */

/*
 *-------------------------------------------------------
 *	Define o Ambiente de Trabalho da Aplicação
 *-------------------------------------------------------
 */
defined('ENVIRONMENT')
	OR define(
		'ENVIRONMENT',
		(isset($_SERVER['PAT_ENV']))
			? $_SERVER['PAT_ENV']
			: 'development'
	);

// Verifica qual é o ambiente de trabalho e
// habilida/desabilita a exibição de erros
switch (ENVIRONMENT) {
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
		break;
	case 'testing':
	case 'production':
		error_reporting('E_ALL ~E_NOTICE ~E_STRICT ~E_USER_NOTICE');
		ini_set('display_errors', 0);
		break;
	default:
		echo "Não foi possível identificar o ambiente de trabalho.";
		exit(1); // EXIT_ERROR
		// no break
}

/*
 *-------------------------------------------------------
 *	Pasta do Sistema
 *-------------------------------------------------------
 */
$system_path = 'system';

/*
 *-------------------------------------------------------
 *	Pasta da Aplicação
 *-------------------------------------------------------
 */
$application_folder = 'application';

/*
 *-------------------------------------------------------
 *	Pasta da Visualização
 *-------------------------------------------------------
 */
$view_folder = '';

/*
 *-------------------------------------------------------
 *	Abreviação da constante DIRECTORY_SEPARATOR (DS)
 *-------------------------------------------------------
 */
defined('DS')
	OR define('DS', DIRECTORY_SEPARATOR);

/*
 *-------------------------------------------------------
 *	Define o caminho até a pasta raiz
 *-------------------------------------------------------
 */
defined('ROOTPATH')
	OR define('ROOTPATH', dirname(__DIR__) . DS);

/*
 *-------------------------------------------------------
 *	Define o caminho até o Front-Controller (index.php)
 *-------------------------------------------------------
 */
defined('FCPATH')
	OR define('FCPATH', pathinfo(__FILE__, PATHINFO_BASENAME));

/*
 *-------------------------------------------------------
 *	Verifica a existência e Define a pasta do Sistema
 *-------------------------------------------------------
 */
if (! file_exists(ROOTPATH . $system_path . DS)) {
	echo "A pasta {$system_path} não existe.";
	exit(3); // EXIT_CONFIG
}

defined('SYSPATH')
	OR define('SYSPATH', ROOTPATH . $system_path . DS);

/*
 *-------------------------------------------------------
 *	Verifica a existência e Define a pasta da Aplicação
 *-------------------------------------------------------
 */
if (! file_exists(ROOTPATH . $application_folder . DS)) {
	echo "A pasta {$application_folder} não existe.";
	exit(3); // EXIT_CONFIG
}

defined('APPPATH')
	OR define('APPPATH', ROOTPATH . $application_folder . DS);

/*
 *-------------------------------------------------------
 *	Verifica a existência e Define a pasta de Visualização
 *-------------------------------------------------------
 */
if (! file_exists(APPPATH . $view_folder . DS)) {
	echo "A pasta {$view_folder} não existe.";
	exit(3); // EXIT_CONFIG
} elseif (! file_exists(APPPATH . 'Views' . DS)) {
	echo 'A pasta Views não existe.';
	exit(3); // EXIT_CONFIG
}

defined('VIEWPATH')
	OR define(
		'VIEWPATH',
		(! empty($view_folder))
			? APPPATH . $view_folder
			: APPPATH . 'Views' . DS
	);

/*
 *-------------------------------------------------------
 *	Verifaca a existência e carrega o Autoloading
 *-------------------------------------------------------
 */
if (! file_exists(ROOTPATH . 'vendor' . DS . 'autoload.php')) {
	echo 'O arquivo de autoload não existe. Por favor execute no terminal o comando: composer install';
	exit(3); // EXIT_CONFIG
}

// inclui o Autoloading do Composer
require_once ROOTPATH . 'vendor' . DS . 'autoload.php';

/*
 *-------------------------------------------------------
 *	Define as constantes
 *-------------------------------------------------------
 */
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1);
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3);

/*
 *-------------------------------------------------------
 *	Carrega as configurações
 *-------------------------------------------------------
 */
$config = new \Parentheses\Config\Config();

// Carrega os arquivos de configurações padrões
$config->load('config');
$config->load('database');

/*
 *-------------------------------------------------------
 *	Inclui as funções comuns
 *-------------------------------------------------------
 */
 require_once SYSPATH . 'parentheses' . DS . 'Core' . DS . 'Common.php';

/*
 *-------------------------------------------------------
 *	Executa a aplicação
 *-------------------------------------------------------
 */
$app = new \Parentheses\Core\Parentheses($config);
$app->run();
