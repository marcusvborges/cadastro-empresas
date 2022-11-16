<?php

    use app\Utils\RenderView;
    use app\Data\Config;
    use app\Model\Usuario;

    class CadastroEmpresasController extends GenericController{
        
        public function getPage(){
            echo RenderView::render('cadastroEmpresas');
        }


        public function postEmpresa(){
            //include_once("../Data/Config.php");
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

            $pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

            $idUsuario = $_SESSION['idusuario'];

            $sql = "SELECT id_empresa, nome, cnpj, data_fund, email, telefone, cep, endereco, id_usuario
            FROM empresas WHERE id_usuario = $idUsuario ORDER BY id_empresa DESC";

            $result = $conexao->query($sql);


            if(($result) and ($result->rowCount() != 0)){
                
                $dados = "<div>";
                while($row_empresa = $result->fetch(PDO::FETCH_ASSOC)){
                    extract($row_empresa);

                    $dados .= "<tr>";
                    $dados .= "<td class='id'>$id_empresa</td>";
                    $dados .= "<td class='nome'>$nome</td>";
                    $dados .= "<td class='cnpj'>$cnpj</td>";
                    $dados .= "<td class='data'>$data_fund</td>";
                    $dados .= "<td class='email'>$email</td>";
                    $dados .= "<td class='telefone'>$telefone</td>";
                    $dados .= "<td class='cep'>$cep</td>";
                    $dados .= "<td class='endereco'>$endereco</td>";
                    $dados .= "<td>";
                    $dados .= "<a class='btn btn-primary' href='#' onclick='getEmpresaById($id_empresa)'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 
                                        1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                                    </svg>
                                </a>";
                    $dados .= " ";
                    $dados .= "<a class='btn btn-danger' href='#' onclick='deleteEmpresa($id_empresa)'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                        <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                                        <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                                    </svg>
                                </a>";
                    $dados .= "</td>";
                    $dados .= "</tr>";

                }
                $dados .= "</div>";

                $retorno = ['status' => true, 'dados' => $dados, 'pagina' => $pagina];
            }else { 
                $retorno = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Aviso: Este usuário ainda não possui empresas cadastradas!</div>"];
            }

            echo json_encode($retorno);

        }

        public function deleteEmpresa($id){
            $conexao = Config::getConexao();

            if(!empty($id)){
                $sqlDelete = "DELETE FROM empresas WHERE id_empresa = $id";
                $conexao->query($sqlDelete);
                $retorno = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aviso: Empresa deletada com sucesso!</div>"];
                json_encode($retorno);
            } else { 
                $retorno = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Aviso: Empresa não deletada com sucesso!</div>"];
            }

            
           
            
        }
    

    }

?>