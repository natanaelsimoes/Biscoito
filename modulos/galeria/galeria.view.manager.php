<?php include('galeria.css.default.php'); ?>
<?php include('galeria.js.manager.php'); ?>
<?php $GLOBALS['_Biscoito']->usarJQueryUI(); ?>

<article class="module width_full">

    <header><h3>Lista de Galerias</h3></header>

    <div class="module_content">

        <button type="button" onclick="GerenciarGaleria('exibir_formulario_adicionar')">+ Adicionar Galeria</button>

        <div class="spacer"></div>

        <div class="galerias"><!-- Carregar Galerias --></div>
        
        <div class="clear"></div>
        
        <div class="spacer"></div>

    </div>

</article>