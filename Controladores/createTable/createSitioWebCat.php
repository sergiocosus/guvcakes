<?php
include ("../MVC/SQLconexion.php");
SQLconexion::conectar();
$con=  SQLconexion::getConexion();
$sql = "CREATE TABLE sitioswebcat
(
id int NOT NULL AUTO_INCREMENT, 
link  varchar(100) NOT NULL,
titulo varchar(100),
descripcion text,
formato char(3),
catId int,
prioridad int,
fechaSubida timestamp,
contiene boolean not null default 0,
visible boolean not null default 1,
PRIMARY KEY(id,link)
)";

if($con->query($sql))
	echo "creado!";
else{
	echo "no creado";
        echo $con->error;
}



