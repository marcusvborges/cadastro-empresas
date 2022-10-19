<?php 

    class Usuario{
        private$id;
        private $nome;
        private $login;
        private $password;
        private$empresa;

        public function __construct()
        {
            $this->empresa = array();
        }

    }

?>