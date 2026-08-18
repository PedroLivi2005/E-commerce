<?php


spl_autoload_register(function ($classe) {
    if (file_exists("../../../gestor.ado/{$classe}.class.php")) {
        include_once "../../../gestor.ado/{$classe}.class.php";
    } 
    else if (file_exists("../../../gestor.control/{$classe}.class.php")) {
        include_once "../../../gestor.control/{$classe}.class.php";
    } 
    else if (file_exists("../../../gestor.model/{$classe}.php")) {
        include_once "../../../gestor.model/{$classe}.php";
    } 
    else if (file_exists("../../../gestor.view/{$classe}.class.php")) {
        include_once "../../../gestor.view/{$classe}.class.php";
    } 
    else if (file_exists("../../../gestor.widgets/{$classe}.class.php")) {
        include_once "../../../gestor.widgets/{$classe}.class.php";
    }
});
extract($_POST);
extract($_GET);

if(isset($evento)){
    switch($evento){
        case 'cadastrar':
            
            $categoria = new AquisicaoCategorias();
            $categoria->descricao = $descricao;
            
            if($categoria->insert()){
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
        
            $categoria = new AquisicaoCategorias();
            $categoria->getObject($cd_categoria);
            $categoria->descricao = $descricao;

            if($categoria->update()){
                $msg_tipo = 1;
                $msg_texto = "Categoria alterada com sucesso!";
                header("location: ".$retorno."?cd_categoria=".$cd_categoria."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            else{
                $msg_tipo = 2;
                $msg_texto = "Erro ao alterar a categoria!";
                header("location: ".$retorno."?cd_categoria=".$cd_categoria."&msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
        
            break;
            
        case 'excluir':
            
            if(AquisicaoCategorias::delete($cd_categoria)){
                $msg_tipo = 1;
                $msg_texto = "Categoria excluído com sucesso";
                header("location: index.php?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto);
            }
            else{
                $msg_tipo = 2;
                $msg_texto = "Erro ao excluir categoria. Entre em contato com o departamento de Tecnologia para maiores informações.";
                header("location: ".$retorno."?msg_tipo=".$msg_tipo."&msg_texto=".$msg_texto."&cd_papel=".$cd_papel);
            }            
            
            break;
    }
}

?>