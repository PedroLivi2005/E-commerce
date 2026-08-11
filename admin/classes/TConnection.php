<?php
/*
 * classe TConnection
 * gerencia conexões com bancos de dados através de arquivos de configuração
 */

final class TConnection {
    /*
     * método __construct()
     * não existirão instâncias de TConnection, por isso estamos marcando-o como private
     */
    private function __construct() {
        
    }
    
    /*
     * método open()
     * recebe o nome do banco de dados e instancia o objeto PDO correspondente
     * Parametros:
     *      -> $nome (default = db_ecommerce): Nome do arquivo que será aberto com as configurações do banco.
     */
    public static function open($nome = "db_ecommerce"){
        //$db = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/administrador/gestor.config/{$nome}.ini");   

        
        $user = "root";
        $pass = "";
        $name = "db_ecommerce";
        $host = "localhost";
        $tipo = "mysql";
        $port = "3306";

              
                
        switch($tipo){
            case 'mysql':
                $port = $port ? $port : '3306';
                $conn = new PDO("mysql:host={$host};dbname={$name}", $user, $pass);
                break;
        }
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $conn;
    }
}