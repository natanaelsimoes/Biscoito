<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Lib\Util;

class TGaleriaControl {        

    public function AdicionarFotos() {

        $_SESSION['GALERIA_FOTOS'] = array();

        include('galeria.view.adicionarfotos.php');
    }

    public function AdicionarFotosAction() {

        $fotoBase64 = str_replace('data:image/jpeg;base64,', '', $_POST['foto']);

        $imagem = imagecreatefromstring(base64_decode($fotoBase64));

        $foto = new TFoto();

        $foto->Carregar($imagem);

        $foto->Upload();

        $foto->setDescricao($_POST['descricao']);

        $foto->Salvar();

        if ($_POST['capa'] == 'checked')
            $_SESSION['GALERIA_FOTOS_CAPA'] = $foto->__toString();

        array_push($_SESSION['GALERIA_FOTOS'], $foto->__toString());
    }

    public function AdicionarGaleria() {

        include('galeria.view.adicionargaleria.php');
    }

    public function AdicionarGaleriaAction() {

        $galeria = new TGaleria();

        $categoria = new CategoriaGaleria\TCategoriaGaleria();

        $categoria->CarregarSerial($_POST['categoriagaleria']);

        $galeria->setNome($_POST['nome']);

        $galeria->setCategoria_id($categoria->getId());

        $galeria->setFonte($_POST['fonte']);

        $capa = new TFoto();

        $capa->CarregarSerial($_SESSION['GALERIA_FOTOS_CAPA']);

        $galeria->setCapa_id($capa->getId());

        $galeria->Salvar();

        foreach ($_SESSION['GALERIA_FOTOS'] as $serial) {

            $foto = new TFoto();

            $foto->CarregarSerial($serial);

            $foto->setGaleria_id($galeria->getId());

            $foto->Salvar();
        }
    }

    public function ExcluirGaleriaAction() {

        $galeria = new TGaleria();

        $galeria->CarregarSerial($_REQUEST['galeria']);

        $galeria->DeletarRegistro();
    }

    public function Gerenciar() {

        include('galeria.view.gerenciar.php');
    }

    public function EditarFotos() {
        
        global $_Biscoito;                
        
        $galerias = new TGaleria();
        
        $galeria = $galerias->ListarPorId($_Biscoito->getVariaveisDaURL(2));                
        
        include('galeria.view.editarfotos.php');
    }        
    
    public function GerenciarFotos() {
        
        global $_Biscoito;
        
        $paginacao = new Util\TPaginacao();

        $pagina = $_POST['pagina'];

        $galerias = new TGaleria();
        
        $foto = new TFoto();
        
        $galeria = $galerias->ListarPorId($_Biscoito->getVariaveisDaURL(2));                

        $paginacao->itensPorPagina = 21;

        $paginacao->totalItens = $foto->QuantidadeRegistrados('galeria_id', '=', $galeria->getId());                

        $fotos = $foto->ListarTodosOnde('galeria_id', '=', $galeria->getId(), $pagina, $paginacao->itensPorPagina);

        $paginacao->Paginar();
        
        include('galeria.view.listarfotosadm.php');
        
    }

    public function CarregarGalerias() {

        $paginacao = new Util\TPaginacao();

        $pagina = $_POST['pagina'];

        $galeria = new TGaleria();

        $paginacao->itensPorPagina = 21;

        $paginacao->totalItens = $galeria->QuantidadeRegistrados();

        $galerias = $galeria->ListarTodos($pagina, $paginacao->itensPorPagina);

        $paginacao->Paginar();

        include('galeria.view.listar.php');
    }

}

?>