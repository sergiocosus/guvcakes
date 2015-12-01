<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <?php
            global $path,$path;
            $seccion='Fotos';
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
                    <div id="flechaMiniAnterior">
                        <img src="<?php echo $path; ?>/imagenes/flecha.png" class="rot180"/>
                    </div>
                    <nav id="listaMiniFotos"></nav>
                    <div id="flechaMiniSiguiente">
                        <img src="<?php echo $path; ?>/imagenes/flecha.png" class="opacity" />
                    </div>
                </div>
                <h1>
                    <?php
                    if($elemento!==null){
                        echo $elemento->titulo;
                    }elseif($categoria!==null){
                        echo $categoria->titulo;
                    }else{
                        echo 'Fotografías del Sitio';
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
                    <img <?php if($elemento!=null) {echo 'src="',$path,'/imagenes/Foto/'.$elemento->id.".".$elemento->formato.'"';} ?>/>
                    <div id="cargando" >
                        <img src="<?php echo $path; ?>/imagenes/cargando.gif"/>
                    </div>

                    <date>
                        <?php if($elemento!=null) {echo $elemento->fechaTomada;} ?>
                    </date>
                </div>

                <nav id="listaMiniaturas">
                </nav>

                <article>
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
            <div id="recomendaciones"></div>
        </div>
            
        <script type="text/javascript" src="<?php echo $path; ?>/library/jquery-1.10.2.min.js"></script>
        <script src="<?php echo $path; ?>/library/jquery.mobile.custom.min.js"></script>
        <script src="<?php echo $path; ?>/Scripts/fotoScript.min.js"></script>
        <script src="<?php echo $path; ?>/Scripts/galeriaFotos.min.js"></script>
        <script>
            var categorias= <?php Categoria::codificarArreglo($categorias); ?>;
            var elementos=<?php Foto::codificarArreglo($elementos); ?>;
            var elemento=<?php  if($elemento!=null)Foto::codificar($elemento); else echo 'null'; ?>;
            var categoria=<?php  if($categoria!=null)Categoria::codificar($categoria); else echo 'null'; ?>;    
            
            imgDir=path+"/imagenes/";
        
            var galeria=new GaleriaDeFotos();
            galeria.inicializar();
            inicializarSocial(false);
            $(window).on('resize',function(){
                if($('#fotoGrande  > img').attr('src')!=undefined)
                    $('#fotoGrande').height(window.innerHeight-160);
            });
            if($('#fotoGrande > img').attr('src')!=undefined)
                $('#fotoGrande').height(window.innerHeight-160);
        </script>
    </body>
</html>
