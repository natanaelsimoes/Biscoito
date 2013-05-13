<?php

namespace Biscoito\Modulos\Blog;

use Biscoito\Lib\Database\TObjeto;

class TCategoriaPostagem extends TObjeto {

    private $Nome;

    public function getNome() {
        return $this->Nome;
    }

    public function setNome($value) {
        $this->Nome = $value;
    }

    private $Descricao;

    public function getDescricao() {
        return $this->Descricao;
    }

    public function setDescricao($value) {
        $this->Descricao = $value;
    }

    private $Apelido;

    public function getApelido() {
        return $this->Apelido;
    }

    public function setApelido($value) {
        $this->Apelido = $value;
    }

    private $CategoriaPai;

    public function getCategoriaPai() {
        return $this->CategoriaPai;
    }

    public function setCategoriaPai($value) {
        $this->CategoriaPai = $value;
    }

}

?>
