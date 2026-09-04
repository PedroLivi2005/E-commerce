<?php

class Produtos {

    public $cd_produto;
    public $nm_produto;
    public $vl_produto;
    public $vl_promocao;
    public $dt_validade_promocao;
    public $ds_produto;
    public $ds_ficha_tecnica;
    public $fg_status;
    public $cd_subcategoria;

    const TABLE                 = "produtos";
	const ID                    = "cd_produto";

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

            $stmt->bindParam(':cd_categoria', $this->cd_categoria);
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

	static function listar($nm_produto = null, $cd_subcategoria = null) {

		try{

			$sql_nm_produto = null;

			if($nm_produto != null){
				$sql_nm_produto = " and nm_produto like '%".$nm_produto."%' ";
			}

            $sql_cd_subcategoria = null;

			if($cd_subcategoria > 0){
				$sql_cd_subcategoria = " and subcategorias.cd_subcategoria = $cd_subcategoria ";
			}            

			TTransaction::open();

			$sql = "SELECT 
                        produtos.cd_produto, 
                        produtos.nm_produto, 
                        produtos.vl_produto, 
                        produtos.vl_promocao, 
                        produtos.dt_validade_promocao, 
                        produtos.ds_produto, 
                        produtos.ds_ficha_tecnica, 
                        produtos.fg_status, 
                        subcategorias.ds_subcategoria, 
                        subcategorias.cd_subcategoria 
                    FROM " . self::TABLE." 
                INNER JOIN subcategorias ON produtos.cd_subcategoria = subcategorias.cd_subcategoria 
                WHERE produtos.fg_status ='A' 
				$sql_nm_produto 
                $sql_cd_subcategoria";

			$conn = TTransaction::get();

			$result = $conn->query($sql);
			$result = $result->fetchAll(PDO::FETCH_ASSOC);

			$lista = null;

			if ($result) {
				foreach ($result as $data) {
					$objeto = new Produtos();

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

            $sql = "UPDATE ".self::TABLE." SET ds_subcategoria = :ds_subcategoria, cd_categoria = :cd_categoria WHERE ".self::ID." = :id";

            // Obtém a conexão
            $conn = TTransaction::get();
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':cd_categoria', $this->cd_categoria);
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
