<?php

namespace Biscoito\Modulos\Galeria\CategoriaGaleria;

class TCategoriaGaleriaControl {
    

    public static function ExibirFormularioAdicionar() {
        
        include('categoriagaleria.view.adicionar.php');
        
    }
    
    public static function ExibirSelecaoCategorias() {
        
        $categoria = new TCategoriaGaleria;
        
        $categorias = $GLOBALS['_Biscoito']->ordenarObjetos($categoria->ListarTodos(), 'getNome()');
        
        include('categoriagaleria.view.select.php');
    }
    
}

?>
