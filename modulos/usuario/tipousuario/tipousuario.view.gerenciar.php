<?php

use Biscoito\Modulos\Usuario;
use Biscoito\Modulos\Usuario\TipoUsuario;
use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Usu�rios', 'administrador');
?>

<article class="subhead">    

    <header class="row page-header">        
        <div class="pull-right">
            <button class="btn">Gerenciar Tipos de Usu�rio</button>
            <button type="button" onclick="_Biscoito.IrPara('administrador/usuario/adicionar')" class="btn btn-primary">
                <i class="icon-plus"></i> 
                Adicionar Usu�rio
            </button>
        </div>
    </header>    

    <div class="row">                

        <?php foreach (TipoUsuario\TTipoUsuarioControl::ListarTiposUsuario() as $tipoUsuario) : ?>
            <h3><?php echo $tipoUsuario->getNome(); ?></h3>
            <?php Usuario\TUsuarioControl::ExibirTabelaUsuariosPorTipo($tipoUsuario->getId()); ?>
        <?php endforeach; ?>

        <div class="clear"></div>        

    </div>

</article>