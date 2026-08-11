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
            <h1>Categorias</h1>        
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
                                            <div class="col">
                                                <form action="" method="post">
                                                    <input class="form-control" type="text" placeholder="Nome da categoria" aria-label="Nome da categoria" name="ds_categoria" id="ds_categoria">
                                                    <input type="submit" class="btn btn-success" value="Buscar">
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
                <button type="button" class="btn btn-success margin pull-right" onclick="window.location = 'cadastro.php'">Inserir novo</button>

                <div class="tab-content rounded-bottom">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1005">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome da Categoria</th>
                            <th scope="col">Status</th>
                            <th scope="col">Editar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            include '../classes/Categorias.php';
                            include '../includes/conexao.php';
                            
                            $list = new Categorias($pdo);
                            $categorias = $list->listar();
                            
                            foreach ($categorias as $linha) {
                          ?>
                              <tr>
                                <th scope="row"><?php echo $linha['cd_categoria']; ?></th>
                                <td><?php echo $linha['ds_categoria']; ?></td>
                                <td><?php echo $linha['fg_status']; ?></td>
                                <td>
                                  <a class="btn btn-success btn-sm" href="edicao.php?cd_categoria=<?php echo $linha['cd_categoria']; ?>">
                                    <i class="icon cil-color-border"></i>
                                  </a>
                                </td>
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
                
        <!--<div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                    <strong>Forms layout</strong>
                    <span class="small ms-1">Grid</span>
                    </div>
                <div class="card-body">
                  <p class="text-body-secondary small">
                    More complex forms can be built using our grid classes. Use these for form layouts that require multiple columns, varied widths, and additional alignment options.
                    <strong>
                      Requires the
                      <code>$enable-grid-classes</code>
                      Sass variable to be enabled
                    </strong>
                    (on by default).
                  </p>
                  <div class="example">
                    <ul class="nav nav-underline-border" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-coreui-toggle="tab" href="#preview-1001" role="tab" aria-selected="true">
                          <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="var(--ci-primary-color, currentcolor)" d="M444.4 235.236 132.275 49.449A24 24 0 0 0 96 70.072v364.142a24.017 24.017 0 0 0 35.907 20.839L444.03 276.7a24 24 0 0 0 .367-41.461ZM128 420.429V84.144l288.244 171.574Z" class="ci-primary"></path>
                          </svg>
                          Preview
                        </a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link" href="https://coreui.io/bootstrap/docs/forms/layout/#form-grid" target="_blank" aria-selected="false" tabindex="-1" role="tab">
                          <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="var(--ci-primary-color, currentcolor)" d="m388.632 393.82 107.191-137.88-107.139-137.762-25.26 19.644 91.864 118.122-91.92 118.236zm-240.053-19.639L56.712 255.999l91.917-118.176-25.258-19.646L16.177 255.993l107.137 137.826zM330.529 16h-32.97L178.441 496h32.971z" class="ci-primary"></path>
                          </svg>
                          Code
                        </a>
                      </li>
                    </ul>
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                        <div class="row">
                          <div class="col">
                            <input class="form-control" type="text" placeholder="First name" aria-label="First name">
                          </div>
                          <div class="col">
                            <input class="form-control" type="text" placeholder="Last name" aria-label="Last name">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>-->

    <!--<div class="row">
            <div class="col-12">
                <div class="row g-3">
                    <div class="col">
                        <label for="ds_categoria">Pesquisar</label>
                        <input type="text" class="form-control" placeholder="Nome da categoria" aria-label="Nome da categoria" name="ds_categoria" id="ds_categoria">
                    </div>
                </div>
            </div>
        </div>-->
            </div>
        </div>
    </div>
    <?php include '../includes/plugins.php'?>
</body>
</html>