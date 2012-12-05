<script type="text/javascript">
  $(document).ready(function(){
    $('title').html($('title').html() + ' - ' + $('#pagina_nome').html());
    $('meta[name="description"]').attr('content', $('#pagina_descricao').html());
  });
</script>
<div class="row-fluid">
  <h1 id="pagina_nome"><?php echo $pagina->getNome(); ?></h1>
  <h2 id="pagina_descricao"><?php echo $pagina->getDescricao(); ?></h2>
  <div id="pagina_conteudo"><?php echo $pagina->getConteudo(); ?></div>
</div>