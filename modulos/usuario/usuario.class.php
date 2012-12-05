<?php

namespace Biscoito\Modulos\Usuario;

use Biscoito\Lib\Database\TObjeto;
use Biscoito\Modulos\Loja;

class TUsuario extends TObjeto {

    private $nome;
    private $nomeDoMeio;
    private $sobrenome;
    private $usuario;
    private $senha;
    private $ultimoLogin;
    private $tipousuario_id;
    private $loja_id;
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

    public function getNomeCompleto() {
        return trim(sprintf('%s %s %s', $this->nome, $this->nomeDoMeio, $this->sobrenome));
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

    public function getLoja_Id() {
        return $this->loja_id;
    }

    public function getLoja() {

        $loja = new Loja\TLoja;

        if (!empty($this->loja_id))
            $loja = $loja->ListarPorId($this->loja_id);

        return $loja;
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

    public function setLoja_Id($value) {
        $this->loja_id = $value;
    }

    public function setStatus($value) {
        $this->status = $value;
    }

    public function getTipoUsuario() {

        $tipoUsuario = new TipoUsuario\TTipoUsuario;

        return $tipoUsuario->ListarPorId($this->getTipoUsuario_Id());
    }

}

?>