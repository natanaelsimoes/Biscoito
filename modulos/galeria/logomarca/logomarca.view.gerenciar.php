<?php

namespace Biscoito\Modulos\Galeria\Logomarca;

use Biscoito\Modulos\Administrador\TAdministradorControl;

global $_Biscoito;

TAdministradorControl::CabecalhoModulo('Galeria', 'administrador/galeria');

include_once('logomarca.css.php');

include_once('logomarca.js.php');
?>

<div class="page-header">        

    <h2>Logomarcas</h2>

</div>    

<div class="row">

    <div class="logomarcas">

        <?php $_Biscoito->imagem('modulos/galeria/fotos/sample.jpg', 'Exemplo'); ?>

        <?php $_Biscoito->imagem('modulos/galeria/fotos/logo_template.png', 'Logomarca'); ?>

        <div class="logorow row1">
            <div class="logospot" data-position="1"></div>
            <div class="logospot" data-position="2"></div>
            <div class="logospot" data-position="3"></div>
        </div>

        <div class="logorow row2">
            <div class="logospot" data-position="4"></div>
            <div class="logospot" data-position="5"></div>
            <div class="logospot" data-position="6"></div>
        </div>

        <div class="logorow row3">
            <div class="logospot" data-position="7"></div>
            <div class="logospot" data-position="8"></div>
            <div class="logospot" data-position="9"></div>
        </div>

    </div>

</div>   

<div class="modal hide" id="ModalLogomarca">
    
    <div class="modal-header"><h2>Nova Logomarca</h2></div>
    
    <div class="modal-body">
        
        <div class="alert alert-info">A nova logomarca será sobreposta na posição <span id="posicaoTexto"></span></div>
        
        <form name="FrmLogomarca" id="FrmLogomarca" method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo $GLOBALS['_Biscoito']->getSite(); ?>administrador/galeria/logomarca/salvar/">
        
            <div class="control-group">
            
                <label for="logo">Imagem: </label>
                
                <input type="file" name="logo" id="logo">
                
            </div>            
            
            <input type="hidden" name="posicao" id="posicao">
            
        </form>        
        
    </div>
    
    <div class="modal-footer">                
        
        <button class="btn btn-danger" data-dismiss="modal"><i class="icon-cancel-2"></i> Cancelar</button>

        <button class="btn btn-success" onclick="btnSalvar_Click(this)"><i class="icon-checkmark-3"></i> Salvar</button>
    
    </div>
    
</div>

<div class="clear"></div>        