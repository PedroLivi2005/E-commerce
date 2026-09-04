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
                $msg_texto = "Erro ao inserir subcategoria!";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            
            break;
            
        case 'salvar':
        
            $subcategoria = new Subcategorias();
            $subcategoria->getObject($cd_subcategoria);

            // print($cd_subcategoria);
            // print_r($subcategoria);
            // exit;
            $subcategoria->ds_subcategoria = $ds_subcategoria;
            $subcategoria->cd_categoria = $cd_categoria;

            if($subcategoria->update()){
                $msg_tipo = 1;
                $msg_texto = "Subcategoria alterada com sucesso!";
                header("location: index.php?cd_subcategoria=".$cd_subcategoria."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            else{
                $msg_tipo = 2;
                $msg_texto = "Erro ao alterar subcategoria!";
                header("location: index.php?cd_subcategoria=".$cd_subcategoria."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
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