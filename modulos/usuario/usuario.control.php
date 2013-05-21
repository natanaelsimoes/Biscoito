<?php

namespace Biscoito\Modulos\Usuario;

use Biscoito\Modulos\Administrador;

class TUsuarioControl {

    public function __construct() {

        if (!isset($_SESSION['BISCOITO_SESSAO_MSG']))
            $_SESSION['BISCOITO_SESSAO_MSG'] = '';
    }

    public static function Gerenciar() {        
        TUsuarioControl::VerificarNivelAcesso('ADMINISTRADOR');
        include('usuario.view.gerenciar.php');
    }

    public static function Salvar() {
        global $_UsuarioLogado;
        $usuario = new TUsuario;
        $usuario->CarregarSerial($_REQUEST['obj']);
        $usuario->setNome($_REQUEST['nome']);
        $usuario->setNomeDoMeio($_REQUEST['nomeMeio']);
        $usuario->setSobrenome($_REQUEST['sobrenome']);
        $usuario->setTipoUsuario_Id($_REQUEST['tipousuario_id']);
        $usuario->setUsuario($_REQUEST['usuario']);
        if (isset($_REQUEST['novaSenha']))
            $usuario->setSenha(md5($_REQUEST['novaSenha']));
        $usuario->Salvar();
        if ($_UsuarioLogado->getId() == $usuario->getId())
            $_SESSION['BISCOITO_SESSAO_USUARIO'] = serialize($usuario);
    }

    public static function AlterarSenha() {

        $usuario = new TUsuario;

        $usuario->CarregarSerial($_REQUEST['obj']);

        $usuario->setSenha(md5($_REQUEST['senha']));

        $usuario->Salvar();
    }

    public static function getNomeUsuario() {

        $usuario = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);

        if (is_object($usuario))
            return $usuario->getNome();
    }

    public static function getSobrenomeUsuario() {

        $usuario = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);

        if (is_object($usuario))
            return $usuario->getSobrenome();
    }

    public function Login() {
        $usuario = new TUsuario();
        $usuario = $usuario->ListarTodosOnde("usuario = '{$_REQUEST['usuario']}'");
        $_SESSION['BISCOITO_SESSAO_MSG'] = 'Usuário ou senha inválida. Tente novamente.';
        if (count($usuario) == 1)
            if ($usuario[0]->getSenha() == md5($_REQUEST['senha']))
                if ($usuario[0]->getStatus()) {
                    $_SESSION['BISCOITO_SESSAO_USUARIO'] = serialize($usuario[0]);
                    $_SESSION['BISCOITO_SESSAO_MSG'] = 'Sucesso!';
                }
                else
                    $_SESSION['BISCOITO_SESSAO_MSG'] = 'Usuário desativado. Contate o administrador.';
        header('location:' . $_SERVER['HTTP_REFERER']);
    }

    public function Logout() {
        global $_Biscoito;
        unset($_SESSION['BISCOITO_SESSAO_USUARIO']);
        unset($_SESSION['BISCOITO_SESSAO_MSG']);
        header('location:' . $_Biscoito->getSite());
    }

    public static function AdministradorLogado() {
        if (TUsuarioControl::UsuarioLogado()) {
            global $_UsuarioLogado;
            return ($_UsuarioLogado->getStatus());
        }
        else
            return false;
    }

    public static function UsuarioLogado() {
        return isset($_SESSION['BISCOITO_SESSAO_USUARIO']);
    }

    public static function VerificarNivelAcesso($acesso, $_ = null) {
        global $_Biscoito;
        global $_UsuarioLogado;
        $acessos = func_get_args();
        if (!in_array($_UsuarioLogado->getTipoUsuario()->getFlag(), $acessos))
            header('location: ' . $_Biscoito->getSite() . 'administrador/');
    }

    public static function ExibirTabelaUsuariosPorTipo($tipo) {
        global $_Biscoito;
        global $_UsuarioLogado;
        $usuarios = new TUsuario;
        $usuarios = $usuarios->ListarTodosOnde("TipoUsuario_Id = $tipo");
        $usuarios = $_Biscoito->ordenarObjetos($usuarios, 'Nome', SORT_ASC);
        $usuarios = $_Biscoito->ordenarObjetos($usuarios, 'Status', SORT_DESC);
        include('usuario.view.ui.table.gerenciar.php');
    }

    public static function Adicionar() {
        TUsuarioControl::VerificarNivelAcesso('ADMINISTRADOR');
        $usuario = new TUsuario;
        $acao = 'Adicionar';
        include('usuario.view.edicao.php');
    }

    public static function Editar() {
        global $_Biscoito;
        global $_UsuarioLogado;
        $usuario = new TUsuario;
        $usuario = $usuario->ListarPorId($_Biscoito->getVariaveisDaURL(2));
        if ($_UsuarioLogado->getId() != $usuario->getId())
            TUsuarioControl::VerificarNivelAcesso('ADMINISTRADOR');
        $acao = 'Editar';
        include('usuario.view.edicao.php');
    }

    public static function VerificarSenhaAtual() {

        $usuario = new TUsuario;

        $usuario->CarregarSerial($_REQUEST['obj']);

        echo ($usuario->getSenha() == md5($_REQUEST['senhaAtual'])) ? 'true' : 'false';
    }

    public static function ReativarUsuario() {
        $usuario = new TUsuario;
        $usuario->CarregarSerial($_REQUEST['obj']);
        $usuario->setStatus('1');
        $usuario->Salvar();
    }

    public static function DesativarUsuario() {
        $usuario = new TUsuario;
        $usuario->CarregarSerial($_REQUEST['obj']);
        $usuario->setStatus('0');
        $usuario->Salvar();
    }

    public static function Excluir() {
        $usuario = new TUsuario;
        $usuario->CarregarSerial($_REQUEST['obj']);
        $usuario->DeletarRegistro();
    }

    public static function VerificarUsuario() {

        $usuario = new TUsuario;

        if (count($usuario->ListarTodosOnde("usuario = '{$_REQUEST['usuario']}'")) > 0)
            echo '1';
    }

    public static function AlterarTipo() {

        $_SESSION['TIPO_INDEX'] = $_REQUEST['tipo'];
    }

    public static function ResetarTipo() {
        unset($_SESSION['TIPO_INDEX']);
    }

}

?>
