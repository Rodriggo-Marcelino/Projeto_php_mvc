<?php

namespace App\Http;

class Router{

    /**
     * URL completa do projeto(raiz do projeto)
     * @var string
    */
 	private $url = '';

	/**
     * Prefixo de todas as rotas
     * @var string
    */
	private $prefix='';

	/**
     * Indice de rotas
     * @var array
    */
	private $routes = [];

	/**
     * Instancia do Request
     * @var Request
    */
	private $request;

	/**
     * Metodo responsavel por iniciar a classe
     * @param string $url
    */
	public function __construct($url){
		$this->request = new Request();
		$this->url = $url;
	}
}