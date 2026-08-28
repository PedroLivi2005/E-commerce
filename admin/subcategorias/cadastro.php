<?php
    spl_autoload_register(function ($classe) {
        if (file_exists("../classes/{$classe}.php")) {
            include_once "../classes/{$classe}.php";
        }
    });

    include('../includes/valida_sessao.php');
?>
    <!-- inicio  -->
    <?php include '../includes/preheader.php'?>
    <!-- fim -->
    <?php include '../includes/menu.php'?>

    <div class="wrapper d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'?>

        <div class="body">
            <div class="container-lg px-4"><!-- Espaços na laterais -->     
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Cadastrar Subcategoria</strong>
                                <span class="small ms-1"></span>
                            </div>
                            <div class="card-body"> 
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                                            <div class="row">
                                                <div class="col-12">
                                                    <form action="subcategorias/subcategorias_man.php" name="novo" id="novo" method="post">
                                                        <input type="hidden" name="evento" id="evento" value="cadastrar" />
                                                        <div class="row g-3">
                                                            <div class="col-6">
                                                                <input class="form-control" type="text" placeholder="Nome da categoria" aria-label="default input example" name="ds_subcategoria" id="ds_subcategoria" required>
                                                            </div>
                                                            <div class="col-4">
                                                                <select class="form-select" aria-label="Default select example" name="cd_categoria" id="cd_categoria">
                                                                    <option selected value="0">Selecionar</option>
                                                                    <?php
                                                                        $categorias = Categorias::listar($ds_categoria);
                                                                        foreach ($categorias as $linha) {
                                                                            $selected = ($linha->cd_categoria == $subcategoria->cd_categoria) ? 'selected' : '';
                                                                        ?>
                                                                        <option value="<?php echo $linha->cd_categoria; ?>" <?= $selected; ?>><?php echo ucwords(strtolower($linha->ds_categoria)); ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-2">
                                                                 <button type="button" class="btn btn-success" onclick="cadastrar()">Cadastrar</button>
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
    <script>                
        function cadastrar(){
            if(document.novo.ds_subcategoria.value == ''){
                alert("O campo Descric\u00e3o n\u00e3o pode ficar em branco!");
            }
            else if(document.novo.cd_categoria.value == 0){
                alert("O campo Categoria precisa ser selecionado!");
            }
            else{
                document.novo.submit();
            }
        }
    </script>
    <?php include '../includes/plugins.php'?>
</body>
</html>