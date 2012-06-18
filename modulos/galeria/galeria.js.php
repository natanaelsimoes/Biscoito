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
        
        this.btnAdicionar_Click = function() {
                        
            _Biscoito.AbrirPopupDinamico('FrmGaleria', 'galeria/exibir_formulario_adicionar')
            
            $(galeria.DOMNome).focus();
            
        }
        
        this.btnSalvar_Click = function() {                    
        
            if(Validar(galeria)) {
                          
                _Biscoito.ExecutarAcao('galeria/adicionar_galeria_action', $(galeria.getFormName()).serialize(), true); 
                
                bsUtilForm = new BootstrapUtilForm();
                
                bsUtilForm.alert('Galeria adicionada com sucesso!', function() {
                    _Biscoito.IrPara('administrador/galeria');
                });               
            
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
        
            logo.src = 'http://localhost:8080/Biscoito/10.jpg';                   
        
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
            
            if(capaSelecionada) {
                            
                _Biscoito.AbrirPopupDinamico('FrmGaleria', 'galeria/adicionar_galeria');
            
                self.enviarImagens();
            
            }
            
            else {
             
                bsUtilForm = new BootstrapUtilForm();
            
                bsUtilForm.alert('Você precisa selecionar uma foto como capa para continuar.');
             
            }                
            
        }

        this.manipularImagens = function(files) {
            
            $('#btnEnviar').removeClass('hidden');
        
            for (var i = 0; i < files.length; i++) {
        
                var file = files[i];
        
                var imageType = /image.*/;

                if (!file.type.match(imageType)) continue;

                var img = document.createElement("img");                   
        
                img.file = file;
        
                var reader = new FileReader();
        
                reader.onloadend = (function(aImg) { 
                
                    return function(e) { 
                    
                        aImg.src = e.target.result; 
                    
                        aImg.onload = function() {
                        
                            canvastoscreen ( imagetocanvas( this, 800, 600) );
                        
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
            .attr('type', 'text')
            .attr('name', 'descricao')
            
                        
            quebraLinha = document.createElement('br');
            
            checkBoxCapa = document.createElement('input');
            
            $(checkBoxCapa).addClass('fotoCapa')
            .attr('type', 'checkbox')
            .attr('name', 'capa')   
            .click(self.selecionarCapa);
            
            labelCapa = document.createElement('span');
            
            $(labelCapa).html(' Capa')                        
            
            $(formFoto).append(inputDescricao);
            
            $(formFoto).append(quebraLinha);
            
            $(formFoto).append(checkBoxCapa);
            
            $(formFoto).append(labelCapa);
                                    
            $(divFotoInfo).append(canvas);                        
            
            $(divFotoInfo).append(formFoto);                        
            
            $(fotos).append(divFotoInfo);
        
        }
    
        var imagetocanvas = function( img, thumbwidth, thumbheight) {
    
            c  = document.createElement( 'canvas' );                
        
            c.classList.add('fotoGaleria');                
        
            cx = c.getContext( '2d' )
        
            c.width = thumbwidth;
        
            c.height = thumbheight;
        
            var dimensions = resize( img.width, img.height, thumbwidth, thumbheight );
       
            c.width = dimensions.w;
        
            c.height = dimensions.h;
        
            dimensions.x = 0;
        
            dimensions.y = 0;               
       
            cx.drawImage(img, dimensions.x, dimensions.y, dimensions.w, dimensions.h);
        
            cx.globalAlpha = 0.5;
        
            cx.drawImage(logo, dimensions.x, dimensions.y);
        
            return c;
        
        }
    
        var resize = function( imagewidth, imageheight, thumbwidth, thumbheight ) {
        
            var w = 0, h = 0, x = 0, y = 0,
        
            widthratio  = imagewidth / thumbwidth,
        
            heightratio = imageheight / thumbheight,
        
            maxratio    = Math.max( widthratio, heightratio );
        
            if ( maxratio > 1 ) {
            
                w = imagewidth / maxratio;
            
                h = imageheight / maxratio;
            
            } 
        
            else {
            
                w = imagewidth;
        
                h = imageheight;
        
            }
        
            x = ( thumbwidth - w ) / 2;
        
            y = ( thumbheight - h ) / 2;
        
            return { w:w, h:h, x:x, y:y };
        
        }
        
        this.selecionarCapa = function() {
            
            $('.fotoCapa').attr('checked', false);
            
            capaSelecionada = true;
            
            $(this).attr('checked', true);
            
        }

        this.enviarImagens = function() {                     
        
            self.canvasFotos = document.querySelectorAll(".fotoGaleria");        
        
            if (self.indexFotoCanvas == self.canvasFotos.length) {
                
                $('#FrmGaleria #btnEnviando').addClass('hidden');
                
                $('#FrmGaleria #btnSalvar').removeClass('hidden');
                
                $('#FrmGaleria .modal-header h2').html('Suas fotos foram enviadas!<br>Finalize o cadastro da nova galeria.')
                
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
                
                    var percentage = Math.round(((100 / (self.indexFotoCanvas + 1)) * self.indexFotoCanvas) + (((e.loaded * 100) / e.total)/self.canvasFotos.length));        
                
                    $('#FrmGaleria .bar').css('width', percentage+'%');
                
                }
            
            }, false);       
            
            xhr.upload.addEventListener("load", function(e){ 
                
                self.indexFotoCanvas++;
            
                self.enviarImagens();
            
            });                         

            xhr.open("POST", _Biscoito.MontarURLAcao("galeria/adicionar_fotos_action", false));                    

            xhr.send(formData);                           
            
        }                
            
    }
    
    galeriaJSForm = new TGaleriaJSForm();          
    
    galeriaJSAdicionarFotos = new TGaleriaJSAdicionarFotos();
        
</script>