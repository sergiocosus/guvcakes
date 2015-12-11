<?php
include ("../MVC/SQLconexion.php");
SQLconexion::conectar();
$con=  SQLconexion::getConexion();
$sql = "CREATE TABLE categorias
(
id int NOT NULL AUTO_INCREMENT, 
link  varchar(100) NOT NULL,
titulo varchar(100),
descripcion text,
formato char(3),
catId int,
prioridad int,
fechaSubida timestamp,
contieneFotos boolean not null default 0,
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



