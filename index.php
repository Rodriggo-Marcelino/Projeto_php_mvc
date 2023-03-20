<?php

    require __DIR__.'/vendor/autoload.php';

	use \App\Http\Router;
	use \App\Utils\View;
    use \WilliamCosta\DotEnv\Environment;

	//carrega variaveis de ambiente
	Environment::load(__DIR__);

	//DEFINE A CONSTANTE DE URL DO PROJETO
	define('URL',getenv('URL'));

	//DEFINE O VALOR PADRÃO DAS VARIAVEIS  
	View::init([
		'URL' => URL
	]);
	
	//INICIA O ROUTER 
	$obRouter = new Router(URL);

	//inclui as rotas de paginas 
	include __DIR__.'/routes/pages.php';

	//imprime o response da rota
	$obRouter->run()
			->sendResponse();

	
