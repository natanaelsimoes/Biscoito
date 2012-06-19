<?php

namespace Biscoito\Lib\Util;

define('NAVEGADOR_IE', 'Internet Explorer');
define('NAVEGADOR_FF', 'Mozilla Firefox');
define('NAVEGADOR_GC', 'Google Chrome');
define('NAVEGADOR_IE_ABR', 'IE');
define('NAVEGADOR_FF_ABR', 'FF');
define('NAVEGADOR_GC_ABR', 'GC');

/**
 * FUNCOES GLOBAIS :: NAVEGADOR
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2010 Natanael Simoes
 *
 * DESCRICAO
 *
 * Metodos para manipulacao do browser, como escrita na tela
 * e funcoes javascript
 *
 * @package     Global Functions
 * @subpackage  Browser
 * @category    Functions
 * @author      Natanael Simoes <natanael@fabricadecodigo.com.br>
 * @copyright   Copyright (c) 2010 Natanael Simoes
 * @license     http://www.opensource.org/licenses/lgpl-3.0.html LGPLv3
 * @version     1.02
 * @link        http://www.fabricadecodigo.com.br/
 */
class TNavegador {

    public static function getNome() {

        $infoNavegador = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($infoNavegador, 'MSIE') !== false)
            return NAVEGADOR_IE;

        else if (strpos($infoNavegador, 'Firefox') !== false)
            return NAVEGADOR_FF;

        else if (strpos($infoNavegador, 'Chrome') != false)
            return NAVEGADOR_GC;
    }

    public static function getSigla() {

        $nomeNavegador = TNavegador::getNome();

        switch ($nomeNavegador) {

            case NAVEGADOR_IE: return NAVEGADOR_IE_ABR;

            case NAVEGADOR_FF: return NAVEGADOR_FF_ABR;

            case NAVEGADOR_GC: return NAVEGADOR_GC_ABR;
        }
    }

    public static function getVersao() {

        $infoNavegador = $_SERVER['HTTP_USER_AGENT'];

        if (($pos = strpos($infoNavegador, 'MSIE')) !== false) {

            $posVer = strpos($infoNavegador, ';');

            return substr($infoNavegador, $pos + 5, $posVer - $pos + 5);
        } else if (($pos = strpos($infoNavegador, 'Firefox')) !== false) {

            $posVer = strpos($infoNavegador, '/', $pos) + 1;

            return substr($infoNavegador, $posVer);
        } else if (($pos = strpos($infoNavegador, 'Chrome')) != false) {

            $posVer = strpos($infoNavegador, '/', $pos) + 1;

            $posVerStop = strpos($infoNavegador, ' ', $posVer);

            return substr($infoNavegador, $posVer, $posVerStop - $posVer);
        }
    }

    public static function SuportaHTML5() {

        $versaoNavegador = TNavegador::getVersao();
        
        switch (TNavegador::getSigla()) {

            case 'FF':

                return ($versaoNavegador) >= 4;

            case 'GC':

                return ($versaoNavegador) >= 10;

            case 'IE':

                return ($versaoNavegador) >= 9;
        }
    }

    // <editor-fold defaultstate="collapsed" desc="static public AdicionarScript($referencia)">
    /**
     * Adiciona JavaScript a pagina
     *
     * Ultima revisao: 17/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $referencia Referencia do arquivo
     */
    static function AdicionarScript($referencia) {
        echo '<script type="text/javascript" src="' . $referencia . '"></script>';
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public AdicionarEstilo($referencia)">
    /**
     * Adiciona CSS a pagina
     *
     * Ultima revisao: 17/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $referencia Referencia do arquivo
     */
    static function AdicionarEstilo($referencia) {
        echo '<link type="text/css" rel="stylesheet" href="' . $referencia . '" />';
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Alertar($mensagem)">
    /**
     * Exibe uma mensagem
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.02
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $mensagem Mensagem para ser exibida
     */
    static public function Alertar($mensagem) {
        echo "<script type=\"text/javascript\">alert('$mensagem');</script>";
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Confirmar($mensagem, $sim, $nao = null)">
    /**
     * Pede a confirmacao do usuario para alguma questao
     * 
     * Ultima revisao: 06/01/2011
     * Versao: 1.02
     * 
     * @since 1.01
     * @author Natanael Simoes
     * 
     * @param string $mensagem Mensagem para ser exibida
     * @param string $sim Uma funcao do javascript para executar ao confirmar
     * @param string $nao Uma funcao do javascript para executar ao cancelar
     */
    static public function Confirmar($mensagem, $sim, $nao = null) {
        echo "<script type='text/javascript'> if( confirm('$mensagem') ) $sim;";
        if (!is_null($nao))
            echo " else $nao; ";
        echo "</script>";
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Escrever($texto, $cor = 'black', $peso = 'normal')">
    /**
     * Escreve numa linha na tela
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.02
     *
     * @since 1.01
     * @author Natanael Simoes
     *
     * @param string $texto O que sera escrito
     * @param string $cor Cor do que sera escrito. Pode ser a palavra em ingles, hexadecimal ou rgb(a)
     * @param string $peso Peso em que sera escrito
     */
    static public function Escrever($texto, $cor = 'black', $peso = 'normal') {
        echo "<span style='color: $cor; font-weight: $peso'>$texto</span>";
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public EscreverLinha($texto, $cor = 'black', $peso = 'normal')">
    /**
     * Escreve numa linha na tela e pula-a depois de terminar a escrita
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.02
     *
     * @since 1.01
     * @author Natanael Simoes
     * 
     * @param string $textp O que sera escrito
     * @param string $cor Cor do que sera escrito. Pode ser a palavra em ingles, hexadecimal ou rgb(a)
     * @param string $peso Peso em que sera escrito
     */
    static function EscreverLinha($texto = '', $cor = 'black', $peso = 'normal') {
        GF_Navegador::Escrever($texto, $cor, $peso);
        echo '<br />';
    }

    // </editor-fold>

    static public function Redirecionar($caminho) {
        echo "<script type=\"text/javascript\"> location.href = '$caminho'; </script>";
    }

}

?>
