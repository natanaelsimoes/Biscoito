<?php

namespace Biscoito\Modulos\Administrador\Menu;

class TMenu {

    private $nome;    
    
    private $diretorio;
    
    private $icone;    

    public function __construct($nome, $diretorio, $icone) {
        $this->nome = $nome; 
        $this->diretorio = $diretorio;
        $this->icone = $icone;
    }

    public function getNome() {
        return $this->nome;
    }   
    
    public function getDiretorio() {
        return $this->diretorio;
    }
    
    public function getIcone() {
        return $this->icone;
    }

}

?>
