<?php 
    include('../includes/valida_sessao.php');
?>
    <!-- inicio  -->
    <?php include '../preheader'?>
    <!-- fim -->
    <?php include '../menu.php'?>

    <div class="wrapper d-flex flex-column min-vh-100">

    <?php include '../header.php'?>

        <div class="body flex-grow-1">
            <div class="container-lg px-4">
                <h2>Página Inicial</h2>
                <p>Usuário: <?= $_SESSION['usuario_email'] ?></p>
                
                <button class="btn btn-danger">
                    <a href="logout.php">Sair</a>
                </button>
            </div>
        </div>

            <form action="" method="post">
                <label for="ds_categoria">Categoria</label>
                <input class="form-control" type="text" placeholder="Nome da categoria" aria-label="default input example" name="ds_categoria" id="ds_categoria" required>
                
                <label for="descricao">Status</label>
                <select class="form-select" aria-label="Default select example">
                    <option value="A">Ativo</option>
                    <option value="I">Inativo</option>
                </select>
                <input type="submit" class="btn btn-success" value="Cadastrar">
            </form>

    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <script>
      const header = document.querySelector("header.header");

      document.addEventListener("scroll", () => {
        if (header) {
          header.classList.toggle("shadow-sm", document.documentElement.scrollTop > 0);
        }
      });
    </script>
    <!-- Plugins and scripts required by this view-->
    <script src="vendors/chart.js/js/chart.umd.js"></script>
    <script src="vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="vendors/@coreui/utils/js/index.js"></script>
    <script src="js/main.js"></script>
</body>
</html>