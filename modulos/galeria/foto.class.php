<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Lib\Database\TObjeto;
use Biscoito\Lib\Util\TImagem;

class TFoto extends TObjeto {
    
    private $descricao;
    private $caminho;
    private $largura;
    private $altura;
    private $tipo;
    private $galeria_id;
    
    protected $imagem;
    
    public function Carregar($arquivo) {
        $this->imagem = new TImagem($arquivo);
        $this->largura = $imagem->getLargura();
        $this->altura = $imagem->getAltura();
        $this->tipo = $imagem->getTipo();
    }
    
    public function getDescricao() {
        return $this->descricao;
    }
    
    public function getCaminho() {
        return $this->caminho;
    }
    
    public function getLargura() {
        return $this->largura;
    }
    
    public function getAltura() {
        return $this->altura;
    }
    
    public function getTipo() {
        return $this->tipo;
    }
    
    public function getGaleria() {
        
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
}

?>
