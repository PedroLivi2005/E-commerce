<?php

class Categorias {

    public $cd_categoria;
    public $ds_categoria;
    public $fg_status;

    const TABLE                 = "categorias";
	const ID                    = "cd_categoria";

	//Refazer
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

			//conexão com o banco
			TTransaction::open();
			$conn = TTransaction::get();
			
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
								
			TTransaction::rollback();
			
			return false;
		}
	}

	static function listar($ds_categoria = null) {

		try{

			$sql_ds_categoria = null;

			if($ds_categoria != null){
				$sql_ds_categoria = " and ds_categoria like '%".$ds_categoria."%' ";
			}

			TTransaction::open();

			$sql = "SELECT cd_categoria, ds_categoria, fg_status FROM " . self::TABLE." 
				where fg_status ='A' 
				$sql_ds_categoria ";

			$conn = TTransaction::get();

			$result = $conn->query($sql);
			$result = $result->fetchAll(PDO::FETCH_ASSOC);

			$lista = null;

			if ($result) {
				foreach ($result as $data) {
					$objeto = new Categorias();

					foreach ($data as $key => $campo) {
						$objeto->$key = $campo;
					}

					$lista[] = $objeto;
				}
			}

			unset($conn);

			if($lista){
				return $lista;
			}

			
		} catch (Exception $ex) {
								
			TTransaction::rollback();
			
			return false;
		}
	}
}
