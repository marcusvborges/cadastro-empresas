<?php

    use app\Utils\RenderView;
    use app\Data\Config;

    class CadastroController extends GenericController{
             
        public function getPage(){
            
            echo RenderView::render('cadastro');
           
        }

        public function postUsuario(){

            $conexao = Config::getConexao();
            
            $usuario = new Usuario;  
            $usuario->nome = $_POST['nome'];  
            $usuario->email = $_POST['email'];     
            $usuario->senha = $_POST['senha'];

            $sql = "INSERT INTO usuarios (nome,email,senha) VALUES ('$usuario->nome', '$usuario->email', '$usuario->senha')";
           
            $result = $conexao->query($sql);

            header('Location: http://localhost/cadastro-empresas/cadastro');
            return $result;  
            
        }

    }

?>