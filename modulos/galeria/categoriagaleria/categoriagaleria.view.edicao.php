<?php

namespace Biscoito\Modulos\Galeria\CategoriaGaleria\View;

include_once('categoriagaleria.js.php');
?>

<header><h1><?php echo $acao ?> Categoria</h1></header>
<section>
    <form name="FrmCategoriaGaleria" onsubmit="categoriaGaleriaJSForm.Salvar(); return false;">
        <div class="divisor"></div>
        <fieldset>
            <label for="nomeCategoriaGaleria">Nome:</label>
            <input type="text" name="nomeCategoriaGaleria" id="nomeCategoriaGaleria" value="<?php echo $categoria->getNome() ?>">
        </fieldset>
        <input type="hidden" name="idCategoriaGaleria" value="<?php echo $categoria->getId() ?>">
        <input type="hidden" name="objCategoriaGaleria" value='<?php echo $categoria ?>'>
        <div class="divisor"></div>
        <button type="submit">Salvar</button>
    </form>
</section>