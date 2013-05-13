<?php

namespace Biscoito\Modulos\Blog;

use Biscoito\Lib\Database\TObjeto;

class TPostagem extends TObjeto {

    private $Titulo;

    public function getTitulo() {
        return $this->Titulo;
    }

    public function setTitulo($value) {
        $this->Titulo = $value;
    }

    private $DataCriacao;

    public function getDataCriacao() {
        return $this->DataCriacao;
    }

    public function setDataCriacao($value) {
        $this->DataCriacao = $value;
    }

    private $DataAtualizacao;

    public function getDataAtualizacao() {
        return $this->DataAtualizacao;
    }

    public function setDataAtualizacao($value) {
        $this->DataAtualizacao = $value;
    }

    private $DataPublicacao;

    public function getDataPublicacao() {
        return $this->DataPublicacao;
    }

    public function setDataPublicacao($value) {
        $this->DataPublicacao = $value;
    }   
    
    private $Categorias;

    public function getCategorias() {
        return $this->Categorias;
    }

    public function setCategorias($value) {
        $this->Categorias = $value;
    }

    private $Resumo;

    public function getResumo() {
        return $this->Resumo;
    }

    public function setResumo($value) {
        $this->Resumo = $value;
    }

    private $PalavrasChave;

    public function getPalavrasChave() {
        return $this->PalavrasChave;
    }

    public function setPalavrasChave($value) {
        $this->PalavrasChave = $value;
    }

    private $Texto;

    public function getTexto() {
        return $this->Texto;
    }

    public function setTexto($value) {
        $this->Texto = $value;
    }

    private $Publicado;

    public function getPublicado() {
        return $this->Publicado;
    }

    public function setPublicado($value) {
        $this->Publicado = $value;
    }

}

?>
