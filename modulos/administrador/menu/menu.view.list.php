<div class="row-fluid">    
    <?php for ($i = 0, $maxMenuList = count($menuList), $menu = $menuList[0]; $i < $maxMenuList; $i++, @$menu = $menuList[$i]) : ?>    
        <?php if ($i & $i % 4 == 0) : ?>    
            <div class="row-fluid">
            <?php endif; ?>        
            <div class="span3">
                <a href="<?php echo $GLOBALS['_Biscoito']->montarLink('administrador', $menu->getDiretorio()); ?>">
                    <p style="text-align: center">
                        <img class="icone" src="<?php echo $menu->getIcone(); ?>" alt="<?php echo $menu->getNome(); ?>">
                    </p>                        
                    <p style="text-align: center"><?php echo $menu->getNome(); ?></p>
                </a>
            </div>        
            <?php if ($i & $i % 4 == 0) : ?>         
            </div>
        <?php endif; ?>
    <?php endfor; ?>
</div>