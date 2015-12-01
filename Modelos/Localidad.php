<?php
/** 
*
* @Clase Foto para obtención, almacenamiento y edicion de las fotografías directamente a la base de datos
* @versión: 0.5      @modificado: 31 de diciembre del 2013
* @autor: Sergio
  @test:OK
*/

include_once("MVC/Base.php");
class Localidad extends Base{
    public static $tabla = "localidades";
    public $id;
    public $link;
    public $titulo;
    public $descripcion;
    public $formato;
    public $catId;
    public $prioridad;
    public $etiqueta;
    
    static function obtenerPorCondicion($condicion,$condiciones,$type){
        $foto = new Localidad();
        $stmt=self::prepare('SELECT id,link,titulo,descripcion,formato,catId,prioridad,etiqueta FROM '.self::$tabla." $condicion");
        if(count($condiciones)!=0)
            call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $condiciones));
        $stmt->bind_result($foto->id,$foto->link,$foto->titulo,$foto->descripcion,$foto->formato,$foto->catId,$foto->prioridad,$foto->etiqueta);
        if($stmt->execute()){
            if ($renglon = $stmt->fetch())      
                return $foto;
        }
        else    
            return null;
    }
        
    static function obtenerTodos($condicion="",$condiciones=array(),$type=""){
        $fotos=array();
        $foto=new Localidad();
        $stmt=self::prepare('SELECT id,link,titulo,formato,catId FROM '.self::$tabla.' '.$condicion.' ORDER BY prioridad,titulo');
        if(count($condiciones)!=0)
            call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $condiciones));
        $stmt->bind_result($foto->id,$foto->link,$foto->titulo,$foto->formato,$foto->catId);
        if($stmt->execute())
            while($stmt->fetch()){
                array_push($fotos,clone $foto);
                $foto=new Localidad();
                $stmt->bind_result($foto->id,$foto->link,$foto->titulo,$foto->formato,$foto->catId);
            }
        else
            return null;
        return $fotos;
    }

    function actualizar(){
        $result=self::prepare('UPDATE '.static::$tabla.' SET titulo=?,descripcion=?,formato=?,catID=?,prioridad=?,etiqueta=? WHERE id=?');
        $result->bind_param('sssiisi',$this->titulo,$this->descripcion,$this->formato,$this->catId,$this->prioridad,$this->etiqueta,$this->id);    
        $result->execute();
        return $result->error; 
    } 
    function insertar(){
        $result=self::prepare('INSERT INTO '.static::$tabla.' (titulo,link,descripcion,formato,catID,prioridad,etiqueta) '
                . 'VALUES (?,?,?,?,?,?,?)');
        $result->bind_param('ssssiis',$this->titulo,$this->link,$this->descripcion,$this->formato,$this->catId,$this->prioridad,$this->etiqueta);
        $result->execute();
        echo $result->error;
        return $result->error;
    }
  
    static function codificarArreglo($fotos){
        echo '[';
        if(count($fotos)>0)
            static::codificarSimple($fotos[0]);
        for($i=1;$i<count($fotos);$i++){
            ?>,<?php static::codificarSimple($fotos[$i]) ?>
        <?php }
        echo ']';
    }
    
    static function codificarSimple($foto){
        ?>Localidad.simple(<?php echo $foto->id; ?>,<?php echo json_encode($foto->link); ?>,<?php echo json_encode($foto->titulo); ?>,<?php echo json_encode($foto->formato); ?>,<?php echo $foto->catId; ?>)<?php
    }
     
    static function codificar($foto){
        ?>new Localidad(<?php echo $foto->id; 
        ?>,<?php echo json_encode($foto->link); 
        ?>,<?php echo json_encode($foto->titulo); 
        ?>,<?php echo json_encode($foto->descripcion); 
        ?>,<?php echo json_encode($foto->formato); 
        ?>,<?php echo $foto->catId; 
        ?>,<?php echo $foto->prioridad; 
        ?>,<?php echo json_encode($foto->etiqueta); 
        ?>)<?php
    }

}
