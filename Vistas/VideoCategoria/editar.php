<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type=text/css" href="../css/foto.css"/>
    <title>Modo edición de categorias</title>
</head>
<body>
    <h1>Categorias</h1>
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
        var categorias=<?php VideoCategoria::codificarArreglo($categorias); ?>;
        inicializarCategoria();
            
        
    </script>
</body>
</html> 
