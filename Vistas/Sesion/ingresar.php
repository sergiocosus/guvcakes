<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
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
                width: 200px;
                height: 100px;
                text-align: center;
            }
            #ingresar input, #ingresar button{
                display:block;
                width: 100%;
                height: 100%;
               margin-bottom: 5px;
               border-radius: 5px;
            }
            #ingresar span{
                color:white;
                font-family: Arial;
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
            <form method="post" action="Login">
                <span>Iniciar Sesión</span>
                <input name="usuario" type="text" placeholder="Nombre de usuario"/>
                <input name="contrasena" type="password" placeholder="Contraseña" />
                <button type="submit"> Iniciar sesión </button>
                <?php 
                    if(isset($_GET['error']))
                        echo '<span>Datos inválidos! :(</span>';
                 
                 
                    ?>
            </form>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
