<?php

namespace Biscoito\Lib;

abstract class TBiscoitoRouter {
    
    public function Rotear() {
        
        global $_Biscoito;

        $ajax = array_key_exists('ajax', $_GET);

        if ($_Biscoito->getGateway() == $_Biscoito->getModulo()) 
            $this->ExibirPagina();

        else
            $this->ExibirPagina($_Biscoito->requisitarAcao($_Biscoito->getClasseControle(), $_Biscoito->getAcao()), $ajax);
        
    }
    
    public abstract function ExibirPagina($view = null, $ajax = false);
    
}
?>
