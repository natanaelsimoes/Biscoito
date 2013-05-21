<?php

namespace Biscoito;

use Biscoito\Lib;

require_once('lib/util/cache.class.php');

global $_Cache;

$_Cache = Lib\Util\Cache::getInstance();
$_Cache->getCache();

require 'lib/biscoito.class.php';
require 'lib/biscoitoconfig.class.php';
require 'lib/biscoitorouter.class.php';
require 'lib/database/database.class.php';
require 'lib/database/database.util.php';
require 'lib/database/objeto.class.php';
require 'lib/util/autoload.function.php';

session_start();

/**
 * Instancia global do objeto de configuracao de toda a Framework
 * @var Biscoito\Lib\TBiscoitoConfig $_BiscoitoConfig
 */
global $_BiscoitoConfig;
/**
 * Instancia global do objeto principal de gerenciamento de toda a Framework
 * @var Biscoito\Lib\TBiscoito $_Biscoito;
 */
global $_Biscoito;
/**
 * Instancia global do objeto de usuário logado
 * @var Biscoito\Modulos\Usuario $_UsuarioLogado
 */
global $_UsuarioLogado;

$_BiscoitoConfig = Lib\TBiscoitoConfig::singleton();
$_Biscoito = Lib\TBiscoito::singleton();
if (array_key_exists('BISCOITO_SESSAO_USUARIO', $_SESSION) & !empty($_SESSION['BISCOITO_SESSAO_USUARIO']))
    $_UsuarioLogado = unserialize($_SESSION['BISCOITO_SESSAO_USUARIO']);
$classeGateway = $_Biscoito->getClasseGateway();
$controleGateway = new $classeGateway;
$controleGateway->Rotear();
?>