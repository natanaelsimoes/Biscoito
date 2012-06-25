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

                            <a href="#" class="btn btn-mini" onclick="galeriaJSForm.btnExcluirFoto_Click(this)" data-object='<?php echo $foto; ?>'>
                                <i class="icon-remove"></i>
                                Excluir
                            </a>

                        </p>

                    </div>

                </div>               

                <textarea name="descricao" class="xlarge fotoDescricao"><?php echo $foto->getDescricao() ?></textarea>

                <input type="checkbox" name="capa" class="fotoCapa" <?php if($galeria->getCapa_id() == $foto->getId()) echo 'checked="checked"' ?>><span> Capa</span>
                
                <a class="btn btn-mini disabled" onclick="galeriaJSForm.btnSalvarFoto_Click(this)" data-object="<?php echo $foto ?>" href="#">salvar alterações</a>

            </div>               

        <?php endforeach; ?>

    </div>

    <?php
    echo $paginacao->MostrarPaginas();
endif;
?>