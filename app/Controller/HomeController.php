<?php

    use app\Utils\RenderView;

    class HomeController extends GenericController{
        
        public function getPage(){
            echo RenderView::render('home');
        }

    }

?>