<?php

class Categorias {
    public $cd_categoria;
    public $ds_categoria;
    public $fg_status;

    // Propriedade privada para guardar a conexão PDO
    private $conn;

    // O construtor recebe a conexão com o banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    public function inserir() {
        // 1. Criar a query SQL com "named placeholders" (os dois pontos :)
        $query = "INSERT INTO Categorias (ds_categoria, fg_status) VALUES (:ds_categoria, :fg_status)";

        // 2. Preparar a query
        $stmt = $this->conn->prepare($query);

        // (Opcional) Limpar os dados para evitar injeção de HTML/scripts indesejados
        $this->ds_categoria = htmlspecialchars(strip_tags($this->ds_categoria));
        $this->fg_status = htmlspecialchars(strip_tags($this->fg_status));

        // 3. Fazer o bind (ligação) dos valores com os placeholders
        $stmt->bindValue(':ds_categoria', $this->ds_categoria);
        $stmt->bindValue(':fg_status', $this->fg_status);

        // 4. Executar a query
        if ($stmt->execute()) {
            return true;
        }

        // Retorna false caso algo dê errado
        return false;
    }
}

/*
    public function listar() {
    }*/

/*
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
    }*/