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
                Guvcakes
            </div>
            <div id="galeria">
                <img src="/imagenes/bar.jpg" style="width: 100%;"/>
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

            <a href="/Foto/Ver/Galera-de-fotos/" class="zoom">
                <img src="/imagenes/ima.jpg">

            </a>
            <a href="/Descripcion/Ver/" class="zoom">
                <img alt="Descripción" src="/imagenes/des.jpg">

            </a>
           <a href="/Foto/Ver/Videos/" class="zoom">
               <img alt="Videos" src="/imagenes/vid.jpg">
           </a>
           <a href="/Foto/Ver/Carteles" class="zoom">
               <img alt="Carteles" src="/imagenes/car.jpg">
           </a>
           <a href="/Contacto/Ver/" class="zoom">
               <img alt="Carteles" src="/imagenes/con.jpg">
           </a>

         <!--  <a href="https://plus.google.com/+FotoscalvilloMx/posts" class="zoom">
               <img src="/imagenes/index/google-plus.png">
           </a>-->
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
            Si tienes alguna duda o comentario puedes contactarnos en 
            <a href="mailto:guvcakes@gmail.com">guvcakes@gmail.com </a>
        </div>

   
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
