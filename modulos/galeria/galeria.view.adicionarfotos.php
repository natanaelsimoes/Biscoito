<?php

namespace Biscoito\Modulos\Galeria;

include_once('galeria.js.adicionarfotos.php');
?>

<section>   
    <form name="FrmAdicionarFotos" id="FrmAdicionarFotos" class="FrmGaleriaForm">
        <input type="file" name="fotos[]" id="fGaleriaFotos" multiple onchange="handleFiles(this.files); sendFiles();">
        <input type="hidden" name="galeria" id="objGaleria" value="">
    </form>
    <div id="fotosGaleria"></div>
    <div id="dropbox"></div>
</section>