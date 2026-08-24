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
        $breadcrumb_item = 'Subategorias';
        include '../includes/header.php';
        
        $subcategoria = new Subcategorias;
        $subcategoria->getObject($cd_subcategoria);
    ?>
        <div class="body">
            <div class="container-lg px-4"><!-- Espaços na laterais -->     
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Editar Subategoria</strong>
                                <span class="small ms-1"></span>
                            </div>
                            <div class="card-body"> 
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                                            <div class="row">
                                                <div class="col-12">
                                                    <form action="subategorias/subategorias_man.php" name="edita" id="edita" method="post">
                                                        <input type="hidden" name="evento" id="evento" value="salvar" />
                                                        <input type="hidden" name="cd_subcategoria" id="cd_subcategoria" value="<?= $subcategoria->cd_subcategoria; ?>" />
                                                        <div class="row g-3">
                                                            <div class="col-10">
                                                                <input class="form-control" type="text" placeholder="Nome da subategoria" aria-label="default input example" name="ds_subcategoria" id="ds_subcategoria" value="<?= $subcategoria->ds_subcategoria; ?>" required>
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
            if(document.edita.ds_subcategoria.value == '')
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