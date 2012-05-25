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
        
        $moduloAuxiliar = $_Biscoito->getModuloAuxiliar();

        $classeAuxiliar = $_Biscoito->getClasseControleModuloAvulso($moduloAuxiliar);

        if ($acao == $moduloAuxiliar) {
            
            $xmlModuloConfig = $_Biscoito->getConfiguracaoXML($moduloAuxiliar);
            
            $acao = strval($xmlModuloConfig->index->acao);
            
        }
        
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
