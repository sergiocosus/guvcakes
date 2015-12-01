<?php
/**
 * Description of LocalidadControlador
 *Clase que trabaja todas las acciones de la sección Localidades
 * @author sergio
 */
include_once "Controladores/BaseControlador.php";
class SitioWebControlador extends BaseControlador {
    public  $modelo = "SitioWeb";
    public  $modeloCat = "SitioWebCat";
    public  $imageDir='/imagenes/SitioWeb/';
    function accionVer(){
        include_once "Modelos/$this->modelo.php";
        include_once "Modelos/$this->modeloCat.php";
        include_once "Vistas/$this->modelo/ver.php";
    }
    
    function accionEditar(){
        $modeloCat=$this->modeloCat;
        include_once "Modelos/$this->modeloCat.php";
        global $urlArray,$urlArray;
        if(count($urlArray)===2){
            $categorias= $modeloCat::obtenerTodos('where visible=1');
        }
        include_once "Vistas/$this->modelo/editar.php";
    }
    
    
    function actualizaInserta($opcion){
        sesionIniciada();
        if(isset($_POST['titulo']) &&
            isset($_POST['descripcion']) && 
            isset($_POST['catId']) && is_numeric($_POST['catId']) &&
            isset($_POST['prioridad']) &&  is_numeric($_POST['prioridad']) &&
            isset($_POST['url']) &&
             ($opcion == "insertar" && isset($_FILES['imagen'])) || ($opcion == "actualizar")
        ){
            include_once 'Modelos/SitioWeb.php';
            if(isset($_FILES['imagen'])){
                include 'library/Image.php';
                if($opcion=="actualizar"){
                    $id=$_POST['id'];
                }else{
                    $id=SitioWeb::siguienteId();
                }
                $_POST['formato']=$this->insertarImagen($id,$this->serverPath.'/imagenes','SitioWeb');                
                        
                if(!$_POST['formato']){
                    die('-2');
                }
            }  elseif(!isset($_POST['formato'])){
                die('-1');
            }
            $foto=new SitioWeb();
            if($opcion==="actualizar")
                $foto->id=$_POST['id'];
            $foto->titulo=$_POST['titulo'];
            $foto->formato=$_POST['formato'];
            $foto->descripcion=$_POST['descripcion'];
            $foto->catId=$_POST['catId'];
            $foto->prioridad=$_POST['prioridad'];
            $foto->url=$_POST['url'];
            if($foto->$opcion()===""){
                echo '0';
            }else{
                echo "-3";
            }
         }
         else{
             echo "-4";
         }
    }
    
   
}
