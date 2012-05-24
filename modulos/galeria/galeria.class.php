<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Lib\Database\TObjeto;
use Biscoito\Modulos\Galeria\TFoto;
use Biscoito\Modulos\Galeria\CategoriaGaleria\TCategoriaGaleria;

class TGaleria extends TObjeto {

    private $nome;
    private $categoria;
    private $descricao;
    private $fonte;
    private $dataCriacao;
    private $publicado;
    private $capa;
    private $fotos;

    public function __construct() {
        $this->categoria = new TCategoriaGaleria();
        $this->capa = new TFoto();
        $this->fotos = array();
        parent::__construct();
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getFonte() {
        return $this->fonte;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function getPublicado() {
        return $this->publicado;
    }
    
    public function getCapa() {
        return $this->capa;
    }
    
    public function getFotos() {
        $this->CarregarFotos();
        return $this->fotos;
    }
    
    public function getQuantidadeFotos() {
        $this->CarregarFotos();
        return count($this->fotos);
    }
    
    public function CarregarFotos($pagina = null, $quantidade = null) {
        if (!isset($this->fotos)) {
            $fotos = new TFoto();
            $this->fotos = $fotos->ListarTodosOnde('galeria_id', '=', $this->getId(), $pagina, $quantidade);
        }
    }
    
    private function CarregarCapa() {
        if(!isset($this->capa)) {
            $foto = new TFoto();
            $this->capa = $foto->ListarPorId($this->capa->id);
        }
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCategoria(TCategoria $categoria) {
        $this->categoria = $categoria;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setFonte($fonte) {
        $this->fonte = $fonte;
    }

    public function setPublicado($publicado) {
        $this->publicado = $publicado;
    }
    
    public function setCapa($capa) {
        $this->capa = $capa;
    }
    
    public function ListarTodos($pagina = null, $quantidade = null) {
        $galerias = parent::ListarTodos($pagina, $quantidade);
        foreach($galerias as $galeria) 
            $galeria->CarregarCapa();
        return $galerias;
    }

}

?>