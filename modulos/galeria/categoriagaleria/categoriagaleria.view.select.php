<?php

namespace Biscoito\Modulos\Galeria\CategoriaGaleria\View;

global $_Biscoito;

include_once('categoriagaleria.js.php');
?>

<select name="selectCategoriaGaleria" id="selectCategoriaGaleria" style="width: 90%">
    <option value="">Selecione uma categoria...</option>
    <?php foreach ($categorias as $categoria) { ?>
        <option value='<?php echo $categoria; ?>'><?php echo $categoria->getNome() ?></option>
    <?php } ?>
</select>
<a href="#" onclick="_Biscoito.AbrirPopup('FrmCategoriaGaleria', 600, 'galeria/categoriagaleria/exibir_formulario_alterar', $('.FrmGaleriaForm').serialize());">
    <?php $_Biscoito->imagem('cms/images/icn_edit.png', 'Alterar'); ?>
</a>
<a href="#" onclick="categoriaGaleriaJSForm.Excluir()">
    <?php $_Biscoito->imagem('cms/images/icn_trash.png', 'Excluir'); ?>
</a>
<p style="text-align: right; margin-right: 20px;">
    <a href="#" onclick="_Biscoito.AbrirPopup('FrmCategoriaGaleria', 600, 'galeria/categoriagaleria/exibir_formulario_adicionar');">
        + Adicionar Categoria
    </a>
</p>
