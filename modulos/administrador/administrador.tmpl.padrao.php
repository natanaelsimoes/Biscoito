<?php

namespace Biscoito\Modulos\Administrador\View;

use Biscoito\Modulos\Administrador\Menu;
use Biscoito\Modulos\Administrador\Breadcrumbs;
use Biscoito\Modulos\Usuario;
use Biscoito\Lib\Util;

global $_Biscoito;
?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt-BR"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt-BR"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt-BR"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt-BR"> <!--<![endif]-->
    <head>
        <meta charset="iso-8859-1">
        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />        
        <meta name="viewport" content="width=device-width">
        <title>Biscoito - Painel Administrativo</title>                        
        <?php $_Biscoito->usarJQuery(); ?>
        <?php $_Biscoito->usarBiscoitoJS(); ?>        
        <?php include_once('administrador.css.padrao.php'); ?>               
        <?php $_Biscoito->usarScript('plugins/bootstrap/scripts/modernizr.min.js'); ?>        
        <!--@RenderSection("head", false)-->
    </head>
    <body>

        <?php if ($_Biscoito->getModuloAuxiliar() == '') : ?>
            <header id="nav-bar" class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <h1>Painel Administrativo</h1>
                        <a id="user-info" class="pull-right" href="#">
                            <div class="user-info-block">
                                <h3><?php echo Usuario\TUsuarioControl::getNomeUsuario(); ?></h3>
                                <h4>LastName</h4>
                            </div>
                            <div class="user-info-block">
                                <b class="icon-user"></b>
                            </div>
                        </a>
                    </div>
                </div>                
            </header>
        <?php endif; ?>

        <div id="charms" class="win-ui-dark">
            <div id="charms-header" class="row">
                <div class="span1 align-left">
                    <a id="close-charms" class="win-backbutton" href="#"></a>
                </div>                
            </div>

            <div id="charms-body">
                <div id="charms-user" class="span3">

                    <br />

                    <div class="row">
                        <div class="span2">
                            <h3><?php echo Usuario\TUsuarioControl::getNomeUsuario(); ?></h3>
                            <h4>LastName</h4>
                        </div>
                        <div class="span1">
                            <img src="http://www.gravatar.com/avatar/6cc5a644d49a9bfe88bc0819ae7bdea6.png?s=48" alt="user" />
                        </div>
                    </div>

                    <hr/>

                    <div>
                        <ul>
                            <li><a href="#">Editar dados</a></li>
                            <li><a href="#" onclick="_Biscoito.IrPara('usuario/logout');">Sair</a></li>
                        </ul>                                                
                    </div>

                </div>

                <div id="charms-search">
                    Search:
                    <input type="text" id="charmsSearchTextbox" />
                    <ul id="searchResults">
                    </ul>
                </div>

            </div>

        </div>

        <!--<header id="header">
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a class="brand" href="#" onclick="_Biscoito.IrPara('administrador')"></a>
                        <div class="btn-group pull-right">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-user"></i> 
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
                        </div>
                    </div>
                </div>
            </div>            
        </header> <!-- end of header bar -->       

        <section id="main" class="container">                       

            <!--<div id="breadcrumbs_container">            
            <?php echo Breadcrumbs\TBreadcrumbsControl::Exibir(); ?>
            </div>-->

            <?php echo $view; ?>

            <div class="spacer"></div>

        </section>

        <footer>
            <hr />
            <p><strong>Copyright &copy; 2012 Natanael Simões</strong></p>           
        </footer>              

        <?php $_Biscoito->usarBootstrap(); ?>                                      

    </body>

</html>
