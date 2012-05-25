<?php

namespace Biscoito\Modulos\Galeria\CategoriaGaleria\View;

global $_Biscoito;
?>

<select name="selectCategoria" id="selectCategoria">
    <option value="">Selecione uma categoria...</option>
    <?php foreach ($categorias as $categoria) { ?>
        <option value="<?php echo $categoria ?>"><?php echo $categoria->getNome() ?></option>
    <?php } ?>
</select><a href="#"><?php $_Biscoito->imagem('cms/images/icn_edit.png', 'Alterar'); ?></a>
    <a href="#"><?php $_Biscoito->imagem('cms/images/icn_trash.png', 'Excluir'); ?></a>
<p style="text-align: right; margin-right: 20px;">
    <a href="#" onclick="_Biscoito.AbrirPopup('FrmCategoriaGaleria', 600, 'galeria/categoriagaleria/exibir_formulario_adicionar');">+ Adicionar Categoria</a>
</p>
