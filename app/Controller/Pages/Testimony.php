<?php
namespace App\Controller\Pages;

use \App\Utils\View;


class Testimony extends Page{
    /** 
     * Método responsavel pelo conteudo (view) da nossa pagina de testemunha
     * @return string
    */
    public static function getTestimonies(){
      
        
        //view de depoimentos
         $content = View::render('pages/testimonies',[
            
         ]);
         
         //retorna a view da pagina
         return parent ::getPage('DEPOIMENTOS > Rodrigo', $content);
    }
}
