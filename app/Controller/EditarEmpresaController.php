<?php

    use app\Utils\RenderView;
    use app\Data\Config;
    use app\Model\Usuario;

    class EditarEmpresaController extends GenericController{
        
        public function getPage(){
            echo RenderView::render('editarEmpresa');
        }

        public function editEmpresa(){
        
            $conexao = Config::getConexao();

            $empresa = new Empresa;  
            $empresa->nome = $_POST['nome'];  
            $empresa->cnpj = $_POST['cnpj'];     
            $empresa->data_fund = $_POST['data_fund'];
            $empresa->email = $_POST['email'];  
            $empresa->telefone = $_POST['telefone'];  
            $empresa->cep = $_POST['cep'];  
            $empresa->endereco = $_POST['endereco'];

            $sql = "SELECT * FROM empresas";

            $resultSql = $conexao->query($sql);

            $dados = $resultSql->fetch();

            $idEmpresa = $dados['id_empresa'];
            
            $sqlUpdate = "UPDATE empresas SET nome='$empresa->nome', cnpj='$empresa->cnpj', data_fund='$empresa->data_fund', 
            email='$empresa->email', telefone='$empresa->telefone', cep='$empresa->cep', endereco='$empresa->endereco'
            WHERE id_empresa =$idEmpresa";

            $conexao->query($sqlUpdate);

            header('Location: http://localhost/cadastro-empresas/home');
        }

        public function getEmpresaById($id) {
  
            $conexao = Config::getConexao();

            // $sql = "SELECT * FROM empresas";

            // $resultSql = $conexao->query($sql);

            // $dados = $resultSql->fetch();

            // $id = $dados['id_empresa'];
   

            //if($resultSql->rowCount() >= 1){
                $sqlGetById = "SELECT * FROM empresas WHERE id_empresa = $id";   
                $result = $conexao->query($sqlGetById);

                echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));
                //header('Location: http://localhost/cadastro-empresas/editarEmpresa');
            //} 

        }

    }
    
?>