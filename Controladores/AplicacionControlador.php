<?php 
class AplicacionControlador {
    //Acció Index que muestra el menú principal que está en la vista index de la carpeta Aplicacion
    function accionIndex(){
         
         include_once 'Modelos/Foto.php';
        include_once 'Modelos/Categoria.php';
        $categorias=Categoria::obtenerTodos(' where visible=1');
        $catCant=count($categorias);
     
        $elementos=Foto::obtenerTodos(' where visible=1 ORDER BY rand() desc limit 100');//fechaSubida
        function generarLink($catId,$categorias,$catCant){ 
            for($i=0;$i<$catCant;$i++){
                if($categorias[$i]->id===$catId){
                    return generarLink($categorias[$i]->catId,$categorias,$catCant).'/'.$categorias[$i]->link;
                }
            }
            return "";
        }
        include 'Vistas/Aplicacion/index.php';
        
    }
    
 
}   