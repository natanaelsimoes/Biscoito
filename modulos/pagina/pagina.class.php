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

  private $Conteudo;

  public function getConteudo() {
    return $this->Conteudo;
  }

  public function setConteudo($value) {
    $this->Conteudo = $value;
  }

}

?>