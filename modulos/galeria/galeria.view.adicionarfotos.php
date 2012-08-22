<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Galeria', 'administrador/galeria');

include_once('galeria.js.php');

include_once('galeria.css.padrao.php');

global $_Biscoito;
?>

<div class="modal-header">    

    <h2>

        <?php if (empty($galeria)): ?>Adicione as fotos da sua nova galeria

        <?php else : ?>Adicione mais fotos a: <?php echo $galeria->getNome(); ?>

        <?php endif; ?>

    </h2>

</div>
<br>

<div class="row">

    <form class="form-horizontal">

        <div class="control-group pull-right">

            <label class="control-label" for="cmbFotoFill">Preencher com:</label>

            <div class="controls">

                <select id="cmbFotoFill" onchange="galeriaJSAdicionarFotos.mudarCorPreenchimento()">
                    
                    <option style="background-color: #ddd" value="">Não preencher</option>
                    
                    <option style="background-color: #fff" value="#fff" selected="selected">Branco</option>
                    
                    <option style="background-color: #222; color: #fff" value="#222">Preto</option>                                        
                    
                    <option style="background-color: #f22; color: #fff" value="#f22">Vermelho</option>
                    
                    <option style="background-color: #ff2" value="#ff2">Amarelo</option>
                    
                    <option style="background-color: #22f; color: #fff" value="#22f">Azul</option>
                    
                    <option style="background-color: #2f2" value="#2f2">Verde</option>
                    
                </select>

            </div>

        </div>

    </form>

</div>

<div class="align-center" id="dropbox" style="border: 1px dashed #0088cc">

    <p><button class="btn btn-large" onclick="$('#fGaleriaFotos').click()"><i class="icon-camera"></i> Clique aqui para selecionar as fotos...</button></p>
    <p>-- ou --</p>
    <p>Arraste suas fotos para dentro do espaço delimitado</p>

    <form name="FrmAdicionarFotos" id="FrmAdicionarFotos" class="FrmGaleriaForm">        

        <input type="file" name="fotos[]" class="hidden" id="fGaleriaFotos" multiple onchange="galeriaJSAdicionarFotos.manipularImagens(this.files);">

        <input type="hidden" name="galeria" id="objGaleria" value="">

    </form>

    <div id="fotosGaleria" class="align-center"></div>        

    <canvas id="fotoFill" width="1" height="1"></canvas>

    <br style="clear: both">
</div>

<div class="modal-footer align-center">    

    <input type="hidden" id="adicionandoGaleria" value="<?php echo (!empty($galeria)) ? 'true' : 'false'; ?>">

    <input type="hidden" id="galeria_id" value="<?php if (!empty($galeria)) echo $galeria->getId(); ?>">

    <button id="btnEnviar" class="btn btn-primary hidden" onclick="galeriaJSAdicionarFotos.btnEnviarFotos_Click()"><i class="icon-upload-2"></i> Enviar Fotos</button>

</div>