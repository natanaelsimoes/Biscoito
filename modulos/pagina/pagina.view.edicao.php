<?php
global $_Biscoito;

use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Páginas', 'administrador/pagina/gerenciar');
include_once('pagina.js.php');
?>
<script type="text/javascript" src="<?php echo $_Biscoito->getSite(); ?>plugins/ckeditor/ckeditor.js"></script>

<header class="row-fluid page-header">
  <div class="span6"><h2><?php echo $acao; ?> Página</h2></div>
</header>

<div class="row-fluid">
  <form name="FrmEdicao" id="FrmEdicao" class="well form-horizontal" onsubmit="usuarioJSForm.btnSalvar_Click(); return false;">
    <fieldset>
      <div class="control-group">
        <label class="control-label" for="textNome">Nome*:</label>
        <div class="controls">
          <input type="text" name="Nome" id="textNome" class="input-xxlarge" value="<?php echo $pagina->getNome() ?>" onblur="paginaJSForm.onTextNome_Blur()">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="textApelido">Apelido:</label>
        <div class="controls">
          <input type="text" name="Apelido" id="textApelido" class="input-xxlarge" value="<?php echo $pagina->getApelido() ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="textConteudo">Conteúdo*:</label>
        <div class="controls">
          <textarea name="textConteudo" id="textConteudo" class="ckeditor span10" style="height: 500px"><?php echo $pagina->getConteudo() ?></textarea>
          <input type="hidden" name="Conteudo" id="hConteudo" value="">
        </div>
      </div>
      <?php if($pagina->getEstado()) : ?>
      <div class="control-group">
        <label class="control-label" for="aExcluir"></label>
        <div class="controls">
          <a href="#" onclick="paginaJSForm.btnExcluir_Click();">Excluir página</a>
        </div>
      </div>
      <?php endif; ?>
    </fieldset>
    <input type="hidden" name="id" value="<?php echo $pagina->getId() ?>">
    <input type="hidden" name="obj" value='<?php echo $pagina ?>'>
  </form>
  <div class="align-right">
    <button class="btn btn-danger" onclick="_Biscoito.IrPara('administrador/pagina/gerenciar')"><i class="icon-cancel-2"></i> Cancelar</button>
    <button class="btn btn-success" onclick="paginaJSForm.btnSalvar_Click();"><i class="icon-checkmark-3"></i> Salvar</button>

  </div>
</div>