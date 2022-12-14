<?php

    use app\Data\Config;
    use app\Utils\RenderView;
    use app\Model\Usuario;

    class LoginController extends GenericController{
        
        public function getPage(){
            
            echo RenderView::render('login'); 

        }

        public function verificaLogin()
        {
            //include_once("../Data/Config.php");
            if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){           
                
                $conexao = Config::getConexao();

                $usuario = new Usuario();
                $usuario->email =  $_POST['email'];
                $usuario->senha =  $_POST['senha'];


                $sql = "SELECT * FROM usuarios WHERE email = '$usuario->email' and senha = '$usuario->senha'";
                
                $result = $conexao->query($sql);


                if($result->rowCount()){
                    $dados = $result->fetch();
                    
                    $_SESSION['idusuario'] = $dados['id_usuario'];
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['senha'] = $usuario->senha;

                    header('Location: http://localhost/cadastro-empresas/home');                     
                    
                } else { 
                    unset($_SESSION['email']);
                    unset($_SESSION['senha']);
                    header('Location: http://localhost/cadastro-empresas/login');
                    throw new \Exception('Login ou senha invalido!');
                } 

            } else {               
                header('Location: http://localhost/cadastro-empresas/login');
            }
                
            
        }
      

    }

?>