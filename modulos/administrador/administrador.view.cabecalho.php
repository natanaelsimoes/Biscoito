<?php 

use Biscoito\Modulos\Usuario\TUsuarioControl; 

use Biscoito\Modulos\Administrador\Menu; 
?>

<header id="nav-bar" class="container-fluid">
    <div class="row-fluid">
        <div class="span8">
            <div id="header-container">
                <a id="backbutton" class="win-backbutton" href="#" onclick="_Biscoito.IrPara('<?php echo $voltarPara ?>')"></a>
                <h5>Painel Administrativo</h5>
                <div class="dropdown">
                    <a class="header-dropdown dropdown-toggle accent-color" data-toggle="dropdown" href="#" >
                        <?php echo $nomeModulo; ?>
                        <b class="caret" href="#"></b>
                    </a>
                    <?php Menu\TMenuControl::ListarNomes() ?>                    
                </div>
            </div>
        </div>
        <a id="user-info" class="pull-right" href="#">
            <div class="user-info-block">
                <h3><?php echo TUsuarioControl::getNomeUsuario(); ?></h3>
                <h4><?php echo TUsuarioControl::getSobrenomeUsuario(); ?></h4>
            </div>
            <div class="user-info-block">
                <b class="icon-user"></b>
            </div>
        </a>
    </div>
</header>