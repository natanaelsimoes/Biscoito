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
    
        $this->imagem = $arquivo;                
        
        $this->largura = imagesx($this->imagem);
        
        $this->altura = imagesy($this->imagem);
        
        $this->tipo = 'image/jpeg';
        
    }
    
    public function Upload() {
        
        $destino = sprintf('modulos/galeria/fotos/%s.%s', uniqid('img_'), 'jpg');
        
        $this->caminho = $destino;                
        
        imagejpeg($this->imagem, $destino, 80);                                
        
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
    
    public function getGaleria_id() {
        return $this->galeria_id;
    }
    
    public function isCapa() {
        
        $galeria = new TGaleria();
        
        $galeria = $galeria->ListarPorId($this->getGaleria_id());
        
        return ($galeria->getCapa_id() == $this->getId());
        
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    public function setCaminho($caminho) {
        $this->caminho = $caminho;
    }
    
    public function setLargura($largura) {
        $this->largura = $largura;
    }
    
    public function setAltura($altura) {
        $this->altura = $altura;
    }
    
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    
    public function setGaleria_id($galeria_id) {
        $this->galeria_id = $galeria_id;
    }
    
}

?>
