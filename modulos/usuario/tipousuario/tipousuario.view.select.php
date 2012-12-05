<?php

namespace Biscoito\Modulos\Usuario\TipoUsuario;

global $_Biscoito;
?>

<select <?php if($readonly) : ?>disabled="disabled"<?php endif;?> name="tipousuario_id" id="selectTipoUsuario_id" class="input-xlarge">
    <option value="">Selecione um tipo de usuário...</option>
    <?php foreach ($tiposUsuario as $tipoUsuario) { ?>
        <option value='<?php echo $tipoUsuario->getId(); ?>' flag="<?php echo $tipoUsuario->getFlag() ?>" <?php if ($tipoUsuario->getId() == $id) : ?>selected="selected"<?php endif;?>><?php echo $tipoUsuario->getNome() ?></option>
    <?php } ?>
</select>