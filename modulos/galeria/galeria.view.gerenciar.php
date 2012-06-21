<?php

use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Galeria', 'administrador');

include_once('galeria.css.padrao.php');

include_once('galeria.js.php');
?>

<script type="text/javascript">
    $(document).ready(function(){ 
        galeriaJSForm.CarregarGalerias(1)
    });
</script>

<div class="row page-header">        
    
    <div class="span6"><h2>Lista de galerias</h2></div>
    
    <div class="span6 align-right"><?php include('galeria.view.ui.button.adicionar.php'); ?></div>
    
</div>    

<div>                

    <div class="galerias"><!-- Carregar Galerias --></div>

    <div class="clear"></div>        

</div>