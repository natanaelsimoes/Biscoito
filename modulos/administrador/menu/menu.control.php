<?php

namespace Biscoito\Modulos\Administrador\Menu;

use Biscoito\Lib\Util;

class TMenuControl {

    public static function Listar() {

        $menuList = TMenuControl::CarregarMenus();

        include('menu.view.list.php');
    }

    private static function CarregarMenus() {

        $menuList = array();

        $hDiretorio = opendir('modulos');

        while ($hModulo = readdir($hDiretorio)) {

            if (!in_array($hModulo, array('.', '..', 'administrador', '_modulo_padrao'))) {
                array_push($menuList, TMenuControl::CarregarMenu($hModulo));
            }
        }

        return $menuList;
    }

    private static function CarregarMenu($modulo) {
        
        global $_Biscoito;

        $strNomeModulo = $strOpcaoModulo = "";

        $xmlConfiguracaoModulo = simplexml_load_file("modulos/$modulo/config.xml");

        $strNomeModulo = utf8_decode(strval($xmlConfiguracaoModulo->nome));       
        
        $strIconeModulo = $_Biscoito->getSite() . "modulos/$modulo/icone.svg";

        return new TMenu($strNomeModulo, $modulo, $strIconeModulo);
    }

    public static function montarLinkOpcao($nomeModulo, TMenuOpcao $opcao) {

        global $_Biscoito;

        $opcaoFormat = '<li class="%s"><a href="%s" onclick="%s">%s</a></li>';

        $urlFormat = '%sadministrador/%s/%s/';

        $popupFormat = "_Biscoito.AbrirPopup('Frm%s',700,'%s');";

        $classePadrao = 'icn_novo_artigo';

        $popup = '';

        $nomeModulo = strtolower(Util\TTexto::RemoverAcentos($nomeModulo));

        $nomeOpcao = strtolower(Util\TTexto::RemoverAcentos($opcao->getNome()));

        $icone = (!$opcao->getIcone()) ? $classePadrao : "icn_{$opcao->getIcone()}";

        if ($opcao->AbrirPopup()) {

            $popup = sprintf($popupFormat, $nomeModulo, $opcao->getURL());

            $url = '#';
        }
        else
            $url = (empty($opcao->getURL)) ?
                    sprintf($urlFormat, $_Biscoito->getSite(), $nomeModulo, $nomeOpcao) :
                    sprintf($urlFormat, $_Biscoito->getSite(), $opcao->getURL(), '');

        echo sprintf($opcaoFormat, $icone, $url, $popup, $opcao->getNome());
    }

}

?>
