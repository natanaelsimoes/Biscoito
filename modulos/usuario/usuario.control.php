<?php

namespace Biscoito\Modulos\Usuario;

session_start();

class TUsuarioControl {
    
    public function __construct() {
        
        if (!isset($_SESSION['BISCOITO_SESSAO_MSG']))
            $_SESSION['BISCOITO_SESSAO_MSG'] = '';
        
    }
    
    public static function getNomeUsuario() {
        
        $usuario = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);
        
        return $usuario->getNome();
        
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
        
        $_SESSION['BISCOITO_SESSAO_MSG'] = 'Usuário ou senha inválida. Tente novamente.';
        
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

}

?>
