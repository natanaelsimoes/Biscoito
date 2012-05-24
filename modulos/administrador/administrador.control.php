<?php

namespace Biscoito\Modulos\Administrador;

use Biscoito\Modulos\Usuario;

class TAdministradorControl {

    private $usuarioControl;

    public function __construct() {
        $this->usuarioControl = new Usuario\TUsuarioControl();
    }

    public function __call($acao, $args) {
        $moduloAuxiliar = $GLOBALS['_Biscoito']->getModuloAuxiliar();

        $classeAuxiliar = $GLOBALS['_Biscoito']->getClasseControleModuloAvulso($moduloAuxiliar);

        $objetoAuxiliar = new $classeAuxiliar;

        ob_start();
        
        $objetoAuxiliar->$acao();
        
        $view = ob_get_contents();
        
        ob_end_clean(); 
        
        $this->ExibirPainel($view);
    }

    private function VerificarAdministradorLogado() {

        if (!$this->usuarioControl->AdministradorLogado()) {

            $this->ExibirLogin();

            exit;
        }
    }

    public function ExibirLogin() {

        include('administrador.view.login.php');

        unset($_SESSION['BISCOITO_SESSAO_MSG']);
    }

    public function ExibirPainel($view = null) {

        $this->VerificarAdministradorLogado();

        include('administrador.view.index.php');
    }

}

?>
