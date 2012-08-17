<script type="text/javascript">
    function TUsuario() {
        
        var self = this;        
        
        this.DOMId = '#id';                
        
        this.getId = function() { return $(self.DOMId).val(); }                
        
        this.DOMNome = '#textNome';
        
        this.getNome = function() { return $(self.DOMNome).val() }                
        
        this.DOMNomeMeio = '#textNomeMeio';
        
        this.getNomeMeio = function() { return $(self.DOMNomeMeio).val() }                
        
        this.DOMSobrenome = '#textSobrenome';
        
        this.getSobrenome = function() { return $(self.DOMSobrenome).val() } 
    
        this.DOMTipoUsuario = '#selectTipoUsuario';
        
        this.getTipoUsuario = function() { return $(self.DOMTipoUsuario).val() }
        
        this.DOMUsuario = '#textUsuario';
        
        this.getUsuario = function() { return $(self.DOMUsuario).val() }
        
        this.DOMSenha = '#textSenha';
        
        this.getSenha = function() { return $(self.DOMSenha).val() }

    }        
    
    function TUsuarioJSForm() {
        
        this.btnSalvar_Click = function() {                    
        
            if(Validar(new TUsuario())) {                                                                
                
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
            
        if (!_Biscoito.Validar((obj.getNome() == ''), obj.DOMNome, 'Insira um nome')) return false;
        
        if (!_Biscoito.Validar((obj.getSobrenome() == ''), obj.DOMSobrenome, 'Insira um sobrenome')) return false;
        
        if (!_Biscoito.Validar((obj.getUsuario() == ''), obj.DOMUsuario, 'Insira um nome de usuário')) return false;

        if (!_Biscoito.Validar((obj.getSenha() == ''), obj.DOMSenha, 'Insira uma senha')) return false;
        
        if (!_Biscoito.Validar((obj.getSenha().length < 6), obj.DOMSenha, 'Senha de ter no mínimo 6 caracteres')) return false;
            
        return true;
        
    }
    
}
usuarioJSForm = new TUsuarioJSForm();
</script>