<?php

namespace Biscoito\Lib\Util\HTML;

class TSelect extends TTag {

  public function __construct($nome, $classe = '') {
    $this->setNome('select');
    $this->setAtributo('id', CAMPO_COMBO . $nome);
    $this->setAtributo('name', $nome);
    $this->setAtributo('class', $classe);
  }

  public function AdicionarOpcao($descricao, $valor, $classe = '', $selecionado = false) {
    $opcao = new TTag;
    $opcao->setNome('option');
    $opcao->setAtributo('value', $valor);
    $opcao->setAtributo('class', $classe);
    if ($selecionado)
      $opcao->setAtributo('selected', 'selected');
    $opcao->Anexar($descricao);
    $this->Anexar($opcao);
  }

}

?>
