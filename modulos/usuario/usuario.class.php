<?php

namespace Biscoito\Modulos\Usuario;

use Biscoito\Lib\Database\TObjeto;

class TUsuario extends TObjeto {

    private $nome;
    private $nomeDoMeio;
    private $sobrenome;
    private $usuario;
    private $senha;
    private $ultimoLogin;
    private $tipousuario_id;
    private $status;

    public function getNome() {
        return $this->nome;
    }

    public function getNomeDoMeio() {
        return $this->nomeDoMeio;
    }

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getUltimoLogin() {
        return $this->ultimoLogin;
    }

    public function getTipoUsuario_Id() {
        return $this->tipousuario_id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getStatusStr() {
        return ($this->status) ? 'ATIVADO' : 'DESATIVADO';
    }
    
    public function getFlag() {
        $tipoUsuario = new TipoUsuario\TTipoUsuario;
        return $tipoUsuario->ListarPorId($this->getTipoUsuario_Id())->getFlag();
    }

    public function setNome($value) {
        $this->nome = $value;
    }

    public function setNomeDoMeio($value) {
        $this->nomeDoMeio = $value;
    }

    public function setSobrenome($value) {
        $this->sobrenome = $value;
    }

    public function setSenha($value) {
        $this->senha = $value;
    }

    public function setUsuario($value) {
        $this->usuario = $value;
    }

    public function setUltimoLogin($value) {
        $this->ultimoLogin = $value;
    }

    public function setTipoUsuario_Id($value) {
        $this->tipousuario_id = $value;
    }

    public function setStatus($value) {
        $this->status = $value;
    }

}

?>