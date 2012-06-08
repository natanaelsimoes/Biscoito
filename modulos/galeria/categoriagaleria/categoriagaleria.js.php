<script type="text/javascript">
    function TCategoriaGaleria() {
        
        var self = this;
        
        var id;
        
        var nome;
        
        this.DOMId = $('#idCategoriaGaleria');
        
        this.getId = function() { return self.DOMId.val(); }
        
        this.DOMNome = $('#nomeCategoriaGaleria');
        
        this.getNome = function() { return self.DOMNome.val() }
        
    }
    
    function TCategoriaGaleriaJSForm() {
        
        this.Salvar = function() {
        
            var categoria = new TCategoriaGaleria();
        
            if(Validar(categoria)) {
                
                var msg = _Biscoito.ExecutarAcao('galeria/categoriagaleria/salvar', $('.FrmCategoriaGaleria form').serialize(), true);
                
                if (msg != '') alert(msg);
                
                else RecarregarCategorias();
                
            }
        
        }                
        
        this.Excluir = function() {
            
            if($('#selectCategoriaGaleria').val() != '') 
                
            if(confirm('Deseja realmente excluir a categoria selecionada?')) {
                    
                _Biscoito.ExecutarAcao('galeria/categoriagaleria/excluir', $('.FrmGaleriaForm').serialize());
                    
                RecarregarCategorias();    
                    
            }
            
    }
    
    var RecarregarCategorias = function() {
    
        var categorias = _Biscoito.ExecutarAcao('galeria/categoriagaleria/exibir_selecao_categorias', null, true);
                
        $('div.selectCategoriaGaleria').html(categorias);
                
        _Biscoito.FecharPopup('FrmCategoriaGaleria');
    
    }
    
    var Validar = function(categoria) {
        
        if(categoria.getNome() == '') {
         
            alert('Insira um nome na categoria.');
         
            categoria.DOMNome.focus();
            
            return false;
         
        }
        
        else return true;
        
    }
    
}
    
categoriaGaleriaJSForm = new TCategoriaGaleriaJSForm();
</script>