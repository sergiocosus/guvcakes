var editorInit={
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor moxiemanager"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true
};  
 
var path='';
var imgDir=path+'/imagenes/';
var thumb='-thumb.';
var thumb2='-thumb2.';
var listaFotos=$('#listaFotos');
var listaCategorias=$('#listaCategorias');
var infoBar=$('#infoBar');
var elementos=[];
var categorias;
var tipo;
var mensajes=[];
var test;
mensajes[0]='do con éxito';
mensajes[1]='No se ha iniciado sesión';
mensajes[-1]='Error en los datos';
mensajes[-2]="Error al insertar";
mensajes[-3]="Erro al insertar";
mensajes[-4]="Error, faltan campos";


function decode(str){return  str;};
function Modelo(){
    this.id="";
    this.titulo="";
    this.descripcion="";
    this.prioridad=0;
    this.formato="";
    
    this.elementoHTML=null;
    this.tipo="";    
    this.modo="";
    this.ocultar=function(e){
        $.post(path+'/'+this.tipo+'/Ocultar',{id:this.id},function(data){            
            mensajeInfoBar(e.data.titulo,"Ocultado",data);
            e.data.elementoHTML.remove();
        });
        e.stopPropagation();
        e.preventDefault();
    };
    this.eliminar=function(e){
        if(confirm("¿Está seguro de elimiarlo? El cambio no se puede deshacer u.u")){
            $.post(path+'/'+this.tipo+'/Eliminar',{id:this.id,formato:this.formato},function(data){
                mensajeInfoBar(e.data.titulo,"Eliminado",data);
                e.data.elementoHTML.remove();
            });
        }
        e.stopPropagation();
        e.preventDefault();
    };
    this.mostrar=function(e){
        $.post(path+'/'+this.tipo+'/Mostrar',{id:this.id},function(data){
            mensajeInfoBar(e.data.titulo,"Mostrado",data);
            e.data.elementoHTML.remove();
        });
        e.stopPropagation();
        e.preventDefault();
    };
    this.crearMiniatura=function(seElimina){
        this.elementoHTML=$('<div>');
        var imagenElemento=$('<img>',{src:imgDir+this.id+thumb2+this.formato+'?'+Math.random()});
        var tituloElemento=$('<p>',{text:this.titulo});
        var botones=this.crearBotones(seElimina);
        //console.log(this);
        this.elementoHTML.on('click',{foto:this, seElimina:seElimina},function(e){
            var foto=e.data.foto;
            $.post(path+'/'+foto.tipo+'/Obtener',{id:foto.id},
                function(data,status){
                   //console.log(data);
                   var fotoNueva=eval(data);
                   fotoNueva.elementoHTML=fotoNueva.toForm(true,e.data.seElimina);
                   foto.elementoHTML.replaceWith(fotoNueva.elementoHTML);
                   tinymce.init(editorInit);
                }
            );
            e.stopPropagation();
        });
        this.elementoHTML.append(imagenElemento,tituloElemento,botones);
        return this.elementoHTML;
    };
    this.crearBotones=function(seElimina){
        var contenedor=$('<div>',{'class':'eliminarContenedor'});
        if(seElimina){
            var botonEliminar=$('<button>',{text:'X','class':'eliminar'}).click(this,function(e){e.data.eliminar(e);});
            var botonMostrar=$('<button>',{text:'✓','class':'eliminar'}).click(this,function(e){e.data.mostrar(e);});
            contenedor.append(botonMostrar,botonEliminar);
        }else{
            var botonOcultar=$('<button>',{text:'X','class':'eliminar'}).click(this,function(e){e.data.ocultar(e);});
            contenedor.append(botonOcultar);
        }
        return contenedor;
    };
    this.jQueryForm=function(){
        var foto=this;
        var progress=$('<progress>',{max:100});
        var texto=$('<span>');
        var li=$('<li>').append(progress,texto);    
        var opciones = {      
            beforeSubmit: 
                function(formData, jqForm) { 
                   if(formData[2].value==="" && foto.modo==="Inserta"){
                       mensajeInfoBar("Seleccione una imagen","","");
                       return false;
                   }
                   if(formData[3].value.length<3){
                       mensajeInfoBar("El título es inválido, almenos 3 carácteres","","");
                       return false;
                   }
                   foto.jQueryForm();
                   li.attr('titulo',formData[3].value); 
                   li.children().text(foto.modo+'ndo... '+formData[3].value);
                   infoBar.prepend(li);
                   return true; 
               },       
            success:     
                function (responseText, statusText, xhr, $form)  { 
                    progress=li.children('progress');
                    var salida,codigoRespuesta=parseInt(responseText);
                    if(codigoRespuesta==0){
                        salida=foto.modo+mensajes[codigoRespuesta];
                        progress.remove();
                    }else{
                        if(mensajes[codigoRespuesta]){
                            salida=mensajes[codigoRespuesta];
                        }else{
                            salida='Error desconocido...' + responseText;
                        }
                        progress.removeAttr('value'); 
                    }
                    li.children().text(li.attr('titulo')+' - '+salida);
                    li.delay(10000).fadeOut(5000,function(){$(this).remove();});
                },
            error:
                function(){
                    progress=li.children('progress');
                    progress.remove();
                    li.children().text(li.attr('titulo')+' - Error desconocido.....');
                    li.delay(10000).fadeOut(5000,function(){$(this).remove();});
                },
            uploadProgress:function (e,posicion,total,porcentaje){
                li.children('progress').attr('value',porcentaje);
            },
            type:'post',
            mimeType:'multipart/form-data'
        }; 
        this.elementoHTML.ajaxForm(opciones);
    };
    this.inputId=function(){
        return $('<input>',{name:'id',type:'hidden',value:this.id});
    };
    this.inputImage=function(){
        var input=$('<input>',{name:'imagen',type:'file',accept:'image/gif,image/jpeg,image/png',tabindex:1,acceskey:'a'});
        return input.on('change',cargarImagenEvento);
    };
    this.inputFormato=function(){
        return $('<input>',{name:'formato',type:'hidden',value:this.formato});
    };
    this.imageVistaPrevia=function(){
        return $('<img>',{
            src:imgDir+this.id+thumb2+this.formato+'?'+Math.random(),
            name:'vistaPrevia'
        });
    };
    this.inputTitulo=function(){
        return $('<input>',
                    {name:'titulo',type:'text',maxlength:100,placeholder:"Título de la "+this.tipo,value:this.titulo}
                ).on('input',validarLinkEvento);;
    };
    this.inputLink=function(){
        return $('<input>',{name:'link',type:'text',readonly:"readonly",placeholder:"Título en url",value:this.link});
    };
    this.inputPrioridad=function(){
        return $('<input>',{name:'prioridad',type:'number',value:this.prioridad});
    };
    this.inputEnviar=function(){
        return $('<input>',{type:'submit'});
    };
    this.inputDescripcion=function(){
        return $('<textarea>',{name:'descripcion',type:'text',text:this.descripcion});
    };
    this.nuevoForm=function(){
        //console.log(this.tipo);
        test=this;
        return $('<form>',{action:path+'/'+this.tipo+'/'+this.modo+'r',autocomplete:'on'}).
                bind('form-pre-serialize', function() {tinyMCE.triggerSave();});  
    };
    this.selectCategorias=function(){
        var select=$('<select>',{name:"catId"});
        var option=$('<option>',{value:0,text:"Raíz"});
        if(0===this.catId)
            option.attr('selected','selected');
        select.append(option);
        for(var i=0;i<categorias.length;i++){
            if(categorias[i].contiene===0 && categorias[i].id!==this.id){
                var option=$('<option>',{value:categorias[i].id,text:categorias[i].titulo});
                if(categorias[i].id===this.catId)
                    option.attr('selected','selected');
                select.append(option);
            }
        }
        return select;
    };
    this.selectElementos=function(){
        var select=$('<select>',{name:"catId"});
        for(var i=0;i<categorias.length;i++){
            if(categorias[i].contiene===1){
                var option=$('<option>',{value:categorias[i].id,text:categorias[i].titulo});
                if(categorias[i].id===this.catId)
                    option.attr('selected','selected');
                select.append(option);
            }
        }
        return select;
    };
    this.miniaturaGeneral=function(){
        var a=$('<a>',{'class':'miniaturaGeneral zoom',href:path+'/'+this.tipo+'/Ver'+generarLink(this.catId)+"/"+this.link});
        var image=$('<img>',{src:imgDir+this.tipo+'/'+this.id+thumb2+this.formato});
        var titulo=$('<p>',{text:this.titulo});
        a.append(image,titulo);
        return a;
    };
    this.miniaturaCategoria=function(tipo,tipoLink){
         var a,divImagen,divDatos,image,titulo,descripcion;
         this.tipo=tipo;
         divImagen=$('<div>');
         divDatos=$('<div>');
         a=$('<a>',{'class':'miniaturaCategoria zoom',href:path+'/'+tipoLink+'/Ver'+generarLink(this.catId)+"/"+this.link+'/'});
         image=$('<img>',{src:imgDir+this.tipo+'/'+this.id+thumb2+this.formato});
         titulo=$('<p>',{text:this.titulo});
         descripcion=$('<div>');
         descripcion.html(this.descripcion);
         divImagen.append(image);
         divDatos.append(titulo,descripcion);
         a.append(divImagen,divDatos);
         return a;
     };

    this.miniaturaMini=function(){
        var div=$('<div>',{'class':'zoom'});
        var image=$('<img>',{src:imgDir+this.tipo+'/'+this.id+thumb+this.formato});
        div.click(this,function(e){
            for(i=0;i<elementos.length;i++){
                if(elementos[i]===e.data){
                    galeria.cambiarFoto(i);
                    break;
                }
            }
        });
        var texto=$('<p>',{text:this.titulo});
           texto.hide();
           div.hover(function(){
               texto.fadeIn(200);
           },function(){
               texto.fadeOut(200);
           });
        div.append(image,texto);
        return div;
    };
    
  
}

        



/*----------------------------------------------------------------------------------------------------------------------*/

function Categoria(id,link,titulo,descripcion,formato,catId,prioridad,contiene){
    if(arguments.length!==0){
        this.id=id;
        this.link=link;
        this.titulo=decode(titulo);
        this.descripcion=decode(descripcion);
        this.formato=formato;
        this.catId=catId;
        this.prioridad=prioridad;
        this.contiene=contiene;
    }
}

Categoria.simple=function(id,link,titulo,descripcion,formato,catId,contiene){
    return new Categoria(id,link,titulo,descripcion,formato,catId,null,contiene);
};

Categoria.prototype=new Modelo();
Categoria.prototype.tipo="Categoria";

Categoria.prototype.inputContiene=function(){
    var span=$('<span>').text("Contiene Fotos");
    var input= $('<input>',{name:'contiene',type:'checkbox'});
    if(this.contiene===1){
        input.attr('checked',true);
    }
    return span.prepend(input);
};

Categoria.prototype.toForm=function (actualizar,seElimina){
    var formRight,formLeft,select;   
    this.modo=actualizar?'Actualiza':"Inserta";
    formRight=$('<div>',{'class':'formRight'});
    formLeft=$('<div>',{'class':'formLeft'});
    
    with (this){
        this.elementoHTML=nuevoForm(); 
        formLeft.append(inputId(),inputFormato(),inputImage(),imageVistaPrevia(),inputTitulo(),inputLink(),
            inputPrioridad(),selectCategorias(),inputContiene(),inputEnviar());
        formRight.append(inputDescripcion()); 
        elementoHTML.append(formLeft,formRight,actualizar ? crearBotones(seElimina) : null);
    }
    
    this.jQueryForm();
    return this.elementoHTML;
};

/*---------------------------------------------------------------------------*/

function Foto(id,link,titulo,descripcion,formato,catId,prioridad,fechaTomada){
    if(arguments.length!==0){
        this.id=id;
        this.link=link;
        this.titulo=decode(titulo);
        this.descripcion=decode(descripcion);
        this.formato=formato;
        this.catId=catId;
        this.prioridad=prioridad;
        this.fechaTomada=fechaTomada;
    }
}
Foto.prototype=new Modelo();
Foto.prototype.tipo="Foto";

Foto.prototype.link='';
Foto.prototype.catId='';

Foto.prototype.fechaTomada='';

var a;

Foto.prototype.inputFecha=function(){
    fecha=toDateTimeLocal(this.fechaTomada);
    return $('<input>',{name:'fechaTomada',type:'datetime-local',value:fecha});
};

Foto.prototype.toForm=function (actualizar,seElimina){
     var formRight,formLeft,select;   
    this.modo=actualizar?'Actualiza':"Inserta";
    
    formRight=$('<div>',{'class':'formRight'});
    formLeft=$('<div>',{'class':'formLeft'});
    
    if(!actualizar){; this.fechaTomada=new Date().toDateString();}
    with (this){
        this.elementoHTML=nuevoForm(); 
        formLeft.append(inputId(),inputFormato(),inputImage(),imageVistaPrevia(),inputTitulo(),inputLink(),
            inputPrioridad(),selectElementos(),inputFecha(),inputEnviar());
        formRight.append(inputDescripcion()); 
        elementoHTML.append(formLeft,formRight,actualizar ? crearBotones(seElimina) : null);
    }
    
    this.jQueryForm();
    return this.elementoHTML;
    return this.elementoHTML;
};

Foto.simple=function(id,link,titulo,formato,catId){
    return new Foto(id,link,titulo,null,formato,catId,null,null,null);
};


function Directorio(id,titulo,descripcion,formato,catId,prioridad,direccion,telefono,celular,email,website,facebook,youtube,latitud,longitud){
    if(arguments.length!==0){
        this.id=id;
        this.titulo=decode(titulo);
        this.descripcion=decode(descripcion);
        this.formato=formato;
        this.catId=catId;
        this.prioridad=prioridad;
        this.direccion=decode(direccion);
        this.telefono=telefono;
        this.celular=celular;
        this.email=email;
        this.website=website;
        this.facebook=facebook;
        this.youtube=youtube;
        this.latitud=latitud;
        this.longitud=longitud;        
    }
}
Directorio.prototype=new Modelo();
Directorio.prototype.tipo="Directorio";

Directorio.prototype.catId='';
Directorio.prototype.direccion='';
Directorio.prototype.telefono='';
Directorio.prototype.celular='';
Directorio.prototype.email='';
Directorio.prototype.website='';
Directorio.prototype.faceboook='';
Directorio.prototype.youtube='';
Directorio.prototype.latitud='';
Directorio.prototype.longitud='';

Directorio.prototype.inputDireccion=function(){
    return $('<input>',{name:'direccion',type:'text',placeholder:"Dirección",value:this.direccion});
};
Directorio.prototype.inputTelefono=function(){
    return $('<input>',{name:'telefono',type:'text',placeholder:"Teléfono",value:this.telefono});
};
Directorio.prototype.inputCelular=function(){
    return $('<input>',{name:'celular',type:'text',placeholder:"Celular",value:this.celular});
};
Directorio.prototype.inputEmail=function(){
    return $('<input>',{name:'email',type:'text',placeholder:"Correo electrónico",value:this.email});
};
Directorio.prototype.inputWebSite=function(){
    return $('<input>',{name:'website',type:'text',placeholder:"Sitio Web",value:this.website});
};
Directorio.prototype.inputFacebook=function(){
    return $('<input>',{name:'facebook',type:'text',placeholder:"Facebook",value:this.facebook});
};
Directorio.prototype.inputYoutube=function(){
    return $('<input>',{name:'youtube',type:'text',placeholder:"Youtube",value:this.youtube});
};
Directorio.prototype.inputLatitud=function(){
    return $('<input>',{name:'latitud',type:'text',placeholder:"Ubicación: Latitud",value:this.latitud});
};
Directorio.prototype.inputLongitud=function(){
    return $('<input>',{name:'longitud',type:'text',placeholder:"Ubicación: Longitud",value:this.longitud});
};

Directorio.prototype.toForm=function (actualizar,seElimina){
     var formRight,formLeft,select;   
    this.modo=actualizar?'Actualiza':"Inserta";
    
    formRight=$('<div>',{'class':'formRight'});
    formLeft=$('<div>',{'class':'formLeft'});
    
    if(!actualizar){; this.fechaTomada=new Date().toDateString();}
    with (this){
        elementoHTML=nuevoForm(); 
        formLeft.append(inputId(),inputFormato(),inputImage(),imageVistaPrevia(),inputTitulo(),
            inputPrioridad(),  inputDireccion(),inputTelefono(),inputCelular(), inputEmail(), inputWebSite(),
            inputFacebook(), inputYoutube(), inputLatitud(), inputLongitud() ,selectElementos(),inputEnviar());
        formRight.append(inputDescripcion()); 
        elementoHTML.append(formLeft,formRight,actualizar ? crearBotones(seElimina) : null);
    }
    
    this.jQueryForm();
    return this.elementoHTML;
    return this.elementoHTML;
};

Directorio.simple=function(id,titulo,formato,catId){
    return new Directorio(id,titulo,null,formato,catId,null,null,null);
};

SitioWebCat=DirectorioCat=LocalidadCat=Categoria;

function Localidad(id,link,titulo,descripcion,formato,catId,prioridad,etiqueta){
    if(arguments.length!==0){
        this.id=id;
        this.link=link;
        this.titulo=decode(titulo);
        this.descripcion=decode(descripcion);
        this.formato=formato;
        this.catId=catId;
        this.prioridad=prioridad;
        this.etiqueta=etiqueta;
    }
}
Localidad.prototype=new Modelo();
Localidad.prototype.tipo="Localidad";

Localidad.prototype.link='';
Localidad.prototype.catId='';
Localidad.prototype.etiqueta='';

Localidad.prototype.inputEtiqueta=function(){
    return $('<input>',{name:'etiqueta',value:this.etiqueta,placeholder:'Etiqueta'});
};

Localidad.prototype.toForm=function (actualizar,seElimina){
     var formRight,formLeft,select;   
    this.modo=actualizar?'Actualiza':"Inserta";
    
    formRight=$('<div>',{'class':'formRight'});
    formLeft=$('<div>',{'class':'formLeft'});
    
    if(!actualizar){; this.fechaTomada=new Date().toDateString();}
    with (this){
        this.elementoHTML=nuevoForm(); 
        formLeft.append(inputId(),inputFormato(),inputImage(),imageVistaPrevia(),inputTitulo(),inputLink(),
            inputPrioridad(),selectElementos(),inputEtiqueta(),inputEnviar());
        formRight.append(inputDescripcion()); 
        elementoHTML.append(formLeft,formRight,actualizar ? crearBotones(seElimina) : null);
    }
    
    this.jQueryForm();
    return this.elementoHTML;
    return this.elementoHTML;
};

Localidad.simple=function(id,link,titulo,formato,catId){
    return new Localidad(id,link,titulo,null,formato,catId,null,null,null);
};


function SitioWeb(id,titulo,descripcion,formato,catId,prioridad,url){
    if(arguments.length!==0){
        this.id=id;
        this.titulo=decode(titulo);
        this.descripcion=decode(descripcion);
        this.formato=formato;
        this.catId=catId;
        this.prioridad=prioridad;
        this.url=url;
    }
}
SitioWeb.prototype=new Modelo();
SitioWeb.prototype.tipo="SitioWeb";
SitioWeb.prototype.catId='';
SitioWeb.prototype.url='';

SitioWeb.prototype.inputURL=function(){
    return $('<input>',{name:'url',value:this.url,placeholder:'URL'});
};

SitioWeb.prototype.toForm=function (actualizar,seElimina){
     var formRight,formLeft,select;   
    this.modo=actualizar?'Actualiza':"Inserta";
    
    formRight=$('<div>',{'class':'formRight'});
    formLeft=$('<div>',{'class':'formLeft'});
    
    if(!actualizar){; this.fechaTomada=new Date().toDateString();}
    with (this){
        this.elementoHTML=nuevoForm(); 
        formLeft.append(inputId(),inputFormato(),inputImage(),imageVistaPrevia(),inputTitulo(),
            inputPrioridad(),selectElementos(),inputURL(),inputEnviar());
        formRight.append(inputDescripcion()); 
        elementoHTML.append(formLeft,formRight,actualizar ? crearBotones(seElimina) : null);
    }
    
    this.jQueryForm();
    return this.elementoHTML;
    return this.elementoHTML;
};

SitioWeb.simple=function(id,titulo,formato,catId){
    return new SitioWeb(id,titulo,null,formato,catId,null,null);
};



function validarLink(string) {
    string=string.replace(/ /gi,'-');
    for (var i=0, output='', validos="1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-"; i<string.length; i++)
       if (validos.indexOf(string.charAt(i)) !== -1)
          output += string.charAt(i);
    return output;
}; 

function validarLinkEvento(){
    var titulo=$(this).val();
    titulo=validarLink(titulo);
    $(this).siblings('[name="link"]').val(titulo);
}

function cargarImagenEvento(e){
    var f=e.target.files[0];
    var lector = new FileReader();
    var imagen=this;
    lector.onloadend = function(e){
        $(imagen).siblings('[name="vistaPrevia"]').attr('src',e.target.result);
    };
    $(this).fileExif(function(exifObject){
        var date,dates,fecha,hora;
        if(exifObject.DateTimeOriginal){
            date=exifObject.DateTimeOriginal;
        }else{
            date=exifObject.DateTime;
        }
        dates=date.split(' ');
        fecha=dates[0].split(':');
        hora=dates[1].split(':');
        fecha=new Date(fecha[0],fecha[1]-1,fecha[2],hora[0],hora[1],0,0);
        $(imagen).siblings('[name="fechaTomada"]').attr('value',toDateTimeLocal(fecha));
    });
    lector.readAsDataURL(f);
}

function imprimirFotos(seElimina){
    listaFotos.empty();
    for(i=0;i<elementos.length;i++){
        listaFotos.append(elementos[i].crearMiniatura(seElimina));
    }
}

function toDateTimeLocal(string){
    if(string =="0000-00-00 00:00:00")
        date=new Date("1977-01-01 00:00:00");
    else
        date=new Date(string);
 
    date.setHours(date.getHours()-6);
    return date.toISOString().split(".")[0].trim();
}



function imprimeCatInterna(catId,tipo){
    var ul=$('<ul>');
    for (var i=0;i<categorias.length;i++){
        if(categorias[i].catId===catId) {
            var li=$('<li>',{text:categorias[i].titulo});
            ul.append(li);
            if(categorias[i].contiene===0){
                li.append(imprimeCatInterna(categorias[i].id,tipo));
                li.on('click',(function(catId){              
                    return function(e){
                        $.post(path+'/'+tipo+'/ObtenerPorCategoria',{catId:catId},function(data){
                            elementos=eval(data);
                            imprimirFotos(false);
                        });
                        $(this).children().toggle(100);
                    $(this).toggleClass("bordeCat");
                    e.stopPropagation();
                    };
                })(categorias[i].id)
                );
            }else{
                li.addClass('catContieneFotos');
                li.on('click',(function(catId){              
                    return function(e){
                        $.post(path+'/'+tipo+'/ObtenerPorCategoria',{catId:catId},function(data){
                            elementos=eval(data);
                            imprimirFotos(false);
                        });
                        e.stopPropagation();
                    };
                })(categorias[i].id)
                );
            } 
        }
    }
    return ul;
}

function inicializar(tipo){
    $('#insertar').append((eval("new "+tipo+"()")).toForm(false,false));
    imgDir=path+'/imagenes/'+tipo+'/';
    tinymce.init(editorInit);
    listaCategorias.append(imprimeCatInterna(0,tipo));
    
    var categoriasEscpeciales=[];
    categoriasEscpeciales[0]='Ocultos';
    categoriasEscpeciales[1]='Huerfanos';
    
    for(var i=0; i<categoriasEscpeciales.length; i++){
        liCat=$('<li>',{text:'-'+categoriasEscpeciales[i]+'-'});
        liCat.on('click',{catEspecial:categoriasEscpeciales[i]},(function(e){
            $.post(path+'/'+tipo+'/Obtener'+e.data.catEspecial,function(data){
                elementos=eval(data);
                imprimirFotos(true);
            });
            e.stopPropagation();
        }));
        listaCategorias.children().append(liCat);
    }   
    $('#listaCategorias ul ul').hide();    
}

function mensajeInfoBar(titulo,accion,data){
    var span=$('<span>',{text:titulo+' - '+accion+' - '+data});
    var li=$('<li>').append(span);
    infoBar.prepend(li);
    li.delay(10000).fadeOut(5000,function(){$(this).remove();});
}

function inicializarCategoria(tipo){
    if(!tipo) tipo="Categoria";
    Categoria.prototype.tipo=tipo;
    imgDir=path+'/imagenes/'+tipo+'/';
    $('#insertar').append((eval("new "+tipo+"()")).toForm(false,false));
    tinymce.init(editorInit);
    listaCategorias.append(imprimeCatInterna(0,tipo));
    
    var categoriasEspeciales=[];
    categoriasEspeciales[0]='Ocultos';
    categoriasEspeciales[1]='Huerfanos';
    
    
    for(var i=0; i<categoriasEspeciales.length; i++){
        liCat=$('<li>',{text:'-'+categoriasEspeciales[i]+'-'});
        liCat.on('click',{catEspecial:categoriasEspeciales[i]},(function(e){
            $.post(path+'/'+tipo+'/Obtener'+e.data.catEspecial,function(data){
                elementos=eval(data);
                imprimirFotos(true);
            });
            e.stopPropagation();
        }));
        listaCategorias.children().append(liCat);
    }
       
    li=$('<li>',{text:'-Raíz-'});
    li.on('click',(function(e){
        $.post(path+'/'+tipo+'/ObtenerPorCategoria',{catId:0},function(data){
            elementos=eval(data);
            imprimirFotos(false);
        });
    }));
    listaCategorias.children().append(li);
    $('#listaCategorias ul ul').hide();    
}

function generarLink(catId){
    for(var i=0;i<categorias.length;i++){
        if(categorias[i].id===catId){
            return generarLink(categorias[i].catId)+'/'+categorias[i].link;
        }
    }
    return "";
}

function obtenerIdActual(){
    var linkCategorias=location.href.split("Ver")[1];
    var algo=linkCategorias.split("/");
    var linkActual=algo[algo.length-1];
    if(linkActual==="")
        var linkActual=algo[algo.length-2];
    if(linkActual==="")
        return 0;
    for(var i=0;i<categorias.length;i++){
        if(categorias[i].link===linkActual)
            return categorias[i].id;
    }
    return 0;
}

var social,like,gplusone,recomendaciones,comentarios;

function inicializarSocial(){
    
    social=$('#social');
    like=$('#like');
    gplusone=$('.g-plusone');
    recomendaciones=$('#recomendaciones');
    comentarios=$('#comentarios');
    cambiarURLFacebook(false);
    
}

function cambiarURLFacebook(recargar) {
    var value=window.location.origin+window.location.pathname;
    
    var width=(social.innerWidth()-50);
    if(width>1000)
        width=1000;

    var fbComments='<fb:comments \
            href="'+value+'" \
            width="'+width+'" \n\
            numposts="5" colorscheme="dark"></fb:comments>';
    comentarios.html(fbComments);
    if(recargar)
    FB.XFBML.parse(comentarios.get(0),function(){
        $(".FB_Loader").remove();
    });

    var facebook_bar = '<fb:recommendations-bar href="' + value + '" site="calvillo.com.mx" read_time="30" side="left" action="like"></fb:recommendations-bar>';
    recomendaciones.html(facebook_bar);
    if(recargar)
    FB.XFBML.parse(recomendaciones.get(0),function(){
        $(".FB_Loader").remove();
    });

     var facebook_like = '<fb:like href="'+value+'" width="200" layout="standard" action="like" show_faces="true" share="true"></fb:like>';
    like.html(facebook_like);
    if(recargar)
    FB.XFBML.parse(like.get(0),function(){
        $(".FB_Loader").remove();
    });
    gplusone.empty();
      window.___gcfg = {lang: 'es-419'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();

}

function crearLikeBox(){
    var value=window.location.href;
    social=$('#social');
    var width=(social.innerWidth()-50);
     
    if(width>1000)
        width=1000;
    var fbLikeBox='<fb:like-box href="https://www.facebook.com/calvillo.com.mx" colorscheme="dark" show_faces="true" header="false" stream="true" show_border="false"\ width="'+width+'"></fb:like-box>';
              
    social.html(fbLikeBox);
    FB.XFBML.parse(social.get(0),function(){
        $(".FB_Loader").remove();
    });
}