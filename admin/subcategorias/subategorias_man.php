<?php
    spl_autoload_register(function ($classe) {
        if (file_exists("../classes/{$classe}.php")) {
            include_once "../classes/{$classe}.php";
        }
    });

extract($_POST);
extract($_GET);

    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $dados_form = [
    //         'ds_categoria' => $_POST['ds_categoria']
    //     ];

    //     // Chama o método estático passando os dados
    //     $resultado = Categorias::inserir($dados_form);
        
    //     if ($resultado) {
    //         header("Location: cadastro.php");
    //         exit;
    //     }
    // }

if(isset($evento)){
    switch($evento){
        case 'cadastrar':
            
            $categoria = new Categorias();
            $categoria->ds_categoria = $ds_categoria;
            
            if($categoria->inserir()){
                $msg_tipo = 1;
                $msg_texto = "Categoria inserida sucesso!";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            else{
                $msg_tipo = 2;
                $msg_texto = "Erro ao inserir a categoria!";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            
            break;
            
        case 'salvar':
        
            $categoria = new Categorias();
            $categoria->getObject($cd_categoria);

            // print($cd_categoria);
            // print_r($categoria);
            // exit;
            $categoria->ds_categoria = $ds_categoria;

            if($categoria->update()){
                $msg_tipo = 1;
                $msg_texto = "Categoria alterada com sucesso!";
                header("location: index.php?cd_categoria=".$cd_categoria."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            else{
                $msg_tipo = 2;
                $msg_texto = "Erro ao alterar a categoria!";
                header("location: index.php?cd_categoria=".$cd_categoria."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
        
            break;
            
        case 'excluir':
            
            if(Categorias::delete($cd_categoria)){
                $msg_tipo = 1;
                $msg_texto = "Categoria excluído com sucesso";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            else{
                $msg_tipo = 2;
                $msg_texto = "Erro ao excluir categoria. Entre em contato com o departamento de Tecnologia para maiores informações.";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto."&cd_papel=".$cd_papel);
            }            
            
            break;
    }
}