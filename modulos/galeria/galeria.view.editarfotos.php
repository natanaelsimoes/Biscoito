<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Galeria', 'administrador/galeria');

include_once('galeria.js.php');

include_once('galeria.css.padrao.php');
?>

<script type="text/javascript">
    $(document).ready(function(){ 
        galeriaJSForm.CarregarFotos(<?php echo $galeria->getId() ?>, 1);
    });
</script>

<div class="page-header row">    

    <div class="span6"><h2><?php echo $galeria->getNome(); ?></h2></div>        
    
    <div class="span6 align-right"><a href="#" class="btn"><i class="icon-remove-2"></i> Editar dados da galeria</a> <a href="#" onclick="_Biscoito.IrPara('administrador/galeria/adicionarfotos/<?php echo $galeria->getId() ?>')" class="btn btn-primary"><i class="icon-plus"></i> Adicionar mais fotos</a></div>

</div>
<br />
<div class="loading"><p style="text-align: center"><?php $_Biscoito->imagem('modulos/index/images/loading.gif', 'Carregando...') ?></p></div>
<div class="fotos">
    <!-- Carregar fotos -->
</div>