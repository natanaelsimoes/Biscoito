<?php

namespace Biscoito\Modulos\Index;

use Biscoito\Lib;

class TIndexControl extends Lib\TBiscoitoRouter {

    public function ExibirPagina($view = null, $ajax = false) {
        global $_Cache;
        if (is_null($view)) {
            ob_start();
            include('index.view.principal.php');
            $view = ob_get_contents();
            ob_end_clean();
            $_Cache->doCache = true;
        }
        if ($ajax) {
            $_Cache->doCache($view);
            echo $view;
        }
        else {
            ob_start();
            include('index.tmpl.padrao.php');
            $page = ob_get_contents();
            ob_end_clean();
            $_Cache->doCache($page);
            echo $page;
        }
    }

}

?>
