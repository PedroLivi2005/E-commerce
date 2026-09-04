<?php
    extract($_GET);
    extract($_POST);

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

    <?php
        $breadcrumb_item = 'Produtos';
        include '../includes/header.php';
        
        $subcategoria = new Produtos;
        $subcategoria->getObject($cd_produto);
    ?>
        <div class="body">
            <div class="container-lg px-4"><!-- Espaços na laterais -->     
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Editar Produto</strong>
                                <span class="small ms-1"></span>
                            </div>
                            <div class="card-body"> 
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                                            <div class="row">
                                                <div class="col-12">

                                                    <form action="produtos/produtos_man.php" name="edita" id="edita" method="post">
                                                        <input type="hidden" name="evento" id="evento" value="salvar" />
                                                        <input type="hidden" name="cd_produto" id="cd_produto" value="<?= $produto->cd_produto; ?>" />

                                                        <div class="row g-3">
                                                            <div class="col-8">
                                                                <input class="form-control" type="text" placeholder="Nome do produto" aria-label="default input example" name="nm_produto" id="nm_produto" value="<?= $produto->nm_produto; ?>" required>
                                                            </div>

                                                            <div class="col-2">

                                                                <select class="form-select" aria-label="Default select example" name="cd_subcategoria" id="cd_subcategoria">
                                                                    <?php
                                                                        $subcategorias = Subcategorias::listar($ds_subcategoria);
                                                                        foreach ($subcategorias as $linha) {
                                                                            $selected = ($linha->cd_subcategoria == $subcategoria->cd_subcategoria) ? 'selected' : '';
                                                                        ?>
                                                                        <option value="<?php echo $linha->cd_subcategoria; ?>" <?= $selected; ?>><?php echo ucwords(strtolower($linha->ds_subcategoria)); ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-1">
                                                                <button type="button" class="btn btn-success" onclick="salvar()">Salvar</button>
                                                            </div>
                                                            <div class="col-1">
                                                                <button type="button" class="btn btn-danger" onclick="excluir()">Excluir</button>
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
        function salvar(){
            if(document.edita.nm_produto.value == '')
                alert("O campo descric\u00e3o n\u00e3o pode ficar em branco!");                      
            else
                document.edita.submit();                    
        }

        function excluir(){
            if(confirm("Deseja realmente excluir este registro?")){
                document.edita.evento.value = 'excluir'; 
                document.edita.submit(); 
            }
        }
    </script>
    <?php include '../includes/plugins.php'?>
</body>
</html>