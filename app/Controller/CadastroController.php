<?php

    use app\Utils\RenderView;
    use app\Data\Config;
    use app\Model\Usuario;
    use app\Validator\Validator;

    class CadastroController extends GenericController{
             
        public function getPage(){

            echo RenderView::render('cadastro');
           
        }

        public static function postUsuario(){

            $conexao = Config::getConexao();
            
            $usuario = new Usuario();  
            $usuario->nome = $_POST['nome'];  
            $usuario->email = $_POST['email'];     
            
                if(Validator::validaSenha($_POST['senha'])) {
                    $usuario->senha = $_POST['senha'];
                    $sql = "INSERT INTO usuarios (nome,email,senha) VALUES ('$usuario->nome', '$usuario->email', '$usuario->senha')";
            
                    $result = $conexao->query($sql);

                    header('Location: http://localhost/cadastro-empresas/cadastro');
                    return $result; 
                } else {
                   echo json_encode("*A senha deve conter letras e numeros com, no minimo, 7 caracteres."); 
                     
                    //$parameters['erro'] = '*A senha deve conter letras e números com, no mínimo, 7 caracteres.';
                    //header('Location: http://localhost/cadastro-empresas/cadastro');
                }
             
            
        }

    }

?>