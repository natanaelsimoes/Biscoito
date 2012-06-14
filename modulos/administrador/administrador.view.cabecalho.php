<?php use Biscoito\Modulos\Usuario\TUsuarioControl; ?>

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
                    <ul class="dropdown-menu">                        
                        <li><a href="./appbar-demo.html">Demo App-Bar</a></li>
                        <li><a href="./table-simple.html">Demo Simple Table</a></li>
                        <li><a href="./table-filtered.html">Demo Table with Filters</a></li>
                        <li><a href="./tiles-templates.html">Tile Templates</a></li>
                        <li><a href="./bootstrap-scaffolding.html">Bootstrap Scaffolding</a></li>
                        <li><a href="./bootstrap-base-css.html">Bootstrap Base CSS</a></li>
                        <li><a href="./bootstrap-components.html">Bootstrap Components</a></li>
                        <li><a href="./bootstrap-javascript.html">Bootstrap Javascript</a></li>
                        <li class="divider"></li>
                        <li><a href="./index.html">Início</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <a id="user-info" class="pull-right" href="#">
            <div class="user-info-block">
                <h3><?php echo TUsuarioControl::getNomeUsuario(); ?></h3>
                <h4>LastName</h4>
            </div>
            <div class="user-info-block">
                <b class="icon-user"></b>
            </div>
        </a>
    </div>
</header>