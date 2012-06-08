<?php

namespace Biscoito\Modulos\Administrador\Breadcrumbs;

global $AdminBreadcrumbs;
?>
<ul class="breadcrumb">
    <li>
        <a href="#" onclick="_Biscoito.IrPara('administrador')">Início</a> 
        <span class="divider">/</span>
    </li>
    <?php foreach ($AdminBreadcrumbs as $item): ?>
        <li class="<?php echo $item->getClasse(); ?>">
        <a href="<?php echo $item->getURL(); ?>" >
            <?php echo $item->getNome(); ?>
        </a>
        <?php if ($item->getClasse() != 'active'): ?>
            <span class="divider">/</span>
        <?php endif; ?>
        </li>    
    <?php endforeach; ?>    
</ul>