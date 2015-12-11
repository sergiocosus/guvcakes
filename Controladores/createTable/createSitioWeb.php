<?php
include ("../MVC/SQLconexion.php");
SQLconexion::conectar();
$con=  SQLconexion::getConexion();
$sql = "CREATE TABLE sitiosweb
(
id int NOT NULL AUTO_INCREMENT,
titulo varchar(100) NOT NULL,
descripcion text,
formato char(3) NOT NULL,
catId int NOT NULL,
prioridad int NOT NULL default 0,
url varchar(100) NOT NULL,
visible boolean not null default 1,
PRIMARY KEY(id)
)";

if($con->query($sql))
	echo "creado!";
else{
	echo "no creado";
        echo $con->error;
}



