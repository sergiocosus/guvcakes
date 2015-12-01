<!--  <?php /*
if($elemento!=null){
    $descripcion=strip_tags($elemento->descripcion);
    $titulo=$elemento->titulo;
    
    $imagen='http://calvillo.com.mx/imagenes/'.$modelo.'/'.$elemento->id.'-g.'.$elemento->formato;
}
else{
    $descripcion=  strip_tags($categoria->descripcion);
    $titulo=$categoria->titulo;
    $imagen='http://calvillo.com.mx/imagenes/'.$modeloCat.'/'.$categoria->id.'-g.'.$categoria->formato;
}
if($seccion=='Fotos'){
    $cat=Categoria::obtenerPorId($elemento->catId);
    if($cat!=null){
        $titulo=$cat->titulo.' - '. $titulo;
        $cat=Categoria::obtenerPorId($cat->catId);
        if($cat!=null){
            $titulo=$cat->titulo.' - '. $titulo;
        }
    }
   
}else{
    $titulo=$seccion.' - '.$titulo;
}
*/?>
<meta property="fb:app_id" content="151504458379563"/>    
<meta property="og:type" content="website" />
<meta property="fb:admins" content="100000361134459,donchecoscs" />
<meta property="og:url" content="<?php /*echo dameURL(); */?>"/>
<meta property="og:description" content="<?php /*echo $descripcion; */?>"/>
<meta property="og:image" content="<?php /*echo $imagen; */?>" />
<link href="<?php /*echo $imagen; */?>" rel="image_src" />
<meta property="og:title" content="<?php /*echo $titulo; */?> - Calvillo.com.mx" />
<title><?php /*echo $titulo; */?> - Calvillo.com.mx</title>-->