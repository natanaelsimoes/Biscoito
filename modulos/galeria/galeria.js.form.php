<script type="text/javascript">
    
    function adicionarGaleria() {
        
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
        else {
            var id = _Biscoito.ExecutarAcao('galeria/adicionar', $('.FrmGaleria form').serialize());
            var dados = sprintf('id=%s', id);
            _Biscoito.AbrirPopup('FrmGaleria', 700, 'galeria/exibir_formulario_adicionar_fotos', dados);
        }
        
    }
    
</script>