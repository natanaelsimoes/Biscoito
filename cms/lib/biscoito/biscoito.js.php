<?php global $_Biscoito; ?>

<script type="text/javascript">
  /**
   * Principal classe JavaScript do CMS Biscoito
   * @class TBiscoitoJS
   */
  function TBiscoitoJS() {

    var self = this;

    var abrindoPopup = false;

    /**
     * Objeto para tratamento de erros ocorridos na execucao de qualquer
     * funcao desta classe
     * @private
     * @type TBiscoitoJSErros
     */
    var biscoitoJSErros = new TBiscoitoJSErros();

    /**
     * Realiza montagem de uma URL baseado no modulo/submodulo/acao requisitados
     * @param string moduloAcao: Referencia modulos, submodulos e acao no Biscoito
     * @return string URL montada
     * @example MontarURLAcao('noticia/listar');
     */
    this.MontarURLAcao = function(moduloAcao, template) {
      return sprintf('%s%s/%s', self.getSite(),moduloAcao,(template)?'':'?ajax');
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
      return '<?php echo str_replace('\\', '\\\\', $_Biscoito->getNamespace()); ?>';
    }

    /**
     * @return URL principal do site (sem variaveis e modulos)
     */
    this.getSite = function() {
      return '<?php echo $_Biscoito->getSite(); ?>';
    }


    this.AbrirPopupEstatico = function(nomePopup, conteudo) {

      var divPopup, PopupAnterior, idPopup;

      try {

        abrindoPopup = true;

        PopupAnterior = $('.modal.in').attr('id');

        if(PopupAnterior != null)
          self.FecharPopup(PopupAnterior, abrindoPopup);

        else $('body').append('<div class="modal-backdrop fade in"></div>');

        divPopup = sprintf('<div class="modal fade hide" id="%s"><div class="hide idPopupAnterior">%s</div></div>', nomePopup, PopupAnterior);

        idPopup = sprintf('#%s', nomePopup);

        $(idPopup).remove();

        $('body').append(divPopup);

        $(idPopup).append(conteudo);

        $(idPopup).modal({

          backdrop: false,

          keyboard: false,

          show: true

        });

        $(idPopup).on('hidden', function () {

          VoltarPopup($(this).attr('id'));

        });

      }
      catch(erro) {

        biscoitoJSErros.TratarErro(erro);

        return false;

      }

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
     * @example _Biscoito.AbrirPopupDinamico('FrmNoticia',500,'noticias/editar','id=1','POST');
     */
    this.AbrirPopupDinamico = function(nomePopup, moduloAcao, dados, tipoEncapsulamento) {

      try {

        if(moduloAcao == null) throw 2;

        tipoEncapsulamento = (tipoEncapsulamento == null) ? 'POST' : tipoEncapsulamento;

        $.ajax({

          async: false,

          type: tipoEncapsulamento,

          url: self.MontarURLAcao(moduloAcao, false),

          data: dados,

          success: function(retorno) {

            self.AbrirPopupEstatico(nomePopup, retorno);

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

      var retorno;

      try {

        if(moduloAcao == null) throw 1;

        retornar = (retornar == null) ? false : retornar;

        assincrono = (assincrono == null) ? false : assincrono;

        tipoEncapsulamento = (tipoEncapsulamento == null) ? 'POST' : tipoEncapsulamento;

        $.ajax({

          async: assincrono,

          type: tipoEncapsulamento,

          url: self.MontarURLAcao(moduloAcao, false),

          data: dados,

          success: function(retornoExecucao) {
            retorno = retornoExecucao
          }

        });

        if (retornar) return retorno;

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
    this.FecharPopup = function(nomePopup, estaAbrindoPopup) {

      var idPopup, PopupAnterior, idPopupAnterior;

      abrindoPopup = (estaAbrindoPopup != null) ? estaAbrindoPopup : false;

      nomePopup = (nomePopup == null) ? $('.modal.in').attr('id') : nomePopup;

      idPopup = sprintf('#%s', nomePopup);

      $(idPopup).modal('hide');

    }

    this.FecharTodasPopups = function() {

      $('.modal').remove();

      $('.modal-backdrop').remove();

    }

    this.IrParaPopup = function(nomePopup) {

      self.FecharPopup(null, true);

      setTimeout(function(){

        abrindoPopup = false

        var idPopup = sprintf('#%s', nomePopup);

        $(idPopup).modal('show');

      },700);

    }

    var VoltarPopup = function(PopupAtual) {

      if (!abrindoPopup) {

        var idPopupAtual, PopupAnterior, idPopupAnterior;

        idPopupAtual = sprintf('#%s', PopupAtual);

        PopupAnterior = $(idPopupAtual).children('.idPopupAnterior').html();

        idPopupAnterior = sprintf('#%s', PopupAnterior);

        if(PopupAnterior != 'undefined')
          $(idPopupAnterior).modal('show');

        else if($('.modal.in').attr('id') == null)
          $('.modal-backdrop').remove();

      }else abrindoPopup = false;

    }

    /**
     * Redireciona o navegador para um modulo/submodulo/acao especificos
     * @param string moduloAcao: Referencia modulos, submodulos e acao no Biscoito
     * @example _Biscoito.IrPara('administrador');
     */
    this.IrPara = function(moduloAcao) {

      try {

        if(moduloAcao == null) throw 3;

        location.href = self.MontarURLAcao(moduloAcao, true);

      }
      catch(erro) {

        biscoitoJSErros.TratarErro(erro);

        return false;

      }

    }

    this.Validar = function(restricoes, DOM, mensagem) {

      var bsUtilForm = new BootstrapUtilForm();

      bsUtilForm.mudarEstado(DOM, 'normal');

      if(restricoes) {

        bsUtilForm.mudarEstado(DOM, 'error', mensagem);

        $(DOM).focus();

        return false;

      }

      return true;

    }

    this.AbrirAguarde = function(msg) {

      self.AbrirPopupEstatico('aguarde-box', '<h1 class="align-center">Aguarde<h1><h3 class="align-center">...</h3><h3 class="align-center">'+msg+'</h3>');

    }

    this.FecharAguarde = function() {

      self.FecharPopup('aguarde-box');

    }

    this.MASCARA_CEP = function(id) {
      $(id).bind('keyup', function(e) {
        var v = $(this).val()
        v=v.replace(/D/g,"")
        v=v.replace(/^(\d{5})(\d)/,"$1-$2")
        $(this).val(v)
      });
    }

    this.MASCARA_CNPJ= function(id) {
      $(id).bind('keyup', function(e) {
        var v = $(this).val()
        v=v.replace(/\D/g,"")
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
        v=v.replace(/(\d{4})(\d)/,"$1-$2")
        $(this).val(v)
      });
    }

    this.MASCARA_CPF = function(id) {
      $(id).bind('keyup', function(e) {
        var v = $(this).val()
        v=v.replace(/\D/g,"")
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
        $(this).val(v)
      });
    }

    this.MASCARA_Data = function(id) {
      $(id).bind('keyup', function(e) {
        var v = $(this).val()
        v=v.replace(/\D/g,"")
        v=v.replace(/(\d{2})(\d)/,"$1/$2")
        v=v.replace(/(\d{2})(\d)/,"$1/$2")
        $(this).val(v)
      });
    }

    this.MASCARA_Hora = function(id) {
      $(id).bind('keyup', function(e) {
        var v = $(this).val()
        v=v.replace(/\D/g,"")
        v=v.replace(/(\d{2})(\d)/,"$1:$2")
        $(this).val(v)
      });
    }

    this.MASCARA_Moeda = function(id) {
      $(id).bind('keypress', function(e){
        var objTextBox = this;
        var SeparadorMilesimo = '.';
        var SeparadorDecimal = ',';
        var i = j = len = len2 = 0;
        var strCheck = '0123456789';
        var key, aux = aux2 = '';
        var whichCode = (window.Event) ? e.which : e.keyCode;
        if (whichCode == 13) return true;
        key = String.fromCharCode(whichCode); // Valor para o código da Chave
        //if (strCheck.indexOf(key) == -1) return false; // Chave inválida
        len = objTextBox.value.length;
        for(i = 0; i < len; i++)
          if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
        aux = '';
        for(; i < len; i++)
          if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
        if (strCheck.indexOf(key) != -1) // inclui aqui
          aux += key;
        len = aux.length;
        if (len == 0) objTextBox.value = '';
        if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
        if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
        if (len > 2) {
          aux2 = '';
          for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
              aux2 += SeparadorMilesimo;
              j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
          }
          objTextBox.value = '';
          len2 = aux2.length;
          for (i = len2 - 1; i >= 0; i--)
            objTextBox.value += aux2.charAt(i);
          objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
        }
        return false;
      });
      $(id).keypress();
    }

    this.MASCARA_Telefone = function(id) {
      $(id).bind('keyup', function(e) {
        var v = $(this).val()
        v=v.replace(/\D/g,"")
        v=v.replace(/^(\d\d)(\d)/g,"($1) $2")
        v=v.replace(/(\d{4})(\d)/,"$1-$2")
        $(this).val(v)
      });
    }

    this.MASCARA_URL = function(id) {
      $(id).bind('keyup', function(e) {
        var v = $(this).val()
        v=v.replace(/^http:\/\/?/,"")
        dominio=v
        caminho=''
        if(v.indexOf('/')>-1)
          dominio=v.split("/")[0]
        caminho=v.replace(/[^\/]*/,'')
        dominio=dominio.replace(/[^\w\.\+-:@]/g,'')
        caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,'')
        caminho=caminho.replace(/([\?&])=/,"$1")
        if(caminho!="")dominio=dominio.replace(/\.+$/,'')
        v="http://"+dominio+caminho
        $(this).val(v)
      });
    }

  }

  var _Biscoito = new TBiscoitoJS();
</script>