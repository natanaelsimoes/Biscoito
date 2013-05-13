<?php

namespace Biscoito\Modulos\Usuario;

use Biscoito\Modulos\Administrador\TAdministradorControl;

global $_UsuarioLogado;

TAdministradorControl::CabecalhoModulo('Usuários', 'administrador/usuario/gerenciar');

include_once('usuario.js.php');
?>

<header class="row-fluid page-header"> 
  <div class="span6"><h2><?php echo $acao; ?> Usuário</h2></div>
</header>    
<div class="row-fluid">
  <div class="span6">
    <form name="FrmEdicao" id="FrmEdicao" class="well form-horizontal" onsubmit="usuarioJSForm.btnSalvar_Click();
            return false;">
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
            <?php TipoUsuario\TTipoUsuarioControl::ExibirSelecao($usuario->getId(), $usuario->getTipoUsuario_Id()); ?>
          </div>
        </div>        
        <div class="control-group">
          <label class="control-label" for="textUsuario">Nome de usuario*:</label>
          <div class="controls">
            <input type="text" <?php if ($usuario->getEstado() != 0) echo 'readonly="readonly"' ?> name="usuario" id="textUsuario" class="input-medium" value="<?php echo $usuario->getUsuario() ?>">
          </div>

        </div>  

        <?php if ($usuario->getEstado() == 0) : ?>

          <div class="control-group">

            <label class="control-label">Senha:</label>

            <div class="controls">

              <span style="font-size: 16px; font-weight: bold"><?php echo $passGen = substr(uniqid(), 7); ?></span>

              <input type="hidden" name="novaSenha" value="<?php echo $passGen; ?>">

            </div>

          </div>

        <?php endif; ?>

      </fieldset>

      <input type="hidden" name="id" value="<?php echo $usuario->getId() ?>">

      <input type="hidden" name="obj" value='<?php echo $usuario ?>'>                        

    </form>

    <div class="align-right">

      <button class="btn btn-danger" onclick="_Biscoito.IrPara('administrador/usuario/gerenciar')"><i class="icon-cancel-2"></i> Cancelar</button>

      <button class="btn btn-success" onclick="usuarioJSForm.btnSalvar_Click();"><i class="icon-checkmark-3"></i> Salvar</button>

    </div>

  </div>

  <?php if ($usuario->getEstado() != 0) : ?>

    <div class="span6">

      <h3>Deseja alterar a senha?</h3>

      <form name="FrmEdicaoSenha" id="FrmEdicaoSenha" class="well form-horizontal" onsubmit="usuarioJSForm.btnSalvar_Click();
              return false;">

        <div class="control-group">

          <label class="control-label" for="textSenhaAtual">Senha atual:</label>

          <div class="controls">

            <input type="password" name="senhaAtual" id="textSenhaAtual" class="input-medium" value="">

          </div>

        </div>

        <div class="control-group">

          <label class="control-label" for="textSenha">Nova senha:</label>

          <div class="controls">

            <input type="password" name="senha" id="textSenha" class="input-medium" value="">

          </div>

        </div>

        <div class="control-group">

          <label class="control-label" for="textConfSenha">Repita a nova senha:</label>

          <div class="controls">

            <input type="password" name="confSenha" id="textConfSenha" class="input-medium" value="">

          </div>

        </div>

        </fieldset>

        <input type="hidden" name="id" value="<?php echo $usuario->getId() ?>">

        <input type="hidden" name="obj" value='<?php echo $usuario ?>'>

      </form>

      <div class="align-right">           

        <button class="btn" onclick="usuarioJSForm.btnAlterarSenha_Click();"><i class="icon-pencil-2"></i> Alterar senha</button>

      </div>

      <div class="align-right">           
        <br>
        <?php if ($usuario->getStatus()) : ?>
          <a href="#" onclick="usuarioJSForm.btnDesativar_Click();">Desativar usuário</a>
        <?php else : ?>
          (Usuário desativado) <a href="#" onclick="usuarioJSForm.btnReativar_Click();">Reativar usuário</a>
        <?php endif; ?>
        | <a href="#" onclick="usuarioJSForm.btnExcluir_Click();">Excluir usuário</a>
      </div>

    </div>

  <?php endif; ?>

</div>