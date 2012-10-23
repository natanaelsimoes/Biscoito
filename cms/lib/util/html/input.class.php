<?php

namespace Biscoito\Lib\Util\HTML;

class TInput extends TTag {

  public function __construct($nome, $tipo = CAMPO_TEXTO, $classe = '', $valor = '', $selecionado = false) {
    $this->setNome('input');
    $this->setAtributo('type', $tipo);
    $this->setAtributo('id', $tipo . $nome);
    $this->setAtributo('name', $nome);
    $this->setAtributo('value', $valor);
    $this->setAtributo('class', $classe);
    if ($selecionado)
      $this->setAtributo('selected', 'selected');
  }

}

?>
