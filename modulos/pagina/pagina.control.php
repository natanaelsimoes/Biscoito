<?php

namespace Biscoito\Modulos\Pagina;

class TpaginaControl {

  public function __call($acao, $args) {
    global $_Biscoito;
    $pagina = TpaginaControl::Listar($_Biscoito->getVariaveisDaURL(1));
    include('pagina.view.padrao.php');
  }

  public static function Gerenciar() {    
    $paginas = TPagina::ListarTodos();
    include('pagina.view.gerenciar.php');
  }

  public static function Salvar() {
    $paginas = new TPagina;
    $paginas->CarregarSerial($_REQUEST['obj']);
    $paginas->setNome($_REQUEST['Nome']);
    $paginas->setApelido($_REQUEST['Apelido']);
    $paginas->setDescricao($_REQUEST['Descricao']);
    $paginas->setConteudo($_REQUEST['Conteudo']);
    $paginas->Salvar();
  }

  public static function Adicionar() {
    $pagina = new TPagina;
    $acao = 'Adicionar';
    include('pagina.view.edicao.php');
  }

  public static function Editar() {
    global $_Biscoito;
    $pagina = new TPagina;
    $pagina = $pagina->ListarPorId($_Biscoito->getVariaveisDaURL(2));
    $acao = 'Editar';
    include('pagina.view.edicao.php');
  }

  public static function Excluir() {
    $pagina = new TPagina;
    $pagina->CarregarSerial($_REQUEST['obj']);
    $pagina->DeletarRegistro();
  }

  public static function Listar($apelido) {
    $pagina = new TPagina;
    $pagina = $pagina->ListarTodosOnde("TPagina.apelido = '$apelido'");
    return $pagina[0];
  }
}

?>
