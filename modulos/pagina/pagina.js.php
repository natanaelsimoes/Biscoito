<script type="text/javascript">
  function TPagina() {

    var self = this;

    this.DOMId = '#id';

    this.getId = function() { return $(self.DOMId).val(); }

    this.DOMNome = '#textNome';

    this.getNome = function() { return $(self.DOMId).val(); }

    this.DOMConteudo = '#hConteudo';

    this.getConteudo = function() { return $(self.DOMConteudo).val(); }

  }

  function TPaginaJSForm() {

    var retirarAcento = function (objResp) {
      var varString = new String(objResp.value);
      var stringAcentos = new String('àâêôûãõáéíóúçüÀÂÊÔÛÃÕÁÉÍÓÚÇÜ');
      var stringSemAcento = new String('aaeouaoaeioucuAAEOUAOAEIOUCU');

      var i = new Number();
      var j = new Number();
      var cString = new String();
      var varRes = '';

      for (i = 0; i < varString.length; i++) {
        cString = varString.substring(i, i + 1);
        for (j = 0; j < stringAcentos.length; j++) {
          if (stringAcentos.substring(j, j + 1) == cString){
            cString = stringSemAcento.substring(j, j + 1);
          }
        }
        varRes += cString;
      }
      objResp.value = varRes;
    }

    this.onTextNome_Blur = function() {
      if ($('#textApelido').val() == '') {
        $('#textApelido').val(strtolower(str_replace(' ', '-',$('#textNome').val())));
        retirarAcento(document.getElementById('textApelido'));
      }
    }

    this.btnSalvar_Click = function() {

      $('#hConteudo').val(CKEDITOR.instances.textConteudo.getData());

      if(Validar(new TPagina())) {

        var msg = _Biscoito.ExecutarAcao('pagina/salvar', $('#FrmEdicao').serialize(), true);

        if (msg != '') alert(msg);

        else {

          var bsUtilForm = new BootstrapUtilForm();

          bsUtilForm.alert('Página salva com sucesso!', function(){
            _Biscoito.IrPara('administrador/pagina/gerenciar');
          });

        }

      }

    }

    this.btnExcluir_Click = function() {

      var bsUtilForm = new BootstrapUtilForm();

      bsUtilForm.confirm('Deseja realmente excluir esta página?', function() {

        _Biscoito.ExecutarAcao('pagina/excluir', $('#FrmEdicao').serialize(), false, false);

        bsUtilForm.alert('Página excluída com sucesso!', function(){
          _Biscoito.IrPara('administrador/pagina/gerenciar');
        });

      }, function() { _Biscoito.FecharTodasPopups() }, false);

    }

    var Validar = function(obj) {

      if (!_Biscoito.Validar((obj.getNome() == ''), obj.DOMNome, 'Insira um nome')) return false;

      if (!_Biscoito.Validar((obj.getConteudo() == ''), obj.DOMConteudo, 'Insira um conteúdo')) return false;

      return true;

    }

  }
  paginaJSForm = new TPaginaJSForm();
</script>