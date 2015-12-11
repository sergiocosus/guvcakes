<?php 
include_once "Controladores/BaseControlador.php";
class TestControlador extends BaseControlador {
    function accionVer(){
         include_once 'Modelos/Foto.php';
        include_once 'Modelos/Categoria.php';
        $categorias=Categoria::obtenerTodos(' where visible=1');
        $catCant=count($categorias);
     
        $elementos=Foto::obtenerTodos(' where visible=1 ORDER BY fechaSubida desc limit 100');//fechaSubida
        function generarLink($catId,$categorias,$catCant){ 
            for($i=0;$i<$catCant;$i++){
                if($categorias[$i]->id===$catId){
                    return generarLink($categorias[$i]->catId,$categorias,$catCant).'/'.$categorias[$i]->link;
                }
            }
            return "";
        }
        include 'Vistas/Aplicacion/test.php';
    }
    
    function accionFace(){
        include_once 'library/facebook/src/Facebook/autoload.php';
        
        include 'Modelos/Categoria.php';
        include 'Modelos/Foto.php';
        include 'Modelos/DirectorioCat.php';
        include 'Modelos/Directorio.php';
        include 'Modelos/Localidad.php';
        include 'Modelos/LocalidadCat.php';
        
        include_once 'Vistas/Face/index.php';
    }
}     