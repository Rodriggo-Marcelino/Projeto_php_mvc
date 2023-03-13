<?php
namespace App\Controller\Pages;

use \App\Utils\View;

class Page{
    /**
     * metodo responsavel por rederizar o topo da pagina
     * @return string
     */
    private static function getHeader(){
        return View::render('pages/header');
    }

    private static function getFooter(){
        return View::render('pages/footer');
    }
    /** 
     * Método responsavel por retornar o conteudo da pagina
     * @return string
    */
    public static function getPage($title, $content){
         return View::render('pages/page',[
            'title' => $title,
            'header' => self::getHeader(),
            'footer' => self::getFooter(),
            'content' => $content
         ]);
    }
}
