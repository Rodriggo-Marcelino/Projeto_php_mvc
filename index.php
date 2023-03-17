<?php

    require __DIR__.'/vendor/autoload.php';

	use \App\Http\Router;
    

	define('URL','http://localhost/mvc');
	
	$obRouter = new Router(URL);

	//inclui as rotas de paginas 
	include __DIR__.'/routes/pages.php';

	//imprime o response da rota
	$obRouter->run()
			->sendResponse();

	
