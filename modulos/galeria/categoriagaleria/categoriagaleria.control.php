<?php

namespace Biscoito\Modulos\Galeria\CategoriaGaleria;

class TCategoriaGaleriaControl {    
    
    public function Salvar() {
        
        $categoria = new TCategoriaGaleria();
        
        $categoria->CarregarSerial($_REQUEST['objCategoriaGaleria']);
        
        $categoria->setNome($_REQUEST['nome']);
        
        $categoria->Salvar();
        
    }
    
    public function Excluir() {
        
        $categoria = new TCategoriaGaleria();
        
        $categoria->CarregarSerial($_REQUEST['categoriagaleria']);
        
        $categoria->DeletarRegistro();
        
    }

    public static function ExibirFormularioAdicionar() {
        
        $categoria = new TCategoriaGaleria();
        
        $acao = 'Adicionar';
        
        include('categoriagaleria.view.edicao.php');
        
    }
    
    public static function ExibirFormularioAlterar() {
        
        $categoria = new TCategoriaGaleria();
        
        $categoria->CarregarSerial($_REQUEST['categoriagaleria']);
        
        $acao = 'Alterar';
        
        include('categoriagaleria.view.edicao.php');
        
    }
    
    public static function ExibirSelecaoCategorias() {
        
        $categoria = new TCategoriaGaleria;
        
        $categorias = $GLOBALS['_Biscoito']->ordenarObjetos($categoria->ListarTodos(), 'getNome()');
        
        include('categoriagaleria.view.select.php');
    }
    
}

?>
