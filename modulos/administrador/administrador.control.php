<?php

namespace Biscoito\Modulos\Administrador;

use Biscoito\Modulos\Usuario;

class TAdministradorControl {

    private $usuarioControl;

    public function __construct() {
        $this->usuarioControl = new Usuario\TUsuarioControl();
    }

    public function __call($acao, $args) {

        global $_Biscoito;

        $URLVars = $_Biscoito->getVariaveisDaURL();

        $moduloAuxiliar = $URLVars[0];

        $classeAuxiliar = $_Biscoito->getClasseControleModuloAvulso($moduloAuxiliar);

        if ($acao == $moduloAuxiliar) {

            $xmlModuloConfig = $_Biscoito->getConfiguracaoXML($moduloAuxiliar);

            $acao = strval($xmlModuloConfig->index->acao);
        }
        
        $this->ExibirPainel($_Biscoito->requisitarAcao($classeAuxiliar, $acao));
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

    public function ExibirPainel($view = null) {

        if (is_null($view)) {

            ob_start();

            include('administrador.view.principal.php');

            $view = ob_get_contents();

            ob_end_clean();
        }

        $this->VerificarAdministradorLogado();

        include('administrador.tmpl.padrao.php');
    }

}

?>
