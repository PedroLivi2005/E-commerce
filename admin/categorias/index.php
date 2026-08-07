<?php
    include('../includes/valida_sessao.php');
?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        include '../includes/conexao.php';

        include '../classes/Categorias.php';

        $categorias = new Categorias($pdo);


        $categoria = new Categorias();
        $categoria->cd_carteoria = 'testte';
        $categoria->update();

        // $ds_categoria = trim($_POST['ds_categoria'] ?? '');
        // $fg_status = $_POST['fg_status'] ?? '';
        // $erro = "";

        // if (!empty($ds_categoria)) {
        //     include '../includes/conexao.php';
        //     try {
        //         $sql = "INSERT INTO Categorias (ds_categoria, fg_status) VALUES (:ds_categoria, :fg_status)";

        //         $stmt = $pdo->prepare($sql);
        //         $stmt->bindParam(":ds_categoria", $ds_categoria);
        //         $stmt->bindParam(":fg_status", $fg_status);

        //         if ($stmt->execute()) {
        //             // Redireciona para a mesma página passando '?sucesso=1' na URL
        //             header("Location: " . $_SERVER['PHP_SELF'] . "?sucesso=1");
        //             exit;
        //         } else {
        //             $erro = "Erro ao criar a categoria";
        //         }
        //     } catch(PDOException $e) {
        //         $erro = "Erro de Banco de Dados: " . $e->getMessage();
        //     }
        // } else {
        //     $erro = "O nome da categoria não pode estar vazio.";
        // }
    }
?>
    <!-- inicio  -->
    <?php include '../includes/preheader.php'?>
    <!-- fim -->
    <?php include '../includes/menu.php'?>

    <div class="wrapper d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'?>

        <div class="body flex-grow-1">
            <div class="container-lg px-4">
                <h1>Categorias</h1>
                <p>Usuário: <?= $_SESSION['usuario_email'] ?></p>
            </div>
        </div>
        <?php 
            // if (isset($_GET['sucesso']) && $_GET['sucesso'] == '1') {
            //     echo "<div class='alert alert-success mt-3'>Categoria criada com sucesso!</div>";
            // }

            // if (!empty($erro)) {
            //     echo "<div class='alert alert-danger mt-3'>$erro</div>";
            // }
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
    </div>
    <?php include '../includes/plugins.php'?>
</body>
</html>