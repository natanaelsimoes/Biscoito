<?php

namespace Biscoito\Modulos\Usuario\TipoUsuario;

use Biscoito\Lib\Database\TObjeto;

class TTipoUsuario extends TObjeto {

  private $Nome;

  public function getNome() {
    return $this->Nome;
  }

  public function setNome($value) {
    $this->Nome = $value;
  }

  private $Flag;

  public function getFlag() {
    return $this->Flag;
  }

  public function setFlag($value) {
    $this->Flag = $value;
  }

}

?>
