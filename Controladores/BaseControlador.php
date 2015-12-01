<?php
/**
 * Description of BaseControlador
 *
 * @author sergio
 */
abstract class BaseControlador {
    public  $modelo;
    public  $modeloCat;
    public  $imageDir;
    public $serverPath='/home/u899649304/public_html';
    protected function vistaArbol(){
        include_once "Modelos/$this->modelo.php";
        include_once "Modelos/$this->modeloCat.php";
        $modeloCat=$this->modeloCat;
        $modelo=$this->modelo;
        $elementos=[];
        $categoria=$elemento=null;
        global $urlArray,$urlArray;
        $urlCount=count($urlArray);
        $ultimo=$urlArray[$urlCount-1];
        
        $categorias=$modeloCat::obtenerTodos('where visible=1');
      
        $elemento=$modelo::obtenerPorLink($ultimo);
        if($elemento==null){
            if($ultimo!=='Ver'){
                $categoria=$modeloCat::obtenerPorLink($ultimo);
                if($categoria->contiene){
                $elementos=$modelo::obtenerTodos('where visible=1 and catId=?', array(&$categoria->id), "i");
            }
            }else {
                $categoria=new $modeloCat();
                $categoria->titulo=$this->modelo;
                $categoria->contiene=0;
                $categoria->id=0;
                $categoria->descripcion='Directorio de negocios calvillenses';
                $categoria->catId=0;
                $categoria->formato=0;
                $categoria->prioridad=0;
                $categoria=null;
            }
            
        }else{
        $elementos=$modelo::obtenerTodos('where visible=1 and catId=?', array(&$elemento->catId), "i");
        }
        include_once "Vistas/$this->modelo/ver.php";
    }
    
    
    function accionInsertar(){
        $this->actualizaInserta("insertar");
    }
    
    function accionOcultar(){
        $this->accionPorId('ocultar');
    }
    
    function accionMostrar(){
        $this->accionPorId('mostrar');
    }
    
    function accionEliminar(){
        echo $_POST['id'];
        if(isset($_POST['id']) && is_numeric($_POST['id'])
              && isset($_POST['formato'])){
            $id=$_POST['id'];
            $formato=$_POST['formato'];
            
            echo @unlink($this->serverPath.$this->imageDir.$id.'.'.$formato);
            echo @unlink($this->serverPath.$this->imageDir.$id.'-thumb.'.$formato);
            echo @unlink($this->serverPath.$this->imageDir.$id.'-thumb2.'.$formato);
            echo @unlink($this->serverPath.$this->imageDir.$id.'-p.'.$formato);
            echo @unlink($this->serverPath.$this->imageDir.$id.'-m.'.$formato);
            echo @unlink($this->serverPath.$this->imageDir.$id.'-g.'.$formato);
            $this->accionPorId('eliminar');
        }else{
            echo '-4';
        }
    }
    
    function accionActualizar(){
         $this->actualizaInserta("actualizar");
    }

    function accionObtener(){
        $modelo=$this->modelo;
        include_once "Modelos/$this->modelo.php";;
        if( isset($_POST['id']) && is_numeric($_POST['id']) ) {
            $foto=$modelo::obtenerPorId($_POST['id']);
            $modelo::codificar($foto);
        }else{
            die('Error');
        }
    }
    function accionObtenerPorCategoria(){
        $modelo=$this->modelo;
        include_once "Modelos/$this->modelo.php";
        if( isset($_POST['catId']) && is_numeric($_POST['catId']) ) {
            $fotos=$modelo::obtenerPorCategoria($_POST['catId']);
            $modelo::codificarArreglo($fotos);
        }else{
            die('Error');
        }
    }
    
     function accionObtenerOcultos(){
        $modelo=$this->modelo;
        include_once "Modelos/$this->modelo.php";
        $fotos=$modelo::obtenerTodos("WHERE visible = 0");
        $modelo::codificarArreglo($fotos);
        
    }
    
    function accionObtenerHuerfanos(){
        $modelo=$this->modelo;
        $modeloCat=$this->modeloCat;
        include_once "Modelos/$this->modelo.php";
        include_once "Modelos/$this->modeloCat.php";
        $categorias=$modeloCat::obtenerTodos('where contiene=1');
        $catIds=array();
        for($i=0;$i<count($categorias);$i++){
            array_push($catIds,$categorias[$i]->id);
        }
        
        $fotos=$modelo::obtenerTodos('where catId!='.implode(' and catId!=',$catIds));
        $modelo::codificarArreglo($fotos);
    }
    
    function accionPorId($opcion){
        sesionIniciada();
        $modelo=$this->modelo;
        if(isset($_POST['id']) && is_numeric($_POST['id'])){
            include_once "Modelos/$this->modelo.php";
            if($modelo::$opcion($_POST['id'])==0){
                echo "0";
            }else{
                echo "1";
            }
        }else{
            echo '2';
        }
    }
    
   function insertarImagen($nombreFinal,$directorio,$carpeta,$file='imagen'){
        if (save($file, "$directorio/$carpeta/", $nombreFinal)) {
            $final=explode('.', $_FILES[$file]['name']);
            $extension = strtolower(end($final));
            cropAndSave("$directorio/$carpeta/$nombreFinal.$extension", "$directorio/$carpeta/$nombreFinal-thumb", 75, 75); //original 65x65
            resizeAndSave("$directorio/$carpeta/$nombreFinal.$extension", "$directorio/$carpeta/$nombreFinal-thumb2", 144, 108); //20% más que 120x90
            resizeAndSave("$directorio/$carpeta/$nombreFinal.$extension", "$directorio/$carpeta/$nombreFinal-p", 320, 240); 
            resizeAndSave("$directorio/$carpeta/$nombreFinal.$extension", "$directorio/$carpeta/$nombreFinal-m", 640, 480); 
            resizeAndSave("$directorio/$carpeta/$nombreFinal.$extension", "$directorio/$carpeta/$nombreFinal-g", 1280, 1024); 
            
            return $extension;
        } else {
            return false;
        }
    }
}
