<?php

namespace Biscoito\Modulos\Administrador\Menu;

class TMenuOpcao {
    
    private $nome;
    
    private $url;
    
    private $abrirPopup;
    
    private $icone;
    
    public function __construct($nome, $url, $icone, $abrirPopup) {
        
        $this->nome = $nome;
        
        $this->url = $url;
        
        $this->icone = $icone;
        
        $this->abrirPopup = ($abrirPopup == 'true');
        
    }
    
    public function getNome() { return $this->nome; }
    
    public function getURL() { return $this->url; }
    
    public function getIcone() { return $this->icone; }
    
    public function AbrirPopup() { return $this->abrirPopup; }
    
}
?>
