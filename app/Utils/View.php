<?php

namespace App\Utils;
class View{ 

    /**
     * variaveis padrão da view
     * @var array
     */
    private static $vars = [];

    /**
     * metodo responsavel por definir os dados adicionais da rota 
     * @param array $vars
    */
    public static function init($vars =[]){
        self::$vars = $vars;
    }

    /**
     * Método responsavel por retornar o conteudo de uma view
     * @param string $view
     * @return string
     */
    private static function getContentView($view){
        $file = __DIR__ .'/../../resources/view/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
        }
    /**
     * metodo responsavel por retornar um conteudo renderisado de uma view
     * @param string $view
     * @param array $vars (string/numeric)
     * @return string
     */
    public static function render($view, $vars = []){
        //conteudo da view
        $contentView = self::getContentView($view);

        // merge de variaveis da view
        $vars = array_merge(self::$vars,$vars);

        //CHAVES DOS ARRAYS DE VARIAVEIS
        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        },$keys);
        // RETORNA O CONTEUDO RENDERIZADO
        return str_replace($keys,array_values($vars), $contentView);
    }
}