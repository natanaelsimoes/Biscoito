<?php

namespace Biscoito\Lib\Util\HTML;

class TButton extends TTag {

  public function __construct($nome, $label, $tipo = 'submit', $classe = '') {
    parent::__construct('button');
    $this->setAtributo('id', CAMPO_BOTAO . $nome);
    $this->setAtributo('name', $nome);
    $this->setAtributo('class', $classe);
    $this->setAtributo('type', $tipo);
    $this->Anexar($label);
    $this->setMostrarLabel(false);
  }

}

?>
