<script type="text/javascript">
    
    function TGaleriaJSAdicionarFotos() {
        
        var self = this;
    
        var dropbox, fotos, logo;
        
        this.indexFotoCanvas;
        
        this.canvasFotos;       

        var create = function() {
        
            dropbox = document.getElementById("dropbox");
        
            fotos = document.getElementById("fotosGaleria");                                               
        
            window.addEventListener("dragenter", dragenter, true);
        
            window.addEventListener("dragleave", dragleave, true);
        
            dropbox.addEventListener("dragover", dragover, false);
        
            dropbox.addEventListener("drop", drop, false);
            
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

        this.manipularImagens = function(files) {
        
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
            
            $(inputDescricao).addClass('xlarge')
                             .attr('type', 'text')
                             .attr('name', 'descricao')
            
                        
            quebraLinha = document.createElement('br');
            
            checkBoxCapa = document.createElement('input');
            
            $(checkBoxCapa).addClass('fotoCapa')
                           .attr('type', 'checkbox')
                           .attr('name', 'capa')                            
            
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

        this.enviarImagens = function() {                     
        
            self.canvasFotos = document.querySelectorAll(".fotoGaleria");        
        
            if (self.indexFotoCanvas == self.canvasFotos.length) return;
        
            var fotoAtual = self.canvasFotos[self.indexFotoCanvas];
            
            var formData = new FormData();
            
            formData.append('foto', fotoAtual.toDataURL('image/jpeg'));                        
        
            var xhr = new XMLHttpRequest();            
        
            xhr.upload.addEventListener("progress", function(e) { 
            
                if (e.lengthComputable) {
                
                    var percentage = Math.round(((100 / (self.indexFotoCanvas + 1)) * self.indexFotoCanvas) + (((e.loaded * 100) / e.total)/self.canvasFotos.length));        
                
                    $('#progresso').html(percentage);
                
                }
            
            }, false);       
            
            xhr.upload.addEventListener("load", function(){ 
            
                self.indexFotoCanvas++;
            
                self.enviarImagens();
            
            }); 

            xhr.open("POST", _Biscoito.MontarURLAcao("galeria/adicionar_fotos_action", false));                    

            xhr.send(formData);                           
            
        }                
            
    }
    
    galeriaJSAdicionarFotos = new TGaleriaJSAdicionarFotos();
</script>