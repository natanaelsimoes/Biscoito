<script type="text/javascript">
    
    $(document).ready(function(){
        
        CarregarGalerias(0);
        
    });
    
    function CarregarGalerias(pagina) {
        
        $.ajax({
            url: '<?php echo $GLOBALS['_Biscoito']->getSite(); ?>galeria/carregar_galerias/',
            data: 'pagina='+pagina,
            type: 'POST',
            success: function(html) {
                $('.galerias').html(html);
                
            }
        });
        
    }
    
    function GerenciarGaleria(acao, formData) {
        
        //$('.FrmGaleria').dialog('option', 'disable', true);
        
        $.ajax({
            async: false,
            url: _Biscoito.getSite()+'galeria/'+acao+'/',
            data: formData,
            success: function(html) {
                $('.FrmGaleria').remove();
                $('body').append('<div class="FrmGaleria"></div>');
                $('.FrmGaleria').html(html);
                $('.FrmGaleria').dialog({
                    autoOpen:false,
                    draggable: false,
                    modal:true,
                    resizable:false,
                    width:700
                });
                $('.FrmGaleria').dialog('open');
            }
        });
        
    }
</script>