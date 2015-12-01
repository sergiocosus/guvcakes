<?php

class SQLconexion {
    static private $db;
    static function conectar(){
        if(self::$db = new mysqli("localhost","root","root","guvcakes")){
            mysqli_set_charset(self::$db, "utf8");  
            return "Conexión correcta";
        }else{
            die("No hay conexión a la base de gatos");
            header('Location: error-conexion.php');
            return 0;
        }
        
    }
    
    static function desconectar(){
        self::$db->close();
    }
    static function getConexion(){
        return self::$db;
    }
    static function query($consulta){
        return self::$db->query($consulta);
    }
    static function prepare($consulta){
        $stmt=self::$db->stmt_init();
        $stmt->prepare($consulta);
        return $stmt; 
    }
}
