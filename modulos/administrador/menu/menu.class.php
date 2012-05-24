<?php

namespace Biscoito\Modulos\Administrador\Menu;

class TMenu {

    private $menu;

    function __construct() {
        $this->CarregarMenus();
    }

    public function getMenu() {
        return $this->menu;
    }

    private function CarregarMenus() {

        $this->menu = array();

        $hDiretorio = opendir('modulos');

        while ($hModulo = readdir($hDiretorio)) {

            if (!in_array($hModulo, array('.', '..', 'administrador', '_modulo_padrao'))) {
                array_push($this->menu, $this->CarregarOpcoes($hModulo));
            }
        }
    }

    private function CarregarOpcoes($modulo) {

        $strNomeModulo = $strOpcaoModulo = "";

        $arrOpcoes = array();

        $xmlConfiguracaoModulo = simplexml_load_file("modulos/$modulo/config.xml");

        $strNomeModulo = utf8_decode(strval($xmlConfiguracaoModulo->nome));

        foreach ($xmlConfiguracaoModulo->menu as $menu)
            foreach ($menu->opcao as $opcao)
                array_push($arrOpcoes, utf8_decode(strval($opcao)));

        return array($strNomeModulo, $arrOpcoes);
    }

}

?>
