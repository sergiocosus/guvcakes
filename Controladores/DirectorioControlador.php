<?php
/**
 * Description of FotoControlador
 *Clase que trabaja todas las acciones de la sección Fotos
 * @author sergio
 */
include_once "Controladores/BaseControlador.php";
class DirectorioControlador extends BaseControlador{
    public  $modelo = "Directorio";
    public  $modeloCat = "DirectorioCat";
    public  $imageDir='/imagenes/Directorio/';
   
    function accionVer(){
        $this->vistaArbol();
    }
    
    function accionEditar(){
        sesionIniciada();
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
             ($opcion == "insertar" && isset($_FILES['imagen'])) || ($opcion == "actualizar")
        ){
            include_once "Modelos/$this->modelo.php";
            if(isset($_FILES['imagen'])){
                include 'library/Image.php';
                if($opcion=="actualizar"){
                    $id=$_POST['id'];
                }else{
                    $id=  Directorio::siguienteId();
                }
                $_POST['formato']=$this->insertarImagen($id,$this->serverPath.'/imagenes','Directorio');                
                        
                if(!$_POST['formato']){
                    die('-2');
                }
            }  elseif(!isset($_POST['formato'])){
                die('-1');
            }
            $foto=new Directorio();
            if($opcion==="actualizar")
                $foto->id=$_POST['id'];
            $foto->titulo=$_POST['titulo'];
            $foto->formato=$_POST['formato'];
            $foto->descripcion=$_POST['descripcion'];
            $foto->catId=$_POST['catId'];
            $foto->prioridad=$_POST['prioridad'];
            
            $foto->direccion=$_POST['direccion'];
            $foto->telefono=$_POST['telefono'];
            $foto->celular=$_POST['celular'];
            $foto->email=$_POST['email'];
            $foto->website=$_POST['website'];
            $foto->facebook=$_POST['facebook'];
            $foto->youtube=$_POST['youtube'];
            $foto->latitud=$_POST['latitud'];
            $foto->longitud=$_POST['longitud'];
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
