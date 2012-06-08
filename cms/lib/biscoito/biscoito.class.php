<?php

namespace Biscoito\Lib;

use Biscoito\Lib\Util;

require_once('cms/lib/util/texto.class.php');
require_once('cms/lib/util/navegador.class.php');
require_once('cms/lib/util/vetor.class.php');

define('PATHJQUERY', 'cms/js/jquery-1.7.2.min.js');
define('PATHJQUERYUI', 'cms/js/jquery-ui-1.8.20.custom.min.js');
define('PATHJQUERYUICSS', 'cms/css/jqueryui/smoothness/jquery-ui-1.8.20.custom.css');
define('ADM_MODULOS', 'menu');

/**
 * @author Natanael Simoes
 * @category Framework
 * @package Biscoito
 * @subpackage Lib
 * @uses Biscoito\Lib\Util\TTexto;
 * @version 1.0
 */
class TBiscoito {

    /**
     * Namespace ao qual o modulo/auxiliar pertence
     * @var string
     */
    private $namespace;

    /**
     * Nome do modulo principal executado pelo Biscoito
     * @var string
     */
    private $modulo;
    private $variaveisDaURL;

    /**
     * Nome do submodulo principal executado pelo Biscoito
     * @var String
     */
    private $subModulo;

    /**
     * Nome do modulo auxiliar principal executado pelo Biscoito
     * @var string
     */
    private $moduloAuxiliar;

    /**
     * Nome da classe de controle principal executado pelo Biscoito
     * @var string
     */
    private $classeControle;

    /**
     * Funcao executada na classe principal pelo Biscoito
     * @var type 
     */
    private $acao;

    /**
     * Ao instanciar um objeto desta classe, este sera carregado inicialmente
     * com as configuracao de config.xml na raiz do servidor para definir
     * modulos, acao a executar e banco de dados
     */
    public function __construct() {

        global $_BiscoitoConfig;

        $countURLVars = 0;

        $arrOffset = (strpos($_SERVER['HTTP_HOST'], '.') !== false) ? 1 : 2;

        $requestURI = $_SERVER['REQUEST_URI'];

        $arrURLVars = array_slice(explode('/', $requestURI), $arrOffset);

        array_pop($arrURLVars);

        $countURLVars = count($arrURLVars); 

        if ($countURLVars > 0) {

            $this->modulo = $arrURLVars[0];

            $this->variaveisDaURL = array_slice($arrURLVars, 1);

            $xmlModuloConfig = $this->getConfiguracaoXML($this->modulo);

            if ($countURLVars == 1)
                $this->acao = strval($xmlModuloConfig->index->acao);

            else {

                $this->moduloAuxiliar = $this->acao = str_replace('_', '', array_pop($arrURLVars));

                $countURLVars--;
            }

            $this->namespace = 'Biscoito\\Modulos\\';

            for ($i = 0; $i < $countURLVars; $i++) {

                $this->namespace .= "{$arrURLVars[$i]}\\";

                if ($i < $countURLVars - 1)
                    if ($arrURLVars[$i] == 'administrador' && strpos(ADM_MODULOS, $arrURLVars[$i + 1]) === false)
                        $i = $countURLVars;
            }

            $this->namespace = substr($this->namespace, 0, -1);

            //$this->subModulo = array_pop($arrURLVars);
            if (!empty($this->variaveisDaURL))
                $this->subModulo = $this->variaveisDaURL[0];

            if ($this->modulo != $this->subModulo)
                $this->moduloAuxiliar = $this->subModulo;

            if ($this->moduloAuxiliar == $this->acao)
                $this->moduloAuxiliar = $this->modulo;
        }

        else {

            $this->modulo = strval($_BiscoitoConfig->index->modulo);

            $this->acao = strval($_BiscoitoConfig->index->acao);

            $this->namespace = "Biscoito\\Modulos\\{$this->modulo}";

            $this->classeControle = $this->namespace . '\\' . $_BiscoitoConfig->index->controle;
        }
    }

    /**
     * Retorna a acao princial executada pelo Biscoito
     * @return string 
     */
    public function getAcao() {
        return $this->acao;
    }

    /**
     * Retorna o caminho fisico de determinado modulo
     * @param array $arrDiretorios Array de diretorios
     * @return string 
     */
    public function getCaminhoModulo($arrDiretorios) {

        $href = '';

        foreach ($arrDiretorios as $arg)
            $href.=strtolower("$arg/");

        return $href;
    }

    /**
     * Retorna classe de controle principal executada no Biscoito
     * @return string
     */
    public function getClasseControle() {

        if (empty($this->classeControle)) {

            if ((strpos($this->namespace, 'administrador') === false && count(explode('\\', $this->namespace)) <= 3) || (strpos($this->namespace, 'administrador') !== false && strpos(ADM_MODULOS, $this->subModulo) === false))
                $this->subModulo = '';

            $xmlModuloConfig = $this->getConfiguracaoXML($this->modulo);

            foreach ($xmlModuloConfig->classes as $classes)
                foreach ($classes as $nomeClasse => $classe)
                    if ($this->subModulo == $classe['sub-modulo'] && $classe['controle'] = 'true')
                        return $this->classeControle = "$this->namespace\\$nomeClasse";
        }

        return $this->classeControle;
    }

    /**
     * Enquanto getClasseControle() retorna a principal classe de controle
     * este metodo retorna a classe de controle de um modulo/submodulo
     * especifico
     * @param string $modulo Modulo avulso
     * @param string $subModulo Submodulo avulso (opcional)
     * @return string 
     */
    public function getClasseControleModuloAvulso($modulo, $subModulo = '') {

        $xmlModuloConfig = $this->getConfiguracaoXML($modulo);

        foreach ($xmlModuloConfig->classes as $classes)
            foreach ($classes as $nomeClasse => $classe)
                if ($classe['sub-modulo'] == $subModulo && $classe['controle'] = 'true')
                    return ($subModulo == '') ? "$xmlModuloConfig->namespace\\$nomeClasse" : "$xmlModuloConfig->namespace\\$subModulo\\$nomeClasse";
    }

    /**
     * Retorna a classe de relacionamento referente a um atributo de uma classe
     * principal que e uma instancia ou colecao de instancia de outra classe
     * agregada
     * @param string $classe Nome da classe principal onde esta o atributo relacionado
     * @param type $atributo Nome do atributo instancia ou colecao de instancias de outra classe
     * @return string Retorna o nome da classe relacionada. Se nao for encontrada qualquer configuracao de relacionamento, retorna falso
     */
    public function getClasseRelacionamento($classe, $atributo) {

        $xmlModuloConfig = $this->getConfiguracaoXML($this->moduloAuxiliar);

        foreach ($xmlModuloConfig->classes as $classes)
            foreach ($classes as $nomeClasse => $classeVars)
                if ($nomeClasse == $classe)
                    foreach ($classeVars as $nomeAtributo => $configAtributo)
                        if ($nomeAtributo == $atributo)
                            return $configAtributo['relacionamento'];

        return false;
    }

    /**
     * Retorna um objeto com a configuracao de um modulo
     * @param string $modulo Nome do modulo 
     * @return SimpleXMLElement 
     */
    public function getConfiguracaoXML($modulo) {
        return $xmlBiscoitoConfig = simplexml_load_file("modulos/$modulo/config.xml");
    }

    /**
     * Retorna o (nome da pasta) modulo principal executado pelo Biscoito
     * @return string 
     */
    public function getModulo() {
        return $this->modulo;
    }

    /**
     * Retorna o modulo auxiliar principal (o ultimo de uma serie de submodulos, responsavel pela acao) executado pelo Biscoito
     * @return string 
     */
    public function getModuloAuxiliar() {
        return $this->moduloAuxiliar;
    }

    /**
     * Retorno o namespace do modulo (ou modulo auxiliar se houver)
     * @return string 
     */
    public function getNamespace() {
        return $this->namespace;
    }

    /**
     * Retorna o nome do modulo principal executado pelo Biscoito segundo o arquivo de configuracao XML do modulo
     * @return string 
     */
    public function getNomeModulo() {
        $xml = $this->getConfiguracaoXML($this->modulo);
        return $xml->nome;
    }

    public function getNomeModuloAuxiliar() {
        $xml = $this->getConfiguracaoXML($this->getModuloAuxiliar());
        return $xml->nome;
    }

    /**
     * Retorna a URL principal do site (sem variaveis e modulos)
     * @global Biscoito\Lib\TBiscoitoConfig $_BiscoitoConfig
     * @return string 
     */
    public function getSite() {
        global $_BiscoitoConfig;
        return $_BiscoitoConfig->site;
    }

    public function getSubModulo() {
        return $this->subModulo;
    }

    public function getVariaveisDaURL() {
        return $this->variaveisDaURL;
    }

    /**
     * Exibe uma imagem na tela configurando-a seguindo as exigencias do Biscoito
     * @param string $src Caminho relativo da imagem a partir da raiz do site
     * @param string $title Titulo da imagem
     * @param string $alt Texto alternativo a imagem
     */
    public function imagem($src, $title, $alt = '') {

        $imagem = '<img title="%s" alt="%s" src="%s%s">';

        echo sprintf($imagem, $title, $alt, $this->getSite(), $src);
    }

    /**
     * Exibe um link na tela configurando-o segundo as exigencias do Biscoito
     * @param type $texto Texto do link
     * @param type $alt Texto alternativo para o link
     * @param type $modulo Nome do modulo
     * @param type $_ [opcional] Nome do(s) submodulo(s) e/ou acao
     */
    public function link($texto, $alt, $modulo, $_ = null) {

        $href = '';

        $link = '<a href="%s%s" alt="%s">%s</a>';

        $args = array_slice(func_get_args(), 2);

        foreach ($args as $arg)
            $href.=strtolower("$arg/");

        echo sprintf($link, $this->getSite(), $href, $alt, $texto);
    }

    public function montarLink($modulo, $_ = null) {

        $dir = func_get_args();

        $link = $this->getSite();

        foreach ($dir as $part)
            $link.= "$part/";

        return $link;
    }

    /**
     * Ordena os objetos dentro de uma colecao (array)
     * @param array $array Objetos Colecao de objetos
     * @param string $atributo Nome do atributo que regera a ordenacao
     * @param integer $ordem Metodo de ordenacao da colecao: SORT_ASC ou SORT_DESC
     * @return array 
     */
    public function ordenarObjetos($arrayObjetos, $atributo, $ordem = SORT_ASC) {

        $resolucaoFormat = 'return (strtolower($arrayObjetos[$j+1]->%s) <= strtolower($arrayObjetos[$j]->%s));';

        $resolucaoString = sprintf($resolucaoFormat, $atributo, $atributo);

        for ($i = 0, $quantidadeObjetos = count($arrayObjetos); $i < $quantidadeObjetos; $i++) {

            for ($j = 0; $j < $quantidadeObjetos - 1; $j++) {

                $resolucao = eval($resolucaoString);

                if ($resolucao) {

                    $tempVar = $arrayObjetos[$j];

                    $arrayObjetos[$j] = $arrayObjetos[$j + 1];
                    $arrayObjetos[$j + 1] = $tempVar;
                }
            }
        }

        if ($ordem == SORT_DESC)
            $arrayObjetos = array_reverse($arrayObjetos);

        return $arrayObjetos;
    }

    public function usarBootstrap() {
        $this->usarEstilo('plugins/bootstrap/css/bootstrap.css');
        $this->usarEstilo('plugins/bootstrap/css/bootstrap-responsive.css');
        $this->usarScript('plugins/bootstrap/js/jquery.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-transition.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-alert.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-modal.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-dropdown.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-scrollspy.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-tab.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-tooltip.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-popover.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-button.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-collapse.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-carousel.js');
        $this->usarScript('plugins/bootstrap/js/bootstrap-typeahead.js');        
    }
    
    /**
     * Carrega os arquivos JavaScript do Biscoito 
     */
    public function usarBiscoitoJS() {
        $this->usarScript('plugins/phpjs/js/php.default.min.js');
        include('biscoito.js.erros.php');
        include('biscoito.js.php');
    }

    /**
     * Carrega uma folha de estilo
     * @param string $src Caminho relativo da folha de estilo a partir da raiz do site
     */
    public function usarEstilo($src) {
        $styleTag = '<style type="text/css">@import "%s%s"</style>';
        echo sprintf($styleTag, $this->getSite(), $src);
    }

    /**
     * Carrega a biblioteca JQuery para uso
     */
    public function usarJQuery() {
        $this->usarScript(PATHJQUERY);
    }

    /**
     * Carrega a biblioteca JQueryUI para uso 
     */
    public function usarJQueryUI() {
        $this->usarScript(PATHJQUERYUI);
        $this->usarEstilo(PATHJQUERYUICSS);
    }

    /**
     * Carrega um script
     * @param string $src Caminho relativo do script a partir da raiz do site
     */
    public function usarScript($src) {
        $scriptTag = '<script type="text/javascript" src="%s%s"></script>';
        echo sprintf($scriptTag, $this->getSite(), $src);
    }

    public function requisitarAcao($classe, $acao) {

        if (!class_exists($classe)) {
            $classe = $this->getClasseControleModuloAvulso($this->variaveisDaURL[0]);
            if (empty($classe))
                throw new Exception('ERRRRRRO');
        }

        $metodosClasse = get_class_methods($classe);
        
        $vetor = new Util\TVetor(get_class_methods($classe));        
        
        if (count(@$vetor->Procurar($this->variaveisDaURL[1])) > 0)
            $this->acao = $acao = $this->variaveisDaURL[1];

        ob_start();

        $objeto = new $classe;

        $objeto->$acao();

        $requisicao = ob_get_contents();

        ob_end_clean();

        return $requisicao;
    }

}

?>
