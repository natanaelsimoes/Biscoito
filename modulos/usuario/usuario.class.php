<?php

namespace Biscoito\Modulos\Usuario;

use Biscoito\Lib\Database\TObjeto;

class TUsuario extends TObjeto {

  private $Nome;

  public function getNome() {
    return $this->Nome;
  }

  public function setNome($value) {
    $this->Nome = $value;
  }

  private $NomeDoMeio;

  public function getNomeDoMeio() {
    return $this->NomeDoMeio;
  }

  public function setNomeDoMeio($value) {
    $this->NomeDoMeio = $value;
  }

  private $Sobrenome;

  public function getSobrenome() {
    return $this->Sobrenome;
  }

  public function setSobrenome($value) {
    $this->Sobrenome = $value;
  }

  private $Usuario;

  public function getUsuario() {
    return $this->Usuario;
  }

  public function setUsuario($value) {
    $this->Usuario = $value;
  }

  private $Senha;

  public function getSenha() {
    return $this->Senha;
  }

  public function setSenha($value) {
    $this->Senha = $value;
  }

  private $UltimoLogin;

  public function getUltimoLogin() {
    return $this->UltimoLogin;
  }

  public function setUltimoLogin($value) {
    $this->UltimoLogin = $value;
  }

  private $TipoUsuario_Id;

  public function getTipoUsuario_Id() {
    return $this->TipoUsuario_Id;
  }

  public function setTipoUsuario_Id($value) {
    $this->TipoUsuario_Id = $value;
  }

  private $Status;

  public function getStatus() {
    return $this->Status;
  }

  public function setStatus($value) {
    $this->Status = $value;
  }

  public function getNomeCompleto() {
    return trim(sprintf('%s %s %s', $this->nome, $this->nomeDoMeio, $this->sobrenome));
  }

  public function getStatusStr() {
    return ($this->Status) ? 'ATIVADO' : 'DESATIVADO';
  }

  public function getTipoUsuario() {
    $tipoUsuario = new TipoUsuario\TTipoUsuario;
    return $tipoUsuario->ListarPorId($this->getTipoUsuario_Id());
  }

}

?>