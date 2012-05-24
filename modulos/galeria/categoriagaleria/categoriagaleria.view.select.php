<?php

namespace Biscoito\Modulos\Galeria\CategoriaGaleria\View;

include('categoriagaleria.js.form.php');
?>

<select name="selectCategoria" id="selectCategoria">
    <option value="">Selecione uma categoria...</option>
    <?php foreach ($categorias as $categoria) { ?>
        <option value="<?php echo $categoria ?>"><?php echo $categoria->getNome() ?></option>
    <?php } ?>
</select>
<p style="text-align: right; margin-right: 20px;">
<a href="#" onclick="GerenciarCategoria('exibir_formulario_adicionar')">+ Adicionar Categoria</a>
</p>
