<?php

namespace App\Model\Entity;

class Testimony{
    /**
     * ID do depoimento
     * @var integer
     */
    public $id;

    /**
     * Nome do usuario 
     * @var string
     */
    public $nome;

    /**
     * Mensagem digitada pelo usuario 
     * @var string
     */
    public $mensagem;

    /**
     * Data de publicação do documento
     * @var string
     */
    public $date;

    /**
     * Método responsavel por cadastrar a instancia atual no banco de dados  
     * @return boolean
     */
    public function cadastrar(){
        echo "<pre>";
        print_r($this);
        echo "</pre>"; exit;
    }

}