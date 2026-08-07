<?php

class Categorias {
    public $cd_categoria;
    public $ds_categoria;
    public $fg_status;

    public function inserir() {

        $sql = "INSERT INTO categorias";

        foreach(){
            
        }

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':ds_categoria', $ds_categoria);
        $stmt->bindParam(':fg_status', $fg_status);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}
