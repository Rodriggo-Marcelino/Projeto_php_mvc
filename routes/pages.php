<?php

    
	use \App\Http\Response;
    use \App\Controller\Pages;

	/**
	 * verificar bub na / pos mvc da definição da url principal 
	 * obs ganbiarra feira no header concatenando / manualmente
	 */

    //ROTA HOME
	$obRouter->get('/',[
		function (){
			return new Response(200,Pages\Home::getHome());
		}
	]);

	//rota sobre
	$obRouter->get('/sobre',[
		function (){
			return new Response(200,Pages\About::getAbout());
		}
	]);

	//rota dinamica
	$obRouter->get('/pagina/{idPagina}/{acao}',[
		function ($idPagina,$acao){
			return new Response(200,'pagina '.$idPagina.' - '.$acao);
		}
	]);