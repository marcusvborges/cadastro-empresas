<?php

    use app\Utils\RenderView;

    class HomeController extends GenericController{
        
        public function getPage(){
            return RenderView::render('home');
        }

    }

?>