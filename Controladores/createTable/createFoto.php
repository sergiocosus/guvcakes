<?php
include ("../MVC/SQLconexion.php");
SQLconexion::conectar();
$con=  SQLconexion::getConexion();
$sql = "CREATE TABLE fotos
(
id int NOT NULL AUTO_INCREMENT, 
link  varchar(100) NOT NULL,
titulo varchar(100),
descripcion text,
formato char(3),
catID int,
prioridad int,
fechaSubida timestamp,
fechaTomada timestamp,
visible boolean not null default 1,
PRIMARY KEY(id,link)
)";
/*
$sql = "CREATE TABLE maotts
(
id int NOT NULL AUTO_INCREMENT, 
idUsuario int,
texto char(140),
fecha datetime,
PRIMARY KEY(id)
)";
 */
// Execute query
if($con->query($sql))
	echo "creado!";
else{
	echo "no creado";
        echo $con->error;
}
