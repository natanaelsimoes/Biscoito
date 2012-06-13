<script type="text/javascript">
    function TGaleriaJS() {
       
        var self = this;        
        
        var formName = '.FrmGaleriaForm';
        
        this.getFormName = function() { return formName; }
        
        this.DOMId = sprintf('%s %s', formName, ' #idGaleria');                
        
        this.DOMNome = sprintf('%s %s', formName, '#textNome');
        
        this.DOMDescricao = sprintf('%s %s', formName, '#textDescricao');
        
        this.DOMFonte = sprintf('%s %s', formName, '#textFonte');
        
        this.DOMCategoria = sprintf('%s %s', formName, '#selectCategoriaGaleria');
        
        this.getId = function() { return $(self.DOMId).val(); }
        
        this.getNome = function() { return $(self.DOMNome).val() }
        
        this.getDescricao = function() { return $(self.DOMDescricao).val(); }
        
        this.getFonte = function() { return $(self.DOMFonte).val(); }                
        
        this.getCategoria = function() { return $(self.DOMCategoria).val(); }
        
        this.setId = function(value) { $(self.DOMId).val(value); }                                
        
        this.setNome = function(value) { $(self.DOMNome).val(value); }
        
        this.setDescricao = function(value) { $(self.DOMDescricao).val(value); }
                   
    }
    
    function TGaleriaJSForm() {
        
        var self = this;
        
        var galeria = new TGaleriaJS();
        
        $(document).ready(function(){
        
            self.CarregarGalerias(0);
        
        });                
        
        this.btnAdicionar_Click = function() {
                        
            _Biscoito.AbrirPopupDinamico('FrmGaleria', 'galeria/exibir_formulario_adicionar')
            
            $(galeria.DOMNome).focus();
            
        }
        
        this.btnSalvar_Click = function() {                    
        
            if(Validar(galeria)) {
                          
                galeria.setId(_Biscoito.ExecutarAcao('galeria/adicionar', $(galeria.getFormName()).serialize()));
            
                var dados = sprintf('id=%s', galeria.getId());
            
                _Biscoito.AbrirPopupDinamico('FrmGaleria', 'galeria/exibir_formulario_adicionar_fotos', dados); 
            
            }                    
        
        }
        
        var Validar = function(galeria) {                        
            
            var bsUtilForm = new BootstrapUtilForm();
        
            if(galeria.getNome() == '') {
                
                bsUtilForm.mudarEstado(galeria.DOMNome, 'warning', 'Insira um nome na galeria');
            
                $(galeria.DOMNome).focus();

                return false;
                
            }
            
            else if (galeria.getCategoria() == '') {
                
                bsUtilForm.mudarEstado(galeria.DOMCategoria, 'warning', 'A seleção de uma categoria é obrigatória. Se não houver uma em que sua nova Galeria se encaixe, você pode criar uma!')
                
                $(galeria.DOMCategoria).focus();
            
                return false;
                
            } 
            
            else return true;
            
        }

        this.CarregarGalerias = function(pagina) {
        
            var dados = 'pagina='+pagina;
        
            var galerias = _Biscoito.ExecutarAcao('galeria/carregar_galerias', dados, true, false);        
        
            $('.galerias').html(galerias);
        
        }

    }
    
    galeriaJSForm = new TGaleriaJSForm();          
        
</script>