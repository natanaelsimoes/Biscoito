<script type="text/javascript">
    function TTipoUsuario() {
        
        var self = this;        
        
        this.DOMId = '#id';                
        
        this.getId = function() { return $(self.DOMId).val(); }
        
        this.setId = function(value) { $(self.DOMId).val(value); }
        
        this.DOMNome = '#textNome';
        
        this.getNome = function() { return $(self.DOMNome).val() }
        
        this.setNome = function(value) { $(self.DOMNome).val(value); }
        
        this.DOMFlag = '#textFlag';
        
        this.getFlag = function() { return $(self.DOMFlag).val() }
        
        this.setFlag = function(value) { $(self.DOMFlag).val(value); }
        
    }
    
    function TTipoUsuarioJSForm() {
        
        this.btnSalvar_Click = function() {                    
        
            if(Validar(new TTipoUsuario())) {                                                                
                
                var msg = _Biscoito.ExecutarAcao('usuario/tipousuario/salvar', $('#FrmEdicao').serialize(), true);
                
                if (msg != '') alert(msg);
                
                else {                                        
                    
                    var bsUtilForm = new BootstrapUtilForm();  
                
                    bsUtilForm.alert('Categoria salva com sucesso!', function(){
                        _Biscoito.IrPara('administrador/usuario/tipousuario/gerenciar');
                    });
                    
                }
                
            }
        
        }                
        
        this.btnExcluir_Click = function(id, button) {
        
            var bsUtilForm = new BootstrapUtilForm();                
                
            usuariosDoTipo = _Biscoito.ExecutarAcao('usuario/tipousuario/getUsuariosDoTipo', 'ajax&id='+id, true, false);                        
                        
            if (usuariosDoTipo == 0) {               
                
                bsUtilForm.confirm('Deseja realmente excluir o tipo selecionado?', function(){
                    
                    _Biscoito.ExecutarAcao('usuario/tipousuario/excluir/'+id);                                        
                    
                    $(button).parent().parent().remove();
                    
                    bsUtilForm.alert('Categoria excluída com sucesso!', true);
                    
                });
    
            }
            
            else
            
            bsUtilForm.alert('Existem usuários cadastrados deste tipo. Enquanto houver algum usuário aqui será impossível excluir o tipo.');
            
        }
    
        var RecarregarCategorias = function() {
    
            var categorias = _Biscoito.ExecutarAcao('galeria/categoriagaleria/exibir_selecao_categorias', null, true);
                
            $('div.selectCategoriaGaleria').html(categorias);                            
    
        }
    
        var Validar = function(obj) {
            
            var bsUtilForm = new BootstrapUtilForm();
        
            if(obj.getNome() == '') {                                                         

                bsUtilForm.mudarEstado(obj.DOMNome, 'warning', 'Insira um nome');
         
                $(obj.DOMNome).focus();
            
                return false;
         
            }
            
            if(obj.getFlag() == '') {
            
                bsUtilForm.mudarEstado(obj.DOMFlag, 'warning', 'Insira um identificador flag');
         
                $(obj.DOMFlag).focus();
            
                return false;
            
            }
        
            else return true;
        
        }
    
    }
    
    tipoUsuarioJSForm = new TTipoUsuarioJSForm();
</script>