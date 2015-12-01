<?php
include_once "Controladores/BaseControlador.php";
class CategoriaControlador extends BaseControlador{ 
    public  $modelo = "Categoria";
    public  $modeloCat = "Categoria";
    public  $imageDir='/imagenes/Categoria/';
    
    function accionVer(){
        include_once "Modelos/$this->modelo.php";
        include_once 'Vistas/Categoria/ver.php';
    }
    
    function accionEditar(){
        sesionIniciada();
        include_once 'Modelos/Categoria.php';
        global $urlArray,$urlArray;
        if(count($urlArray)===2){
            $categorias=Categoria::obtenerTodos('where visible=1');
        }
        include_once 'Vistas/Categoria/editar.php';
    }
    
    
    function accionObtenerHuerfanos(){
        include_once "Modelos/$this->modelo.php";
        $categorias=Categoria::obtenerTodos();
        $catIds=array();
        for($i=0;$i<count($categorias);$i++){
            array_push($catIds,$categorias[$i]->id);
        }
        array_push($catIds,0);
        $categorias=Categoria::obtenerTodos('where visible=1 and catId!='.implode(' and catId!=',$catIds));
        Categoria::codificarArreglo($categorias);
    }
    
     function actualizaInserta($opcion){
        sesionIniciada();
        $modelo=$this->modelo;
        if(isset($_POST['titulo']) &&
            isset($_POST['link']) &&
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
                    $id=$modelo::siguienteId();
                }
                $_POST['formato']=$this->insertarImagen($id,$this->serverPath.'/imagenes',$this->modelo);
                if(!$_POST['formato']){
                    die('-2');
                }
            }  elseif(!isset($_POST['formato'])){
                die('-1');
            }
            $categoria=new $modelo();
            if($opcion==="actualizar")
            $categoria->id=$_POST['id'];
            $categoria->titulo=$_POST['titulo'];
            $categoria->formato=$_POST['formato'];
            if($opcion=="insertar"){
                $link=$_POST['link'];
                $i=0;
                while($modelo::obtenerPorLink($link) != null){
                    $i++;
                    $link=$_POST['link'].'_'.$i;
                }
                $categoria->link=$link;
            }
            $categoria->descripcion=$_POST['descripcion'];
            $categoria->catId=$_POST['catId'];
            $categoria->prioridad=$_POST['prioridad'];
            if(isset($_POST['contiene']))
                $categoria->contiene=1;
            else{
                $categoria->contiene=0;
            }
            if($categoria->$opcion()===""){
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
