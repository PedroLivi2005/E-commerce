<?php

class Categorias {

    public $cd_categoria;
    public $ds_categoria;
    public $fg_status;

    const TABLE                 = "categorias";
	const ID                    = "cd_categoria";

	//Refazer
    // Método estático para ser chamado como Categorias::inserir($dados)
    public static function inserir($dados) {
        try {
            // Abre a conexão com o banco
            TTransaction::open();
            $conn = TTransaction::get();
            
            // Remove o ID do array caso tenha vindo do form (deixa o banco gerenciar o auto-increment)
            if (isset($dados[self::ID])) {
                unset($dados[self::ID]);
            }

            // Monta as colunas e os placeholders (ex: :ds_categoria, :fg_status) dinamicamente
            $colunas = implode(', ', array_keys($dados));
            $placeholders = ':' . implode(', :', array_keys($dados));
            
            // Monta a query final de INSERT
            $sql = "INSERT INTO " . self::TABLE . " ($colunas) VALUES ($placeholders)";
            $stmt = $conn->prepare($sql);
            
            // Faz o bind dinâmico dos valores, protegendo contra SQL Injection
            foreach ($dados as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            
            // Executa a inserção
            $stmt->execute();
            
            // Recupera o ID gerado pelo banco (útil caso precise usar depois)
            $last_id = $conn->lastInsertId();
            
            TTransaction::close();
            
            return $last_id;
            
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
