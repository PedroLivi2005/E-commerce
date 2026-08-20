<?php

class Categorias {

    public $cd_categoria;
    public $ds_categoria;
    public $fg_status;

    const TABLE                 = "categorias";
	const ID                    = "cd_categoria";

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

    public function inserir() {
        $colunas = null;
        $valores = null;
        try{
            TTransaction::open();
    
            $sql = "INSERT INTO ".self::TABLE." (ds_categoria) values (:ds_categoria) ";            

            $conn = TTransaction::get();
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':ds_categoria', $this->ds_categoria);

            $stmt->execute();
    
            //fecha a transação aplicando todas as transações
            TTransaction::close();
    
            return true;
    
        } catch (Exception $ex) {
            //$usuario_erro =  $_SESSION['usuario']->cd_usuario." - ".$_SESSION['usuario']->nm_usuario;
            //TTransaction::open();
            //TTransaction::setLogger(new TLoggerXML($_SERVER['DOCUMENT_ROOT'].$_SESSION['parametro']->dir.'/gestor.log/logSistema.xml'));
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

    public function update() {
        $linhas = null;

        try {
            TTransaction::open();

            $sql = "UPDATE ".self::TABLE." SET ds_categoria = :ds_categoria WHERE ".self::ID." = :id";

            // Obtém a conexão
            $conn = TTransaction::get();
            $stmt = $conn->prepare($sql);

            // $stmt->bindValue(':ds_categoria', $ds_categoria, PDO::PARAM_STR);
            // $stmt->bindValue(':cd_categoria', $cd_categoria, PDO::PARAM_INT);
            $stmt->bindParam(':ds_categoria', $this->ds_categoria);
            $stmt->bindParam(':id', $this->cd_categoria);

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
