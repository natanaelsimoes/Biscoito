<?php

namespace Biscoito\Modulos\Galeria\CategoriaGaleria\View;

include_once('categoriagaleria.js.php');
?>

<div class="modal-header">

    <button type="button" class="close" data-dismiss="modal">X</button>

    <h3><?php echo $acao ?> Categoria</h3>

</div>

<div class="modal-body">

    <form name="FrmCategoriaGaleriaEdicao" id="FrmCategoriaGaleriaEdicao" class="FrmCategoriaGaleriaForm form-horizontal" onsubmit="categoriaGaleriaJSForm.btnSalvar_Click(); return false;">

        <fieldset>

            <div class="control-group">

                <label class="control-label" for="textNome">Nome da Categoria:</label>

                <div class="controls">

                    <input type="text" name="nome" id="textNome" class="input-xlarge" value="<?php echo $categoria->getNome() ?>">

                </div>

            </div>        
            
        </fieldset>
        
        <input type="hidden" name="idCategoriaGaleria" value="<?php echo $categoria->getId() ?>">
        
        <input type="hidden" name="objCategoriaGaleria" value='<?php echo $categoria ?>'>
        
    </form>
    
</div>

<div class="modal-footer">

    <button class="btn btn-danger" data-dismiss="modal"><i class="icon-remove-sign"></i> Cancelar</button>

    <button class="btn btn-success" onclick="categoriaGaleriaJSForm.btnSalvar_Click();"><i class="icon-ok-sign"></i> Salvar</button>
    
</div>