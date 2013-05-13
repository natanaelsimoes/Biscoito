<?php

namespace Biscoito\Modulos\Administrador\View;

use Biscoito\Modulos\Administrador\Breadcrumbs;
use Biscoito\Modulos\Usuario;

global $_Biscoito;
global $_UsuarioLogado;
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt-BR"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt-BR"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt-BR"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt-BR"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
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
    <?php if ($_Biscoito->getModulo() == 'administrador') : ?>
      <header id="nav-bar" class="container-fluid">
        <div class="row-fluid">
          <div class="span12">
            <h1>Painel Administrativo</h1>
            <a id="user-info" class="pull-right" href="#">
              <div class="user-info-block">
                <h3><?php echo Usuario\TUsuarioControl::getNomeUsuario(); ?></h3>
                <h4><?php echo Usuario\TUsuarioControl::getSobrenomeUsuario(); ?></h4>
              </div>
              <div class="user-info-block">
                <b class="icon-user"></b>
              </div>
            </a>
          </div>
        </div>                
      </header>
    <?php endif; ?>
    <div id="charms" class="win-ui-dark" style="z-index: 1">
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
              <h4><?php echo Usuario\TUsuarioControl::getSobrenomeUsuario(); ?></h4>
            </div>
            <div class="span1">
              <img src="http://www.gravatar.com/avatar/6cc5a644d49a9bfe88bc0819ae7bdea6.png?s=48" alt="user" />
            </div>
          </div>
          <hr/>
          <div>
            <div class="btn btn-large"><i class="icon-switch"></i> Sair</div>
            <ul>
              <li><a href="#" onclick="_Biscoito.IrPara('administrador/usuario/editar/<?php echo $_UsuarioLogado->getId() ?>')">Editar dados</a></li>
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
    <section id="main" class="container">                             
      <?php echo Breadcrumbs\TBreadcrumbsControl::Exibir(); ?>      
      <?php echo $view; ?>
      <div class="spacer"></div>
    </section>
    <footer>
      <hr />
      <p class="align-center"><strong>Copyright &copy; 2012 - <?php echo date('Y') ?> Natanael Simões</strong></p>           
    </footer>              
    <?php $_Biscoito->usarBootstrap(); ?>                                      
  </body>
</html>