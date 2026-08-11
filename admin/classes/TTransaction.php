
<?php

/*
 * classe TTransaction
 * esta classe provê os métodos necessários para manipular transações 
 */

final class TTransaction {
    private static $conn;
    private static $logger;
    
    /*
     * método __construct()
     * não existirão instâncias de TConnection, por isso estamos marcando-o como private
     */
    private function __construct() {
        
    }
    
    /*
     * método open()
     * recebe o nome do banco de dados e instancia o objeto PDO correspondente
     */
    public static function open($nome = 'db_ecommerce'){
        //abre uma conexão e armazena na propriedade estatica $conn
        if(empty(self::$conn)){
            self::$conn = TConnection::open($nome);
            //inicia a transação
            self::$conn->beginTransaction();
        }
    }
    
    /*
     * método get()
     * retorna a conexão ativa da transação
     */
    public static function get(){
        //retorna a conexão ativa
        return self::$conn;
    }
    
    /*
     * método rollback()
     * desfaz todas as operações realizadas durante a transação
     */
    public static function rollback(){
        if(self::$conn){
            //desfaz as operações realizadas durante a transação
            self::$conn->rollback();
            self::$conn = NULL;
        }
    }
    
    /*
     * método close()
     * Aplica todas as operações realizadas e fecha a transação
     */
    public static function close(){
        if(self::$conn){
            //aplica as operações realizadas durante a transação
            self::$conn->commit();
            self::$conn = NULL;
        }
    }
    
    /*
     * método setLogger
     * define qual estratégia (algoritmo de LOG será usado)
     */
    /*
    public static function setLogger(TLogger $logger){
        self::$logger = $logger;
    }*/
    
    /*
     * método log()
     * armazena uma mensagem no arquivo de LOG
     * baseada na estratégia ($logger) atual
     */
    /*
    public static function log($mensagem, $usuario, $pessoa){
        $usuario_erro = explode(" - ", $usuario);
        
        $chamado = new TiChamados();
        $chamado->data_hora_cadastro    = date("Y-m-d H:i:s");
        $chamado->ds_defeito            = str_replace("'", "", $mensagem);
        $chamado->id_usuario            = $usuario_erro[0];
        $chamado->status                = 'A';
	    $chamado->id_status		        = 2;
        $chamado->id_computador         = 0;
        $chamado->id_tecnico            = 0;
        $chamado->id_tipo_chamado       = 17;
        $chamado->id_assunto            = 3;
        $chamado->fg_procedente         = 1;
        $chamado->fg_prioridade         = 0;
        $chamado->insert();
        
    }*/
}
