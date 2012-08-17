function BootstrapUtilForm() {
    
    var self = this;      
    
    var confirmResult = false;
    
    this.getConfirmResult = function() {
        return confirmResult;
    }
    
    this.confirm = function(mensagem, onSim, onNao, fecharAoConfirmar) {                
        
        var content, modalheader, header, modalbody, message, modalfooter, simIcon, simButton, naoIcon, naoButton;
        
        var titulo = 'Confirmação';
        
        fecharAoConfirmar = (fecharAoConfirmar == null) ? true : fecharAoConfirmar;
        
        content = document.createElement('div');
        
        modalheader = document.createElement('div');
        
        $(modalheader).addClass('modal-header');
        
        header = document.createElement('h4');
        
        $(header).append(titulo);
        
        $(modalheader).append(header);
        
        modalbody = document.createElement('div');
        
        $(modalbody).addClass('modal-body');
        
        message = document.createElement('p');
        
        $(message).css('text-align', 'justify');
        
        $(message).append(mensagem);
        
        $(modalbody).append(message);
        
        modalfooter = document.createElement('div');
        
        $(modalfooter).addClass('modal-footer');
        
        $(modalfooter).css('text-align', 'center');
        
        simIcon = document.createElement('i');
        
        $(simIcon).addClass('icon-thumbs-up');
        
        simButton = document.createElement('button');                
        
        $(simButton).addClass('btn btn-success');                                       
        
        $(simButton).append(simIcon);
        
        $(simButton).append(' Sim');                
        
        $(simButton).click(function(){
            
            confirmResult = true;
            
            if(onSim != null)
                onSim();                        
            
            if (fecharAoConfirmar)
                _Biscoito.FecharPopup('ConfirmBS');
            
        });       
                    
        $(modalfooter).append(simButton);               
        
        naoIcon = document.createElement('i');               
        
        $(naoIcon).addClass('icon-thumbs-down');
        
        naoButton = document.createElement('button');
        
        $(naoButton).addClass('btn btn-danger');                                       
        
        $(naoButton).append(naoIcon);
        
        $(naoButton).append(' Não');
        
        $(naoButton).click(function(){
            
            confirmResult = false;
            
            if(onNao != null)
                onNao();                       
            
            if(fecharAoConfirmar)
                _Biscoito.FecharPopup('ConfirmBS');
            
        });                                                        
            
        $(modalfooter).append(naoButton);
        
        $(content).append(modalheader);
        
        $(content).append(modalbody);
        
        $(content).append(modalfooter);
        
        _Biscoito.AbrirPopupEstatico('ConfirmBS', content);
        
    }
    
    this.alert = function(mensagem, irParaPopup) {
        
        titulo = 'Mensagem do sistema';
        
        var content, modalheader, header, modalbody, message, modalfooter, okButton;
        
        content = document.createElement('div');
        
        modalheader = document.createElement('div');
        
        $(modalheader).addClass('modal-header');
        
        header = document.createElement('h4');
        
        $(header).append(titulo);
        
        $(modalheader).append(header);
        
        modalbody = document.createElement('div');
        
        $(modalbody).addClass('modal-body');
        
        message = document.createElement('p');
        
        $(message).css('text-align', 'justify');
        
        $(message).append(mensagem);
        
        $(modalbody).append(message);
        
        modalfooter = document.createElement('div');
        
        $(modalfooter).addClass('modal-footer');
        
        $(modalfooter).css('text-align', 'center');
        
        okButton = document.createElement('button');
        
        $(okButton).addClass('btn btn-primary');                
        
        if(irParaPopup == null)
            $(okButton).click(function() {
                _Biscoito.FecharPopup('AlertBS')
            }); 
            
        else if(irParaPopup == true) 
            $(okButton).click(function(){
                _Biscoito.FecharTodasPopups();
            });
    
        else if(is_string(irParaPopup))
            $(okButton).click(function() {
                _Biscoito.IrParaPopup(irParaPopup)
            });            
            
        else
            $(okButton).click(irParaPopup);
        
        $(okButton).append('OK');
            
        $(modalfooter).append(okButton);
        
        $(content).append(modalheader);
        
        $(content).append(modalbody);
        
        $(content).append(modalfooter);
        
        _Biscoito.AbrirPopupEstatico('AlertBS', content);
        
    }
    
    this.mudarEstado = function(elemento, estado, mensagem) {                
        
        var objElemento = $(elemento);
        
        var groupElemento = objElemento.parents('.control-group');                        
        
        switch (estado) {
            
            case 'normal':
                
                groupElemento.attr('class', 'control-group');        
                
                groupElemento.find('.help-inline').remove();
                
                break;
                
            case 'error':
            case 'success':
            case 'warning':
               
                var helpInline = document.createElement('span');
                
                helpInline = $(helpInline);
                
                helpInline.addClass('help-inline');
                
                helpInline.html(mensagem);
                
                objElemento.after(helpInline);
                
                groupElemento.addClass(estado);
                    
                break;                    
            
        }
        
    }    
    
}