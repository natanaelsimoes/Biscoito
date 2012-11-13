<?php

namespace Biscoito\Lib\Util;

class TImagem {

    private $imagem;
    private $tipo;
    private $tipoCompleto;
    private $nomeArquivo;
    private $nomeArquivoTemporario;

    function __construct($arquivo) {
        $this->nomeArquivoTemporario = $arquivo['tmp_name'];
        $image_info = getimagesize($this->nomeArquivoTemporario);
        $this->nomeArquivo = $arquivo['name'];
        $this->tipo = $image_info[2];
        $this->tipoCompleto = $arquivo['type'];
        if ($this->tipo == IMAGETYPE_JPEG)
            $this->imagem = imagecreatefromjpeg($this->nomeArquivoTemporario);
        else if ($this->tipo == IMAGETYPE_GIF)
            $this->imagem = imagecreatefromgif($this->nomeArquivoTemporario);
        else if ($this->tipo == IMAGETYPE_PNG)
            $this->imagem = imagecreatefrompng($this->nomeArquivoTemporario);
    }

    function getNomeArquivoTemporario() {
        return $this->nomeArquivoTemporario;
    }

    function getLargura() {
        return imagesx($this->imagem);
    }

    function getAltura() {
        return imagesy($this->imagem);
    }

    function getTipo() {
        $infoImagem = explode('.', $this->nomeArquivo);
        return array_pop($infoImagem);
    }

    function toBase64() {
        ob_start();
        $this->output();
        $stringdata = ob_get_contents(); // read from buffer
        ob_end_clean(); // delete buffer
        return base64_encode($stringdata);
    }

    function Salvar($caminho, $tipoImagem = IMAGETYPE_JPEG, $compressao = 75, $permissao = null) {
        if ($tipoImagem == IMAGETYPE_JPEG)
            imagejpeg($this->imagem, $caminho, $compressao);
        elseif ($tipoImagem == IMAGETYPE_GIF)
            imagegif($this->imagem, $caminho);
        elseif ($tipoImagem == IMAGETYPE_PNG) {
            imagealphablending($this->imagem, true);
            imagesavealpha($this->imagem, true);
            imagepng($this->imagem, $caminho);
        }
        if ($permissao != null)
            chmod($caminho, $permissao);
    }

    function Imprimir($image_type = IMAGETYPE_JPEG) {
        header("Content-Type: {$this->tipoCompleto}");
        if ($image_type == IMAGETYPE_JPEG)
            imagejpeg($this->imagem);
        elseif ($image_type == IMAGETYPE_GIF)
            imagegif($this->imagem);
        elseif ($image_type == IMAGETYPE_PNG)
            imagepng($this->imagem);
    }

    function RedimensionarParaAltura($height) {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    function RedimensionarParaLargura($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    function Escalar($scale) {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    function Redimensionar($largura, $altura) {
        $novaImagem = imagecreatetruecolor($largura, $altura);
        imagecopyresampled($novaImagem, $this->imagem, 0, 0, 0, 0, $largura, $altura, $this->getLargura(), $this->getAltura());
        $this->imagem = $novaImagem;
    }

}

?>