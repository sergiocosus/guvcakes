<?php
/**
 * Description of LocalidadControlador
 *Clase que trabaja todas las acciones de la sección Localidades
 * @author sergio
 */
include_once "Controladores/BaseControlador.php";
class LocalidadControlador extends BaseControlador {
    public  $modelo = "Localidad";
    public  $modeloCat = "LocalidadCat";
    public  $imageDir='/imagenes/Localidad/';
    function accionVer(){
      $this->vistaArbol();
    }
    
    function accionEditar(){
        $modeloCat=$this->modeloCat;
        include_once "Modelos/$this->modeloCat.php";
        global $urlArray,$urlArray;
        $categorias= $modeloCat::obtenerTodos('where visible=1');
        include_once "Vistas/$this->modelo/editar.php";
    }
    
    
    function actualizaInserta($opcion){
        sesionIniciada();
        $modelo=$this->modelo;
        if(isset($_POST['titulo']) &&
            isset($_POST['link']) &&
            isset($_POST['descripcion']) && 
            isset($_POST['catId']) && is_numeric($_POST['catId']) &&
            isset($_POST['prioridad']) &&  is_numeric($_POST['prioridad']) &&
            isset($_POST['etiqueta']) &&
             ($opcion == "insertar" && isset($_FILES['imagen'])) || ($opcion == "actualizar")
        ){
            include_once 'Modelos/Localidad.php';
            if(isset($_FILES['imagen'])){
                include 'library/Image.php';
                if($opcion=="actualizar"){
                    $id=$_POST['id'];
                }else{
                    $id=Localidad::siguienteId();
                }
                $_POST['formato']=$this->insertarImagen($id,$this->serverPath.'/imagenes','Localidad');                
                        
                if(!$_POST['formato']){
                    die('-2');
                }
            }  elseif(!isset($_POST['formato'])){
                die('-1');
            }
            $foto=new Localidad();
            if($opcion==="actualizar")
                $foto->id=$_POST['id'];
            $foto->titulo=$_POST['titulo'];
            $foto->formato=$_POST['formato'];
            if($opcion=="insertar"){
                $link=$_POST['link'];
                $i=0;
                while($modelo::obtenerPorLink($link) != null){
                    $i++;
                    $link=$_POST['link'].'-'.$i;
                }
                $foto->link=$link;
            }
            $foto->descripcion=$_POST['descripcion'];
            $foto->catId=$_POST['catId'];
            $foto->prioridad=$_POST['prioridad'];
            $foto->etiqueta=$_POST['etiqueta'];
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
