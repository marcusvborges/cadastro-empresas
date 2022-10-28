<?php

    namespace app\Validator;

    class Validator {

        public static function validaSenha($senha){
            if(preg_match('/^(?=.*\d)(?=.*[A-z])[0-9a-zA-Z$*&@#]{7,}$/', $senha)){
                return true;
            } else { 
                return false;
            }
            
        }

        public static function validaEmail($email){ 
            if(preg_match('/^[a-z0-9.]+@[a-z0-9]+\.[a-z]+\.([a-z]+)?$/i', $email)){
                return true;
            } else { 
                return false;
            }
        }

    }

?>