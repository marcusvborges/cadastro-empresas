<?php

    use app\Utils\RenderView;
    use app\Data\Config;
    use app\Model\Usuario;

    class EditarEmpresaController extends GenericController{
        
        public function getPage(){
            echo RenderView::render('editarEmpresa');
        }

        public function editEmpresa(){
            //include_once("../Data/Config.php");
            $conexao = Config::getConexao();

            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (empty($dados['nome'])) {
                $retorno = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
            } elseif (empty($dados['cnpj'])) {
                $retorno = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo CNPJ!</div>"];
            } elseif (empty($dados['data_fund'])) {
                $retorno = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Data!</div>"];
            } elseif (empty($dados['email'])) {
                $retorno = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Email!</div>"];
            } elseif (empty($dados['telefone'])) {
                $retorno = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Telefone!</div>"];
            } elseif (empty($dados['cep'])) {
                $retorno = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo CEP!</div>"];
            } elseif (empty($dados['endereco'])) {
                $retorno = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Endereco!</div>"];
            } else { 

                
                $sqlUpdate = "UPDATE empresas SET nome=:nome, cnpj=:cnpj, data_fund=:data_fund, email=:email,
                 telefone=:telefone, cep=:cep, endereco=:endereco WHERE id_empresa = :id_empresa";

                $edit_empresa = $conexao->prepare($sqlUpdate);
               
                $edit_empresa->bindParam(':nome', $dados['nome']);
                $edit_empresa->bindParam(':cnpj', $dados['cnpj']);
                $edit_empresa->bindParam(':data_fund', $dados['data_fund']);
                $edit_empresa->bindParam(':email', $dados['email']);
                $edit_empresa->bindParam(':telefone', $dados['telefone']);
                $edit_empresa->bindParam(':cep', $dados['cep']);
                $edit_empresa->bindParam(':endereco', $dados['endereco']);
                $edit_empresa->bindParam(':id_empresa', $dados['id_empresa']);

                if ($edit_empresa->execute()) { 
                    $retorno = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Empresa editada com sucesso!</div>"];
                } else {
                    $retorno = ['status' => false, 'msg' => "<div class='alert alert-success' role='alert'>Empresa não foi editada com sucesso!</div>"];
                }

            }
                echo json_encode($retorno);
        }

        public function getEmpresaById($id) {
            //include_once("../Data/Config.php");
            $conexao = Config::getConexao();

            if(!empty($id)){
                $sqlGetById = "SELECT * FROM empresas WHERE id_empresa = $id";   
                $result = $conexao->query($sqlGetById);

                if(($result) and ($result->rowCount() != 0)){
                    $row_empresa = $result->fetch(PDO::FETCH_ASSOC);
                    $retorno = ['status' => true, 'dados' => $row_empresa];
                } else {
                    $retorno = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma empresa encontrado!</div>"];
                }

            } else {
                $retorno = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhuma empresa encontrado!</div>"];
            }

            echo json_encode($retorno); 

        }

    }
    
?>