<?php

    use app\Utils\RenderView;

    class CadastroController extends GenericController{
        
        public function getPage(){
            
           return RenderView::render('cadastro');
           
        }


    }

?>