<script type="text/javascript">
    
    $(document).ready(function(){
        
        CarregarGalerias(0);
        
    });
    
    function CarregarGalerias(pagina) {
        
        var dados = 'pagina='+pagina;
        
        var galerias = _Biscoito.ExecutarAcao('galeria/carregar_galerias', dados, true, false);        
             
        $('.galerias').html(galerias);
        
    }
</script>