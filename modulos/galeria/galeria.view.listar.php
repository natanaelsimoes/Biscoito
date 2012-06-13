<?php

header('Content-Type: text/html; charset=iso-8859-1');

global $_Biscoito;

if (!empty($galerias)) :

    foreach ($galerias as $galeria) :
        ?>
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

                        <a href="#" class="btn btn">
                            <i class="icon-trash"></i>
                            Excluir
                        </a>

                    </p>

                </div>

            </div>

        </div>
        <?php
    endforeach;
else:
    ?>
    Não há galeria alguma cadastrada. Clique em <?php include('galeria.view.button.adicionar.php'); ?> para começar a usar!
<?php endif; ?>