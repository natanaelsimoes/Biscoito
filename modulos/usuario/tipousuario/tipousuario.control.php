<?php

namespace Biscoito\Modulos\Usuario\TipoUsuario;

class TTipoUsuarioControl {

    public function __call($acao, $args) {

        global $_Biscoito;

        switch ($_Biscoito->getVariaveisDaURL(2)) {

            case 'editar':

                TTipoUsuarioControl::Editar($_Biscoito->getVariaveisDaURL(3));

                break;

            case 'excluir':

                TTipoUsuarioControl::Excluir($_Biscoito->getVariaveisDaURL(3));

                break;
        }
    }

    public static function ListarTiposUsuario() {

        $tiposUsuario = new TTipoUsuario;

        $usuarioLogado = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);

        if (is_object($usuarioLogado))
            switch ($usuarioLogado->getFlag()) {

                case 'ADMINISTRADOR':

                    return $tiposUsuario->ListarTodosOnde("flag in ('ADMINISTRADOR','LOCAL')");

                    break;

                case 'CAIXA':
                case 'LOCAL':

                    return $tiposUsuario->ListarTodosOnde("flag in ('LOCAL', 'CAIXA')");

                    break;
            }
    }

    public static function Gerenciar() {

        $tiposUsuario = new TTipoUsuario();

        $tiposUsuario = $tiposUsuario->ListarTodos();

        include('tipousuario.view.gerenciar.php');
    }

    public static function Adicionar() {

        $tipoUsuario = new TTipoUsuario();

        $acao = 'Adicionar';

        include('tipousuario.view.edicao.php');
    }

    public static function Editar($id) {

        $tipoUsuario = new TTipoUsuario();

        $tipoUsuario = $tipoUsuario->ListarPorId($id);

        $acao = 'Editar';

        include('tipousuario.view.edicao.php');
    }

    public static function Excluir($id) {

        $tipoUsuario = new TTipoUsuario();

        $tipoUsuario = $tipoUsuario->ListarPorId($id);

        $tipoUsuario->DeletarRegistro();
    }

    public function Salvar() {

        $tipoUsuario = new TTipoUsuario();

        $tipoUsuario->CarregarSerial($_REQUEST['obj']);

        $tipoUsuario->setNome($_REQUEST['nome']);

        $tipoUsuario->setFlag($_REQUEST['flag']);

        $tipoUsuario->Salvar();
    }

    public static function getUsuariosDoTipo() {

        $usuario = new \Biscoito\Modulos\Usuario\TUsuario();

        echo count($usuario->ListarTodosOnde("tipousuario_id = {$_REQUEST['id']}"));
    }

    public static function ExibirSelecao($usuario_id = null, $id = null) {

        global $_Biscoito;

        $tiposUsuario = new TTipoUsuario();

        $usuarioLogado = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);

        switch ($usuarioLogado->getFlag()) {

            case 'ADMINISTRADOR':

                $tiposUsuario = $tiposUsuario->ListarTodosOnde("flag in ('ADMINISTRADOR','LOCAL')");

                break;

            case 'CAIXA':
            case 'LOCAL':

                $tiposUsuario = $tiposUsuario->ListarTodosOnde("flag in ('LOCAL', 'CAIXA')");

                break;
        }

        $tiposUsuario = $_Biscoito->ordenarObjetos($tiposUsuario, 'nome', SORT_ASC);

        $usuarioLogado = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);

        $readonly = ($usuarioLogado->getId() == $usuario_id);

        include('tipousuario.view.select.php');
    }

}

?>
