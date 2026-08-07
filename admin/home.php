<?php
    include('includes/valida_sessao.php');
?>
    <!-- inicio  -->
    <?php include './includes/preheader.php'?>
    <!-- fim -->
    <?php include './includes/menu.php'?>

    <div class="wrapper d-flex flex-column min-vh-100">

    <?php include './includes/header.php'?>

        <div class="body flex-grow-1">
            <div class="container-lg px-4">
                <h2>Página Inicial</h2>
                <p>Usuário: <?= $_SESSION['usuario_email'] ?></p>
            </div>
        </div>

            <!-- <form action="" method="post">
                <label for="ds_categoria">Categoria</label>
                <input class="form-control" type="text" placeholder="Nome da categoria" aria-label="default input example" name="ds_categoria" id="ds_categoria" required>
                
                <label for="descricao">Status</label>
                <select class="form-select" aria-label="Default select example">
                    <option value="A">Ativo</option>
                    <option value="I">Inativo</option>
                </select>
                <input type="submit" class="btn btn-success" value="Cadastrar">
            </form> -->

    </div>
    <?php include './includes/plugins.php'?>
</body>
</html>