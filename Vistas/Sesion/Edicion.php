
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title></title>
        <style>
            body{
                background-color: rgb(0,90,0);
                padding: 0px;
                margin:0px;
            }
            #ingresar{
                position:absolute;
                display:inline-block;
                top:0px;
                left: 0px;
                right: 0px;
                bottom:0px;
                margin: auto;
                padding:10px;
                background-color: rgba(0,0,0,.5);
                border-radius: 15px;
                width: 300px;
                height: 180px;
                text-align: center;
            }
            #ingresar li{
                 display: inline-block;
                list-style: none;
                margin:0px;
                color:white;
               margin-bottom: 5px;
               border-radius: 5px;
               
            }
            #ingresar li a{
                color:white;
                font-family: Arial;
                
            }
            #ingresar ul{
                padding: 0px;
            }
           #ingresar{
                -webkit-animation: iniciar .5s;
                -moz-animation: iniciar .5s;
                animation: iniciar .5s;
                opacity:1;
                -webkit-transform:transform:scale(5,5);
            }
            #top{
                margin:0px;
                background-color: rgba(0,0,0,.7);
            }
            #top a{
                color:white;
                font-family:Arial;
                font-weight: bolder;
                text-decoration: none;
                font-size: x-large;
                
            }

            @keyframes iniciar{
                from {
                    opacity: 0;
                    transform:scale(5,5);
                }
                to {
                    opacity: 1;
                    transform:scale(1,1);
                }
            }

            @-webkit-keyframes iniciar{
                from {
                    opacity: 0;
                    -webkit-transform:scale(0,0);
                }
                to {
                    opacity: 1;
                    -webkit-transform:scale(1,1);
                }
            }
        </style>
    </head>
    <body>
        <div id='top'>
            <a href='../'>←</a>
        </div>
        <div id="ingresar">
            <ul>
                <li>
                    <a href="../Foto/Editar" >Editar sección <b>Fotos</b></a>
                </li>
                <li>
                    <a href="../Categoria/Editar" >Editar sección <b>Categorias de Fotos</b></a>
                </li>
                <li>
                <!--    <a href="../Directorio/Editar" >Editar sección <b>Directorio</b></a>
                </li>
                <li>
                    <a href="../DirectorioCat/Editar" >Editar sección <b>Categorias de Directorio</b></a>
                </li>
                <li>
                    <a href="../Localidad/Editar" >Editar sección <b>Localidad</b></a>
                </li>
                <li>
                    <a href="../LocalidadCat/Editar" >Editar sección <b>Categorias de Localidad</b></a>
                </li>-->
            </ul>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
