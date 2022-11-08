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
            
            $empresa = new Empresa;  
            $empresa->nome = $_POST['nome'];  
            $empresa->cnpj = $_POST['cnpj'];     
            $empresa->data_fund = $_POST['data_fund'];
            $empresa->email = $_POST['email'];  
            $empresa->telefone = $_POST['telefone'];  
            $empresa->cep = $_POST['cep'];  
            $empresa->endereco = $_POST['endereco'];
            

            $idUsuario = $_SESSION['idusuario'];

            $sql = "INSERT INTO empresas (nome,cnpj,data_fund,email,telefone,cep,endereco,id_usuario) 
            VALUES ('$empresa->nome', '{$empresa->cnpj}', '{$empresa->data_fund}', '{$empresa->email}',
            '{$empresa->telefone}','{$empresa->cep}', '{$empresa->endereco}', '{$idUsuario}')";
           
            $result = $conexao->query($sql);

            header('Location: http://localhost/cadastro-empresas/cadastroEmpresas');
            return $result;  
            
        }

        public function getEmpresa() {
            $conexao = Config::getConexao();

            $idUsuario = $_SESSION['idusuario'];

            $sql = "SELECT id_empresa, nome, cnpj, data_fund, email, telefone, cep, endereco 
            FROM empresas WHERE id_usuario = $idUsuario ORDER BY id_empresa DESC";

            $result = $conexao->query($sql);

            if($result->rowCount() >= 1){
                echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));
            } else { 
                echo json_encode('<br>Este usuário ainda não possui empresas cadastradas.<br>');
            }

        }

        public function deleteEmpresa($id){
            $conexao = Config::getConexao();
            
            // $sql = "SELECT * FROM empresas";

            // $resultSql = $conexao->query($sql);

            // $dados = $resultSql->fetch();

            // $idEmpresa = $dados['id_empresa'];    

            //if($resultSql->rowCount() >= 1){
                $sqlDelete = "DELETE FROM empresas WHERE id_empresa = $id";
                $conexao->query($sqlDelete);
            //}
           
            header('Location: http://localhost/cadastro-empresas/home');
        }
    

        public function consultarCep(){

            $empresa = new Empresa;
            $cep = $empresa->cep = $_GET['cep'];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'http://m.correios.com.br/movel/buscaCepConfirma.do'.$cep
            ]);

        }

    }

?>