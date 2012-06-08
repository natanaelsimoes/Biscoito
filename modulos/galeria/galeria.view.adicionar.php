<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Modulos\Galeria\CategoriaGaleria\TCategoriaGaleriaControl;

include_once('galeria.js.form.php');
?>

<header><h1>Adicionar Galeria</h1></header>
<section>
    <div class="divisor"></div>
    <form name="FrmAdicionarGaleria" id="FrmAdicionarGaleria" class="FrmGaleriaForm">
        <fieldset>
            <label for="textNome">Nome da Galeria:</label>
            <input type="text" name="textNome" id="textNome">
        </fieldset>
        <fieldset>
            <label for="selectCategoriaGaleria">Categoria:</label>
            <div class="selectCategoriaGaleria">
                <?php TCategoriaGaleriaControl::ExibirSelecaoCategorias() ?>
            </div>
        </fieldset>
        <fieldset>
            <label for="textFonte">Fonte:</label>
            <input type="text" name="textFonte" id="textFonte">
        </fieldset>
    </form>
    <div class="divisor"></div>
    <button type="button" onclick="adicionarGaleria()">Adicionar fotos >></button>
</section>