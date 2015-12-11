<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title></title>
         <link type="text/css" rel="stylesheet" href="/calvillo.com.mx/css/vista.css"/>
        <script type="text/javascript" src="/calvillo.com.mx/library/jquery-1.10.2.min.js"></script>
        <script src="/calvillo.com.mx/Scripts/fotoScript.js"></script>
        <script type="text/javascript" src="http://www.panoramio.com/wapi/wapi.js?v=1"></script>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=151504458379563";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
   
        
        <section id="lista">
            <h1 id="titulo">
                <?php
                if($elemento!==null){
                    echo $elemento->titulo;
                }elseif($categoria!==null){
                    echo $categoria->titulo;
                }else{
                    echo 'Localidades del Sitio';
                }
                ?>
            </h1>
            <div id="panoramio"></div>
             <div id="listaMiniaturas">
            </div>
        </section>
         <article >
                <?php
                    if($elemento!==null){
                        echo $elemento->descripcion;
                    }elseif($categoria!==null){
                        echo $categoria->descripcion;
                    }else{
                        echo 'Fotografías del Sitio';
                    }
                ?>
            </article>
                
        <div id="social">
            <div id="like"></div>
            <div class="g-plusone" data-annotation="inline" data-width="300"></div>       
            <div id="comentarios"></div>
        </div>
        <div id="recomendaciones"></div>
        
        <script>


            request = {"user":"3003950","order":panoramio.PhotoOrder.DATE_DESC/*, "tag":window.tag*/}; 
            mainWidgetStyle = {"attributionStyle": panoramio.tos.Style.HIDDEN,"width":400, "height": 400, "disableDefaultEvents":[panoramio.events.EventType.PHOTO_CLICKED]}; 

  var photo_ex_options = {'width': 350, 'height': 200};
  var widget = new panoramio.PhotoWidget('panoramio', request, photo_ex_options);
  widget.setPosition(0);

       var categorias= <?php LocalidadCat::codificarArreglo($categorias); ?>;
       var elementos=<?php Localidad::codificarArreglo($elementos); ?>;
       var elemento=<?php  if($elemento!=null)  Localidad::codificar($elemento); else echo 'null'; ?>;
       var categoria=<?php  if($categoria!=null)  LocalidadCat::codificar($categoria); else echo 'null'; ?>;



       GaleriaDeLocalidades=function(){
           this.categoriaActual=obtenerIdActual();
           this.listaMiniaturas=$('#listaMiniaturas');
           this.titulo=$('#titulo');

       }

        GaleriaDeLocalidades.prototype.inicializar=function(){
           if(elemento === null){
               with(this){

               }

               if(elementos.length==0){
                   for(var i=0;i<categorias.length;i++){
                       if(categorias[i].catId==this.categoriaActual){
                           this.listaMiniaturas.append(categorias[i].miniaturaCategoria("Localidad"));   
                       }
                   }
               }else{
                   for(var i=0;i<elementos.length;i++){
                       this.listaMiniaturas.append(elementos[i].miniaturaGeneral("Localidad"));
                   }
               }
           }else{
               this.generarListaMiniFotos("Localidad");
           }
       }


       var galeria=new GaleriaDeLocalidades();
       galeria.inicializar();

       </script>
        <?php
        // put your code here
        ?>
    </body>
</html>
