<?php
namespace Biscoito\Modulos\Galeria\CategoriaGaleria;

use Biscoito\Lib\Database\TObjeto;

class TCategoriaGaleria extends TObjeto {
    
    private $nome;
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
}
?>
