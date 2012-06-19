<?php
header('Content-Type: text/html; charset=iso-8859-1');

global $_Biscoito;

if (!empty($galerias)) :
    ?>

    <div class="galeria row">

        <? foreach ($galerias as $galeria) : ?>        

            <div class="album span4">

                <h4 class="album_titulo"><?php echo $galeria->getNome(); ?></h4>

                <div class="album_capa"><?php $_Biscoito->imagem($galeria->getCapa()->getCaminho(), $galeria->getNome()); ?></div>

                <div class="album_opcoes">

                    <p class="align-center">

                        <a href="<?php echo $_Biscoito->montarLink('administrador', 'galeria', 'editargaleria', $galeria->getId()); ?>" class="btn">
                            <i class="icon-camera"></i>
                            Editar
                        </a>

                        <a href="#" class="btn" onclick="galeriaJSForm.btnExcluir_Click(this)" data-object='<?php echo $galeria; ?>'>
                            <i class="icon-remove"></i>
                            Excluir
                        </a>

                    </p>

                </div>                                

            </div>               

        <?php endforeach; ?>

    </div>

<?php 
    echo $paginacao->MostrarPaginas();
else: ?>
    Não há galeria alguma cadastrada. Clique em <?php include('galeria.view.button.adicionar.php'); ?> para começar a usar!
<?php endif; ?>