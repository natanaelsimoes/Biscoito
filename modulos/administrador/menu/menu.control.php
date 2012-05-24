<?php

namespace Biscoito\Modulos\Administrador\Menu;

require_once('menu.class.php');

class TMenuControl {

    static function Listar() {
        
        $menuList = null;

        $menu = new TMenu();
        
        $menuList = $menu->getMenu();

        include('menu.view.list.php');
    }

}
?>
