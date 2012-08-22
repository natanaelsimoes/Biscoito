<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Modulos\Galeria\CategoriaGaleria\TCategoriaGaleriaControl;

if (empty($galeria))
    $galeria = new TGaleria();
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('.FrmGaleriaForm #textNome').focus();
    })
</script>

<div class="modal-body">

    <form name="FrmEditarGaleria" id="FrmEditarGaleria" class="FrmGaleriaForm form-horizontal">

        <fieldset>

            <div class="control-group">

                <label class="control-label" for="textNome">Nome da Galeria:*</label>

                <div class="controls">

                    <input type="text" class="input-xlarge" id="textNome" name="nome" value="<?php echo $galeria->getNome(); ?>">

                </div>

            </div>


            <div class="control-group">

                <label class="control-label" for="selectCategoriaGaleria">Categoria:*</label>

                <div class="controls selectCategoriaGaleria">

                    <?php TCategoriaGaleriaControl::ExibirSelecaoCategorias($galeria->getCategoria_Id()) ?>

                </div>

            </div>

            <div class="control-group">

                <label class="control-label" for="textDescricao">Descrição:</label>

                <div class="controls">

                    <textarea name="descricao" id="textDescricao"><?php echo $galeria->getDescricao(); ?></textarea>                    

                </div>

            </div>

            <div class="control-group">

                <label class="control-label" for="textLocal">Local:</label>

                <div class="controls">

                    <input type="text" class="input-xlarge" name="local" id="textLocal" value="<?php echo $galeria->getLocal(); ?>">   

                </div>

            </div>

            <div class="control-group">

                <label class="control-label" for="textFonte">Fonte:</label>

                <div class="controls">

                    <input type="text" class="input-xlarge" name="fonte" id="textFonte" value="<?php echo $galeria->getFonte(); ?>">   

                </div>

            </div>

            <?php if (empty($galeria)) : ?>
            <div class="control-group">

                <label class="control-label">Progresso:</label>

                <div class="controls">

                    <div class="progress progress-striped active input-xlarge">

                        <div class="bar"style="width: 0%;"></div>

                    </div>

                </div>

            </div>            
            <?php endif; ?>

        </fieldset>
        
        <input type="hidden" name="galeria_id" id="galeria_id" value="<?php echo $galeria->getId(); ?>">

    </form>

</div>

<div class="modal-footer align-center">       
    
    <input type="hidden" id="adicionandoGaleria" value="false">

    <?php if (empty($galeria)) : ?>
    <a href="#" id="btnEnviando" class="btn disabled">Aguarde, enviando fotos...</a>
    <?php endif; ?>

    <a href="#" id="btnSalvar" class="btn btn-success <?php if (empty($galeria)) echo 'hidden' ?>" onclick="galeriaJSForm.btnSalvar_Click()"><i class="icon-checkmark-3"></i> Salvar</a>

</div>