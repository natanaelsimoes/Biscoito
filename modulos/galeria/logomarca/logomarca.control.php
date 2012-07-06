<?php

namespace Biscoito\Modulos\Galeria\Logomarca;

use Biscoito\Lib\Util;

class TLogomarcaControl {

    public function GerarTemplate() {

        $logoTemplateWidth = 1024;

        $logoTemplateHeight = 768;

        $logoTemplate = imagecreatetruecolor($logoTemplateWidth, $logoTemplateHeight);

        imagesavealpha($logoTemplate, true);

        $color = imagecolorallocatealpha($logoTemplate, 0x00, 0x00, 0x00, 127);

        imagefill($logoTemplate, 0, 0, $color);

        for ($i = 1; $i <= 9; $i++) {

            $filename = "modulos/galeria/fotos/logo_pos_$i.png";

            if (file_exists($filename)) {

                $logoPos = imagecreatefrompng($filename);

                $logoPosWidth = imagesx($logoPos);

                $logoPosHeight = imagesy($logoPos);

                $hAlign = 0;

                $vAlign = 0;

                if ($logoTemplateWidth / 3 > $logoPosWidth)
                    $hAlign = (($logoTemplateWidth / 3) - $logoPosWidth) / 2;

                if ($logoTemplateHeight / 3 > $logoPosHeight)
                    $vAlign = (($logoTemplateHeight / 3) - $logoPosHeight) / 2;

                switch ($i) {

                    case 1:

                        $logoTemplateX = 0;

                        $logoTemplateY = 0;

                        break;

                    case 2:

                        $logoTemplateX = $logoTemplateWidth / 3;

                        $logoTemplateY = 0;

                        break;

                    case 3:

                        $logoTemplateX = $logoTemplateWidth / 3 * 2;

                        $logoTemplateY = 0;

                        break;

                    case 4:

                        $logoTemplateX = 0;

                        $logoTemplateY = $logoTemplateHeight / 3;

                        break;

                    case 5:

                        $logoTemplateX = $logoTemplateWidth / 3;

                        $logoTemplateY = $logoTemplateHeight / 3;

                        break;

                    case 6:

                        $logoTemplateX = $logoTemplateWidth / 3 * 2;

                        $logoTemplateY = $logoTemplateHeight / 3;

                        break;

                    case 7:

                        $logoTemplateX = 0;

                        $logoTemplateY = $logoTemplateHeight / 3 * 2;

                        break;

                    case 8:

                        $logoTemplateX = $logoTemplateWidth / 2;

                        $logoTemplateY = $logoTemplateHeight / 3 * 2;

                        break;

                    case 9:

                        $logoTemplateX = $logoTemplateWidth / 3 * 2;

                        $logoTemplateY = $logoTemplateHeight / 3 * 2;

                        break;
                }



                imagecopy($logoTemplate, $logoPos, $logoTemplateX + $hAlign, $logoTemplateY + $vAlign, 0, 0, imagesx($logoPos), imagesy($logoPos));

                imagedestroy($logoPos);
            }
        }

        imagepng($logoTemplate, 'modulos/galeria/fotos/logo_template.png', 0);

        imagedestroy($logoTemplate);
    }

    public function Salvar() {
        
        $posicao = $_POST['posicao'];

        if (!empty($_FILES['logo']['tmp_name'])) {

            $logo = new Util\TImagem($_FILES['logo']);

            $logo->Salvar("modulos/galeria/fotos/logo_pos_$posicao.png", IMAGETYPE_PNG, 90);
        } else {

            unlink("modulos/galeria/fotos/logo_pos_$posicao.png");
        }

        $this->GerarTemplate();

        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    public function Gerenciar() {

        include('logomarca.view.gerenciar.php');
    }

}

?>