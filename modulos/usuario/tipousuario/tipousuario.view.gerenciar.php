<?php

use Biscoito\Modulos\Usuario;
use Biscoito\Modulos\Usuario\TipoUsuario;
use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Usuários', 'administrador/usuario');

include_once('tipousuario.js.php');

?>

<article class="subhead">    

    <header class="row-fluid page-header">        
        <div class="span6"><h2>Tipos de Usuário</h2></div>
        <div class="span6 align-right">            
            <button type="button" onclick="_Biscoito.IrPara('administrador/usuario/tipousuario/adicionar')" class="btn btn-primary">
                <i class="icon-plus"></i> 
                Adicionar Tipo de Usuário
            </button>
        </div>
    </header>    

    <div class="row-fluid">                

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th></th>                    
                </tr>
            </thead>
            <tbody>
                <?php foreach (TipoUsuario\TTipoUsuarioControl::ListarTiposUsuario() as $tipoUsuario) : ?>
                    <tr>
                        <td><?php echo $tipoUsuario->getNome(); ?></td>                
                        <td class="align-right">                            
                            <button class="btn" onclick="_Biscoito.IrPara('administrador/usuario/tipousuario/editar/<?php echo $tipoUsuario->getId() ?>')"><span class="icon icon-pencil"></span> Editar</button>                            
                            <button class="btn" onclick="tipoUsuarioJSForm.btnExcluir_Click(<?php echo $tipoUsuario->getId() ?>,this)"><span class="icon icon-remove"></span> Excluir</button> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="clear"></div>        

    </div>

</article>