<?php
include ("../MVC/SQLconexion.php");
SQLconexion::conectar();
$con=  SQLconexion::getConexion();
$sql = "CREATE TABLE localidades
(
id int NOT NULL AUTO_INCREMENT,
link varchar(100) NOT NULL,
titulo varchar(100) NOT NULL,
descripcion text,
formato char(3) NOT NULL,
catId int NOT NULL,
prioridad int NOT NULL default 0,
etiqueta varchar(30) NOT NULL,
visible boolean not null default 1,
PRIMARY KEY(id)
)";

if($con->query($sql))
	echo "creado!";
else{
	echo "no creado";
        echo $con->error;
}



