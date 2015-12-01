<!DOCTYPE html>
<?php
$elementos=Foto::obtenerTodos(' ORDER BY fechaSubida desc limit 10');

        ?>
<html xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="css/vista.min.css"/>
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
        <link href="css/camera.css" rel="stylesheet" type="text/css"/>
    </head>
    <body   >
        <?php include 'library/analyticstracking.php'; 
        include 'library/facebook.php'?>

        <header id="arriba" >
            <div id="titulo">
                Calvillo.com.mx
            </div>
            <div id="galeria">
                <?php
                $cantidad=count($elementos);

                for($i=0;$i<$cantidad;$i++){?>
                    <div data-src="/imagenes/Foto/<?php echo $elementos[$i]->id; ?>-g.<?php echo $elementos[$i]->formato;?>"
                         data-thumb="/imagenes/Foto/<?php echo $elementos[$i]->id; ?>-thumb.<?php echo $elementos[$i]->formato;?>"
                         data-link="Foto/Ver<?php echo generarLink($elementos[$i]->catId,$categorias,$catCant),'/',$elementos[$i]->link;?>">
                    <div class="camera_caption"><?php echo $elementos[$i]->titulo; ?></div> 
                    </div>
                    <?php
                } ?>
            </div>  
           
        </header>  
        <!--
        <nav id="listaNuevos">
            <p>¡Lo más nuevo!</p>
        </nav>
        -->
    <div style="text-align:center">
        <nav id="circulos">
            <a class="zoom" href="Localidad/Ver/">
                <img src="imagenes/index/localidades.png">
            </a>
            <a class="zoom" href="Directorio/Ver/">
                <img src="imagenes/index/directorio_down.png">
            </a>
        </nav>
        
        <fb:like href="http://calvillo.com.mx" layout="button_count" action="like" show_faces="false" share="false"></fb:like>
        <form action="http://www.google.com.mx" id="cse-search-box">
            <div>
              <input type="hidden" name="cx" value="partner-pub-4211453260979774:7651543142" />
              <input type="hidden" name="ie" value="UTF-8" />
              <input type="text" name="q" size="55" />
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
         <div id="social"></div>
   
    </div>
   
    <script type="text/javascript" src="library/jquery-1.10.2.min.js"></script>
    <script src="library/jquery.min.js" type="text/javascript"></script>
    <script src="library/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="library/jquery.mobile.customized.min.js" type="text/javascript"></script>
    <script src="library/camera.min.js" type="text/javascript"></script>

       
        <script src="Scripts/fotoScript.js.php"></script>
        <script>
 jQuery('#galeria').camera({ //here I declared some settings, the height and the presence of the thumbnails 
	height: '30%',
        imagePath: '/imagenes/images/',
	thumbnails: true,
        portrait: true 
});
     
            var fotos=<?php Foto::codificarArreglo($elementos); ?>
            
            var categorias= <?php Categoria::codificarArreglo(Categoria::obtenerTodos('where visible=1')); ?>;
            var nav=$('nav');
                imgDir=path+"/imagenes/Foto/";
            Modelo.prototype.miniaturaIndex=function(){
                //console.log(this.catId);
                var a=$('<a>',{href:path+"/Foto/Ver"+generarLink(this.catId)+'/'+this.link});
                var image=$('<img>',{src:imgDir+this.id+thumb2+this.formato,'class':'zoom'});
                var texto=$('<p>',{text:this.titulo});
                texto.hide();
               a.hover(function(){
                   texto.fadeIn(200);
               },function(){
                   texto.fadeOut(200);
               });
              
                a.append(image,texto);
                return a;
            }
            /*
            var listaNuevos=$('#listaNuevos');
            for(var i=0;i<20;i++){
                listaNuevos.append(fotos[i].miniaturaIndex());
            }
            */
            
            Modelo.prototype.botonCircular=function(){
                var a=$('<a>',{href:"Foto/Ver/"+this.link,'class':'zoom'});
                var image=$('<img>',{src:"imagenes/"+this.tipo+"/"+this.id+'.'+this.formato});
                a.append(image);
                return a;
            }
            for(i=0;i<categorias.length;i++){
                if(categorias[i].catId===0){
                    nav.append(categorias[i].botonCircular());
                }
            }
            var a=$('<a>',{href:"https://www.facebook.com/calvillo.com.mx",'class':'zoom'});
            var image=$('<img>',{src:"imagenes/index/faceCirculo.png"});
            a.append(image);
            nav.append(a);
                
            a=$('<a>',{href:"https://plus.google.com/+FotoscalvilloMx/posts",'class':'zoom'});
            image=$('<img>',{src:"imagenes/index/google-plus.png"});
            a.append(image);
            nav.append(a);
            crearLikeBox();
        </script>
        
    </body>
</html>
