<?php

namespace Biscoito\Modulos\Galeria;
?>

<header><h1>Enviando fotos...</h1></header>
<section>   
    <form name="FrmAdicionarFotos" id="FrmAdicionarFotos" class="FrmGaleriaForm">
        <input type="file" name="fotos[]" id="fGaleriaFotos" multiple>
        <input type="hidden" name="galeria" id="objGaleria" value="">
    </form>        
</section>