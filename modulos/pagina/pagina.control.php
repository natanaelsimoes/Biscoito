<?php

namespace Biscoito\Modulos\Pagina;

class TpaginaControl {

  public static function Gerenciar() {
    $paginas = new TPagina;
    $paginas = $paginas->ListarTodos();
    include('pagina.view.gerenciar.php');
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

  public static function Adicionar() {
    $pagina = new TPagina;
    $acao = 'Adicionar';
    include('pagina.view.edicao.php');
  }

  public static function Editar() {

    global $_Biscoito;

    $usuario = new TUsuario;

    $usuario = $usuario->ListarPorId($_Biscoito->getVariaveisDaURL(2));

    $acao = 'Editar';

    include('usuario.view.edicao.php');
  }

  public static function Excluir() {

    $usuario = new TUsuario;

    $usuario->CarregarSerial($_REQUEST['obj']);

    $usuario->DeletarRegistro();
  }

}

?>
