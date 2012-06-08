<?php

namespace Biscoito\Modulos\Galeria;

class TGaleriaControl {       
    
    public function ExibirFormularioAdicionar() {
        
        include('galeria.view.adicionar.php');
        
    }
    
    public function Gerenciar() {
        
        include('galeria.view.gerenciar.php');
        
    }
    
    public function Editar() {
        global $_Biscoito;
        var_dump($_Biscoito->getVariaveisDaURL());
    }
    
    public function CarregarGalerias() {
        
        $pagina = $_POST['pagina'];
        
        $galeria = new TGaleria();
        
        $galerias = $galeria->ListarTodos($pagina, 20);
        
        include('galeria.view.listar.php');
        
    }
    
}
?>
