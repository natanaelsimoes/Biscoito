<?php

namespace Biscoito;

use Biscoito\Lib;
use Biscoito\Lib\Database as Database;
use Biscoito\Lib\Objeto as Objeto;
use Biscoito\Lib\Util;

session_start();

require 'cms/lib/biscoito/biscoito.class.php';
require 'cms/lib/biscoito/biscoitoconfig.class.php';
require 'cms/lib/biscoito/biscoitorouter.class.php';
require 'cms/lib/database/database.class.php';
require 'cms/lib/database/database.util.php';
require 'cms/lib/database/objeto.class.php';
require 'cms/lib/util/autoload.function.php';

/**
 * Instancia global do objeto de configuracao de toda a Framework
 * @global Biscoito\Lib\TBiscoitoConfig $_BiscoitoConfig
 */
global $_BiscoitoConfig;

$_BiscoitoConfig = Lib\TBiscoitoConfig::singleton();

/**
 * Instancia global do objeto principal de gerenciamento de toda a Framework
 * @global Biscoito\Lib\TBiscoito $_Biscoito;
 */
global $_Biscoito;

$_Biscoito = Lib\TBiscoito::singleton();

$classeGateway = $_Biscoito->getClasseGateway();

$controleGateway = new $classeGateway;

$controleGateway->Rotear();

$nav = new Util\TNavegador;
?>