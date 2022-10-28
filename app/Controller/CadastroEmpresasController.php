<?php

    use app\Utils\RenderView;
    use app\Data\Config;
    use app\Model\Usuario;

    class CadastroEmpresasController extends GenericController{
        
        public function getPage(){
            echo RenderView::render('cadastroEmpresas');
        }


        public function postEmpresa(){

            $conexao = Config::getConexao();
            
            $usuario = new Usuario;
            $empresa = new Empresa;  
            $empresa->nome = $_POST['nome'];  
            $empresa->cnpj = $_POST['cnpj'];     
            $empresa->data_fund = $_POST['data_fund'];
            $empresa->email = $_POST['email'];  
            $empresa->telefone = $_POST['telefone'];  
            $empresa->cep = $_POST['cep'];  
            $empresa->endereco = $_POST['endereco'];
            //$usuario->idUsuario = $_POST['id_usuario'];
       
            $idUsuario = intval($usuario->idUsuario);

            $sql = "INSERT INTO empresas (nome,cnpj,data_fund,email,telefone,cep,endereco,id_usuario) 
            VALUES ('$empresa->nome', '$empresa->cnpj', '$empresa->data_fund', '$empresa->email',
            '$empresa->telefone','$empresa->cep', '$empresa->endereco', $idUsuario)";
           
            $result = $conexao->query($sql);

            //$result->bindValue(':id_usuario', $usuario->idUsuario);

            //$_SESSION['id_usuario'] = $usuario->idUsuario;

            header('Location: http://localhost/cadastro-empresas/cadastroEmpresas');
            return $result;  
            
        }

    }

?>