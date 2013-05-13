<script type="text/javascript">
    function TGaleriaJS() {

        var self = this;

        var formName = '.FrmGaleriaForm';

        this.getFormName = function() {
            return formName;
        }

        this.DOMId = sprintf('%s %s', formName, ' #idGaleria');

        this.DOMNome = sprintf('%s %s', formName, '#textNome');

        this.DOMDescricao = sprintf('%s %s', formName, '#textDescricao');

        this.DOMFonte = sprintf('%s %s', formName, '#textFonte');

        this.DOMCategoria = sprintf('%s %s', formName, '#selectCategoriaGaleria');

        this.getId = function() {
            return $(self.DOMId).val();
        }

        this.getNome = function() {
            return $(self.DOMNome).val()
        }

        this.getDescricao = function() {
            return $(self.DOMDescricao).val();
        }

        this.getFonte = function() {
            return $(self.DOMFonte).val();
        }

        this.getCategoria = function() {
            return $(self.DOMCategoria).val();
        }

        this.setId = function(value) {
            $(self.DOMId).val(value);
        }

        this.setNome = function(value) {
            $(self.DOMNome).val(value);
        }

        this.setDescricao = function(value) {
            $(self.DOMDescricao).val(value);
        }

    }

    function TGaleriaJSForm() {

        var self = this;

        var galeria = new TGaleriaJS();

        var paginaAtual = 0;

        this.btnExcluir_Click = function(button) {

            var galeriaObj = $(button).attr('data-object');

            var bsUtilForm = new BootstrapUtilForm();

            bsUtilForm.confirm('Deseja realmente excluir a galeria selecionada?', function() {

                _Biscoito.ExecutarAcao('galeria/excluir_galeria_action', 'galeria=' + galeriaObj, true);

                self.CarregarGalerias(paginaAtual);

                bsUtilForm.alert('Categoria exclu�da com sucesso!', true);

            }, _Biscoito.FecharPopup, false);

        }

        this.btnSalvar_Click = function() {

            adicionandoGaleria = $('#adicionandoGaleria').val();

            if (Validar(galeria) || adicionandoGaleria == 'false') {

                _Biscoito.ExecutarAcao('galeria/adicionar_galeria_action', $(galeria.getFormName()).serialize(), true);

                bsUtilForm = new BootstrapUtilForm();

                if (adicionandoGaleria == 'false') {

                    bsUtilForm.alert('Galeria adicionada com sucesso!', function() {
                        _Biscoito.IrPara('administrador/galeria');
                    });

                }

                else {

                    galeria_id = $('#galeria_id').val();

                    bsUtilForm.alert('Novos fotos adicionadas com sucesso!', function() {
                        _Biscoito.IrPara('administrador/galeria/editarfotos/' + galeria_id);
                    });

                }

            }

        }

        var Validar = function(galeria) {

            var bsUtilForm = new BootstrapUtilForm();

            if (galeria.getNome() == '') {

                bsUtilForm.mudarEstado(galeria.DOMNome, 'warning', 'Insira um nome na galeria');

                $(galeria.DOMNome).focus();

                return false;

            }

            else if (galeria.getCategoria() == '') {

                bsUtilForm.mudarEstado(galeria.DOMCategoria, 'warning', 'A sele��o de uma categoria � obrigat�ria. Se n�o houver uma em que sua nova Galeria se encaixe, voc� pode criar uma!')

                $(galeria.DOMCategoria).focus();

                return false;

            }

            else
                return true;

        }

        this.CarregarGalerias = function(pagina) {
            $('.loading').show();
            $('.galeria').hide();
            $.ajax({
                url: _Biscoito.getSite() + 'galeria/carregar_galerias/',
                data: 'ajax=1&pagina=' + pagina,
                success: function(galerias) {
                    $('.galerias').html(galerias);
                    paginaAtual = pagina;
                    $('.pagination').addClass('pagination-centered');
                    $('.loading').hide();
                    $('.pagination a').click(function(e) {
                        if (!strpos('active|disabled', $(this).parent().attr('class')))
                            galeriaJSForm.CarregarGalerias($(this).attr('data-page'));
                        e.preventDefault();
                    });
                }
            });
        }

        this.CarregarFotos = function(galeria, pagina) {
            $('.loading').show();
            $('.galeria').hide();
            $.ajax({
                url: _Biscoito.getSite() + 'galeria/gerenciar_fotos/' + galeria + '/',
                data: 'ajax=1&pagina=' + pagina,
                success: function(fotos) {
                    $('.fotos').html(fotos);
                    paginaAtual = pagina;
                    $('.loading').hide();
                    $('.pagination').addClass('pagination-centered');
                    $('.pagination a').click(function(e) {
                        if (!strpos('active|disabled', $(this).parent().attr('class'))) {
                            location.href = '#';
                            galeriaJSForm.CarregarFotos(galeria, $(this).attr('data-page'));
                        }
                        e.preventDefault();
                    });
                }
            });
        }

        this.fotoDescricao_KeyPress = function(obj) {

            $(obj).parent().find('.btnSalvarAlteracoes').removeClass('disabled');

        }

        this.btnSalvarAlteracoes_Click = function(obj) {

            _Biscoito.ExecutarAcao('galeria/alterar_descricao_foto/', $(obj).parent().serialize());

            $(obj).parent().find('.btnSalvarAlteracoes').addClass('disabled');

            var bsUtil = new BootstrapUtilForm();

            bsUtil.alert('Descri��o alterada com sucesso!', true);

        }

        this.fotoCapa_Click = function(obj) {

            if ($(obj).attr('checked') == 'checked') {

                var bsUtil = new BootstrapUtilForm();

                bsUtil.confirm('Deseja trocar a capa atual da galeria por esta selecionada?'
                        , function() {

                    $('.fotoCapa').removeAttr('checked');

                    $(obj).attr('checked', 'checked');

                    galeria_id = $(obj).parent().find('.galeria_id').val();

                    _Biscoito.ExecutarAcao(sprintf('galeria/alterar_capa/%i/', galeria_id), $(obj).parent().serialize());

                    bsUtil.alert('Capa alterada com sucesso!', true);

                }, function() {

                    $(obj).removeAttr('checked');

                });

            }

        }

        this.btnExcluirFoto_Click = function(obj) {

            var bsUtil = new BootstrapUtilForm();

            var fotoForm;

            fotoForm = $(obj).parent().parent().parent().parent();

            if (fotoForm.find('.fotoCapa').attr('checked') != 'checked') {

                bsUtil.confirm('Deseja realmente excluir esta foto da galeria?', function() {

                    _Biscoito.ExecutarAcao('galeria/excluir_foto/', sprintf('objFoto=%s', $(obj).attr('data-object')));

                    self.CarregarFotos(fotoForm.find('.galeria_id').val(), paginaAtual);

                    bsUtil.alert('Foto exclu�da da galeria com sucesso!', true);

                });

            }

            else
                bsUtil.alert('N�o � poss�vel excluir a foto que � capa da galeria.<br>Selecione outra foto como capa se quiser excluir esta.', true);

        }

    }

    function TGaleriaJSAdicionarFotos() {

        var self = this;

        var dropbox, fotos, logo, capaSelecionada;

        this.indexFotoCanvas;

        this.canvasFotos;

        var create = function() {

            dropbox = document.getElementById("dropbox");

            fotos = document.getElementById("fotosGaleria");

            window.addEventListener("dragenter", dragenter, true);

            window.addEventListener("dragleave", dragleave, true);

            dropbox.addEventListener("dragover", dragover, false);

            dropbox.addEventListener("drop", drop, false);

            capaSelecionada = false;

            self.indexFotoCanvas = 0;

            logo = new Image();

            logo.src = '<?php echo $GLOBALS['_Biscoito']->getSite(); ?>modulos/galeria/fotos/logo_template.png';

        }

        window.addEventListener("load", create, true);

        var dragenter = function(e) {

            e.preventDefault();

            dropbox.setAttribute("dragenter", true);
        }

        var dragleave = function(e) {

            dropbox.removeAttribute("dragenter");

        }

        var dragover = function(e) {

            e.preventDefault();

        }

        var drop = function(e) {

            e.preventDefault();

            var dt = e.dataTransfer;

            var files = dt.files;

            dropbox.removeAttribute("dragenter");

            self.manipularImagens(files);

        }

        this.btnEnviarFotos_Click = function() {

            adicionandoGaleria = $('#adicionandoGaleria').val();

            if (capaSelecionada || adicionandoGaleria == 'true') {

                if (adicionandoGaleria == 'false') {

                    _Biscoito.AbrirPopupDinamico('FrmGaleria', 'galeria/adicionar_galeria');

                }

                else {

                    _Biscoito.AbrirPopupDinamico('FrmGaleria', 'galeria/adicionar_mais_fotos', 'galeria_id=' + $('#galeria_id').val());

                }

                self.enviarImagens();

            }

            else {

                bsUtilForm = new BootstrapUtilForm();

                bsUtilForm.alert('Voc� precisa selecionar uma foto como capa para continuar.');

            }

        }

        this.manipularImagens = function(files) {

            $('#btnEnviar').removeClass('hidden');

            for (var i = 0; i < files.length; i++) {

                var file = files[i];

                var imageType = /image.*/;

                if (!file.type.match(imageType))
                    continue;

                var img = document.createElement("img");

                img.file = file;

                var reader = new FileReader();

                reader.onloadend = (function(aImg) {

                    return function(e) {

                        aImg.src = e.target.result;

                        aImg.onload = function() {

                            canvastoscreen(imagetocanvas(this, 1024, 768));

                        };

                    };

                })(img);

                reader.readAsDataURL(file);

            }

        }

        var canvastoscreen = function(canvas) {

            divFotoInfo = document.createElement('div');

            $(divFotoInfo).addClass('fotoInfo');

            formFoto = document.createElement('form');

            inputDescricao = document.createElement('textarea');

            $(inputDescricao).addClass('xlarge fotoDescricao')
                    .attr('name', 'descricao')

            quebraLinha = document.createElement('br');

            checkBoxCapa = document.createElement('input');

            $(checkBoxCapa).addClass('fotoCapa')
                    .attr('type', 'checkbox')
                    .attr('name', 'capa')
                    .click(self.selecionarCapa);

            labelCapa = document.createElement('span');

            $(labelCapa).html(' Capa ');

            linkRemover = document.createElement('a');

            $(linkRemover)
                    .attr('href', '#')
                    .html('Remover')
                    .addClass('btn btn-mini');

            $(linkRemover).click(function() {

                galeriaJSAdicionarFotos.removerFoto(this);

            });

            $(formFoto).append(inputDescricao);

            $(formFoto).append(quebraLinha);

            $(formFoto).append(checkBoxCapa);

            $(formFoto).append(labelCapa);

            $(formFoto).append(linkRemover);

            $(divFotoInfo).append(canvas);

            $(divFotoInfo).append(formFoto);

            $(fotos).append(divFotoInfo);

        }

        var imagetocanvas = function(img, thumbwidth, thumbheight) {

            c = document.createElement('canvas');

            c.classList.add('fotoGaleria');

            cx = c.getContext('2d')

            c.width = thumbwidth;

            c.height = thumbheight;

            var dimensions = resize(img.width, img.height, thumbwidth, thumbheight);

            c.width = dimensions.w;

            c.height = dimensions.h;

            dimensions.x = 0;

            dimensions.y = 0;

            cx.drawImage(img, dimensions.x, dimensions.y, dimensions.w, dimensions.h);

            cx.globalAlpha = 0.9;

            cx.drawImage(logo, dimensions.x, dimensions.y);

            return c;

        }

        var resize = function(imagewidth, imageheight, thumbwidth, thumbheight) {

            var w = 0, h = 0, x = 0, y = 0,
                    widthratio = imagewidth / thumbwidth,
                    heightratio = imageheight / thumbheight,
                    maxratio = Math.max(widthratio, heightratio);

            if (maxratio > 1) {

                w = imagewidth / maxratio;

                h = imageheight / maxratio;

            }

            else {

                w = imagewidth;

                h = imageheight;

            }

            x = (thumbwidth - w) / 2;

            y = (thumbheight - h) / 2;

            return {w: w, h: h, x: x, y: y};

        }

        this.selecionarCapa = function() {

            $('.fotoCapa').attr('checked', false);

            capaSelecionada = true;

            $(this).attr('checked', true);

        }

        this.enviarImagens = function() {

            adicionandoGaleria = $('#adicionandoGaleria').val();

            self.canvasFotos = document.querySelectorAll(".fotoGaleria");

            if (self.indexFotoCanvas == self.canvasFotos.length) {

                $('#FrmGaleria #btnEnviando').addClass('hidden');

                $('#FrmGaleria #btnSalvar').removeClass('hidden');

                if (adicionandoGaleria == 'false') {
                    $('#FrmGaleria .modal-header h2').html('Suas fotos foram enviadas!<br>Finalize o cadastro da nova galeria.')
                }
                else {
                    $('#FrmGaleria .modal-header h2').html('Suas fotos foram enviadas!<br>Clique em Salvar para finalizar.')
                }

                return;

            }

            var fotoAtual = self.canvasFotos[self.indexFotoCanvas];

            var descricaoAtual = $('.fotoDescricao').eq(self.indexFotoCanvas).val();

            var capaAtual = $('.fotoCapa').eq(self.indexFotoCanvas).attr('checked');

            var formData = new FormData();

            formData.append('foto', fotoAtual.toDataURL('image/jpeg'));

            formData.append('descricao', descricaoAtual);

            formData.append('capa', capaAtual);

            var xhr = new XMLHttpRequest();

            xhr.upload.addEventListener("progress", function(e) {

                if (e.lengthComputable) {

                    var percentage = Math.round(((100 / (self.indexFotoCanvas + 1)) * self.indexFotoCanvas) + (((e.loaded * 100) / e.total) / self.canvasFotos.length));

                    $('#FrmGaleria .bar').css('width', percentage + '%');

                }

            }, false);

            xhr.upload.addEventListener("load", function(e) {

                self.indexFotoCanvas++;

                self.enviarImagens();

            });

            xhr.open("POST", _Biscoito.MontarURLAcao("galeria/adicionar_fotos_action", false));

            xhr.send(formData);

        }

        this.removerFoto = function(obj) {

            $(obj).parent().parent().remove();

        }

    }

    galeriaJSForm = new TGaleriaJSForm();

    galeriaJSAdicionarFotos = new TGaleriaJSAdicionarFotos();

</script>