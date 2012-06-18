<?php $maxItensSecao = 10; ?>

<div class="row-fluid">

    <div class="metro span12">

        <div class="metro-sections">

            <div class="metro-section" id="section1">
            
            <?php if (($maxMenuList = count($menuList)) > $maxItensSecao) : ?>
            <a data-next="#section2" data-prior="#section1" href="#" class="next-section"></a>
            <?php endif; ?>
                
            <h2>módulos</h2>
            
            <?php for ($i = 0, $section = 1, $maxMenuList = count($menuList), $menu = $menuList[0]; $i < $maxMenuList; $i++, @$menu = $menuList[$i]) : ?>    
            
                <?php if ($i & $i % $maxItensSecao == 0) : ?>
            
                <div class="metro-section" id="section<?php echo ++$section ?>">
                 
                <?php if (($maxMenuList = count($menuList)) > ($maxItensSecao * $section)) : ?>    
                <a data-next="#section<?php echo ($section + 1) ?>" data-prior="#section<?php echo $section ?>" href="#" class="next-section"></a>    
                <?php endif; ?>
                
                <h2>módulos</h2>   
                <?php endif; ?>    
                
                    <a class="tile tilesquareimage bg-color-white" href="<?php echo $GLOBALS['_Biscoito']->montarLink('administrador', $menu->getDiretorio()); ?>">                        
                        
                        <?php echo $menu->getIcone(); ?>
                        
                    </a>
                
                <?php if (($i+1) & (($i+1) % $maxItensSecao) == 0) : ?>
                </div>
            
                <?php endif; ?>
            
            <?php endfor; ?> 
            
            </div>    
                
        </div>

    </div>

</div>