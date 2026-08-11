<?php

class Categorias {
    public $cd_categoria;
    public $ds_categoria;
    public $fg_status;

    const TABLE                 = "categorias";
	const ID                    = "cd_categoria";

    // Propriedade privada para guardar a conexão PDO
    private $conn;

    // O construtor recebe a conexão com o banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert() {
		$colunas = null;
		$valores = null;
		
		try{

			TTransaction::open();

			$sql = "INSERT INTO ".self::TABLE;
			
			foreach($this as $key=>$campo){
				if($key != self::ID){
					if($colunas == ''){
						$colunas = $key;
					}
					else{
						$colunas .= ', '.$key;
					}
					
					if($valores == ''){
						$valores = "'".$campo."'";;
					}
					else{
						$valores .= ", '".$campo."'";
					}
				}
			}
			
			$sql .= " (".$colunas.") VALUES (".$valores.") ";
			
			
			$sql = "SELECT max(cd_categoria) as cd_categoria 
				from ".self::TABLE." 
				WHERE ds_categoria = '".$this->ds_categoria."' 
        		AND fg_status = '".$this->fg_status."' ";

			$conn = TTransaction::get();
			$result = $conn->query($sql);
			
			$data = $result->fetch(PDO::FETCH_ASSOC);
			
			foreach($data as $key=>$campo){
				$this->$key = $campo;
			}
			
			//fecha a transação aplicando todas as transações
			TTransaction::close();
			
			return $data;
			
		} catch (Exception $ex) {
								
			TTransaction::log("Erro ao inserir ".self::TABLE." na base de dados. ".$ex->getMessage(), $usuario_erro, 'Não Informado');
			TTransaction::rollback();
			
			return false;
		}
	}

	public function listar() {
		$sql = "SELECT cd_categoria, ds_categoria, fg_status FROM ".self::TABLE;
		$stmt = $this->conn->query($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		/*
		while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "Nome: {$linha['ds_categoria']} - Status: {$linha['fg_status']} <a class='btn btn-success btn-sm' href='edicao.php?cd_categoria=".$linha['cd_categoria']."'>EDITAR</a><br/>";
		}*/
	}
}
