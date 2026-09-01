<?php

    include('../includes/valida_sessao.php');

    spl_autoload_register(function ($classe) {
      if (file_exists("../classes/{$classe}.php")) {
          include_once "../classes/{$classe}.php";
      }
    });

    $ds_categoria = null;
    extract($_POST);

    ?>
    <!-- inicio  -->
    <?php include '../includes/preheader.php'?>
    <!-- fim -->
    <?php include '../includes/menu.php'?>

    <div class="wrapper d-flex flex-column min-vh-100">

    <?php
      $breadcrumb_item = 'Categorias';
      include '../includes/header.php';
    ?>
    
    <div class="body">
        <div class="container-lg px-4"><!-- Espaços na laterais -->     
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>Pesquisar Categoria</strong>
                            <span class="small ms-1"></span>
                        </div>
                        <div class="card-body"> 
                            <div class="example">
                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                                        <div class="row">
                                            <div class="col-12">
                                                <form action="categorias/index.php" method="post">
                                                    <div class="row g-2">
                                                      <div class="col-9">
                                                        <input class="form-control" type="text" placeholder="Nome da categoria" aria-label="Nome da categoria" name="ds_categoria" id="ds_categoria">
                                                      </div>
                                                      <div class="col-1">
                                                        <input type="submit" class="btn btn-success" value="Buscar">
                                                      </div>
                                                      <div class="col-2">
                                                        <button onclick="window.location = 'index.php';" class="btn btn-success">Limpar pesquisa</button>
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
                        <button type="button" class="btn btn-success margin pull-right" onclick="window.location = 'categorias/cadastro.php'">Inserir novo</button>
                      </div>
                      <div class="tab-content rounded-bottom">
                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1005">
                          <div class="card-body">
                            <div class="example">
                              <div class="tab-content rounded-bottom"> 
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th scope="col">Categoria</th>
                                      <th scope="col">Editar</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $categorias = Categorias::listar($ds_categoria);
                                      if ($categorias == null){
                                        echo "<div class='alert alert-secondary' role='alert'>
                                                <p class='mb-0'>Nenhum resultado encontrado.</p>  
                                              </div>";
                                      } else {
                                      foreach ($categorias as $linha) {
                                    ?>
                                      <tr>
                                        <td scope="row"><?php echo ucwords(strtolower($linha->ds_categoria)); ?></td>
                                        <td>
                                          <a class="btn btn-secondary btn-sm" href="categorias/edicao.php?cd_categoria=<?php echo $linha->cd_categoria; ?>">
                                            <i class="icon cil-color-border"></i>
                                          </a>
                                        </td>
                                      </tr>
                                      <?php
                                    }
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