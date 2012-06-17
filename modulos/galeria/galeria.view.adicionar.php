<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Modulos\Galeria\CategoriaGaleria\TCategoriaGaleriaControl;

use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Galeria', 'administrador/galeria');

?>

<div class="modal-header">

    <!--<button type="button" class="close" data-dismiss="modal">X</button>-->

    <h1>Adicionar Galeria</h1>

</div>

<div class="modal-body">

    <form name="FrmAdicionarGaleria" id="FrmAdicionarGaleria" class="FrmGaleriaForm form-horizontal">

        <fieldset>

            <div class="control-group">

                <label class="control-label" for="textNome">Nome da Galeria:</label>

                <div class="controls">

                    <input type="text" class="input-xxlarge" id="textNome" name="nome">

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

                    <input type="text" class="input-xxlarge" name="fonte" id="textFonte">   

                </div>

            </div>

        </fieldset>

    </form>

</div>

<div class="modal-footer">    

    <a href="#" class="btn btn-primary" onclick="bs = new BootstrapUtilForm(); bs.confirm('oi?')"><i class="icon-plus"></i> Adicionar fotos &gt;&gt;</a>

</div>