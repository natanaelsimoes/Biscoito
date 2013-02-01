<?php

namespace Biscoito\Lib\Util\HTML;

class TForm extends TTag {

  private $Acao;

  public function getAcao() {
    return $this->Acao;
  }

  public function setAcao($value) {
    $this->Acao = $value;
    $this->AtualizarAtributos();
  }

  private $Classe;

  public function getClasse() {
    return $this->Classe;
  }

  public function setClasse($value) {
    $this->Classe = $value;
    $this->AtualizarAtributos();
  }

  private $Colunas;

  public function getColunas() {
    return $this->Colunas;
  }

  public function setColunas($value) {
    $this->Colunas = $value;
  }

  private $Encriptacao;

  public function getEncriptacao() {
    return $this->Encriptacao;
  }

  public function setEncriptacao($value) {
    $this->Encriptacao = $value;
    $this->AtualizarAtributos();
  }

  private $ID;

  public function getID() {
    return $this->ID;
  }

  public function setID($value) {
    $this->ID = $value;
    $this->AtualizarAtributos();
  }

  private $Metodo;

  public function getMetodo() {
    return $this->Metodo;
  }

  public function setMetodo($value) {
    $this->Metodo = $value;
    $this->AtualizarAtributos();
  }

  public function __construct() {
    $this->Acao = '';
    $this->Classe = '';
    $this->Colunas = 1;
    $this->Encriptacao = 'multipart/form-data';
    $this->ID = sprintf('%s%s', 'Form', uniqid());
    $this->Metodo = 'POST';
    $this->setNome('form');
    $this->Anexar(new TTag('fieldset'));
    $this->AtualizarAtributos();
  }

  private function AtualizarAtributos() {
    $this->setAtributo('action', $this->Acao);
    $this->setAtributo('class', $this->Classe);
    $this->setAtributo('enctype', $this->Encriptacao);
    $this->setAtributo('id', $this->ID);
    $this->setAtributo('method', $this->Metodo);
  }

  public function AdicionarCampo(TTag $tag, $requerido = false) {
    $controlGroup = new TTag('div');
    $controlGroup->setAtributo('class', 'control-group');
    $controlLabel = new TTag('label');
    $controlLabel->setAtributo('class', 'control-label');
    $controlLabel->setAtributo('for', $tag->getAtributo('id'));
    $controlLabel->Anexar((!$requerido) ? sprintf('%s%s', $tag->getAtributo('name'), ':') : sprintf('%s%s', $tag->getAtributo('name'), '*:'));
    $controls = new TTag('div');
    $controls->setAtributo('classe', 'controls');
    $controls->Anexar($tag);
    if ($tag->getMostrarLabel())
      $controlGroup->Anexar($controlLabel);
    $controlGroup->Anexar($controls);
    $this->HTML[0]->Anexar($controlGroup);
  }

}

?>
