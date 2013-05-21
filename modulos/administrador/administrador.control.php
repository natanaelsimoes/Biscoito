<?php

namespace Biscoito\Modulos\Administrador;

use Biscoito\Lib;
use Biscoito\Modulos\Usuario;

class TAdministradorControl extends Lib\TBiscoitoRouter {

    private $usuarioControl;

    public function __construct() {
        $this->usuarioControl = new Usuario\TUsuarioControl();
    }

    public static function VerificarAdministradorLogado() {
        if (!Usuario\TUsuarioControl::AdministradorLogado()) {
            TAdministradorControl::ExibirLogin();
            exit;
        }
    }

    public static function ExibirLogin() {
        include('administrador.view.entrar.php');
        unset($_SESSION['BISCOITO_SESSAO_MSG']);
    }

    public function ExibirPagina($view = null, $ajax = false) {
        global $_Cache;
        $this->VerificarAdministradorLogado();
        if (is_null($view)) {
            ob_start();
            include('administrador.view.principal.php');
            $view = ob_get_contents();
            ob_end_clean();
        }
        if ($ajax) {
            $_Cache->doCache($view);
            echo $view;
        } else {
            ob_start();
            include('administrador.tmpl.padrao.php');
            $page = ob_get_contents();
            ob_end_clean();
            $_Cache->doCache($page);
            echo $page;
        }
    }

    public static function CabecalhoModulo($nomeModulo, $voltarPara) {

        include('administrador.view.cabecalho.php');
    }

}

?>
