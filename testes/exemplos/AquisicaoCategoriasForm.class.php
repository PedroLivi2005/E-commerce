<?php

/**
 * Classe: TiposProcJuridicosForm
 * Descrição: Classe responsável pelo layout dos formulários de Tipos de Processo Juridico
 * Autor: Maurício Batista
 * Data: 25/01/2017
 */

class AquisicaoCategoriasForm {
    /**
     * Função: campoSelect ()
     * Descrição: Monta o layout do campo select de loacis
     * Parâmetros:
     *      -> $defaul: recebe o campo cd_local pré selecionado
     */
    static function campoSelect($default = null){
        $lista = AquisicaoCategorias::listaTodos();
        ?>
        	<select name="cd_categoria" id="cd_categoria" class="form-control" required="true">
                <?php                
                    if(isset($default)){
                        $objetoDefault;
                        ?>
                            <option value="<?= $objetoDefault ?>"><?= $objetoDefault; ?></option>
                        <?php                
                    }
                ?>
                <option value="0"></option>
                <?php
                    foreach ($lista as $objeto){
                        ?>
                            <option value="<?= $objeto->cd_categoria; ?>"><?= $objeto->descricao; ?></option>
                        <?php
                    }                
                ?>
            </select>
        <?php
    }
    
    /**
     * Função: pesquisa()
     * Descrição: Monta o layout do formulário de pesquisa de acontecimentos
     * Parâmetros: 
     */
    static function pesquisa(){
        ?>
            <!-- TO DO List -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Pesquisar Categoria</h3>
                </div><!-- /.box-header -->
                <form action="index.php" method="GET" role="form">
                    <div class="box-body">                            
                        <div class="box-body">
                            <div class="row">                                
                            <div class="col-lg-12 col-md-12">
                                <label for="nr_conselho">Descric&atilde;o Categoria:</label>
                                <input type="text" class="form-control" id="descricao" name="descricao">
                            </div>                               
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix no-border">
                        <center>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
                            &nbsp;
                            <button onclick="window.location = 'index.php';" class="btn btn-primary">Limpar pesquisa</button>
                        </center>
                    </div>
                </form>
            </div><!-- /.box -->
        <?php
    }
    
    /**
     * Função: novo()
     * Descrição: Monta o layout do formulário de novo acontecimento
     * Parâmetros: 
     *      -> $retorno: variável que indicará para qual url o formulário deverá retornar
     */
    static function novo($retorno){
        ?>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#dados" data-toggle="tab">Dados Cadastrais</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="dados">
                        <?php
                            self::formNovo($retorno);
                        ?>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div>    
        <?php
    }
               
    /**
     * Função: formNovo()
     * Descrição: Monta o layout do formulário de cadastro de de um novo acontecimento
     * Parâmetros: 
     *      -> $retorno: variável que indicará para qual url o formulário deverá retornar
     */    
    static function formNovo($retorno){
        
        ?>
            <form action="<?= $_SESSION['parametro']->dominio_retorno; ?>/gestor.view/<?= AquisicaoCategorias::DIRETORIO ?>/categoria_man.php" name="novo" id="novo" method="POST" role="form">
                <input type="hidden" name="retorno" id="retorno" value="<?= $retorno; ?>" />
                <input type="hidden" name="evento" id="evento" value="cadastrar" />
                <div class="box-body">     
                    <div class="row">
                        <div class="col-lg-12">
                            <label>(*) Campos Obrigat&oacute;rios</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <label for="">Descricao*</label>
                            <input type="text" class="form-control" id="descricao" name="descricao"> 
                        </div>                       
                    </div>  
                </div>
                <div class="box-footer clearfix no-border">
                    <center>
                        <button type="button" class="btn btn-primary" onclick="cadastrar()"><i class="fa fa-plus"></i> Cadastrar</button>
                    </center>
                </div>
            </form>
            
            <script>                
                function cadastrar(){
                    if(document.novo.descricao.value == ''){
                        alert("O campo Descric\u00e3o n\u00e3o pode ficar em branco!");
                    }
                    else{
                        document.novo.submit();
                    }
                }
            </script>
        <?php
    }
    
    /**
     * Função: novo()
     * Descrição: Monta o layout do formulário de novo acontecimento
     * Parâmetros:
     *      -> $retorno: variável que indicará para qual url o formulário deverá retornar
     */
    static function edita($retorno, $objeto, $consulta){
        ?>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#dados" data-toggle="tab">Dados Cadastrais</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="dados">
                        <?php
                            self::formEdita($retorno, $objeto, $consulta);
                        ?>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div>    
        <?php
    }
               
    /**
     * Função: formNovo()
     * Descrição: Monta o layout do formulário de cadastro de de um novo acontecimento
     * Parâmetros: 
     *      -> $retorno: variável que indicará para qual url o formulário deverá retornar
     */    
    static function formEdita($retorno, $objeto, $consulta = false){
        
        ?>
            <form action="<?= $_SESSION['parametro']->dominio_retorno; ?>/gestor.view/<?= AquisicaoCategorias::DIRETORIO ?>/categoria_man.php" name="edita" id="edita" method="POST" role="form">
                <fieldset <?php if($consulta) echo "disabled"; ?>>
                    <input type="hidden" name="retorno" id="retorno" value="<?= $retorno; ?>" />
                    <input type="hidden" name="<?= AquisicaoCategorias::ID ?>" id="<?= AquisicaoCategorias::ID ?>" value="<?= $objeto->cd_categoria; ?>" />
                    <input type="hidden" name="evento" id="evento" value="salvar" />
                    <div class="box-body">     
                        <div class="row">
                            <div class="col-lg-12">
                                <label>(*) Campos Obrigat&oacute;rios</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <label for="nm_principal">Descri&ccedil;&atilde;o:*</label>
                                <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $objeto->descricao; ?>" /> 
                            </div>                    
                        </div>  
                    </div>
                    <div class="box-footer clearfix no-border">
                        <center>
                            <button type="button" class="btn btn-primary" onclick="salvar()"><i class="fa fa-save"></i> Salvar</button>
                            <button type="button" class="btn btn-danger" onclick="excluir()"><i class="fa fa-times"></i> Excluir</button>
                        </center>
                    </div>
                </fieldset>
            </form>
            
            <script>                
                function salvar(){
                	if(document.edita.descricao.value == '')
                        alert("O campo descric\u00e3o n\u00e3o pode ficar em branco!");                      
                    else
                        document.edita.submit();                    
                }

                function excluir(){
					if(confirm("Deseja realmente excluir este registro?")){
						document.edita.evento.value = 'excluir'; 
						document.edita.submit(); 
                    }
                }
            </script>
        <?php
    }
}

?>