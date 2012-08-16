<?php

namespace Biscoito\Modulos\Usuario;

class TUsuarioControl {
    
    public function __call($acao, $args) {

        global $_Biscoito;

        $URLVars = $_Biscoito->getVariaveisDaURL();

        echo $_Biscoito->getVariaveisDaURL(0);
    }
    
    public function __construct() {
        
        if (!isset($_SESSION['BISCOITO_SESSAO_MSG']))
            $_SESSION['BISCOITO_SESSAO_MSG'] = '';
        
    }        
    
    public static function Gerenciar() {
        
        include('usuario.view.gerenciar.php');
        
    }
    
    public static function getNomeUsuario() {
        
        $usuario = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);
        
        return $usuario->getNome();
        
    }
    
    public static function getSobrenomeUsuario() {
        
        $usuario = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);
        
        return $usuario->getSobrenome();
        
    }

    public function Login() {
        
        $strUsuario = $_POST['usuario'];
        
        $strSenha = $_POST['senha'];
        
        $usuarios = array();

        $usuario = new TUsuario();

        $usuarios = $usuario->ListarTodosOnde('usuario', '=', "'$strUsuario'");

        if (count($usuarios) == 1) {
          
            if ($usuarios[0]->getSenha() == $strSenha) {
                
                $_SESSION['BISCOITO_SESSAO_USUARIO'] = serialize($usuarios[0]);
                
                $_SESSION['BISCOITO_SESSAO_MSG'] = 'Sucesso!';
                
            }
            
        }
        
        $_SESSION['BISCOITO_SESSAO_MSG'] = 'Usu�rio ou senha inv�lida. Tente novamente.';
        
        header('location:'.$_SERVER['HTTP_REFERER']);
        
    }

    public function Logout() {
        
        unset($_SESSION['BISCOITO_SESSAO_USUARIO']);
        
        unset($_SESSION['BISCOITO_SESSAO_MSG']);
        
        header('location:'.$_SERVER['HTTP_REFERER']);
        
    }

    public function AdministradorLogado() {
        if ($this->UsuarioLogado()) {
            $usuario = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);
            return $usuario->getTipo();
        }
        else
            return false;
    }

    public function UsuarioLogado() {
        return isset($_SESSION['BISCOITO_SESSAO_USUARIO']);
    }
    
    public static function ExibirTabelaUsuariosPorTipo($tipo) {
        
        global $_Biscoito;
        
        $usuarios = new TUsuario;
        
        $usuarios = $usuarios->ListarTodosOnde('tipousuario_id', '=', $tipo);
        
        $usuarios = $_Biscoito->ordenarObjetos($usuarios, 'nome', SORT_ASC);
        
        $usuarios = $_Biscoito->ordenarObjetos($usuarios, 'status', SORT_DESC);
        
        include('usuario.view.table.gerenciar.php');
    }

}

?>
