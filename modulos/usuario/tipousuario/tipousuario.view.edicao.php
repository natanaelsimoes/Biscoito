<?php

namespace Biscoito\Modulos\Usuario\TipoUsuario;

include_once('tipousuario.js.php');
?>

<div class="modal-header">

    <button type="button" class="close" onclick="_Biscoito.FecharPopup()">X</button>

    <h3><?php echo $acao ?> Tipo de Usuário</h3>

</div>

<div class="modal-body">

    <form name="FrmTipoUsuarioEdicao" id="FrmTipoUsuarioEdicao" class="FrmTipoUsuarioForm form-horizontal" onsubmit="return false;">

        <fieldset>

            <div class="control-group">

                <label class="control-label" for="textNome">Nome:</label>

                <div class="controls">

                    <input type="text" name="nome" id="textNome" class="input-xlarge" value="<?php echo $tipoUsuario->getNome() ?>">

                </div>

            </div>        
            
        </fieldset>
        
        <input type="hidden" name="idCategoriaGaleria" value="<?php echo $tipoUsuario->getId() ?>">
        
        <input type="hidden" name="objCategoriaGaleria" value='<?php echo $tipoUsuario ?>'>
        
    </form>
    
</div>

<div class="modal-footer">

    <button class="btn btn-danger" onclick="_Biscoito.FecharPopup()"><i class="icon-cancel-2"></i> Cancelar</button>

    <button class="btn btn-success" onclick=""><i class="icon-checkmark-3"></i> Salvar</button>
    
</div>