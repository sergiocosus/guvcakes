<?php 
class AplicacionControlador {
    //Acció Index que muestra el menú principal que está en la vista index de la carpeta Aplicacion
    function accionIndex(){
        include_once 'Modelos/Foto.php';
        include_once 'Modelos/Categoria.php';
        $categorias=Categoria::obtenerTodos(' where visible=1');
        $catCant=count($categorias);
        function generarLink($catId,$categorias,$catCant){
            for($i=0;$i<$catCant;$i++){
                if($categorias[$i]->id===$catId){
                    return generarLink($categorias[$i]->catId).'/'.$categorias[$i]->link;
                }
            }
            return "";
        }
        include_once 'Vistas/Aplicacion/index.php';
        
        
    }
    
 
}   