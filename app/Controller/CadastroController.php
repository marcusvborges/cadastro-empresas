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
            header('Content-Type: application/json');
            //include_once("../Data/Config.php");
            $conexao = Config::getConexao();
        
            $usuario = new Usuario();  
        
            if( isset($_POST['nome']) || isset($_POST['email']) || isset($_POST['senha']))  { 
                $nome = $usuario->nome = $_POST['nome'];  
                $email = $usuario->email = $_POST['email'];                  

                if($_POST['senha'] != Validator::validaSenha($_POST['senha'])) {
                                                                 
                    $msgErro = '*A senha deve conter letras e numeros com, no minimo, 7 caracteres.';                 
                    echo json_encode($msgErro);                   
                                          
                } else { 

                    $senha = $usuario->senha = $_POST['senha'];
                    
                    $sql = "INSERT INTO usuarios (nome,email,senha) VALUES (:nome, :email, :senha)";
            
                    $result = $conexao->prepare($sql);

                    $result->bindValue(':nome', $nome);
                    $result->bindValue(':email', $email);
                    $result->bindValue(':senha', $senha);
                    $result->execute();

                    header('Location: http://localhost/cadastro-empresas/login');
                    
                    echo json_encode('Usuario cadastrado com sucesso!');
              
                }   
           }            
                               
        }

    }

?>