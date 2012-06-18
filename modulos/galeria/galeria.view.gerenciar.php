<?php

use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Galeria', 'administrador');

include_once('galeria.css.padrao.php');

include_once('galeria.js.php');
?>

<article class="subhead">    

    <header class="row page-header">        
        <div class="pull-right"><?php include('galeria.view.button.adicionar.php'); ?></div>
    </header>    

    <div>                

        <div class="galerias"><!-- Carregar Galerias --></div>

        <div class="clear"></div>        

    </div>

</article>