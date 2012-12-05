<?php

namespace Biscoito\Modulos\Pagina;

use Biscoito\Lib\Database\TObjeto;

class TPagina extends TObjeto {

  private $Nome;

  public function getNome() {
    return $this->Nome;
  }

  public function setNome($value) {
    $this->Nome = $value;
  }

  private $Apelido;

  public function getApelido() {
    return $this->Apelido;
  }

  public function setApelido($value) {
    $this->Apelido = $value;
  }

  private $Descricao;

  public function getDescricao() {
    return $this->Descricao;
  }

  public function setDescricao($value) {
    $this->Descricao = $value;
  }

  private $Conteudo;

  public function getConteudo() {
    return $this->Conteudo;
  }

  public function setConteudo($value) {
    $this->Conteudo = $value;
  }

  private $Pagina_id;

  public function getPagina_id() {
    return $this->Pagina_id;
  }

  public function setPagina_id($value) {
    $this->Pagina_id = $value;
  }

}

?>