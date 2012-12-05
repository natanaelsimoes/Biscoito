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
        
        this.DOMSenhaAtual = '#textSenhaAtual';
        
        this.getSenhaAtual = function() { return $(self.DOMSenha).val() }
        
        this.DOMSenha = '#textSenha';
    
        this.getSenha = function() { return $(self.DOMSenha).val() }
        
        this.DOMConfSenha = '#textConfSenha';
    
        this.getConfSenha = function() { return $(self.DOMConfSenha).val() }

    }        
    
    function TUsuarioJSForm() {
                
        $(document).ready(function() {
            
            $('#selectTipoUsuario_id').change(function() {
                usuarioJSForm.selectTipoUsuario_Change(this);
            });

            <?php if($GLOBALS['_UsuarioLogado']->getFlag() == 'ADMINISTRADOR') : ?>            
            
            if($('#selectLoja_id').val() > 0) {
                $('#selectTipoUsuario_id').attr('disabled','disabled').change();
                $('#selectLoja_id').attr('disabled','disabled');
            }
            
            var acao = '<?php echo $GLOBALS['_Biscoito']->getVariaveisDaURL(1); ?>';
            
            var idLoja = '<?php echo $GLOBALS['_Biscoito']->getVariaveisDaURL(2); ?>';
           
            if (acao == 'adicionar' && idLoja > 0) {
                
                $('#selectTipoUsuario_id')
                .val($('#selectTipoUsuario_id').children('option[flag="LOCAL"]').val())
                .attr('disabled','disabled')
                .change();
               
                $('#selectLoja_id')
                .val(idLoja)
                .attr('disabled','disabled');                                
               
            }
            
            <?php endif; ?>
            
        });                        
        
        this.selectTipoUsuario_Change = function(select) {
            
            if ($(select).children('option[selected="selected"]').attr('flag') != 'ADMINISTRADOR') {
                
                $('#controlLoja_id').removeClass('hidden');                                                            
            
            }
            
            else {
                
                $('#controlLoja_id').addClass('hidden');
                
                $('#selectLoja_id').val('');
                
            }
            
        }
        
        this.btnSalvar_Click = function() {                    
        
            if(Validar(new TUsuario())) {   
                
                $('#selectTipoUsuario_id').removeAttr('disabled');
                
                $('#selectLoja_id').removeAttr('disabled');
                
                var msg = _Biscoito.ExecutarAcao('usuario/salvar', $('#FrmEdicao').serialize(), true);
                
                if (msg != '') alert(msg);
                
                else {                                        
                    
                    var bsUtilForm = new BootstrapUtilForm();  
                
                    bsUtilForm.alert('Usuário salvo com sucesso!', function(){
                        _Biscoito.IrPara('administrador/usuario/gerenciar');
                    });
                    
                }
                
            }
        
        }  
        
        this.btnAlterarSenha_Click = function() {
        
            if(ValidarSenha(new TUsuario())) {
                
                var bsUtilForm = new BootstrapUtilForm();
                
                var msg = _Biscoito.ExecutarAcao('usuario/alterar_senha', $('#FrmEdicaoSenha').serialize(), true);
            
                if (msg != '') bsUtilForm.alert(msg);
            
                else bsUtilForm.alert('Senha alterada com sucesso!', function() {
                    _Biscoito.IrPara('administrador/usuario/gerenciar');
                });
        
            }
            
        }
              
        this.btnReativar_Click = function() {
    
            var bsUtilForm = new BootstrapUtilForm();
            
            bsUtilForm.confirm('Deseja realmente reativar este usuário?', function() {
            
                _Biscoito.ExecutarAcao('usuario/reativar_usuario', $('#FrmEdicao').serialize(), false, false);
            
                bsUtilForm.alert('Usuário reativado com sucesso!', function(){
                    _Biscoito.IrPara('administrador/usuario/gerenciar');
                });
            
            }, function() { _Biscoito.FecharTodasPopups() }, false);
    
        }
        
        this.btnDesativar_Click = function() {
    
            var bsUtilForm = new BootstrapUtilForm();
            
            bsUtilForm.confirm('Deseja realmente desativar este usuário?', function() {
            
                _Biscoito.ExecutarAcao('usuario/desativar_usuario', $('#FrmEdicao').serialize(), false, false);
            
                bsUtilForm.alert('Usuário desativado com sucesso!', function(){
                    _Biscoito.IrPara('administrador/usuario/gerenciar');
                });
            
            }, function() { _Biscoito.FecharTodasPopups() }, false);
    
        }
        
        this.btnExcluir_Click = function() {
    
            var bsUtilForm = new BootstrapUtilForm();
            
            bsUtilForm.confirm('<div class="alert alert-error"><h4 class="alert-heading">ATENÇÃO</h4>Todas as coisas ligadas a este usuário serão apagadas!</div>Deseja realmente excluir este usuário?', function() {
            
                _Biscoito.ExecutarAcao('usuario/excluir', $('#FrmEdicao').serialize(), false, false);
            
                bsUtilForm.alert('Usuário excluído com sucesso!', function(){
                    _Biscoito.IrPara('administrador/usuario/gerenciar');
                });
            
            }, function() { _Biscoito.FecharTodasPopups() }, false);
    
        }
    
        var Validar = function(obj) {
            
            if (!_Biscoito.Validar((obj.getNome() == ''), obj.DOMNome, 'Insira um nome')) return false;
        
            if (!_Biscoito.Validar((obj.getSobrenome() == ''), obj.DOMSobrenome, 'Insira um sobrenome')) return false;
        
            if (!_Biscoito.Validar((obj.getUsuario() == ''), obj.DOMUsuario, 'Insira um nome de usuário')) return false;        
            
            return true;
        
        }
    
        var ValidarSenha = function(obj) {
        
            if(!_Biscoito.Validar((_Biscoito.ExecutarAcao('usuario/verificar_senha_atual', $('#FrmEdicaoSenha').serialize(), true, false) != 'true'), obj.DOMSenhaAtual, 'Senha atual não confere')) return false;
        
            if(!_Biscoito.Validar((obj.getSenha().trim() == ''), obj.DOMSenha, 'Insira uma senha')) return false;
          
            if(!_Biscoito.Validar((obj.getSenha().length < 6), obj.DOMSenha, 'Senha precisa de pelo menos 6 caracteres')) return false;
            
            if(!_Biscoito.Validar((obj.getSenha() != obj.getConfSenha()), obj.DOMConfSenha, 'Senha não confere')) return false;
          
            return true;               
        
        }
    
    }
    usuarioJSForm = new TUsuarioJSForm();
</script>