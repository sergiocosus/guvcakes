<?php
/** 
*
* @Clase Categoria para obtención, almacenamiento y edicion de las fotografías directamente a la base de datos
* @versión: 0.5      @modificado: 31 de diciembre del 2013
* @autor: Sergio
  @test:
*
*/

include_once("MVC/Base.php");
class Categoria extends Base{
    public static $tabla = "categorias";
    public $id;
    public $link;
    public $titulo;
    public $descripcion;
    public $formato;
    public $catId;
    public $prioridad;
    public $fechaSubida;
    public $contiene;
   
    static function obtenerPorCondicion($condicion,$condiciones,$type){
        $categoria = new Categoria();
        $stmt=self::prepare('SELECT id,link,titulo,descripcion,formato,catId,prioridad,fechaSubida,contiene FROM '.static::$tabla." $condicion");
        if(count($condiciones)!=0)
            call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $condiciones));
        $stmt->bind_result($categoria->id,$categoria->link,$categoria->titulo,$categoria->descripcion,$categoria->formato,$categoria->catId,$categoria->prioridad,$categoria->fechaSubida,$categoria->contiene);
        if($stmt->execute()){
            if ($renglon = $stmt->fetch())      
                return $categoria;
        }
        else    
            return null;
    }
        
    static function obtenerTodos($condicion="",$condiciones=array(),$type=""){
        $fotos=array();
        $categoria=new Categoria();
        $stmt=self::prepare('SELECT id,link,titulo,descripcion,formato,catId,prioridad,contiene FROM '.static::$tabla.' '.$condicion.' ORDER BY prioridad,titulo');
        if(count($condiciones)!=0)
            call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $condiciones));
        $stmt->bind_result($categoria->id,$categoria->link,$categoria->titulo,$categoria->descripcion,$categoria->formato,$categoria->catId,$categoria->prioridad,$categoria->contiene);
        if($stmt->execute())
            while($stmt->fetch()){
                array_push($fotos,clone $categoria);
                $categoria=new Categoria();
                $stmt->bind_result($categoria->id,$categoria->link,$categoria->titulo,$categoria->descripcion,$categoria->formato,$categoria->catId,$categoria->prioridad,$categoria->contiene);
            }
        else
            return null;
        return $fotos;
    }

    function actualizar(){
        $result=self::prepare('UPDATE '.static::$tabla.' SET titulo=?,descripcion=?,formato=?,catId=?,prioridad=?,fechaSubida=?,contiene=? WHERE id=?');
        $result->bind_param('sssiisii',$this->titulo,$this->descripcion,$this->formato,$this->catId,$this->prioridad,$this->fechaSubida,$this->contiene,$this->id);    
        $result->execute();
        return $result->error; 
    } 
    function insertar(){
        $result=self::prepare('INSERT INTO '.static::$tabla.' (titulo,link,descripcion,formato,catId,prioridad,contiene) '
                . 'VALUES (?,?,?,?,?,?,?)');
        $result->bind_param('ssssiii',$this->titulo,$this->link,$this->descripcion,$this->formato,$this->catId,$this->prioridad,$this->contiene);
        $result->execute();
        return $result->error;
    }
    
    static function codificarArreglo($categorias){
        echo '[';
        if(count($categorias)>0)
            static::codificarCategoriaSimple($categorias[0]);
        for($i=1;$i<count($categorias);$i++){
            ?>,<?php static::codificarCategoriaSimple($categorias[$i]) ?>
        <?php }
        echo ']';       
    }
    
    static function codificarCategoriaSimple($categoria){
        ?>Categoria.simple(<?php echo $categoria->id; ?>,<?php echo json_encode($categoria->link); ?>,<?php echo json_encode($categoria->titulo); ?>,<?php echo json_encode($categoria->descripcion); ?>,<?php echo json_encode($categoria->formato); ?>,<?php echo $categoria->catId; ?>,<?php echo $categoria->contiene; ?>)<?php
    }
     
    static function codificar($categoria){
        ?>new Categoria(<?php echo $categoria->id; 
        ?>,<?php echo json_encode($categoria->link); 
        ?>,<?php echo json_encode($categoria->titulo); 
        ?>,<?php echo json_encode($categoria->descripcion); 
        ?>,<?php echo json_encode($categoria->formato); 
        ?>,<?php echo $categoria->catId; 
        ?>,<?php echo $categoria->prioridad; 
        ?>,<?php echo $categoria->contiene; 
        ?>)<?php
    }
    
   
}
