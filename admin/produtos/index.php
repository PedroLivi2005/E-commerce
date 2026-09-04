<?php
  ini_set('display_errors', 'off');
  error_reporting(E_ALL | E_STRICT);
    include('../includes/valida_sessao.php');

    spl_autoload_register(function ($classe) {
      if (file_exists("../classes/{$classe}.php")) {
          include_once "../classes/{$classe}.php";
      }
    });

    $nm_produto = null;
    //$ds_subcategoria = null;
    //$ds_categoria = null;
    extract($_POST);

    ?>
    <!-- inicio  -->
    <?php include '../includes/preheader.php'?>
    <!-- fim -->
    <?php include '../includes/menu.php'?>

    <div class="wrapper d-flex flex-column min-vh-100">

    <?php
      $breadcrumb_item = 'Produtos';
      include '../includes/header.php';
    ?>
    <div class="body">
        <div class="container-lg px-4"><!-- Espaços na laterais -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>Pesquisar Produtos</strong>
                            <span class="small ms-1"></span>
                        </div>
                        <div class="card-body"> 
                            <div class="example">
                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                                        <div class="row">
                                            <div class="col-12">
                                                <form action="produtos/index.php" method="post">
                                                    <div class="row g-2">
                                                      <div class="col-6">
                                                        <input class="form-control" type="text" placeholder="Nome da produto" aria-label="Nome do produto" name="nm_produto" id="nm_produto">
                                                      </div>
                                                      <div class="col-3">

                                                        <select class="form-select" aria-label="Default select example" name="cd_subcategoria" id="cd_subcategoria">
                                                              <option selected value="0">Selecione a subcategoria</option>
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
                        <button type="button" class="btn btn-success margin pull-right" onclick="window.location = 'produtos/cadastro.php'">Inserir novo</button>
                      </div>
                      <div class="tab-content rounded-bottom">
                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1005">
                          <div class="card-body">
                            <div class="example">
                              <div class="tab-content rounded-bottom"> 
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th scope="col">Produtos</th>
                                      <th scope="col">Subcategorias</th>
                                      <th scope="col">Editar</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $produtos = Produtos::listar($nm_produto, $cd_subcategoria);
                                      if ($produtos == null){
                                        echo "<div class='alert alert-secondary' role='alert'>
                                                <p class='mb-0'>Nenhum resultado encontrado.</p>  
                                              </div>";
                                      } else {
                                      foreach ($produtos as $linha) {
                                    ?>
                                      <tr>
                                        <td scope="row"><?php echo ucwords(strtolower($linha->nm_produto)); ?></td>
                                        <td scope="row"><?php echo ucwords(strtolower($linha->ds_subcategoria ?? 'Não cadastrado')); ?></td>
                                        <td>
                                          <a class="btn btn-secondary btn-sm" href="produtos/edicao.php?cd_produto=<?php echo $linha->cd_produto; ?>">
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