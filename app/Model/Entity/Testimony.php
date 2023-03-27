<?php

namespace App\Model\Entity;
use WilliamCosta\DatabaseManager\Database;

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
        //define a data
        $this->date = date('Y-m-d H:i:s');

        //insere o depoimento no banco de dados
        $this->id = (new Database('depoimentos')) -> insert([
            'nome' => $this->nome,
            'mensagem' => $this->mensagem,
            'data' => $this->date
        ]);
        echo "<pre>";
        print_r($this);
        echo "</pre>"; exit;
    }

}