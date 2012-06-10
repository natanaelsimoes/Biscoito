<script type="text/javascript">
    
    function adicionarGaleria() {
        
        nome = $('#textNome').val().trim();
        
        categoria = $('#selectCategoriaGaleria').val();
        
        if(nome == '') {
            alert('Insira um nome para ser o t�tulo da Galeria.')
            $('#textNome').focus();
        }
        else if (categoria == '') {
            alert('A sele��o de uma categoria � obrigat�ria. Se n�o houver uma em que sua nova Galeria se encaixe, voc� pode criar uma!')
            $('#selectCategoriaGaleria').focus();
        }
        else {
            var id = _Biscoito.ExecutarAcao('galeria/adicionar', $('.FrmGaleria form').serialize());
            var dados = sprintf('id=%s', id);
            _Biscoito.AbrirPopupDinamico('FrmGaleria', 700, 'galeria/exibir_formulario_adicionar_fotos', dados);
        }
        
    }
    
</script>