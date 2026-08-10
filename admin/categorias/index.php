<?php
    include('../includes/valida_sessao.php');
?>
<?php 
    $mensagem = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        include '../includes/conexao.php';
        include '../classes/Categorias.php';

        $ds_categoria = trim($_POST['ds_categoria'] ?? '');
        $fg_status = $_POST['fg_status'] ?? '';

        // 4. Validação simples para não inserir vazio
        if (!empty($ds_categoria) && !empty($fg_status)) {
            try {
                // Instancia a classe passando a conexão
                $categoria = new Categorias($pdo);

                // Atribui os dados do formulário às propriedades da classe
                $categoria->ds_categoria = $ds_categoria;
                $categoria->fg_status = $fg_status;

                // Executa o método de inserção
                if ($categoria->inserir()) {
                    $mensagem = "<div class='alert alert-success'>Categoria cadastrada com sucesso!</div>";
                    header("Location: " . $_SERVER['PHP_SELF'] . "?sucesso=1");
                    // 2. O exit é obrigatório para garantir que o script pare por aqui
                    exit;
                    
                } else {
                    $mensagem = "<div class='alert alert-danger'>Erro ao cadastrar a categoria.</div>";
                }

            } catch (PDOException $e) {
                $mensagem = "<div class='alert alert-danger'>Erro no banco de dados: " . $e->getMessage() . "</div>";
            }

        } else {
            $mensagem = "<div class='alert alert-warning'>Por favor, preencha todos os campos.</div>";
        }


        /*
        $categoria = new Categorias();
        $categoria->cd_carteoria = 'testte';
        $categoria->update();
        */
        
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
        <div class="container mt-5">
        <?php
            if (isset($_GET['sucesso']) && $_GET['sucesso'] == '1') {
                echo "<div class='alert alert-success mt-3'>Categoria cadastrada com sucesso!</div>";
            }

            // Exibe mensagens de erro do POST, caso existam
            if (!empty($mensagem)) {
                echo $mensagem;
            }
        ?>
            <div>
                <h2>Cadastrar categoria</h2>
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
    </div>
    <?php include '../includes/plugins.php'?>
</body>
</html>