<?php
include ("../MVC/SQLconexion.php");
SQLconexion::conectar();
$con=  SQLconexion::getConexion();
$sql = "CREATE TABLE directorio
(
id int NOT NULL AUTO_INCREMENT,
titulo varchar(100) NOT NULL,
descripcion text,
formato char(3) NOT NULL,
catId int NOT NULL,
prioridad int NOT NULL,
direccion varchar(100),
telefono varchar(40),
celular varchar(40),
email varchar(60),
website varchar(100),
facebook varchar(100),
youtube varchar(150),
latitud double,
longitud double,

visible boolean not null default 1,
PRIMARY KEY(id)
)";

if($con->query($sql))
	echo "creado!";
else{
	echo "no creado";
        echo $con->error;
}



