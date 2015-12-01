<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html  xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <?php
            global $path,$path;
            $seccion='Directorio';
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
                <div><h1>
                         <?php

                         if($elemento!==null){
                             echo $elemento->titulo;
                         }elseif($categoria!==null){
                             echo $categoria->titulo;
                         }else{
                             echo 'Directorio del Sitio';
                         }
                         ?>
                     </h1>
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
                             echo 'Directorio de negocios y servicios Calvillenses';
                         }
                     ?>
                 </article>


             </section>    
             <div id="fondoMapa">
                 <div id="mapa"></div>

                 <div id="salidaMapa">
                     <button>Volver X</button>
                 </div>
             </div>
                   
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
        <script>
            var test;
            var categorias= <?php DirectorioCat::codificarArreglo($categorias); ?>;
            var elementos=<?php Directorio::codificarArreglo($elementos); ?>;
            var elemento=<?php  if($elemento!=null) Directorio::codificar($elemento); else echo 'null'; ?>;
            var categoria=<?php  if($categoria!=null) DirectorioCat::codificar($categoria); else echo 'null'; ?>;
            
            imgDir=path+"/imagenes/";
         
            var galeria=new GaleriaDeDirectorio();
    
            galeria.inicializar();
            inicializarSocial();
            
        </script>
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCldlviDEqmEgEbpKioJSf5VP79wQ5x2Lo&amp;sensor=false"></script>
     
    </body>
</html>
