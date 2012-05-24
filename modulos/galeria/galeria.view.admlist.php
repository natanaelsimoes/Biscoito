<?php

 namespace Biscoito\Modulos\Galeria\View; ?>

<?php foreach ($galerias as $galeria) { ?>
    <div class="galeria" id="galeria">

        <div class="album">

            <h4 class="album_titulo"><?php echo $galeria->getNome(); ?></h4>

            <div class="album_capa"><img src="<?php echo $galeria->capa->getCaminho(); ?>" /></div>

            <div class="album_opcoes">

                <div class="album_opcao esquerda icn_photo">
                    <a href="#" id="<?php echo $galeria->getId(); ?>">Editar</a>
                </div>

                <div class="album_opcao direita icn_trash">
                    <a href="#" id="<?php echo $galeria->getId(); ?>">Excluir</a>
                </div>

            </div>

        </div>

    </div>
<?php } ?>