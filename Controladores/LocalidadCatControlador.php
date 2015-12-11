<?php
/**
 * Description of FotoControlador
 *Clase que trabaja todas las acciones de la sección Fotos
 * @author sergio
 */
include_once "Controladores/CategoriaControlador.php";
class LocalidadCatControlador extends CategoriaControlador{
    public  $modelo = "LocalidadCat";
    public  $modeloCat = "LocalidadCat";
    public  $imageDir='/imagenes/LocalidadCat/';
    public  $imgfolder='LocalidadCat';
    
    function accionEditar(){
        sesionIniciada();
        include_once 'Modelos/LocalidadCat.php';
        global $urlArray,$urlArray;
        if(count($urlArray)===2){
            $categorias=LocalidadCat::obtenerTodos('where visible=1');
        }
        include_once 'Vistas/Localidad/editarCat.php';
    }
}
