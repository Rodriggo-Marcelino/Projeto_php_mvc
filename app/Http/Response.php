<?php 

namespace App\Http;

class Response{
    /**
     * implementando o codigo do status http
     */
    private $httpCode = 200;

    /**
     * cabeçalho do response
     * @var array
     */
    private $headers = [];

    /**
     * tipo de conteudo que está sendo retornado 
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Conteudo do response
     * @var mixed
     */

    private $content;

    /**
     * Método responsavel por iniciar a classe e definir os valores
     * @param integer $httpCode
     * @param mixed $content
     * @param string $contentType
     */

    public function __construct($httpCode, $content, $contentType = 'text/html'){
        $this-> httpCode = $httpCode;
        $this-> content = $content;
        $this-> setContentType($contentType);
        
    }

    /**
     * metodo responsavel por alterar o content type do response
     * @param string $content type
      */
    public function setContentType($contentType){
        $this->contentType = $contentType;
        $this->addHeader('Content-Type',$contentType);
    }

    /**
     * metodo responsavel por adicionar um registro no cabeçalho de response
     * @param string $key
     * @param string $value
     */
    public function addHeader($key, $value){
        $this->headers[$key] = $value;
    }
}