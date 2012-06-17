<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Modulos\Galeria\CategoriaGaleria\TCategoriaGaleriaControl;

use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Galeria', 'administrador/galeria');

include_once('galeria.js.adicionarfotos.php');

include_once('galeria.css.padrao.php');

?>

<div class="modal-header">    

    <h2>Adicione as fotos da sua nova galeria</h2>

</div>
<br>
<div class="align-center" id="dropbox" style="border: 1px dashed #0088cc">

    
    <p><button class="btn btn-large" onclick="$('#fGaleriaFotos').click()"><i class="icon-camera"></i> Clique aqui para selecionar as fotos...</button></p>
    <p>-- ou --</p>
    <p>Arraste suas fotos para dentro do espaço delimitado</p>
    
    <form name="FrmAdicionarFotos" id="FrmAdicionarFotos" class="FrmGaleriaForm">        
    
        <input type="file" name="fotos[]" class="hidden" id="fGaleriaFotos" multiple onchange="galeriaJSAdicionarFotos.manipularImagens(this.files);">
        
        <input type="hidden" name="galeria" id="objGaleria" value="">
        
    </form>
    
    <div id="fotosGaleria" class="align-center"></div>        
    <br style="clear: both">
</div>

<div class="modal-footer">    
<div><span id="progresso">0</span>%</div>    
    <button class="btn btn-primary" onclick="galeriaJSAdicionarFotos.enviarImagens()">Salvar</button>

</div>