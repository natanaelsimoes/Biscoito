<?php

namespace Biscoito\Modulos\Administrador;

use Biscoito\Lib;
use Biscoito\Modulos\Usuario;

class TAdministradorControl extends Lib\TBiscoitoRouter {

    private $usuarioControl;

    public function __construct() {
        $this->usuarioControl = new Usuario\TUsuarioControl();
    }

    private function VerificarAdministradorLogado() {

        if (!$this->usuarioControl->AdministradorLogado()) {

            $this->ExibirLogin();

            exit;
        }
    }

    public function ExibirLogin() {

        include('administrador.view.entrar.php');

        unset($_SESSION['BISCOITO_SESSAO_MSG']);
    }

    public function ExibirPagina($view = null, $ajax = false) {

        $this->VerificarAdministradorLogado();

        if (is_null($view)) {

            ob_start();

            include('administrador.view.principal.php');

            $view = ob_get_contents();

            ob_end_clean();
        }

        if ($ajax)
            echo $view;

        else
            include('administrador.tmpl.padrao.php');
    }

    public static function CabecalhoModulo($nomeModulo, $voltarPara) {

        include('administrador.view.cabecalho.php');
    }

}

?>
