<script type="text/javascript">
    $(document).ready(function(){
        
        $('.logospot').click(AbrirPopupEnvio);
        
    });
    
    function AbrirPopupEnvio() {
        
        var posicao = $(this).attr('data-position');
        
        $('#FrmLogomarca #posicao').val(posicao);
        
        $('#posicaoTexto').html(posicao);                
        
        $('#ModalLogomarca').modal({show:true});
        
    }
    
    function btnSalvar_Click(obj) {
     
        $(obj).addClass('disabled');             
        
        $(obj).html('Enviando...');
        
        $('#FrmLogomarca').submit();
     
    }    
</script>