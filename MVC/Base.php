<?php

include_once 'MVC/SQLconexion.php';
abstract class Base extends SQLconexion{
    public $id;
    public $link;
    public $catId;

    static function obtenerPorCategoria($catId){
        return static::obtenerTodos("WHERE catID = ? AND visible=1",array(&$catId),'i');
    }

    static function obtenerPorId($id){
        return static::obtenerPorCondicion("WHERE id = ?",array(&$id),'i');
    }
    static function obtenerPorLink($link){
        return static::obtenerPorCondicion("WHERE link = ?",array(&$link),'s');
    }
    abstract function  actualizar();
    abstract function  insertar();

    function eliminame(){
        return self::eliminar($this->id);
    }
    static function eliminar($id){
        $result=self::prepare('DELETE FROM '.static::$tabla.' WHERE id=?');
        $result->bind_param('i',$id);
        $result->execute();
        return $result->errno;
    }
    function ocultame(){
        return self::ocultar($this->id);
    }
    
    static function ocultar($id){
        $result=self::prepare('UPDATE '.static::$tabla.' SET visible=0 WHERE id=?');
        $result->bind_param('i',$id);
        $result->execute();
        return $result->errno;
    }
    
    function muestrame(){
        return self::mostrar($this->id);
    }
    
    static function mostrar($id){
        $result=self::prepare('UPDATE '.static::$tabla.' SET visible=1 WHERE id=?');
        $result->bind_param('i',$id);
        $result->execute();
        return $result->errno;
    }
    static function siguienteId(){
        $stmt=self::query('SHOW TABLE STATUS LIKE "'.static::$tabla.'"');
        $row=$stmt->fetch_assoc();
        return $row['Auto_increment'];
    }
}
