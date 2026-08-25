<?php

class Subcategorias {

    public $cd_subcategoria;
    public $ds_subcategoria;
    public $fg_status;
    public $cd_categoria;
    public $ds_categoria;

    const TABLE                 = "subcategorias";
	const ID                    = "cd_subcategoria";

    public function getObject($id){
        try{
            TTransaction::open();

            $sql = "SELECT * "
                    . "FROM ".self::TABLE." "
                    . "WHERE ".self::ID." = :id ";
            
            $conn = TTransaction::get();
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            unset($conn);

            if(is_array($data)){
                foreach($data as $key=>$campo){
                    $this->$key = $campo;
                }            
            }
            
        } catch (Exception $ex) {
            
        }
    }
    //Melhorar
    public function inserir() {
        $colunas = null;
        $valores = null;
        try{
            TTransaction::open();
    
            $sql = "INSERT INTO ".self::TABLE." (ds_subcategoria, cd_categoria) values (:ds_subcategoria, :cd_categoria)";

            $conn = TTransaction::get();
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':ds_subcategoria', $this->ds_subcategoria);

            $stmt->execute();
    
            //fecha a transação aplicando todas as transações
            TTransaction::close();
    
            return true;
    
        } catch (Exception $ex) {
            
            TTransaction::rollback();
    
            return false;
        }
    }

	static function listar($ds_subcategoria = null) {

		try{

			$sql_ds_subcategoria = null;

			if($ds_subcategoria != null){
				$sql_ds_subcategoria = " and ds_subcategoria like '%".$ds_subcategoria."%' ";
			}

			TTransaction::open();

			$sql = "SELECT 
                        subcategorias.cd_subcategoria, 
                        subcategorias.ds_subcategoria, 
                        subcategorias.fg_status, 
                        categorias.ds_categoria 
                    FROM " . self::TABLE." 
                INNER JOIN categorias ON subcategorias.cd_categoria = categorias.cd_categoria 
                WHERE subcategorias.fg_status ='A' 
				$sql_ds_subcategoria ";

			$conn = TTransaction::get();

			$result = $conn->query($sql);
			$result = $result->fetchAll(PDO::FETCH_ASSOC);

			$lista = null;

			if ($result) {
				foreach ($result as $data) {
					$objeto = new Subcategorias();

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

    public function update() {
        $linhas = null;

        try {
            TTransaction::open();

            $sql = "UPDATE ".self::TABLE." SET ds_subcategoria = :ds_subcategoria WHERE ".self::ID." = :id";

            // Obtém a conexão
            $conn = TTransaction::get();
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':ds_subcategoria', $this->ds_subcategoria);
            $stmt->bindParam(':id', $this->cd_subcategoria);

            // Executa a instrução
            $stmt->execute();

            // Fecha a transação aplicando as mudanças no banco (Commit)
            TTransaction::close();

            return true;

        } catch (Exception $ex) {
            // Desfaz as operações em caso de erro (Rollback)
            TTransaction::rollback();
            
            // Aqui você pode adicionar um log do erro se necessário: erro_log($ex->getMessage());
            return false;
        }
    }

    static function delete($id) {
        try{
            TTransaction::open();

            $sql = "UPDATE ".self::TABLE." SET fg_status = 'I' WHERE ".self::ID." = :id";

            $conn = TTransaction::get();
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            TTransaction::close();

            return true;

        } catch (Exception $ex) {

            TTransaction::rollback();

            return false;
        }
    }

}
