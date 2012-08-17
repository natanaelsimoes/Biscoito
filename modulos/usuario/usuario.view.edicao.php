<?php

namespace Biscoito\Modulos\Usuario\TipoUsuario;

use Biscoito\Modulos\Usuario;
use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Usuários', 'administrador/usuario/gerenciar');

include_once('usuario.js.php');
?>

<header class="row-fluid page-header"> 
    <div class="span6"><h2><?php echo $acao; ?> Usuário</h2></div>
</header>    

<div class="row-fluid">

    <form name="FrmEdicao" id="FrmEdicao" class="well form-horizontal" onsubmit="usuarioJSForm.btnSalvar_Click(); return false;">

        <fieldset>

            <div class="control-group">

                <label class="control-label" for="textNome">Nome*:</label>

                <div class="controls">

                    <input type="text" name="nome" id="textNome" class="input-xlarge" value="<?php echo $usuario->getNome() ?>">

                </div>

            </div>  

            <div class="control-group">

                <label class="control-label" for="textNomeMeio">Nome do meio:</label>

                <div class="controls">

                    <input type="text" name="nomeMeio" id="textMeio" class="input-xlarge" value="<?php echo $usuario->getNomeDoMeio() ?>">

                </div>

            </div>

            <div class="control-group">

                <label class="control-label" for="textSobrenome">Sobrenome*:</label>

                <div class="controls">

                    <input type="text" name="sobrenome" id="textSobrenome" class="input-xlarge" value="<?php echo $usuario->getSobrenome() ?>">

                </div>

            </div>

            <div class="control-group">

                <label class="control-label" for="textNomeMeio">Tipo de Usuário*:</label>

                <div class="controls">

                    <input type="text" name="nomeMeio" id="textMeio" class="input-xlarge" value="<?php echo $usuario->getNomeDoMeio() ?>">

                </div>

            </div>
            
            <div class="control-group">

                <label class="control-label" for="textUsuario">Nome de usuario*:</label>

                <div class="controls">

                    <input type="text" name="usuario" id="textUsuario" class="input-medium" value="<?php echo $usuario->getUsuario() ?>">

                </div>

            </div>
            
            <div class="control-group">

                <label class="control-label" for="textSenha">Senha*:</label>

                <div class="controls">

                    <input type="password" name="senha" id="textSenha" class="input-medium" value="<?php echo $usuario->getUsuario() ?>">

                </div>

            </div>

        </fieldset>

        <input type="hidden" name="id" value="<?php echo $usuario->getId() ?>">

        <input type="hidden" name="obj" value='<?php echo $usuario ?>'>

    </form>

</div>

<div class="row align-right">

    <button class="btn btn-danger" onclick="_Biscoito.IrPara('administrador/usuario/gerenciar')"><i class="icon-cancel-2"></i> Cancelar</button>

    <button class="btn btn-success" onclick="usuarioJSForm.btnSalvar_Click();"><i class="icon-checkmark-3"></i> Salvar</button>

</div>