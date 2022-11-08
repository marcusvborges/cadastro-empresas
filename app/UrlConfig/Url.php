<?php 

    class Url { 
        private $url;
        private $controller;
        private $method = 'getPage';

        private $user;

        public function __construct()
        {
            $this->user = $_SESSION['idusuario'] ?? null;
        }

        public function start($request)
        {
            if(isset($request['url'])){

                $this->url = explode('/', $request['url']);
            
                $this->controller = ucfirst($this->url[0]).'Controller'; 
                array_shift($this->url);
    
                if(isset($this->url[0]) && $this->url != ''){
                    $this->method = $this->url[0];
                    array_shift($this->url);
              
                }
            }

            if($this->user){
                $pg_permission = ['HomeController', 'CadastroEmpresasController', 'EditarEmpresaController'];

                if(!isset($this->controller) || !in_array($this->controller, $pg_permission)){
                    $this->controller = 'HomeController';
                    $this->method = 'getPage';
                }

            } else { 
                $pg_permission = ['LoginController', 'CadastroController'];

                if(!isset($this->controller) || !in_array($this->controller, $pg_permission)){
                    $this->controller = 'LoginController';
                    $this->method = 'getPage';
                }
            }

            //var_dump($request);
            if(isset($request['id']) && $request['id'] != null){
                $id = $request['id'];
            } else{
                $id = null;
            }

            return call_user_func(array(new $this->controller, $this->method), $id);        
            
           
           
        }
        

    }

?>