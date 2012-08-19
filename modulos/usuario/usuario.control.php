<?php

namespace Biscoito\Modulos\Usuario;

class TUsuarioControl {

    public function __construct() {

        if (!isset($_SESSION['BISCOITO_SESSAO_MSG']))
            $_SESSION['BISCOITO_SESSAO_MSG'] = '';
    }

    public static function Gerenciar() {

        include('usuario.view.gerenciar.php');
    }

    public static function Salvar() {

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

        $usuarioLogado = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);

        if ($usuarioLogado->getId() == $usuario->getId())
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

            if ($usuarios[0]->getSenha() == md5($strSenha) && $usuarios[0]->getStatus()) {

                $_SESSION['BISCOITO_SESSAO_USUARIO'] = serialize($usuarios[0]);

                $_SESSION['BISCOITO_SESSAO_MSG'] = 'Sucesso!';
            }
        }

        $_SESSION['BISCOITO_SESSAO_MSG'] = 'Usuário ou senha inválida. Tente novamente.';

        header('location:' . $_SERVER['HTTP_REFERER']);
    }

    public function Logout() {

        unset($_SESSION['BISCOITO_SESSAO_USUARIO']);

        unset($_SESSION['BISCOITO_SESSAO_MSG']);

        header('location:' . $_SERVER['HTTP_REFERER']);
    }

    public function AdministradorLogado() {
        if ($this->UsuarioLogado()) {
            $usuario = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);
            return ($usuario->getFlag() == 'ADMINISTRADOR');
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

    public static function Adicionar() {

        $usuario = new TUsuario;

        $acao = 'Adicionar';

        include('usuario.view.edicao.php');
    }

    public static function Editar() {

        global $_Biscoito;

        $usuario = new TUsuario;

        $usuario = $usuario->ListarPorId($_Biscoito->getVariaveisDaURL(2));

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

}

?>
