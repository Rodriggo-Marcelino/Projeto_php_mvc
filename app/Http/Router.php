<?php

namespace App\Http;

use \Closure;

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
        $this->setPrefix(); 
	}

    /**
     * metodo responsavel por definir o prefixo das rotas 
     */
    private function setPrefix(){
        //informações da url atual 
        $parseUrl = parse_url($this->url);
        //define o prefixo da url 
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * Metodo responsavel por adicionar uma rota na classe
     * @param string $method
     * @param string $route
     * @param array $params
     */
    private function addRoute($method, $route, $params = []){
        // Validação dos parametros
        foreach($params as $key=>$value){
            if($value instanceof Closure){
                $params['controller']= $value;
                unset($params[$key]);
                continue;
            }
        } 

        $patternRoute = str_replace('/', '\/',$route);

        echo "<pre>";
        print_r($patternRoute);
        echo "</pre>";
        exit;

        echo "<pre>";
        print_r($params);
        echo "</pre>";
        exit;
    }

    /**
     * Metodo responsavel por definir uma rota de get 
     * @param string $route 
     * @param array $params 
    */
    public function get($route, $params = []){
        return $this->addRoute('GET', $route, $params);
    }
}