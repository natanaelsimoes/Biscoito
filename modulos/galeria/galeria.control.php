<?php

namespace Biscoito\Modulos\Galeria;

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
