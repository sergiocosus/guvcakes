<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="/css/vista.min.css"/>
        <?php include 'library/background.php'; ?>
        <script type="text/javascript" src="/library/jquery-1.10.2.min.js"></script>
        <meta name="viewport" content="width=device-width"/>
         
        <meta property="fb:app_id" content="151504458379563"/>    
        <meta property="og:type" content="website" />
        <meta property="fb:admins" content="100000361134459,donchecoscs" />
        <meta property="og:url" content="<?php echo dameURL(); ?>"/>
        <meta property="og:description" content="Página web dedicada a mostrar mediante fotografías e información la diversidad del municipio de Calvillo, Aguascalientes, México."/>
        <meta property="description" content="Página web dedicada a mostrar mediante fotografías e información la diversidad del municipio de Calvillo, Aguascalientes, México."/> 
        <meta property="og:image" content="http://calvillo.com.mx/imagenes/index/arriba.jpg" />
        <link href="http://calvillo.com.mx/imagenes/index/arriba.jpg" rel="image_src" />
        <meta property="og:title" content="Calvillo.com.mx - El Valle de Huajúcar" />
        <title>Calvillo.com.mx - El Valle de Huájucar</title>
        
    </head>
    <body>
        <?php include 'library/analyticstracking.php'; 
        include 'library/facebook.php'?>
       
        <header id="arriba" >
            <div id="titulo">
                Calvillo.com.mx
            </div>
            <div id="galeria">
                <?php
                $cantidad=count($elementos);
                for($i=0;$i<$cantidad;$i++){
                ?><a href="/Foto/Ver<?php echo generarLink($elementos[$i]->catId,$categorias,$catCant),'/',$elementos[$i]->link;?>">
                        <img style="width:75px; height: 75px;" src="/imagenes/Foto/<?php echo $elementos[$i]->id; ?>-thumb.<?php echo $elementos[$i]->formato;?>"
                             title="<?php echo $elementos[$i]->titulo; ?>" />

                </a><?php } ?>
            </div>  
        </header>  
         <script>  
            var arriba=$('#arriba');
            var height=window.innerHeight;
            arriba.css('max-height',Math.floor(height/3)+'px');
            $(window).on('resize',function(){
                 height=window.innerHeight;
                 arriba.css('max-height',Math.floor(height/3)+'px');
            });
        </script>
    <div style="text-align:center">
       <nav id="circulos">
            <!--<a class="zoom" href="/Localidad/Ver/">
                <img src="/imagenes/index/localidades.png">
            </a>-->
           <!-- <a class="zoom" href="/Directorio/Ver/">
                <img src="/imagenes/index/directorio_down.png">
            </a>-->
            <a href="/Foto/Ver/Antiguo" class="zoom">
                <img src="/imagenes/Categoria/4.png">
            </a>
            <a href="/Foto/Ver/Artesanias" class="zoom">
                <img src="/imagenes/Categoria/2.png">
            </a>
            <a href="/Foto/Ver/Ferias" class="zoom">
                <img src="/imagenes/Categoria/3.png">
            </a>
           <a href="/Foto/Ver/Gastronoma" class="zoom">
               <img src="/imagenes/Categoria/1.png">
           </a>
           <a href="https://www.facebook.com/Guv-Cakes-1490365367935398/" class="zoom">
               <img src="/imagenes/index/faceCirculo.png">
           </a>
           <a href="https://plus.google.com/+FotoscalvilloMx/posts" class="zoom">
               <img src="/imagenes/index/google-plus.png">
           </a>
       </nav>
        

        <form action="http://www.google.com.mx" id="cse-search-box">
            <div>
              <input type="hidden" name="cx" value="partner-pub-4211453260979774:7651543142" />
              <input type="hidden" name="ie" value="UTF-8" />
              <input type="text" name="q"  />
              <input type="submit" name="sa" value="Buscar" />
            </div>
        </form>

        <script type="text/javascript" src="http://www.google.com.mx/coop/cse/brand?form=cse-search-box&amp;lang=es"></script>


        <div class="divTexto">
            Bienvenido a Calvillo.com.mx, página dedicada a mostrar 
            mediante fotografías e información la diversidad del municipio de 
            Calvillo, Aguascalientes, México.
            <br>
            Si tienes alguna duda o comentario puedes contactarnos en 
            <a href="mailto:contacto@calvillo.com.mx">contacto@calvillo.com.mx </a>
                o en nuestra página de <a href="https://www.facebook.com/calvillo.com.mx">facebook</a>.
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
         <div id="social"></div>
   
    </div>
   
    
    <script src="/library/jquery.min.js" type="text/javascript"></script>
    <script src="/library/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="/library/jquery.mobile.customized.min.js" type="text/javascript"></script>
    <script src="Scripts/fotoScript.js.php"></script>
    <script>
        crearLikeBox();
    </script>

    </body>
</html>
