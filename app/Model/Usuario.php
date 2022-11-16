<?php

    namespace app\Model;

    use app\Data\Config;
    use app\Validator\Validator;

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

        // public static function buscarUsuarios(){ 
        //     $conexao = Config::getConexao();

        //     $sql = "SELECT id_usuario, nome, email, senha FROM usuarios";

        // }


        // public static function buscarIdUsuario(){
        //     $conexao = Config::getConexao();

        //     $usuario = new Usuario();

        //     $idUsuario = $usuario->idUsuario = $_SESSION['id_usuario'];

        //     $sql = "SELECT id_usuario FROM usuarios WHERE id_usuario = $idUsuario";

        //     $result = $conexao->query( $sql);

        //     return $result;
        // }

        // public static function cadastrar($dados){

        //     $conexao = Config::getConexao();

        //     $sql = "INSERT INTO usuarios (nome,email,senha) VALUES (:nome, :email, :senha)";
           
        //     $result = $conexao->query($sql);
           
        //     $result->bindValue("nome", $dados['nome']);
        //     $result->bindValue("email", $dados['email']);
        //     $result->bindValue("senha", $dados['senha']);

        //     if ($conexao){
        //         return true;
        //     }else {
        //         return false;
        //     }
        // }

    }

?>