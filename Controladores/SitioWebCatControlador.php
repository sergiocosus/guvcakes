<?php
/**
 * Description of FotoControlador
 *Clase que trabaja todas las acciones de la sección Fotos
 * @author sergio
 */
include_once "Controladores/CategoriaControlador.php";
class SitioWebCatControlador extends CategoriaControlador{
    public  $modelo = "SitioWebCat";
    public  $modeloCat = "SitioWebCat";
    public  $imageDir='/imagenes/SitioWebCat/';
    public  $imgfolder='SitioWebCat';
    
    function accionEditar(){
        $modelo=$this->modelo;
        include_once 'Modelos/SitioWebCat.php';
        global $urlArray,$urlArray;
        if(count($urlArray)===2){
            $categorias=$modelo::obtenerTodos('where visible=1');
        }
        include_once 'Vistas/SitioWeb/editarCat.php';
    }
}
