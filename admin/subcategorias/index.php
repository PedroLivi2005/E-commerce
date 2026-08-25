<?php

    include('../includes/valida_sessao.php');

    spl_autoload_register(function ($classe) {
      if (file_exists("../classes/{$classe}.php")) {
          include_once "../classes/{$classe}.php";
      }
    });

    $ds_subcategoria = null;
    //$ds_categoria = null;
    extract($_POST);

    ?>
    <!-- inicio  -->
    <?php include '../includes/preheader.php'?>
    <!-- fim -->
    <?php include '../includes/menu.php'?>

    <div class="wrapper d-flex flex-column min-vh-100">

    <?php
      $breadcrumb_item = 'Subcategorias';
      include '../includes/header.php';
    ?>
    <!-- Inserir subcategoria (select)
        editar subcategoria (select)
        busca subcategoria (busca categoria)
    -->
    
    <div class="body">
        <div class="container-lg px-4"><!-- Espaços na laterais -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>Pesquisar Subcategoria</strong>
                            <span class="small ms-1"></span>
                        </div>
                        <div class="card-body"> 
                            <div class="example">
                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                                        <div class="row">
                                            <div class="col-12">
                                                <form action="subcategorias/index.php" method="post">
                                                    <div class="row g-2">
                                                      <div class="col-10">
                                                        <input class="form-control" type="text" placeholder="Nome da subcategoria" aria-label="Nome da subcategoria" name="ds_subcategoria" id="ds_subcategoria">
                                                      </div>
                                                      <div class="col-2">
                                                        <input type="submit" class="btn btn-success" value="Buscar">
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
              <!-- Component Tables CoreUI -->
              <div class="box box-primary">
                <div class="box-body">
                    <div class="card mb-4">
                      <div class="card-header">
                        <button type="button" class="btn btn-success margin pull-right" onclick="window.location = 'subcategorias/cadastro.php'">Inserir novo</button>
                      </div>
                      <div class="tab-content rounded-bottom">
                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1005">
                          <div class="card-body">
                            <div class="example">
                              <div class="tab-content rounded-bottom"> 
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th scope="col">Nome da Subcategoria</th>
                                      <th scope="col">Editar</th>
                                      <th scope="col">Categorias</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $subcategorias = Subcategorias::listar($ds_subcategoria);
                                      foreach ($subcategorias as $linha) {
                                    ?>
                                      <tr>
                                        <td scope="row"><?php echo ucwords(strtolower($linha->ds_subcategoria)); ?></td>
                                        <td>
                                          <a class="btn btn-secondary btn-sm" href="subcategorias/edicao.php?cd_subcategoria=<?php echo $linha->cd_subcategoria; ?>">
                                            <i class="icon cil-color-border"></i>
                                          </a>
                                        </td>
                                        <td scope="row"><?php echo ucwords(strtolower($linha->ds_categoria ?? 'Sem Categoria')); ?></td>
                                      </tr>
                                      <?php
                                    }
                                    ?>
                                  </tbody>
                                </table>
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