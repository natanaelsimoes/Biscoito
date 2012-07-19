<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Modulos\Galeria\CategoriaGaleria\TCategoriaGaleriaControl;

include_once('galeria.js.php');
?>

<div class="modal-header">      

    <h2>Aguarde enquanto enviamos suas fotos para o servidor...</h2>

</div>

<div class="modal-body">

    <form name="FrmEditarGaleria" id="FrmEditarGaleria" class="FrmGaleriaForm form-horizontal">
        
        <input type="hidden" name="adicionarNovasFotos" value="true">
        
        <input type="hidden" name="galeria_id" value="<?php echo $galeria->getId(); ?>">

        <fieldset>                       

            <div class="control-group">

                <label class="control-label">Progresso:</label>

                <div class="controls">

                    <div class="progress progress-striped active input-xlarge">

                        <div class="bar"style="width: 0%;"></div>

                    </div>

                </div>

            </div>            

        </fieldset>

    </form>

</div>

<div class="modal-footer align-center">       

    <a href="#" id="btnEnviando" class="btn disabled">Aguarde, enviando fotos...</a>

    <a href="#" id="btnSalvar" class="btn btn-success hidden" onclick="galeriaJSForm.btnSalvar_Click()"><i class="icon-checkmark-3"></i> Salvar</a>

</div>