<?php

class Categorias {

    public $cd_categoria;
    public $ds_categoria;
    public $fg_status;

    const TABLE                 = "categorias";
	const ID                    = "cd_categoria";

    public static function inserir($dados) {
        try {
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

    static function update($cd_categoria, $ds_categoria) {
        try {

            TTransaction::open();

            $sql = "UPDATE " . self::TABLE . " 
                    SET ds_categoria = :ds_categoria 
                    WHERE " . self::ID . " = :cd_categoria";

            // Obtém a conexão
            $conn = TTransaction::get();
            $stmt = $conn->prepare($sql);

            // Proteção contra SQL Injection (Bind dos parâmetros)
            $stmt->bindValue(':ds_categoria', $ds_categoria, PDO::PARAM_STR);
            $stmt->bindValue(':cd_categoria', $cd_categoria, PDO::PARAM_INT);

            // Executa a instrução
            $sucesso = $stmt->execute();

            // Fecha a transação aplicando as mudanças no banco (Commit)
            TTransaction::close();

            return $sucesso;

        } catch (Exception $ex) {
            // Desfaz as operações em caso de erro (Rollback)
            TTransaction::rollback();
            
            // Aqui você pode adicionar um log do erro se necessário: erro_log($ex->getMessage());
            return false;
        }
    }
}
