<?php 

    namespace app\Data;

    class Config{

        private static $conexao;
        public static function getConn() {
            try{
                self::$conexao = new \PDO("pgsql:host=localhost;dbname=CadastroDeEmpresas;user=postgres;password=ADMIN");
                //$conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);     
                return self::$conexao;

            } catch(\PDOException $e){
                echo 'ERRO ao tentar conectar com o banco de dados' . $e->getMessage();
            }
        }
    }

    


?>
