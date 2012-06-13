<?php

namespace Biscoito\Modulos\Galeria\CategoriaGaleria\View;

global $_Biscoito;

include_once('categoriagaleria.js.php');
?>

<select name="categoriagaleria" id="selectCategoriaGaleria">
    <option value="">Selecione uma categoria...</option>
    <?php foreach ($categorias as $categoria) { ?>
        <option value='<?php echo $categoria; ?>'><?php echo $categoria->getNome() ?></option>
    <?php } ?>
</select>
<p class="help-block">
    <a href="#" class="btn" onmouseover="$(this).tooltip('show')" onclick="categoriaGaleriaJSForm.btnEditar_Click()" title="Editar categoria selecionada">
        <i class="icon-edit"></i>
    </a>
    <a href="#" class="btn" onmouseover="$(this).tooltip('show')" onclick="categoriaGaleriaJSForm.btnExcluir_Click()" title="Excluir categoria selecionada">
        <i class="icon-remove"></i>
    </a>
    <a href="#" class="btn" onclick="categoriaGaleriaJSForm.btnAdicionar_Click()">
        <i class="icon-plus-sign"></i> Adicionar Categoria
    </a>
</p>