<?php
/** 
*
* @Clase Foto para obtención, almacenamiento y edicion de las fotografías directamente a la base de datos
* @versión: 0.5      @modificado: 31 de diciembre del 2013
* @autor: Sergio
  @test:OK
*/

include_once("MVC/Base.php");
class Directorio extends Base{
    public static $tabla = "directorio";
    public $id;
    public $titulo;
    public $descripcion;
    public $formato;
    public $catId;
    public $prioridad;
    public $direccion;
    public $telefono;
    public $celular;
    public $email;
    public $website;
    public $facebook;
    public $youtube;
    public $latitud;
    public $longitud;
    
    
    
    static function obtenerPorCondicion($condicion,$condiciones,$type){
        $foto = new Directorio();
       
        $stmt=self::prepare('SELECT id,titulo,descripcion,formato,catId,prioridad,direccion,telefono,celular,email,website,facebook,youtube,latitud,longitud FROM '.self::$tabla." $condicion");
      //  var_dump($stmt->error);
        if(count($condiciones)!=0)
            call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $condiciones));
        $stmt->bind_result($foto->id,$foto->titulo,$foto->descripcion,$foto->formato,$foto->catId,$foto->prioridad,$foto->direccion,$foto->telefono,$foto->celular,$foto->email,$foto->website,$foto->facebook,$foto->youtube,$foto->longitud,$foto->latitud);
        if($stmt->execute()){
            if ($renglon = $stmt->fetch())      
                return $foto;
        }
        else    
            return null;
    }
        
    static function obtenerTodos($condicion="",$condiciones=array(),$type=""){
        $fotos=array();
        $foto=new Directorio();
        $stmt=self::prepare('SELECT id,titulo,formato,catId FROM '.self::$tabla.' '.$condicion.' ORDER BY prioridad,titulo');
        if(count($condiciones)!=0)
            call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $condiciones));
        $stmt->bind_result($foto->id,$foto->titulo,$foto->formato,$foto->catId);
        if($stmt->execute())
            while($stmt->fetch()){
                array_push($fotos,clone $foto);
                $foto=new Directorio();
                $stmt->bind_result($foto->id,$foto->titulo,$foto->formato,$foto->catId);
            }
        else
            return null;
        return $fotos;
    }

    function actualizar(){
        $result=self::prepare('UPDATE '.static::$tabla.' SET titulo=?,descripcion=?,formato=?,catId=?,prioridad=?,direccion=?,telefono=?,celular=?,email=?,website=?,facebook=?,youtube=?,latitud=?,longitud=? WHERE id=?');
        $result->bind_param('sssiisssssssssi',$this->titulo,$this->descripcion,$this->formato,$this->catId,$this->prioridad,$this->direccion,$this->telefono,$this->celular,$this->email,$this->website,$this->facebook,$this->youtube,$this->longitud,$this->latitud,$this->id);    
        $result->execute();
        return $result->error; 
    } 
    function insertar(){
        $result=self::prepare('INSERT INTO '.static::$tabla.' (titulo,descripcion,formato,catId,prioridad,direccion,telefono,celular,email,website,facebook,youtube,latitud,longitud) '
                . 'VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $result->bind_param('sssiisssssssss',$this->titulo,$this->descripcion,$this->formato,$this->catId,$this->prioridad,$this->direccion,$this->telefono,$this->celular,$this->email,$this->website,$this->facebook,$this->youtube,$this->longitud,$this->latitud);    
        $result->execute();
        return $result->error;
    }
  
    static function codificarArreglo($fotos){
        echo '[';
        if(count($fotos)>0)
            static::codificarFotoSimple($fotos[0]);
        for($i=1;$i<count($fotos);$i++){
            ?>,<?php static::codificarFotoSimple($fotos[$i]) ?>
        <?php }
        echo ']';
    }
    
    static function codificarFotoSimple($foto){
        ?>Directorio.simple(<?php echo $foto->id; ?>,<?php echo json_encode($foto->titulo); ?>,<?php echo json_encode($foto->formato); ?>,<?php echo $foto->catId; ?>)<?php
    }
     
    static function obtenerPorLink($link){
        return null;
    }
    static function codificar($foto){
        ?>new Directorio(<?php echo $foto->id; 
        ?>,<?php echo json_encode($foto->titulo); 
        ?>,<?php echo json_encode($foto->descripcion); 
        ?>,<?php echo json_encode($foto->formato); 
        ?>,<?php echo json_encode($foto->catId); 
        ?>,<?php echo json_encode($foto->prioridad); 
        ?>,<?php echo json_encode($foto->direccion);
        ?>,<?php echo json_encode($foto->telefono);
        ?>,<?php echo json_encode($foto->celular);
        ?>,<?php echo json_encode($foto->email);
        ?>,<?php echo json_encode($foto->website);
        ?>,<?php echo json_encode($foto->facebook);
        ?>,<?php echo json_encode($foto->youtube);
        ?>,<?php echo json_encode($foto->latitud);
        ?>,<?php echo json_encode($foto->longitud);
        
        ?>)<?php
    }

}
