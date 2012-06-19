<script type="text/javascript">
    function TCategoriaGaleria() {
        
        var self = this;        
        
        this.DOMId = '#FrmCategoriaGaleriaEdicao #idCategoriaGaleria';                
        
        this.getId = function() { return $(self.DOMId).val(); }
        
        this.setId = function(value) { $(self.DOMId).val(value); }
        
        this.DOMNome = '#FrmCategoriaGaleriaEdicao #textNome';
        
        this.getNome = function() { return $(self.DOMNome).val() }
        
        this.setNome = function(value) { $(self.DOMNome).val(value); }
        
    }
    
    function TCategoriaGaleriaJSForm() {

        this.btnAdicionar_Click = function() {
            
            _Biscoito.AbrirPopupDinamico('FrmCategoriaGaleria', 'galeria/categoriagaleria/exibir_formulario_adicionar'); 
            
            var categoria = new TCategoriaGaleria();                
            
            $(categoria.DOMNome).focus();
            
        }
        
        this.btnEditar_Click = function() {
            
            if ($('#selectCategoriaGaleria').val() != '') {
                                
                _Biscoito.AbrirPopupDinamico('FrmCategoriaGaleria', 'galeria/categoriagaleria/exibir_formulario_alterar', $('.FrmGaleriaForm').serialize());
                
                var categoria = new TCategoriaGaleria();                
            
                $(categoria.DOMNome).focus();
                
            }
            
            else {
                
                var bsUtilForm = new BootstrapUtilForm();

                bsUtilForm.mudarEstado('#selectCategoriaGaleria', 'warning', 'Você não selecionou uma categoria para editar');

            }
            
        }
        
        this.btnSalvar_Click = function() {                    
        
            if(Validar(new TCategoriaGaleria())) {                                                                
                
                var msg = _Biscoito.ExecutarAcao('galeria/categoriagaleria/salvar', $('.FrmCategoriaGaleriaForm').serialize(), true);
                
                if (msg != '') alert(msg);
                
                else {
                    
                    RecarregarCategorias();
                    
                    bsUtilForm = new BootstrapUtilForm();  
                
                    bsUtilForm.alert('Categoria salva com sucesso!', 'FrmGaleria');
                    
                }
                
            }
        
        }                
        
        this.btnExcluir_Click = function() {
            
            if($('#selectCategoriaGaleria').val() != '') {
                
                var bsUtilForm = new BootstrapUtilForm();                
                
                bsUtilForm.confirm('Deseja realmente excluir a categoria selecionada?', function(){
                    
                    _Biscoito.ExecutarAcao('galeria/categoriagaleria/excluir', $('#selectCategoriaGaleria').serialize(), true);
        
                    RecarregarCategorias(); 
                    
                    bsUtilForm.alert('Categoria excluída com sucesso!', 'FrmGaleria');
                    
                }, _Biscoito.FecharPopup, false);  
                                
            }
            else {
                
                var bsUtilForm = new BootstrapUtilForm();
                
                bsUtilForm.mudarEstado('#selectCategoriaGaleria', 'warning', 'Você não selecionou uma categoria para deletar');
                
            }
            
        }
    
        var RecarregarCategorias = function() {
    
            var categorias = _Biscoito.ExecutarAcao('galeria/categoriagaleria/exibir_selecao_categorias', null, true);
                
            $('div.selectCategoriaGaleria').html(categorias);                            
    
        }
    
        var Validar = function(categoria) {
        
            if(categoria.getNome() == '') {                         
                
                var bsUtilForm = new BootstrapUtilForm();

                bsUtilForm.mudarEstado(categoria.DOMNome, 'warning', 'Insira um nome na categoria');
         
                $(categoria.DOMNome).focus();
            
                return false;
         
            }
        
            else return true;
        
        }
    
    }
    
    categoriaGaleriaJSForm = new TCategoriaGaleriaJSForm();
</script>