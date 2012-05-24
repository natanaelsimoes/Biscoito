<?php

namespace Biscoito\Modulos\Administrador\Menu;

use Biscoito\Lib\Util;

global $_Biscoito;

foreach ($menuList as $modulo) { ?>
    <h3><?php echo $modulo[0] ?></h3>
    <ul class="toggle">
        <?php foreach ($modulo[1] as $opcao) { 
            $modulo[0] = Util\TTexto::RemoverAcentos($modulo[0]); ?>
            <li class="icn_new_article"><?php $_Biscoito->link($opcao, 'administrador', $modulo[0],$opcao); ?></li>
        <?php } ?>
    </ul>
<?php } ?>