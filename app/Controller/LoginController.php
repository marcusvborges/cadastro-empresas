<?php

    use app\Utils\RenderView;

    class LoginController extends GenericController{
        
        public function getPage(){
            
            return RenderView::render('login'); 

        }

        

    }

?>