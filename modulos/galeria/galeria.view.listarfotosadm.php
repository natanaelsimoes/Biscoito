<?php
global $_Biscoito;

if (!empty($fotos)) :
    ?>

    <div class="galeria row">

        <? foreach ($fotos as $foto) : ?>        

            <div class="album span4 align-center">                

                <div class="album_capa">

                    <?php $_Biscoito->imagem($foto->getCaminho(), $galeria->getNome()); ?>

                    <div class="album_opcoes">

                        <p class="align-center">                       

                            <a href="#" class="btn btn-mini btnExcluirFoto" onclick="galeriaJSForm.btnExcluirFoto_Click(this)" data-object='<?php echo $foto; ?>'>
                                <i class="icon-remove"></i>
                                Excluir
                            </a>

                        </p>

                    </div>

                </div>               

                <form id="FrmFoto" method="post" action="">

                    <textarea name="descricao" class="xlarge fotoDescricao" onkeypress="galeriaJSForm.fotoDescricao_KeyPress(this)"><?php echo $foto->getDescricao() ?></textarea>

                    <input type="checkbox" name="capa" class="fotoCapa" value="S" <?php if ($galeria->getCapa_id() == $foto->getId()) echo 'checked="checked"' ?> onclick="galeriaJSForm.fotoCapa_Click(this)"><span> Capa</span>

                    <input type="hidden" name="objFoto" value='<?php echo $foto; ?>'>

                    <input type="hidden" name="foto_id" class="foto_id" value="<?php echo $foto->getId(); ?>">

                    <input type="hidden" name="galeria_id" class="galeria_id" value="<?php echo $galeria->getId(); ?>">

                    <a class="btn btn-mini btnSalvarAlteracoes disabled" onclick="galeriaJSForm.btnSalvarAlteracoes_Click(this)" data-object="<?php echo $foto ?>" href="#">salvar alterações</a>

                </form>

            </div>               

        <?php endforeach; ?>

    </div>

    <?php
    echo $paginacao->MostrarPaginas();
endif;
?>