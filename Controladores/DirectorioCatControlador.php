<?php
/**
 * Description of FotoControlador
 *Clase que trabaja todas las acciones de la sección Fotos
 * @author sergio
 */
include_once "Controladores/CategoriaControlador.php";
class DirectorioCatControlador extends CategoriaControlador{
    public  $modelo = "DirectorioCat";
    public  $modeloCat = "DirectorioCat";
    public  $imageDir='/imagenes/DirectorioCat/';
    public  $imgfolder='DirectorioCat';
    
    function accionEditar(){
        sesionIniciada();
        include_once 'Modelos/DirectorioCat.php';
        global $urlArray,$urlArray;
        if(count($urlArray)===2){
            $categorias=DirectorioCat::obtenerTodos('where visible=1');
        }
        include_once 'Vistas/Directorio/editarCat.php';
    }
}
