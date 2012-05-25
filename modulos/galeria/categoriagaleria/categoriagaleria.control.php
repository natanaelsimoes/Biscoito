<?php

namespace Biscoito\Modulos\Galeria\CategoriaGaleria;

class TCategoriaGaleriaControl {
    
    public function Adicionar() {
        
        $categoria = new TCategoriaGaleria();
        
        $categoria->setNome($_POST['nomeCategoriaGaleria']);
        
        $categoria->Salvar();
        
    }

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
