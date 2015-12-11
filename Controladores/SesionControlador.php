<?php

class SesionControlador {
    function  accionLogin(){
        if(isset($_POST["usuario"]) && isset($_POST["contrasena"])){
            if($_POST["usuario"]=='Ricardo' && $_POST["contrasena"]=="ricardo2000"){
                session_start();
                $_SESSION["admin"]='ok';
                header("Location: ./Edicion");
            }else{
                header("Location: " . $_SERVER['HTTP_REFERER'].'?error');
            }
            
        }else{
            header("Location: " . $_SERVER['HTTP_REFERER'].'?error');
        }
    }
    function accionLogout(){
        session_destroy();
        header("Location: " . $_SERVER['HTTP_REFERER']);;
    }
    function accionIngresar(){
        include 'Vistas/Sesion/ingresar.php';
    }
    function accionEdicion(){
        session_start();
        if(isset($_SESSION["admin"])){
            include 'Vistas/Sesion/Edicion.php';
        }else{
            header("Location: ./Ingresar");
            SQLconexion::desconectar();
            exit();
        }
    }
}