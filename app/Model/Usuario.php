<?php

    namespace app\Model;

    class Usuario{
        public $idUsuario;
        public $nome;
        public $email;
        public $senha;
        public $empresa;

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