<?php
namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Testimony as EntityTestimony;

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

    /**
     * Metodo responsavel por cadastrar um depoimento 
     * @param  Request $request
     * @return string 
     */
    public static function insertTestimony($request){
        //dados do post
        $postVars = $request -> getPostVars();
        //nova instancia 
        $obTestimony = new EntityTestimony;
        $obTestimony->nome = $postVars['nome'];
        $obTestimony->mensagem = $postVars['mensagem'];
        $obTestimony->cadastrar();
        return self::getTestimonies();
    }
}
