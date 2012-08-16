<?php

namespace Biscoito\Modulos\Usuario\TipoUsuario;

use Biscoito\Lib\Database\TObjeto;

class TTipoUsuario extends TObjeto {
    
    private $nome;   
    private $flag;

    public function getNome() {
        return $this->nome;
    }
    
    public function getFlag() {
        return $this->flag;
    }

    public function setNome($value) {
        $this->nome = $value;
    }
    
    public function setFlag($value) {
        $this->flag = $value;
    }

}

?>
