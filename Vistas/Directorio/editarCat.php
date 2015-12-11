<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="../css/foto.css" rel="stylesheet" type="text/css">
    <title>Modo edición de fotografías</title>
   
</head>
<body>
    <h1>Administración de categorias del Directorio</h1>
    <ul id="infoBar">
    </ul>
    <div id="insertar"></div>
    <div id="listaCategorias"></div><div id="listaFotos"></div>
    <div style="height: 50px"> </div>
    <script type="text/javascript" src="../library/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../library/jquery.exif.js"></script>
    <script type="text/javascript" src="../library/tinymce/tinymce.min.js"></script>
    <script src="../library/jquery.form.min.js"></script>
    <script src="../Scripts/fotoScript.js"></script>
    <script>
        categorias=<?php DirectorioCat::codificarArreglo($categorias);?>;
        inicializarCategoria("DirectorioCat");    
    </script>
</body>
</html>