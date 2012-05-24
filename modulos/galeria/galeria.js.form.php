<script type="text/javascript">
    
    function ValidarGaleria() {
        
        nome = $('#textNome').val().trim();
        
        categoria = $('#selectCategoria').val();
        
        if(nome == '') {
            alert('Insira um nome para ser o título da Galeria.')
            $('#textNome').focus();
        }
        else if (categoria == '') {
            alert('A seleção de uma categoria é obrigatória. Se não houver uma em que sua nova Galeria se encaixe, você pode criar uma!')
            $('#selectCategoria').focus();
        }
        else
            GerenciarGaleria('adicionar', $('.FrmGaleria form').serialize());
        
    }
    
</script>