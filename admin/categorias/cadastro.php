<?php
    include('../includes/valida_sessao.php');
?>
    <!-- inicio  -->
    <?php include '../includes/preheader.php'?>
    <!-- fim -->
    <?php include '../includes/menu.php'?>

    <div class="wrapper d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'?>

        
        
        <?php
            if (isset($_GET['sucesso']) && $_GET['sucesso'] == '1') {
                echo "<div class='alert alert-success mt-3'>Categoria cadastrada com sucesso!</div>";
            }

            // Exibe mensagens de erro do POST, caso existam
            if (!empty($mensagem)) {
                echo $mensagem;
            }
        ?>
        <div class="body">
            <div class="container-lg px-4"><!-- Espaços na laterais -->     
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Cadastrar Categoria</strong>
                                <span class="small ms-1"></span>
                            </div>
                            <div class="card-body"> 
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                                            <div class="row">
                                                <div class="col-12">
                                                    <form action="categorias/index.php" method="post">
                                                        <div class="row g-3">
                                                            <div class="col-8">
                                                                <input class="form-control" type="text" placeholder="Nome da categoria" aria-label="default input example" name="ds_categoria" id="ds_categoria" required>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-select" aria-label="Default select example" name="fg_status" id="fg_status">
                                                                    <option value="A">Ativo</option>
                                                                    <option value="I">Inativo</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-2">
                                                                <input type="submit" class="btn btn-success" value="Cadastrar">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/plugins.php'?>
</body>
</html>