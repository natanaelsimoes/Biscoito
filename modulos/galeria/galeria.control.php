<?php

namespace Biscoito\Modulos\Galeria;

use Biscoito\Lib\Util;

class TGaleriaControl {

    public function ExcluirFoto() {

        $foto = new TFoto();

        $foto->CarregarSerial($_POST['objFoto']);

        unlink($foto->getCaminho());

        $foto->DeletarRegistro();
    }

    public function AlterarDescricaoFoto() {

        $foto = new TFoto();

        $foto->CarregarSerial($_POST['objFoto']);

        $foto->setDescricao($_POST['descricao']);

        $foto->Salvar();
    }

    public function AlterarCapa() {

        $foto = new TFoto();

        $foto->CarregarSerial($_POST['objFoto']);

        $galeria = new TGaleria();

        $galeria = $galeria->ListarPorId($_POST['galeria_id']);

        $galeria->setCapa_id($foto->getId());

        $galeria->Salvar();
    }

    public function AdicionarMaisFotos() {

        $galeria = new TGaleria();

        $galeria = $galeria->ListarPorId($_POST['galeria_id']);

        include('galeria.view.adicionarmaisfotos.php');
    }

    public function AdicionarFotos() {

        global $_Biscoito;

        $_SESSION['GALERIA_FOTOS'] = array();

        $galeria_id = @$_Biscoito->getVariaveisDaURL(2);

        if (!empty($galeria_id)) {

            $galeria = new TGaleria();

            $galeria = $galeria->ListarPorId($galeria_id);
        }

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

        if ($_POST['adicionarNovasFotos'] != 'true') {

            $categoria = new CategoriaGaleria\TCategoriaGaleria();

            $categoria->CarregarSerial($_POST['categoriagaleria']);

            $galeria->setNome($_POST['nome']);

            $galeria->setCategoria_id($categoria->getId());

            $galeria->setFonte($_POST['fonte']);

            $this->SalvarCapaGaleria($galeria);
        } else {

            $galeria = $galeria->ListarPorId($_POST['galeria_id']);

            if (isset($_SESSION['GALERIA_FOTOS_CAPA']))
                $this->SalvarCapaGaleria($galeria);
        }

        foreach ($_SESSION['GALERIA_FOTOS'] as $serial) {

            $foto = new TFoto();

            $foto->CarregarSerial($serial);

            $foto->setGaleria_id($galeria->getId());

            $foto->Salvar();
        }
    }

    private function SalvarCapaGaleria(TGaleria &$galeria) {

        $capa = new TFoto();

        $capa->CarregarSerial($_SESSION['GALERIA_FOTOS_CAPA']);

        unset($_SESSION['GALERIA_FOTOS_CAPA']);

        $galeria->setCapa_id($capa->getId());

        $galeria->Salvar();
    }

    public function ExcluirGaleriaAction() {

        $galeria = new TGaleria();

        $galeria->CarregarSerial($_REQUEST['galeria']);

        foreach ($galeria->getFotos(1, null) as $foto)
            unlink($foto->getCaminho());

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

        $paginacao->itensPorPagina = 12;

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