<script type="text/javascript">
    function TCategoria() {
        
        var nome;
        
        this.DOMNome = $('.FrmGaleria #textNome');
        
        this.getNome = function() { return this.nome; }
        
        this.setNome = function(value) { this.nome = value; }
        
    }
    
    function TCategoriaJSForm() {
        
        this.Adicionar = function(categoria) {
        
            if(Validar(categoria)) {
                
            }
        
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
</script>