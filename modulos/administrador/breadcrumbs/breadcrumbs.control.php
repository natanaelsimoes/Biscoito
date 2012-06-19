<?php

namespace Biscoito\Modulos\Administrador\Breadcrumbs;

use Biscoito\Lib\Util;

class TBreadcrumbsControl {

    public static function Exibir() {

        global $_Biscoito;

        global $AdminBreadcrumbs;

        $urlFormat = '%s%s/';

        $moduloAuxiliar = $_Biscoito->getModuloAuxiliar();

        if (!empty($moduloAuxiliar)) {

            $bcModuloAuxiliar = new TBreadcrumb;

            $bcModuloAuxiliar->setNome($_Biscoito->getNomeModuloAuxiliar());

            $bcModuloAuxiliar->setURL(sprintf($urlFormat, $_Biscoito->getSite(), $_Biscoito->getModuloAuxiliar()));

            $bcModuloAcao = new TBreadCrumb;

            $bcModuloAcao->setNome(Util\TTexto::PrimeiraLetraMaiuscula($_Biscoito->getAcao()));

            $bcModuloAcao->setClasse('active');

            $AdminBreadcrumbs = array($bcModuloAuxiliar, $bcModuloAcao);
            
            if($moduloAuxiliar == 'administrador')
                $AdminBreadcrumbs = array($bcModuloAcao);

            include('breadcrumbs.view.index.php');
        }
    }

}

?>
