<?php

namespace Biscoito\Lib;

use Biscoito\Lib\Util;

require_once('cms/lib/util/texto.class.php');
require_once('cms/lib/util/imagem.class.php');
require_once('cms/lib/util/navegador.class.php');
require_once('cms/lib/util/paginacao.class.php');
require_once('cms/lib/util/vetor.class.php');
require_once('cms/lib/util/html.class.php');

define('PATHJQUERY', 'plugins/bootstrap/scripts/jquery-1.7.2.min.js');
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

  private static $instance;

  public static function singleton() {
    if (!isset(self::$instance)) {
      $c = __CLASS__;
      self::$instance = new $c;
    }

    return self::$instance;
  }

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
  private $gateway;
  private $soServidor;

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

      $this->gateway = ($arrURLVars[0] == 'administrador') ? $arrURLVars[0] : 'index';

      $this->modulo = ($arrURLVars[0] == 'administrador' && $countURLVars > 1) ? $arrURLVars[1] : $arrURLVars[0];

      if ($arrURLVars[0] == 'administrador') {

        $this->variaveisDaURL = array_slice($arrURLVars, 1);

        $countURLVars--;
      }

      else
        $this->variaveisDaURL = $arrURLVars;

      $xmlModuloConfig = $this->getConfiguracaoXML($this->modulo);

      if ($countURLVars == 1 || $this->modulo == 'administrador')
        $this->acao = strval($xmlModuloConfig->index->acao);

      else
        $this->acao = str_replace('_', '', end($arrURLVars));

      $this->namespace = "Biscoito\\Modulos\\{$this->modulo}";

      $indiceSubModulo = ($this->gateway == 'administrador') ? 1 : 1;

      if (array_key_exists($indiceSubModulo, $this->variaveisDaURL) && $this->variaveisDaURL[$indiceSubModulo] != $this->acao)
        $this->subModulo = $this->variaveisDaURL[$indiceSubModulo];

      if (!empty($this->subModulo))
        $this->namespace .= "\\$this->subModulo";
    }

    else {

      $this->gateway = 'index';

      $this->modulo = strval($_BiscoitoConfig->index->modulo);

      $this->acao = strval($_BiscoitoConfig->index->acao);

      $this->namespace = "Biscoito\\Modulos\\{$this->modulo}";

      $this->classeControle = $this->namespace . '\\' . $_BiscoitoConfig->index->controle;
    }
  }

  public function getSOServidor() {

    if (empty($this->soServidor)) {

      if (strpos($_SERVER['SERVER_SIGNATURE'], 'Unix') !== false)
        $this->soServidor = 'Linux';

      else if (strpos($_SERVER['SERVER_SIGNATURE'], 'Win32') !== false)
        $this->soServidor = 'Windows';

      else
        $this->soServidor = 'Mac';
    }

    return $this->soServidor;
  }

  public function getGateway() {
    return $this->gateway;
  }

  public function getClasseGateway() {
    return $this->getClasseControleModuloAvulso($this->gateway);
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

    $nomeModulo = ($this->getModulo() == 'administrador') ? $this->getModuloAuxiliar() : $this->getModulo();

    $xmlModuloConfig = $this->getConfiguracaoXML($nomeModulo);

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

    $modulo = strtolower($modulo);

    return $xmlBiscoitoConfig = simplexml_load_file("modulos/$modulo/config.xml");
  }

  /**
   * Retorna o (nome da pasta) modulo principal executado pelo Biscoito
   * @return string
   */
  public function getModulo($namespace = null) {
    if (is_null($namespace))
      return $this->modulo;
    else {
      $arrPartesNamespace = array();
      $arrPartesNamespace = explode('\\', $namespace);
      return $arrPartesNamespace[2];
    }
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

  public function getVariaveisDaURL($index = null) {
    return (is_null($index)) ? $this->variaveisDaURL : (array_key_exists($index, $this->variaveisDaURL)) ? $this->variaveisDaURL[$index] : null;
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

    $resolucaoFormat = 'return (strtolower($arrayObjetos[$j+1]->get%s()) %s strtolower($arrayObjetos[$j]->get%s()));';

    $resolucaoString = sprintf($resolucaoFormat, $atributo, $ordem == SORT_ASC ? '<' : '>', $atributo);

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

    return $arrayObjetos;
  }

  public function usarBootstrap() {
    $this->usarEstilo('plugins/bootstrap/css/bootstrap.css');
    $this->usarEstilo('plugins/bootstrap/css/bootstrap-responsive.css');
    echo "<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>";
    $this->usarEstilo('plugins/bootstrap/css/metro-ui.css');
    $this->usarEstilo('plugins/bootstrap/css/metro-tiles.css');
    $this->usarEstilo('plugins/bootstrap/css/charms.css');
    //$this->usarEstilo('plugins/bootstrap/css/metro-ui-light.css');
    $this->usarEstilo('plugins/bootstrap/css/bootstrap-metro-responsive.css');
    $this->usarEstilo('plugins/bootstrap/css/icomoon.css');
    $this->usarScript('plugins/bootstrap/scripts/jquery-1.7.2.min.js');
    $this->usarScript('plugins/bootstrap/scripts/google-code-prettify/prettify.js');
    $this->usarScript('plugins/bootstrap/scripts/jquery.mousewheel.js');
    $this->usarScript('plugins/bootstrap/scripts/jquery.scrollTo.js');
    $this->usarScript('plugins/bootstrap/scripts/bootstrap.min.js');
    $this->usarScript('plugins/bootstrap/scripts/metro.js');
    $this->usarScript('plugins/bootstrap/scripts/charms.js');
    $this->usarScript('plugins/bootstrap/scripts/bootstrap.util.form.js');
    echo '<script type="text/javascript">
                $(".metro").metro();
              </script>';
  }

  public function usarBootstrap2() {
    $this->usarEstilo('plugins/bootstrap/css/bootstrap.css');
    $this->usarEstilo('plugins/bootstrap/css/bootstrap-responsive.css');
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
    $this->usarScript('plugins/bootstrap/js/bootstrap.util.form.js');
    echo '<!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
              <![endif]--> ';
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
    //$styleTag = '<style type="text/css">@import "%s%s"</style>';
    $styleTag = "<link href='%s%s' rel='stylesheet' type='text/css'>";
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

    $vetor = new Util\TVetor(get_class_methods($classe));

    $possivelAcao = @str_replace('_', '', $this->variaveisDaURL[1]);

    if (count(@$vetor->Procurar($possivelAcao)) > 0)
      $this->acao = $acao = $possivelAcao;

    ob_start();

    $objeto = new $classe;

    $objeto->$acao();

    $requisicao = ob_get_contents();

    ob_end_clean();

    return $requisicao;
  }

}

?>
