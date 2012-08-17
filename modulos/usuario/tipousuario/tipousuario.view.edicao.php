<?php

namespace Biscoito\Modulos\Usuario\TipoUsuario;

use Biscoito\Modulos\Usuario;
use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Usuários', 'administrador/usuario/tipousuario/gerenciar');

include_once('tipousuario.js.php');
?>

<header class="row-fluid page-header"> 
    <div class="span6"><h2><?php echo $acao; ?> Tipo de Usuário</h2></div>
</header>    

<div class="row-fluid">

    <form name="FrmEdicao" id="FrmEdicao" class="well form-horizontal" onsubmit="tipoUsuarioJSForm.btnSalvar_Click(); return false;">

        <fieldset>

            <div class="control-group">

                <label class="control-label" for="textNome">Nome:</label>

                <div class="controls">

                    <input type="text" name="nome" id="textNome" class="input-xlarge" value="<?php echo $tipoUsuario->getNome() ?>">

                </div>

            </div>  
            
            <div class="control-group">

                <label class="control-label" for="textFlag">Flag:</label>

                <div class="controls">

                    <input type="text" name="flag" id="textFlag" class="input-xlarge" value="<?php echo $tipoUsuario->getFlag() ?>">

                </div>

            </div>

        </fieldset>

        <input type="hidden" name="id" value="<?php echo $tipoUsuario->getId() ?>">

        <input type="hidden" name="obj" value='<?php echo $tipoUsuario ?>'>

    </form>

</div>

<div class="row align-right">

    <button class="btn btn-danger" onclick="_Biscoito.IrPara('administrador/usuario/tipousuario/gerenciar')"><i class="icon-cancel-2"></i> Cancelar</button>

    <button class="btn btn-success" onclick="tipoUsuarioJSForm.btnSalvar_Click();"><i class="icon-checkmark-3"></i> Salvar</button>

</div>