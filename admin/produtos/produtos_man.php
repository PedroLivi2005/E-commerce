<?php
    spl_autoload_register(function ($classe) {
        if (file_exists("../classes/{$classe}.php")) {
            include_once "../classes/{$classe}.php";
        }
    });

extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){
        case 'cadastrar':
            
            $subcategoria = new Subcategorias();

            // print_r($subcategoria);
            // exit;
            $subcategoria->ds_subcategoria = $ds_subcategoria;
            $subcategoria->cd_categoria = $cd_categoria;
            
            if($subcategoria->inserir()){
                $msg_tipo = 1;
                $msg_texto = "Subcategoria inserida sucesso!";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            else{
                $msg_tipo = 2;
                $msg_texto = "Erro ao inserir a subcategoria!";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            
            break;
            
        case 'salvar':
        
            $produto = new Produtos();
            $produto->getObject($cd_produto);

            // print($cd_subcategoria);
            // print_r($subcategoria);
            // exit;
            $produto->nm_produto = $nm_produto;
            $produto->cd_subcategoria = $cd_subcategoria;

            if($produto->update()){
                $msg_tipo = 1;
                $msg_texto = "Produto alterado com sucesso!";
                header("location: index.php?cd_subcategoria=".$cd_produto."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            else{
                $msg_tipo = 2;
                $msg_texto = "Erro ao alterar produto!";
                header("location: index.php?cd_produto=".$cd_produto."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
        
            break;
            
        case 'excluir':
            
            if(Subcategorias::delete($cd_subcategoria)){
                $msg_tipo = 1;
                $msg_texto = "Subcategoria excluído com sucesso";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            else{
                $msg_tipo = 2;
                $msg_texto = "Erro ao excluir subcategoria.";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto."&cd_papel=".$cd_papel);
            }            
            
            break;
    }
}