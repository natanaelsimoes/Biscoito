<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Modulos\Galeria\CategoriaGaleria\TCategoriaGaleriaControl;

include_once('galeria.js.php');
?>

<div class="modal-header">      

    <h2>Enquanto enviamos suas fotos para o servidor, entre com os dados referentes à nova galeria!</h2>

</div>

<div class="modal-body">

    <form name="FrmAdicionarGaleria" id="FrmAdicionarGaleria" class="FrmGaleriaForm form-horizontal">

        <fieldset>

            <div class="control-group">

                <label class="control-label" for="textNome">Nome da Galeria:</label>

                <div class="controls">

                    <input type="text" class="input-xlarge" id="textNome" name="nome">

                </div>

            </div>


            <div class="control-group">

                <label class="control-label" for="selectCategoriaGaleria">Categoria:</label>

                <div class="controls selectCategoriaGaleria">

                    <?php TCategoriaGaleriaControl::ExibirSelecaoCategorias() ?>

                </div>

            </div>

            <div class="control-group">

                <label class="control-label" for="textFonte">Fonte:</label>

                <div class="controls">

                    <input type="text" class="input-xlarge" name="fonte" id="textFonte">   

                </div>

            </div>

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