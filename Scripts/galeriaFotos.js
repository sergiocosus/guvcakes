  GaleriaDeFotos=function(){
      this.categoria="Categoria";
      this.tipo="Foto";
};
GaleriaDeFotos.prototype.inicializar=function(){
    this.categoriaActual=obtenerIdActual();
    this.listaMiniaturas=$('#listaMiniaturas');
    this.listaMiniFotos=$('#listaMiniFotos');
    this.listaArriba=$('#listaArriba');
    this.fotoGrande=$('#fotoGrande > img');
    this.fotoGrandeDiv=$('#fotoGrande');
    this.flechaAnterior=$('#flechaAnterior');
    this.flechaSiguiente=$('#flechaSiguiente');
    this.flechaMiniAnterior=$('#flechaMiniAnterior');
    this.flechaMiniSiguiente=$('#flechaMiniSiguiente');
    this.descripcion=$('#lista article');
    this.titulo=$('#lista h1');
    this.fecha=$('#fotoGrande date');
    this.cargando=$('#cargando');
    this.totalPaginas=0;
    this.pagina=0;
    this.numFoto=0;
    
    this.nuevaImagen=new Image();
    this.nuevaImagen.onerror=function(){
        this.src=imgDir+elemento.tipo+'/'+elemento.id+'.'+elemento.formato;
    }
    this.siguienteImagen=new Image();
    this.siguienteImagen.onerror=this.nuevaImagen.onerror;
    this.elementoSiguiente=null;
    this.nuevaImagen.onload=function(e){
        with(galeria){
            if(elementos.length>galeria.numFoto+1){
                console.log("se ha cargado la imagen, cargando la siguiente",numFoto+1);
                elementoSiguiente=elementos[numFoto+1];
            }else{
                elementoSiguiente=null;
            }
            cargando.removeClass('fadeIn');
            cargando.addClass('fadeOut'); 

            fotoGrande.removeClass("inPicture");
            fotoGrande.removeClass("inPictureBack");
            if(!volviendo){
                fotoGrande.addClass("outPictureBack");
            }else{
                fotoGrande.addClass("outPicture");
            }
       

            setTimeout(function(){ 
                fotoGrande.attr('src',nuevaImagen.src);
                fotoGrande.removeClass("outPicture");
                fotoGrande.removeClass("outPictureBack"); 
                if(!volviendo){
                    fotoGrande.addClass("inPictureBack");
                }else{
                    fotoGrande.addClass("inPicture");
                }
                if (elementoSiguiente!=null)
                    siguienteImagen.src=imgDir+elementoSiguiente.tipo+'/'+elementoSiguiente.id+tamanoImg+'.'+elementoSiguiente.formato;
            },300);
        }
    }; 
    
    this.w=$(window);
    this.width=this.w.innerWidth();
    this.height=this.w.innerHeight();
    this.tamanoImg=""; 
    var tol=130;
    console.log(this.width,this.height);
    if(this.width<=320 || this.height<=240+tol){
        this.tamanoImg="-p";
    }else if(this.width<=640 || this.height<=480+tol){
        this.tamanoImg="-m";
    }else if(this.width<=1280 || this.height<=720+tol){
        this.tamanoImg="-g";
    }

    this.cargando.addClass('fadeOut');
    this.flechaMiniAnterior.click(this,function(e){e.data.paginaAnterior();});
    this.flechaMiniSiguiente.click(this,function(e){e.data.paginaSiguiente();});
    this.flechaSiguiente.click(this,function(e){e.data.fotoSiguiente();});
    this.flechaAnterior.click(this,function(e){e.data.fotoAnterior();});
    var esta=this;
    this.fotoGrandeDiv.swipeleft(function(e){esta.fotoSiguiente();});
    this.fotoGrandeDiv.swiperight(function(e){esta.fotoAnterior();});
    $(window).resize(this,function(e){e.data.generarListaMiniFotos();});
    $(document).keydown(this,function(e){
        if(e.keyCode===37){
            e.data.fotoAnterior();   
        }
        if(e.keyCode===39){
            e.data.fotoSiguiente();
        }
    });
    $.event.special.swipe.horizontalDistanceThreshold=20;
    $.event.special.swipe.verticalDistanceThreshold=100;
    if(elemento === null){
        this.crearMenu();
        this.listaArriba.hide();
    }else{
        this.crearGaleria();
    }
    
    
};

GaleriaDeFotos.prototype.crearMenu=function(){
    with(this){
        flechaMiniAnterior.hide();
        flechaMiniSiguiente.hide();
        flechaSiguiente.hide();
        flechaAnterior.hide();
        if(elementos.length===0){
            for(var i=0;i<categorias.length;i++){
                if(categorias[i].catId===categoriaActual){
                    listaMiniaturas.append(categorias[i].miniaturaCategoria(categoria,tipo));   
                }
            }
        }else{
            for(var i=0;i<elementos.length;i++){
                listaMiniaturas.append(elementos[i].miniaturaGeneral(tipo));
            }
        }
    }
}

GaleriaDeFotos.prototype.crearGaleria=function(){
    this.generarListaMiniFotos();
    if(this.numFoto===0)
        this.flechaAnterior.hide();
    if(this.numFoto===elementos.length-1)
        this.flechaSiguiente.hide();
};

GaleriaDeFotos.prototype.generarListaMiniFotos = function (){
    var widthListaMiniFotos=this.listaArriba.innerWidth()-90;
    this.longitudFotos=Math.floor(widthListaMiniFotos/63);
    this.totalPaginas=Math.ceil(elementos.length/this.longitudFotos);
    for(i=0;i<elementos.length;i++){                 
        if(elementos[i].id===elemento.id){
            this.numFoto=i;
            this.cambiarPagina(Math.floor(i/this.longitudFotos));
            break;
        }
    }
};
GaleriaDeFotos.prototype.cambiarPagina=function(nuevaPagina){
    with(this){
        pagina=nuevaPagina;
        limiteInferior=pagina*longitudFotos;
        limiteSuperior=(pagina+1)*longitudFotos;
        if(limiteSuperior>elementos.length)
            limiteSuperior=elementos.length;
        if(pagina===0){
            flechaMiniAnterior.hide();
        }else{
            flechaMiniAnterior.show();
        }
        if(pagina===totalPaginas-1){
            flechaMiniSiguiente.hide();
        }else{
            flechaMiniSiguiente.show();
        }
        var images=new Array();
        for(var i=limiteInferior;i<limiteSuperior;i++){
            images[i]=new Image();
            images[i].src=imgDir+elementos[i].tipo+'/'+elementos[i].id+thumb+elementos[i].formato;
        }
        listaMiniFotos.fadeOut(200,function(){
            listaMiniFotos.empty();
            listaMiniFotos.fadeIn(200);
            for(var i=limiteInferior;i<limiteSuperior;i++){
                listaMiniFotos.append(elementos[i].miniaturaMini());
            }
           
        });
    }
};
GaleriaDeFotos.prototype.paginaSiguiente=function(){
    if(this.pagina<this.totalPaginas)
        this.cambiarPagina(this.pagina+1);
    console.log(this.totalPaginas);
};
GaleriaDeFotos.prototype.paginaAnterior=function(){
    if(this.pagina>0)
        this.cambiarPagina(this.pagina-1);
};

GaleriaDeFotos.prototype.fotoSiguiente=function(){
    if(this.numFoto<elementos.length-1){
        this.cambiarFoto(this.numFoto+1);
    }
};
GaleriaDeFotos.prototype.fotoAnterior=function(){
    if(this.numFoto>0){
        this.cambiarFoto(this.numFoto-1);
    }
};

GaleriaDeFotos.prototype.cambiarFoto=function(posicion){
    this.volviendo=false;
    if(posicion!==undefined){
        if(posicion<this.numFoto){
            this.volviendo=true;
        }
        this.numFoto=posicion;
    }
    if(this.numFoto===0){
        this.flechaAnterior.hide();
    }else{
        this.flechaAnterior.show();
    }
    if(this.numFoto===elementos.length-1){
        this.flechaSiguiente.hide();
    }else{
        this.flechaSiguiente.show();
    }
    $.post(path+'/'+this.tipo+'/Obtener',{id:elementos[this.numFoto].id},function(data){
        elemento=eval(data);
        with(galeria){
            titulo.text(elemento.titulo);
            descripcion.html(elemento.descripcion);
            fecha.text(elemento.fechaTomada);

            nuevaImagen.src=imgDir+elemento.tipo+'/'+elemento.id+tamanoImg+'.'+elemento.formato;
            console.log(nuevaImagen.src);
            cargando.removeClass('fadeOut');
            cargando.addClass('fadeIn');
        }
        history.replaceState({ }, elemento.titulo, elemento.link);
        cambiarURLFacebook(true);
        document.title=elemento.titulo;  
    });
};

/*********Galeria de Localidades******************/

GaleriaDeLocalidades=function(){
    this.tipo="Localidad";
    this.categoria="LocalidadCat";
    this.numFoto=0;
    this.listaMiniFotosLoc=$('#listaMiniFotosLoc');
};
GaleriaDeLocalidades.prototype=new GaleriaDeFotos();

GaleriaDeLocalidades.prototype.widget=null;
GaleriaDeLocalidades.prototype.crearGaleria=function(){
    var request = {user:"3003950","order":panoramio.PhotoOrder.DATE_DESC/*, "tag":window.tag*/}; 
    if(elemento!=null){
      var  request = {user:"3003950","order":panoramio.PhotoOrder.DATE_DESC,tag:elemento.etiqueta}; 
    }

    var width=this.fotoGrandeDiv.innerWidth()-5;
    var height=$(window).innerHeight()*.9-80;
    var mainWidgetStyle = {"width":width, "height": height, "disableDefaultEvents":[panoramio.events.EventType.PHOTO_CLICKED]}; 
    var widgetDiv=$('#widget');
    this.widget = new panoramio.PhotoWidget(widgetDiv[0], request, mainWidgetStyle);
    this.cambiarFoto(this.numFoto); 

    this.widget.enableNextArrow(false);
    this.widget.enablePreviousArrow(false);

    this.flechaAnterior.hide();
    
    var widthListaMiniFotos=this.listaArriba.innerWidth()-40;
    this.longitudFotos=Math.floor(widthListaMiniFotos/62);

    var list_ex_options = {"disableDefaultEvents":[panoramio.events.EventType.PHOTO_CLICKED],
        "attributionStyle": panoramio.tos.Style.HIDDEN,'width': widthListaMiniFotos, 
        'height': 65, 'columns': this.longitudFotos, 'croppedPhotos': true};

    this.widgetList = new panoramio.PhotoListWidget(this.listaMiniFotosLoc[0], request, list_ex_options);
   /*
    this.widgetList.enableNextArrow(false);
    this.widgetList.enablePreviousArrow(false);
*/
    var galeria=this;
    panoramio.events.listen(this.widgetList, panoramio.events.EventType.PHOTO_CLICKED, function(event){
        galeria.cambiarFoto(event.getPosition());
    })
    this.cambiarPagina(0);
};

GaleriaDeLocalidades.prototype.cambiarFoto=function(posicion){
    this.numFoto=posicion;
    this.widget.setPosition(posicion);
    if(this.widget.getAtEnd()){
        this.flechaSiguiente.hide();
    }else{
        this.flechaSiguiente.show();
    }
    if(this.widget.getAtStart()){
        this.flechaAnterior.hide();
    }else{
        this.flechaAnterior.show();
    } 
}
GaleriaDeLocalidades.prototype.fotoSiguiente=function(){
    if(!this.widget.getAtEnd()){
        galeria.cambiarFoto(this.numFoto+1);
    }
}
GaleriaDeLocalidades.prototype.fotoAnterior=function(){
    if(!this.widget.getAtStart()){
         galeria.cambiarFoto(this.numFoto-1);
    }
}

GaleriaDeLocalidades.prototype.cambiarPagina=function(nuevaPagina){
    this.pagina=nuevaPagina;
    this.limiteInferior=this.pagina*this.longitudFotos;
    this.widgetList.setPosition(this.limiteInferior);

      if(this.widgetList.getAtEnd()){
        this.flechaMiniSiguiente.hide();
    }else{
        this.flechaMiniSiguiente.show();
    }
    if(this.widgetList.getAtStart()){
        this.flechaMiniAnterior.hide();
    }else{
        this.flechaMiniAnterior.show();
    }
}

GaleriaDeLocalidades.prototype.paginaAnterior=function(){
    if(!this.widgetList.getAtStart()){
        this.cambiarPagina(--this.pagina);
    }
}

GaleriaDeLocalidades.prototype.paginaSiguiente=function(){
    if(!this.widgetList.getAtEnd()){
        this.cambiarPagina(++this.pagina);
    }
}
            
/*********Galeria del Directorio******************/

 GaleriaDeDirectorio=function(){
    this.tipo="Directorio";
    this.categoria="DirectorioCat";
};
GaleriaDeDirectorio.prototype=new GaleriaDeFotos();

GaleriaDeDirectorio.prototype.crearMenu=function(){
    if(elementos.length===0){
        for(var i=0;i<categorias.length;i++){
            if(categorias[i].catId===this.categoriaActual){
                this.listaMiniaturas.append(categorias[i].miniaturaCategoria(this.categoria,this.tipo));   
            }
        }
    }else{
        for(var i=0;i<elementos.length;i++){
            this.listaMiniaturas.append(elementos[i].miniaturaGeneral(this.tipo));
        }
    }
}

Directorio.prototype.miniaturaGeneral=function(){
    this.miniatura=$('<a>',{'class':'miniaturaGeneral zoom',href:path+'/'+this.tipo+'/Ver'+generarLink(this.catId)+"/"+this.link});
    var imageMini=$('<img>',{src:imgDir+this.tipo+'/'+this.id+thumb2+this.formato});
    var titulo=$('<p>',{text:this.titulo});
    this.miniatura.append(imageMini,titulo);
    this.miniatura.on('click',this,function(e){
        e.preventDefault();
        var elementoOriginal=e.data;
        imageMini.attr('src',imgDir+'cargando.gif');
        $.post(path+'/'+elementoOriginal.tipo+'/Obtener',{id:elementoOriginal.id},function(data){
            console.log(data);
            elementoOriginal.miniatura.addClass('fadeOut');
            
            var elemento=null,div=null,image=null,titulo=null,imgFacebook=null,
            facebook=null,youtube=null,tDireccion=null,direccion=null,
            tTelefono=null,telefono=null,tCelular=null,celular=null,tEmail=null,
            email=null,tWebsite=null,website=null,mapa=null,descripcion=null,
            br=null,br1=null,br2=null,br3=null;
            
            elemento=eval(data);
            div=$('<div>',{'class':'directorio'});
            image=$('<img>',{'class': 'dirImage',src:imgDir+elemento.tipo+'/'+elemento.id+thumb2+elemento.formato});
            titulo=$('<h2>',{text:elemento.titulo});
            imgFacebook=$('<img>',{src:imgDir+'facebookMini.png'});
            imgYoutube=$('<img>',{src:imgDir+'youtubeMini.png'});
            if(elemento.facebook!==""){
                facebook=$('<a>',{'class':'floatRight',href:elemento.facebook}).append(imgFacebook);
            }
            if(elemento.youtube!==""){
                youtube=$('<a>',{'class':'floatRight',href:elemento.youtube}).append(imgYoutube);
            }
            if(elemento.direccion!==""){
                tDireccion=$('<span>',{'class':'tituloDirectorio',text:'Dirección:'});
                direccion=$('<span>',{text:elemento.direccion});
            }
            if(elemento.telefono!==""){
                tTelefono=$('<span>',{'class':'tituloDirectorio',text:'Teléfono:'});
                telefono=$('<span>',{text:elemento.telefono});
                br1=$('</br>');
            }
            if(elemento.celular!==""){
                tCelular=$('<span>',{'class':'tituloDirectorio',text:'Celular:'});
                celular=$('<span>',{text:elemento.celular});
                br2=$('</br>');
            }
            if(elemento.email!==""){
                tEmail=$('<span>',{'class':'tituloDirectorio',text:'E-mail:'});
                email=$('<a>',{href:'mailto:'+elemento.email,text:elemento.email});
                br3=$('</br>');
            }
            if(elemento.website!==""){
                tWebsite=$('<span>',{'class':'tituloDirectorio',text:'Sitio Web:'});
                website=$('<a>',{href:elemento.website,text:elemento.website});
            }
            mapa=$('<button>',{text:'Ver Mapa'});
            mapa.on('click',elemento,function(e){
                e.data.mostrarMapa();
            });
            descripcion=$('<div>',{'class':'descripcionDirectorio',html:elemento.descripcion});

            br=$('</br>');

            div.append(titulo,facebook,youtube,image,tDireccion,direccion,mapa,br,
            tTelefono,telefono,br1,
            tCelular,celular,br2,
            tEmail,email,br3,
            tWebsite,website,descripcion);

            setTimeout(function(){
                elementoOriginal.miniatura.replaceWith(div);
                div.addClass('inPictureBack');
            },250);
        });
    });
    return this.miniatura;
};

GaleriaDeDirectorio.prototype.inicializar=function(){
    this.categoriaActual=obtenerIdActual();
    this.listaMiniaturas=$('#listaMiniaturas');
    this.descripcion=$('#lista article');
    this.titulo=$('#lista h1');
    this.fecha=$('#fotoGrande date');
    this.cargando=$('#cargando');
    this.mapa=$('#mapa');
    this.fondoMapa=$('#fondoMapa');
    this.salidaMapa=$('#salidaMapa');
    this.totalPaginas=0;
    this.pagina=0;
    this.numFoto=0;
    this.salidaMapa.on('click',this,function(e){
        e.data.fondoMapa.fadeOut(200);
    });
    if(elemento === null){
         this.crearMenu();
    }else{
         this.crearGaleria();
    }
};

Directorio.prototype.mostrarMapa=function(){
    galeria.fondoMapa.fadeIn(500);
    var ubicacion=new google.maps.LatLng(this.latitud,this.longitud);
    var mapProp = {
        center:ubicacion,
        zoom:16,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var map=new google.maps.Map(document.getElementById("mapa"),mapProp);
    var marker=new google.maps.Marker({
        position:ubicacion,
        animation:google.maps.Animation.BOUNCE
    });
    marker.setMap(map);
    var infowindow = new google.maps.InfoWindow({
        content:'<font color="black">'+this.titulo+""+"<br>"+'<p color:"black">'+this.direccion+'</p></font>'
    });
    infowindow.open(map,marker);
};



