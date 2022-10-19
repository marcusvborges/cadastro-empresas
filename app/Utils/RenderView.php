<?php 

    namespace App\Utils;

    class RenderView
    {
        public static function getView($view){
            $file = __DIR__.'/../View/'.$view.'.html';
            return file_exists($file) ? file_get_contents($file) : 'Falha ao buscar arquivo';
        }

        public static function render($view){
            $conteudo = self::getView($view);

            return $conteudo;
        }

        
    }

?>