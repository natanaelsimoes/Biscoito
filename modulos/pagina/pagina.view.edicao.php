<?php

use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Usuários', 'administrador/usuario/gerenciar');
include_once('pagina.js.php');
?>
<script type="text/javascript" src="http://localhost:8080/Biscoito/plugins/ckeditor/ckeditor.js"></script>

<header class="row-fluid page-header">
  <div class="span6"><h2><?php echo $acao; ?> Página</h2></div>
</header>

<div class="row-fluid">
  <form name="FrmEdicao" id="FrmEdicao" class="well form-horizontal" onsubmit="usuarioJSForm.btnSalvar_Click(); return false;">
    <fieldset>
      <div class="control-group">
        <label class="control-label" for="textNome">Nome*:</label>
        <div class="controls">
          <input type="text" name="Nome" id="textNome" class="input-xxlarge" value="<?php echo $pagina->getNome() ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="textConteudo">Conteúdo*:</label>
        <div class="controls">
          <textarea name="Conteudo" id="textConteudo" class="ckeditor span10" style="height: 500px"></textarea>
        </div>
      </div>
    </fieldset>
    <input type="hidden" name="id" value="<?php echo $pagina->getId() ?>">
    <input type="hidden" name="obj" value='<?php echo $pagina ?>'>
  </form>
  <button onclick="alert(CKEDITOR.instances.textConteudo.getData()); alert($('#FrmEdicao').serialize())">Valor</button>
</div>