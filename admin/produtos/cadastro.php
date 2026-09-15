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
                                <strong>Cadastrar Produtos</strong>
                                <span class="small ms-1"></span>
                            </div>
                            <div class="card-body"> 
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                                            <div class="row">
                                                <div class="col-12">
                                                    
                                                    <form action="produtos/produtos_man.php" name="novo" id="novo" method="post">
                                                        <input type="hidden" name="evento" id="evento" value="cadastrar" />
                                                        <div class="row g-3">
                                                            <div class="col-8">
                                                                <label for="nm_produto">Nome do produto</label>
                                                                <input class="form-control" type="text" placeholder="" aria-label="default input example" name="nm_produto" id="nm_produto" required>
                                                            </div>

                                                            <div class="col-2">
                                                                <label for="cd_subcategoria">Subcategoria</label>
                                                                <select class="form-select" aria-label="Default select example" name="cd_subcategoria" id="cd_subcategoria">
                                                                    <option selected value="0">Selecionar</option>
                                                                    <?php
                                                                        $subcategorias = Subcategorias::listar($ds_subcategoria);
                                                                        foreach ($subcategorias as $linha) {
                                                                            $selected = ($linha->cd_subcategoria == $produto->cd_subcategoria) ? 'selected' : '';
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
                                                            <div class="col-4">
                                                                <label for="vl_produto">Valor do produto</label>
                                                                <input class="form-control" type="text" placeholder="" aria-label="default input example" name="vl_produto" id="vl_produto" required>
                                                            </div>
                                                            <div class="col-4">
                                                                <label for="vl_promocao">Valor da promoção</label>
                                                                <input class="form-control" type="text" placeholder="" aria-label="default input example" name="vl_promocao" id="vl_promocao" required>
                                                            </div>
                                                            <div class="col-4">
                                                                <label for="dt_validade_promocao">Validade da promocão</label>
                                                                <input class="form-control" type="text" placeholder="aaaa/mm/dd" aria-label="default input example" name="dt_validade_promocao" id="dt_validade_promocao" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="ds_produto">Descrição do produto</label>
                                                                <input class="form-control" type="text" placeholder="" aria-label="default input example" name="ds_produto" id="ds_produto" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="ds_ficha_tecnica">Ficha técnica</label>
                                                                <input class="form-control" type="text" placeholder="" aria-label="default input example" name="ds_ficha_tecnica" id="ds_ficha_tecnica" required>
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
            if(document.novo.nm_produto.value == ''){
                alert("O campo Nome do produto n\u00e3o pode ficar em branco!");
            }
            else if(document.novo.cd_categoria.value == 0){
                alert("O campo Subcategoria precisa ser selecionado!");
            }
            else{
                document.novo.submit();
            }
        }
    </script>
    <?php include '../includes/plugins.php'?>
</body>
</html>