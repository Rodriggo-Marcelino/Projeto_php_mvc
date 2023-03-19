<?php

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;

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
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        } 

        //variaveis da rota 
        $params['variables'] = [];

        //padrão de validação das variaveis das rotas
        $patternVariable  = '/{(.*?)}/';
        if(preg_match_all($patternVariable,$route,$matches)){
           $route = preg_replace($patternVariable,'(.*?)',$route);
           $params['variables'] = $matches[1];
        }

        //padrão de validação da url
        $patternRoute = '/^'.str_replace('/', '\/',$route).'$/';
        
        //adiciona a rota dentro da classe
        $this -> routes [$patternRoute][$method] = $params;
    }

    /**
     * Metodo responsavel por definir uma rota de get 
     * @param string $route 
     * @param array $params 
    */
    public function get($route, $params = []){
        return $this -> addRoute('GET', $route, $params);
    }

    /**
     * Metodo responsavel por definir uma rota de post 
     * @param string $route 
     * @param array $params 
    */
    public function post($route, $params = []){
        return $this -> addRoute('POST', $route, $params);
    }

    /**
     * Metodo responsavel por definir uma rota de put 
     * @param string $route 
     * @param array $params 
    */
    public function put($route, $params = []){
        return $this -> addRoute('PUT', $route, $params);
    }

    /**
     * Metodo responsavel por definir uma rota de delete 
     * @param string $route 
     * @param array $params 
    */
    public function delete($route, $params = []){
        return $this -> addRoute('DELETE', $route, $params);
    }

    /**
     *Metodo responsavel por retornar a uri desconsiderando o prefixo
     * @return string
     */
    private function getUri(){
        //uri da request
        $uri = $this->request->getUri();

        // fatia a uri com o prefixo
        $xUri = strlen($this->prefix) ? explode($this->prefix,$uri) : [$uri];

        //RETORNA A URI SEM PREFIXO
        return end($xUri);
    }

    /**
     * Metodo responsavel por retornar os dados da rota atual
     * @return array
     */
    private function getRoute(){
        //uri
        $uri = $this->getUri();

        //method
        $httpMethod = $this -> request -> getHttpMethod();

        //valida as rotas
        foreach($this->routes as $patternRoute=>$methods){
            //verifica se a uri bate o padrão
            if(preg_match($patternRoute,$uri,$matches)){
                //verifica o metodo
                if(isset($methods[$httpMethod])){
                    //remove a primeria posição 
                    unset($matches[0]);
                    
                    //variaveis processadas
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys,$matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    //retorno dos parametros da rota
                    return $methods[$httpMethod];
                }
                //metodo não permitido
                throw new Exception("Metodo não é permitido", 405);
            }
        }
        //url não encontrada
        throw new Exception("URL NÃO ENCONTRADA", 404);

    }

    /**
     * metodo responsavel por executar a rota atual
     * @return Response
    */
    public function run(){
        try{
            //obtem a rota atual
            $route = $this -> getRoute();
            
            //verifica controlador
            if(!isset($route['controller'])){
                throw new Exception("A url não pode ser processada",500);
            }

            //ARGUMENTOS DA FUNÇÃO 
            $args = [];

            //REFLECTION 

            $reflection = new ReflectionFunction($route['controller']);
            foreach($reflection->getParameters() as $parameter){
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            
            }
            
            //RETORNA A EXECUÇÃO DA FUNÇÃO
            return call_user_func_array($route['controller'], $args);

        }catch(Exception $e){
            return new Response($e -> getCode(), $e -> getMessage());
        }
    }
}