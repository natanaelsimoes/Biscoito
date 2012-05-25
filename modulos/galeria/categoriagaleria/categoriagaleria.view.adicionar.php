<?php

namespace Biscoito\Modulos\Galeria\CategoriaGaleria\View;

include('categoriagaleria.js.php');

include('categoriagaleria.js.adicionar.php');
?>

<header><h1>Adicionar Categoria</h1></header>
<div class="divisor"></div>
<form name="FrmCategoriaGaleria">
    <fieldset>
        <label for="nomeCategoriaGaleria">Nome:</label>
        <input type="text" name="nomeCategoriaGaleria" id="nomeCategoriaGaleria">
    </fieldset>
</form>
<div class="divisor"></div>
<button type="button" id="btnAdicionarCategoriaGaleria">Salvar</button>