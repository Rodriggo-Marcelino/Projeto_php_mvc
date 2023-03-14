<?php

    require __DIR__.'/vendor/autoload.php';

	use \App\Http\Router;
    use \App\Controller\Pages\Home;

	define('URL','http://localhost/mvc');
	
	$obRouter  = new router(URL);
	
	echo "<pre>";
	print_r($obRouter);
	echo "</pre>";

	exit;
    echo Home::getHome();