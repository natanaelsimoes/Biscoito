<?php

use Biscoito\Modulos\Usuario;
use Biscoito\Modulos\Usuario\TipoUsuario;
use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Usuários', 'administrador');
?>

<header class="row-fluid page-header"> 
    <div class="span6"><h2>Lista de Usuários</h2></div>
    <div class="span6 align-right">
        <button type="button" class="btn" onclick="_Biscoito.IrPara('administrador/usuario/tipousuario/gerenciar')">Gerenciar Tipos de Usuário</button>
        <button type="button" onclick="_Biscoito.IrPara('administrador/usuario/adicionar')" class="btn btn-primary">
            <i class="icon-plus"></i> 
            Adicionar Usuário
        </button>
    </div>
</header>    

<div class="row-fluid">

    <?php foreach (TipoUsuario\TTipoUsuarioControl::ListarTiposUsuario() as $tipoUsuario) : ?>
        <h3><?php echo $tipoUsuario->getNome(); ?></h3>
        <?php Usuario\TUsuarioControl::ExibirTabelaUsuariosPorTipo($tipoUsuario->getId()); ?>
    <?php endforeach; ?>

    <div class="clear"></div>        

</div>