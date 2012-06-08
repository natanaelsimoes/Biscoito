<?php

namespace Biscoito\Modulos\Galeria;

global $_Biscoito;
?>

<?php foreach ($galerias as $galeria) { ?>
    <div class="galeria" id="galeria">

        <div class="album">

            <h4 class="album_titulo"><?php echo $galeria->getNome(); ?></h4>

            <div class="album_capa"><img src="<?php echo $galeria->getCapa()->getCaminho(); ?>" /></div>

            <div class="album_opcoes">

                <p class="align-center">

                    <a href="<?php echo $_Biscoito->montarLink('administrador', 'galeria', 'editar', $galeria->getId()); ?>" class="btn">
                        <i class="icon-camera"></i>
                        Editar
                    </a>

                    <a href="#" class="btn">
                        <i class="icon-trash"></i>
                        Excluir
                    </a>
                    
                </p>
                
            </div>

        </div>

    </div>
<?php } ?>