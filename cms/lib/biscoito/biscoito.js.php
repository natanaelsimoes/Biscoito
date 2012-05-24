<?php global $_Biscoito; ?>

<script type="text/javascript">
    /**
     * Principal classe JavaScript do CMS Biscoito
     * @class TBiscoitoJS     
     */
    function TBiscoitoJS() {
        
        var self = this;
        
        /**
         * Objeto para tratamento de erros ocorridos na execucao de qualquer 
         * funcao desta classe
         * @private
         * @type TBiscoitoJSErros
         */
        var biscoitoJSErros = new TBiscoitoJSErros();
        
        /**
         * Realiza montagem de uma URL baseado no modulo/submodulo/acao requisitados
         * @private
         * @param string moduloAcao: Referencia modulos, submodulos e acao no Biscoito
         * @return string URL montada
         * @example MontarURLAcao('noticia/listar');
         */
        var MontarURLAcao = function(moduloAcao) {            
            return sprintf('%s%s/', self.getSite(),moduloAcao);         
        }
        
        /**
         * @return Acao princial executada pelo Biscoito
         */
        this.getAcao = function() {
            return '<?php echo $_Biscoito->getAcao(); ?>';
        }
        
        /**
         * @return Modulo principal executado pelo Biscoito
         */
        this.getModulo = function() {
            return '<?php echo $_Biscoito->getModulo(); ?>';
        }
        
        /**
         * @return Modulo auxiliar do modulo principal executado pelo Biscoito
         */
        this.getModuloAuxiliar = function() {
            return '<?php echo $_Biscoito->getModuloAuxiliar(); ?>';
        }
        
        /**
         * @return Namespace do modulo principal executado pelo Biscoito
         */
        this.getNamespace = function() {
            return '<?php echo $_Biscoito->getNamespace(); ?>';
        }
        
        /**
         * @return URL principal do site (sem variaveis e modulos)
         */
        this.getSite = function() {
            return '<?php echo $_Biscoito->getSite(); ?>';
        }
        
        /**
         * Abre uma janela popup sobre o conte�do exibido mantando o foco sobre si 
         * bloqueando o conteudo exibido antes de sua abertura
         * @param string nomePopup: Nome da janela que sera criada
         * @param integer larguraPopup: Largura em pixel da caixa popup
         * @param string moduloAcao: Referencia modulos, submodulos e acao no Biscoito
         * @param string dados: Variaveis e valores ordenados no formato de URL 
         * que serao passados como parametro para o modulo/submodulo requisitado
         * @param string tipoEncapsulamento: Define o tipo de encapsulmento dos dados: GET ou POST(padrao, se nulo)
         * @example _Biscoito.AbrirPopup('FrmNoticia',500,'noticias/editar','id=1','POST');
         */
        this.AbrirPopup = function(nomePopup, larguraPopup, moduloAcao, dados, tipoEncapsulamento) {
        
            var divPopup, classePopup;
        
            try {
                
                divPopup = sprintf('<div class="%s"></div>', nomePopup);
                
                classePopup = sprintf('.%s', nomePopup);
                
                if(moduloAcao == null) throw 2;
                
                tipoEncapsulamento = (tipoEncapsulamento == null) ? 'POST' : tipoEncapsulamento;
            
                $.ajax({
                    
                    async: assincrono,
                    
                    type: tipoEncapsulamento,
                    
                    url: MontarURLAcao(moduloAcao),
                    
                    data: dados,
                    
                    success: function(retorno) {
                        
                        $(classePopup).remove();
                        
                        $('body').append(divPopup);
                        
                        $(classePopup).html(retorno);
                        
                        $(classePopup).dialog({
                            
                            autoOpen:false,
                            
                            draggable: false,
                            
                            modal:true,
                            
                            resizable:false,
                            
                            width: larguraPopup
                            
                        });
                        
                        $(classePopup).dialog('open');
                        
                    }
            
                });
                
            }
            catch(erro) {
            
                biscoitoJSErros.TratarErro(erro);
                
                return false;
                
            }
        
        }
        
        
        /**
         * Atraves de uma requisicao HTTP, o servidor executa a funcao parametrizada
         * @param string moduloAcao: Referencia modulos, submodulos e acao no Biscoito
         * @param string dados: Variaveis e valores ordenados no formato de URL 
         * @param bool retornar: Define se a funcao deve retornar o resultado da acao. Por padrao a funcao nao retornara qualquer resultado.
         * @param bool assincrono Define se a execucao da acao de ser assincrona. Por padrao a funcao e sincrona.
         * @param string tipoEncapsulamento: Define o tipo de encapsulmento dos dados: GET ou POST(padrao, se nulo)
         * @example _Biscoito.ExecutarAcao('noticias/deletar','id=1',true,'POST');
         */
        this.ExecutarAcao = function(moduloAcao, dados, retornar, assincrono, tipoEncapsulamento) {
            
            try {
                
                if(moduloAcao == null) throw 1;
            
                retornar = (retornar == null) ? false : retornar;
                
                assincrono = (assincrono == null) ? false : assincrono;
                
                tipoEncapsulamento = (tipoEncapsulamento == null) ? 'POST' : tipoEncapsulamento;
            
                $.ajax({
                    
                    async: assincrono,
                    
                    type: tipoEncapsulamento,
                    
                    url: MontarURLAcao(moduloAcao),
                    
                    data: dados,
                    
                    success: function(retorno) {
                        if (retornar) return retorno;
                    }
            
                });
                
            }
            catch(erro) {
            
                biscoitoJSErros.TratarErro(erro);
            
                return false;
                
            }
            
        }
        
        /**
         * Fecha uma janela popup
         * @param string nomePopup: Nome da janela que sera fechada
         * @example _Biscoito.FecharPopup('FrmNoticia');
         */
        this.FecharPopup = function(nomePopup) {
        
            var classePopup;
            
            classePopup = sprintf('.%s', nomePopup);
            
            $(classePopup).dialog('close');
            
        } 
        
        /**
         * Redireciona o navegador para um modulo/submodulo/acao especificos
         * @param string moduloAcao: Referencia modulos, submodulos e acao no Biscoito
         * @example _Biscoito.IrPara('administrador');
         */
        this.IrPara = function(moduloAcao) {
            
            try {
                
                if(moduloAcao == null) throw 3;
            
                location.href = MontarURLAcao(moduloAcao);
            
            }
            catch(erro) {
                
                biscoitoJSErros.TratarErro(erro);
                
                return false;
                
            }
            
        }
        
    }
    
    var _Biscoito = new TBiscoitoJS();
</script>