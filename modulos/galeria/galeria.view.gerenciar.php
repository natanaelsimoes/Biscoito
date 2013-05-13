<?php
global $_Biscoito;

use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Galeria', 'administrador');
include_once('galeria.css.padrao.php');
include_once('galeria.js.php');
?>

<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            galeriaJSForm.CarregarGalerias(1)
        }, 500);
    });
</script>

<div class="row page-header">        

    <div class="span6"><h2>Lista de galerias</h2></div>

    <div class="span6 align-right">

        <button class="btn" onclick="_Biscoito.IrPara('administrador/galeria/logomarca/gerenciar')"><i class="icon-attachment"></i> Gerenciar Logomarcas</button> 

<?php include('galeria.view.ui.button.adicionar.php'); ?>

    </div>

</div>    

<div>                
    <div class="loading"><p style="text-align: center"><?php $_Biscoito->imagem('modulos/index/images/loading.gif', 'Carregando...') ?></p></div>
    <div class="galerias"><!-- Carregar Galerias --></div>
    <div class="clear"></div>        

</div>