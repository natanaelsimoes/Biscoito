<?php

function __autoload($namespace) {

    global $_Biscoito;

    $arrClasses = explode('\\', $namespace);

    if ($arrClasses[1] != 'Lib') {

        $classe = array_pop($arrClasses);

        $configuracaoClasses = $_Biscoito->getConfiguracaoXML($arrClasses[2]);

        $caminhoModulo = $_Biscoito->getCaminhoModulo(array_slice($arrClasses, 2));

        $classeAtributos = $configuracaoClasses->classes->$classe;

        $arquivoClasse = $classeAtributos['arquivo'];

        require_once("modulos/{$caminhoModulo}{$arquivoClasse}");
    }
}

?>