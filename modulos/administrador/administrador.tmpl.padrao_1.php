<?php

namespace Biscoito\Modulos\Administrador\View;

use Biscoito\Modulos\Administrador\Menu;
use Biscoito\Modulos\Administrador\Breadcrumbs;
use Biscoito\Modulos\Usuario;
use Biscoito\Lib\Util;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="iso-8859-1">
        <title>Biscoito - Painel Administrativo</title>
        <?php $GLOBALS['_Biscoito']->usarJQuery(); ?>
        <?php $GLOBALS['_Biscoito']->usarJQueryUI(); ?>
        <?php $GLOBALS['_Biscoito']->usarBiscoitoJS(); ?>
        <?php $GLOBALS['_Biscoito']->usarScript('cms/js/hideshow.js'); ?>
        <?php $GLOBALS['_Biscoito']->usarScript('cms/js/php.default.min.js'); ?>
        <?php $GLOBALS['_Biscoito']->usarScript('cms/js/jquery.tablesorter.min.js'); ?>
        <?php $GLOBALS['_Biscoito']->usarScript('cms/js/jquery.equalHeight.js'); ?>
        <?php include_once('administrador.css.padrao.php'); ?>
        <?php
        if (Util\TNavegador::getSigla() == 'IE'):
            include('administrador.css.padraoIE.php');
        endif;
        ?>
    </head>
    <body>
        <header id="header">
            <hgroup>
                <h1 class="site_title"><a href="#" onclick="_Biscoito.IrPara('administrador')">Biscoito <span>Painel Administrativo</span></a></h1>
                <h2 class="section_title"><?php echo $GLOBALS['_Biscoito']->getNomeModulo(); ?></h2><div class="btn_view_site"><a href="<?php echo $GLOBALS['_Biscoito']->getSite(); ?>">Ir para o Site</a></div>
            </hgroup>
        </header> <!-- end of header bar -->

        <section id="secondary_bar">
            <div class="user">
                <p><?php echo Usuario\TUsuarioControl::getNomeUsuario(); ?> (<a href="#">? Mensagens</a>)</p>
                <a class="logout_user" href="<?php echo $GLOBALS['_Biscoito']->getSite() . 'usuario/logout/'; ?>" title="Sair">Sair</a>
            </div>
<?php echo Breadcrumbs\TBreadcrumbsControl::Exibir(); ?>
        </section><!-- end of secondary bar -->

        <aside id="sidebar" class="column">
            <form class="quick_search">
                <input type="text" value="Busca rápida" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
            </form>
            <hr/>

<?php echo Menu\TMenuControl::Listar(); ?>

            <footer>
                <hr />
                <p><strong>Copyright &copy; 2012 Natanael Simões</strong></p>
                <p>Tema por <a href="http://www.medialoot.com">MediaLoot</a></p>
            </footer>
        </aside><!-- end of sidebar -->

        <section id="main" class="column">

<?php echo $view; ?>

            <div class="spacer"></div>

        </section>

    </body>

</html>
