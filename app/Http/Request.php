<?php

namespace App\Http;

class Request{

    /**
     * medodo http da requisição
     * @var string
     */
    private $httpMethod;

    /**
     * URI DA PAGINA 
     * @var string
     */
    private $uri;

    /**
     * Parametros da url ($_GET)
     * @var array 
     */
    private $queryParams = [];

    /**
     * Variaveis recebidas no post da pagina
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição
     * @var array
     */
    private $headers =[];

    /**
     * construtor da classe
     */
    public function __construct(){
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['RESQUEST_URI'] ?? '';

    }

    /**
     * metodo responsavel por retornar o metodo http da requisição
     * @return string
     */
    public function getHttpMethod(){
        return $this->httpMethod;
    }

    /**
     * metodo responsavel por retornar a uri da requisição
     * @return string
     */
    public function getUri(){
        return $this->uri;
    }

    /**
     * metodo responsavel por retornar o headers da requisição
     * @return array
     */
    public function getHeaders(){
        return $this->headers;
    }

    /**
     * metodo responsavel por retornar os parametros da url da requisição
     * @return array
     */
    public function getQueryParams(){
        return $this->queryParams;
    }

     /**
     * metodo responsavel por retornar as variaveis post da requisição
     * @return array
     */
    public function getPostVars(){
        return $this->postVars;
    }


}