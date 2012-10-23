<?php

namespace Biscoito\Lib\Util\HTML;

class TTextarea extends TTag {
  
  public function __construct($nome, $classe = '', $texto = '') {
    $this->setNome('textarea');
    $this->setAtributo('id', CAMPO_TEXTOGRANDE . $nome);
    $this->setAtributo('name', $nome);    
    $this->setAtributo('class', $classe);
    $this->Anexar($texto);
  }
}
?>
