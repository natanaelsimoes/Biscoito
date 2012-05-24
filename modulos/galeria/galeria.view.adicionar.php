<?php

namespace Biscoito\Modulos\Galeria\View;

use Biscoito\Modulos\Galeria\CategoriaGaleria\TCategoriaGaleriaControl;

include('galeria.css.form.php');

include('galeria.js.form.php');
?>

<header><h1>Adicionar Galeria</h1></header>
<div class="divisor"></div>
<fieldset>
    <label for="textNome">Nome da Galeria:</label>
    <input type="text" name="textNome" id="textNome">
</fieldset>
<fieldset>
    <label for="selectCategoria">Categoria:</label>
    <?php TCategoriaGaleriaControl::ExibirSelecaoCategorias() ?>
</fieldset>
<fieldset>
    <label for="textFonte">Fonte:</label>
    <input type="text" name="textFonte" id="textFonte" style="width:92%;">
</fieldset>
<div class="divisor"></div>
<button type="button" onclick="ValidarGaleria()">Adicionar fotos >></button>