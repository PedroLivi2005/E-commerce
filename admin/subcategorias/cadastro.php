<?php
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
                                <strong>Cadastrar Categoria</strong>
                                <span class="small ms-1"></span>
                            </div>
                            <div class="card-body"> 
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                                            <div class="row">
                                                <div class="col-12">
                                                    <form action="categorias/categorias_man.php" name="novo" id="novo" method="post">
                                                        <input type="hidden" name="evento" id="evento" value="cadastrar" />
                                                        <div class="row g-3">
                                                            <div class="col-6">
                                                                <input class="form-control" type="text" placeholder="Nome da categoria" aria-label="default input example" name="ds_categoria" id="ds_categoria" required>
                                                            </div>
                                                            <div class="col-4">
                                                                <select class="form-select" aria-label="Default select example">
                                                                    <option selected>Selecionar Categoria</option>
                                                                    <option value="1">One</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
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
            if(document.novo.ds_categoria.value == ''){
                alert("O campo Descric\u00e3o n\u00e3o pode ficar em branco!");
            }
            else{
                document.novo.submit();
            }
        }
    </script>
    <?php include '../includes/plugins.php'?>
</body>
</html>