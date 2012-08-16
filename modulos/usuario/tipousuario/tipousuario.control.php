<?php

namespace Biscoito\Modulos\Usuario\TipoUsuario;

class TTipoUsuarioControl {
    
    public static function ListarTiposUsuario() {
        
        $tiposUsuario = new TTipoUsuario;
       
        return $tiposUsuario->ListarTodos();
        
    }

}

?>
