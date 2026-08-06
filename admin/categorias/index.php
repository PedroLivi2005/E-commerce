<?php
    include('../includes/valida_sessao.php');
?>
    <!-- inicio  -->
    <?php include '../includes/preheader.php'?>
    <!-- fim -->
    <?php include '../includes/menu.php'?>

    <div class="wrapper d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'?>

        <div class="body flex-grow-1">
            <div class="container-lg px-4">
                <p>Usuário: <?= $_SESSION['usuario_email'] ?></p>
            </div>
        </div>
        <?php 
            $ds_categoria = $_POST['ds_categoria'] ?? null;
            $fg_status = $_POST['fg_status'] ?? null;
        ?>
        <div>
            <form action="" method="post">
                <label for="ds_categoria">Categoria</label>
                <input class="form-control" type="text" placeholder="Nome da categoria" aria-label="default input example" name="ds_categoria" id="ds_categoria" required>
                
                <label for="fg_status">Status</label>
                <select class="form-select" aria-label="Default select example" name="fg_status" id="fg_status">
                    <option value="A">Ativo</option>
                    <option value="I">Inativo</option>
                </select>
                <input type="submit" class="btn btn-success" value="Cadastrar">
            </form>
        </div>
        <?php 
            include '../includes/conexao.php';

            if (!empty($ds_categoria)) {
            try {
                $sql = "INSERT INTO Categorias (ds_categoria, fg_status) VALUES (:ds_categoria, :fg_status)";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":ds_categoria", $ds_categoria);
                $stmt->bindParam(":fg_status", $fg_status);

                if ($stmt->execute()) {
                    echo "Categoria criada com sucesso!";
                } else {
                    "Erro ao criar a categoria";
                }
                print $ds_categoria . $fg_status;
            } catch(PDOException $e) {
                $erro = 'Erro: ' . $e->getMessage();
            }
        }
        ?>
    </div>
    <?php include '../includes/plugins.php'?>
</body>
</html>