<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Lib\Database\TObjeto;
use Biscoito\Modulos\Galeria\TFoto;
use Biscoito\Modulos\Galeria\CategoriaGaleria\TCategoriaGaleria;

class TGaleria extends TObjeto {

    private $nome;
    private $descricao;
    private $fonte;
    private $dataCriacao;
    private $publicado;
    private $categoria_id;
    private $capa_id;

    public function __construct() {
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
        $foto = new TFoto();
        if (!empty($this->capa_id))
            $foto = $foto->ListarPorId($this->capa_id);
        return $foto;
    }

    public function getFotos($pagina, $quantidade) {
        $fotos = new TFoto();
        return $fotos->ListarTodosOnde('galeria_id', '=', $this->getId(), $pagina, $quantidade);
    }

    public function getQuantidadeFotos() {
        return count($this->getFotos());
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCategoria_id($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setFonte($fonte) {
        $this->fonte = $fonte;
    }
    
    public function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }

    public function setPublicado($publicado) {
        $this->publicado = $publicado;
    }

    public function setCapa_id($capa_id) {
        $this->capa_id = $capa_id;
    }

}

?>