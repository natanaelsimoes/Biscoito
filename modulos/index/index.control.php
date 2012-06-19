<?php

namespace Biscoito\Modulos\Index;

use Biscoito\Lib;

class TIndexControl extends Lib\TBiscoitoRouter {

    public function ExibirPagina($view = null, $ajax = false) {

        if (is_null($view)) {

            ob_start();

            include('index.view.principal.php');

            $view = ob_get_contents();

            ob_end_clean();
        }

        if ($ajax)
            echo $view;

        else
            include('index.tmpl.padrao.php');
    }

}

?>
