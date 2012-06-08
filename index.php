<?php

namespace Biscoito;

use Biscoito\Lib;
use Biscoito\Lib\Database as Database;
use Biscoito\Lib\Objeto as Objeto;
use Biscoito\Lib\Util;

require 'cms/lib/biscoito/biscoito.class.php';
require 'cms/lib/biscoito/biscoitoconfig.class.php';
require 'cms/lib/database/database.class.php';
require 'cms/lib/database/database.util.php';
require 'cms/lib/database/objeto.class.php';
require 'cms/lib/util/autoload.function.php';

/**
 * Instancia global do objeto de configuracao de toda a Framework
 * @global Biscoito\Lib\TBiscoitoConfig $_BiscoitoConfig
 */
global $_BiscoitoConfig;

$_BiscoitoConfig = new Lib\TBiscoitoConfig;

/**
 * Instancia global do objeto principal de gerenciamento de toda a Framework
 * @global Biscoito\Lib\TBiscoito $_Biscoito 
 */
global $_Biscoito;

$_Biscoito = new Lib\TBiscoito;

$controleModulo = $_Biscoito->getClasseControle();

$controleAcao = $_Biscoito->getAcao();

try {
    $controleModuloObj = new $controleModulo;
} catch (\Exception $e) {
    echo "A classe {$controleModulo} não existe no pacote {$_Biscoito->getNamespace()}.";
}

try {
    $controleModuloObj->$controleAcao();
} catch (\Exception $e) {
    echo "<p>A função {$controleAcao}() não existe na classe {$controleModulo} do pacote {$_Biscoito->getNamespace()}</p><br/>";
    echo $e->getMessage();
}

$nav = new Util\TNavegador;
?>