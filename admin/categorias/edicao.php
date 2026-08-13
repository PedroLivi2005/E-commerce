<?php
    include('../includes/valida_sessao.php');

    spl_autoload_register(function ($classe) {
        if (file_exists("../classes/{$classe}.php")) {
            include_once "../classes/{$classe}.php";
        }
        });

    // $ds_categoria = null;
    // extract($_POST);
?>
    <!-- inicio  -->
    <?php include '../includes/preheader.php'?>
    <!-- fim -->
    <?php include '../includes/menu.php'?>

    <div class="wrapper d-flex flex-column min-vh-100">

    <?php
        $breadcrumb_item = 'Categorias';
        include '../includes/header.php';

        //include '../classes/Categorias.php';
        include '../includes/conexao.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 1. Captura os dados do array $_POST. 
            // O operador '??' evita erros caso o campo não tenha sido enviado.
            $cd_categoria = $_GET['cd_categoria'] ?? null;
            $ds_categoria = $_POST['ds_categoria'] ?? null;

            // 2. Validação simples para garantir que não estão vazios
            if (!empty($cd_categoria) && !empty($ds_categoria)) {
                
                // 3. Chama o método passando os dados do formulário
                $atualizou = Categorias::update($cd_categoria, $ds_categoria);

                // 4. Dá o feedback ao usuário
                if ($atualizou) {
                    // Sucesso! Pode redirecionar ou exibir mensagem
                    echo "A categoria foi atualizada com sucesso!";
                    // header("Location: lista_categorias.php"); exit;
                } else {
                    echo "Erro ao atualizar no banco de dados.";
                }
                
            } else {
                echo "Por favor, preencha todos os campos corretamente.";
            }
        } else {
            echo "Preencha os campos.";
        }
        
        /*
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT ds_categoria FROM categorias WHERE cd_categoria = :cd_categoria;");
        $stmt->execute(['cd_categoria' => $cd_categoria]);
        $ds_categoria = $stmt->fetchColumn();
        */
    ?>
        <div class="body">
            <div class="container-lg px-4"><!-- Espaços na laterais -->     
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Editar Categoria</strong>
                                <span class="small ms-1"></span>
                            </div>
                            <div class="card-body"> 
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                                            <div class="row">
                                                <div class="col-12">
                                                    <form action="" method="post">
                                                        <div class="row g-3">
                                                            <div class="col-10">
                                                                <input class="form-control" type="text" placeholder="Nome da categoria" aria-label="default input example" name="ds_categoria" id="ds_categoria" value="" required>
                                                            </div>
                                                            
                                                            <div class="col-1">
                                                                <input type="submit" class="btn btn-success" value="Salvar">
                                                            </div>
                                                            <div class="col-1">
                                                                <button type="button" class="btn btn-danger">Excluir</button>
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