<?php

    use app\Utils\RenderView;

    class HomeController extends GenericController{
        
        public function getPage(){
            echo RenderView::render('home');
        }

        public function logout(){
            unset($_SESSION['idusuario']);
            session_destroy();

            header('Location: http://localhost/cadastro-empresas/login');
        }

    }

?>