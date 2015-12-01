<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="/calvillo.com.mx/css/foto.css" rel="stylesheet" type="text/css">
    <title>Modo edición de fotografías</title>
   
</head>
<body>
     <h1>Administración de Categorias Sitios web de Calvillo</h1>
    <ul id="infoBar">
    </ul>
    <div id="insertar"></div>
    <div id="listaCategorias"></div><div id="listaFotos"></div>
    <div style="height: 50px"> </div>
    <script type="text/javascript" src="../library/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../library/jquery.exif.js"></script>
    <script type="text/javascript" src="../library/tinymce/tinymce.min.js"></script>
    <script src="../library/jquery.form.min.js"></script>
    <script src="/calvillo.com.mx/Scripts/fotoScript.js"></script>
    <script>
        categorias=<?php SitioWebCat::codificarArreglo($categorias);?>;
        inicializarCategoria("SitioWebCat");    
    </script>
</body>
</html>