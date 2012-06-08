<?php

namespace Biscoito\Modulos\Administrador\View;

use Biscoito\Modulos\Administrador\Menu;
use Biscoito\Modulos\Administrador\Breadcrumbs;
use Biscoito\Modulos\Usuario;
use Biscoito\Lib\Util;

global $_Biscoito;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="iso-8859-1">
        <title>Biscoito - Painel Administrativo</title>                
        <?php $_Biscoito->usarBootstrap(); ?>
        <?php $_Biscoito->usarEstilo('plugins/bootstrap/css/metro-ui-bootstrap.css'); ?>        
        <?php $_Biscoito->usarBiscoitoJS(); ?>               
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->        
        <?php include_once('administrador.css.padrao.php'); ?>        
    </head>
    <body>
        <header id="header">
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a class="brand" href="#" onclick="_Biscoito.IrPara('administrador')">Biscoito - Painel Administrativo</a>
                        <div class="btn-group pull-right">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-user"></i> <?php echo Usuario\TUsuarioControl::getNomeUsuario(); ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Editar dados</a></li>
                                <li class="divider"></li>
                                <li><a href="#" onclick="_Biscoito.IrPara('usuario/logout');">Sair</a></li>
                            </ul>
                        </div>
                        <div class="nav-collapse pull-right">
                            <ul class="nav">
                                <li><a href="#" onclick="location.href=_Biscoito.getSite()">Ir para site</a></li>                                
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div>
                </div>
            </div>            
        </header> <!-- end of header bar -->

        <!--<section id="breadcrumbs_container">            
            <?php echo Breadcrumbs\TBreadcrumbsControl::Exibir(); ?>
        </section><!-- end of secondary bar -->        

        <section id="main" class="container">                       
            
            <?php echo $view; ?>

            <div class="spacer"></div>

        </section>

        <footer>
            <hr />
            <p><strong>Copyright &copy; 2012 Natanael Simões</strong></p>           
        </footer>

    </body>

</html>
