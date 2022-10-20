<?php

    use app\Data\Config;    
    //use app\Data\DbConfig;
    use LDAP\Result;

    class Usuario{
        private$id;
        private $nome;
        public $email;
        public $senha;
        private$empresa;

        public function __construct()
        {
            $this->empresa = array();
        }
      

        public function setNome($nome){
            $this->nome  = $nome;
        }
        public function setEmail($email){
            $this->email  = $email;
        }
        public function setSenha($senha){
            $this->senha  = $senha;
        }

        public function getNome(){
            return $this->nome;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getSenha(){
            return $this->senha;
        }


    }

?>