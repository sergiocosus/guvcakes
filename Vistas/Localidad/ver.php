<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <?php
            global $path,$path;
            $seccion='Localidad';
            include_once 'MVC/headTags.php';
        ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $path; ?>/css/vista.min.css"/>
        <?php include 'library/background.php'; ?>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
       <?php 

            include 'MVC/menuArriba.php';

        ?>
         
        <div id="todo">
            <section id="lista">
               <div id="listaArriba">
                   <nav id="listaMiniFotosLoc">

                   </nav>
               </div>

                <h1>
                   <?php
                   if($elemento!==null){
                       echo $elemento->titulo;
                   }elseif($categoria!==null){
                       echo $categoria->titulo;
                   }else{
                       echo 'Fotografías de localidades';
                   }
                   ?>
               </h1>
               <div id="fotoGrande">

                   <div id="flechaAnterior" class="opacity">
                       <img src="<?php echo $path; ?>/imagenes/flecha.png" class="rot180" />
                   </div>
                   <div id="flechaSiguiente" class="opacity" >
                       <img src="<?php echo $path; ?>/imagenes/flecha.png" />
                   </div>

                  
                   <div id="widget"></div>
                   <div id="cargando" >
                       <img src="<?php echo $path; ?>/imagenes/cargando.gif"/>
                   </div>
               </div>
               <nav id="listaMiniaturas">
               </nav>
               <article >
                   <?php
                       if($elemento!==null){
                           echo $elemento->descripcion;
                       }elseif($categoria!==null){
                           echo $categoria->descripcion;
                       }else{
                           echo 'Fotografías de localidades de Calvillo, Aguascalientes';
                       }
                   ?>
               </article>
           </section> 
            <div style="width:98%">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- dinámico -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-4211453260979774"
                     data-ad-slot="2252861942"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
           <div id="social">
               <div id="like"></div>
               <div class="g-plusone" data-annotation="inline" data-width="300"></div>       
               <div id="comentarios"></div>
           </div>
        </div>
         
        <div id="recomendaciones"></div>
        
        <script type="text/javascript" src="<?php echo $path; ?>/library/jquery-1.10.2.min.js"></script>
        <script src="<?php echo $path; ?>/library/jquery.mobile.custom.min.js"></script>
        <script src="<?php echo $path; ?>/Scripts/fotoScript.min.js"></script>
        <script src="<?php echo $path; ?>/Scripts/galeriaFotos.min.js"></script>
        <script type="text/javascript" src="http://www.panoramio.com/wapi/wapi.js?v=1"></script> 
        <script>
            var test;
            var categorias= <?php LocalidadCat::codificarArreglo($categorias); ?>;
            var elementos=<?php Localidad::codificarArreglo($elementos); ?>;
            var elemento=<?php  if($elemento!=null)Localidad::codificar($elemento); else echo 'null'; ?>;
            var categoria=<?php  if($categoria!=null)LocalidadCat::codificar($categoria); else echo 'null'; ?>;
            
            imgDir=path+"/imagenes/"; 
            var galeria=new GaleriaDeLocalidades();
            $(window).on('resize',function(){
                resize();
                galeria.crearGaleria();
                galeria.cambiarFoto(galeria.numFoto);
                 
            });
      
            galeria.inicializar();
            inicializarSocial(false);
        </script>
    </body>
</html>
