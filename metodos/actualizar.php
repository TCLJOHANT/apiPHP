<?php
    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

	include '../conexion.php';
	$pdo = new Conexion();
	$nombreTabla = 'artista';
    	//Actualizar registro
	if($_SERVER['REQUEST_METHOD'] == 'PUT')
    {		
        $sql = "UPDATE $nombreTabla SET nombre=:nombre, genero=:genero, descripcion=:descripcion WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', $_GET['nombre']);
        $stmt->bindValue(':genero', $_GET['genero']);
        $stmt->bindValue(':descripcion', $_GET['descripcion']);
       $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
       header("HTTP/1.1 200 Ok");
        exit;
    }
   

   
   //Si no corresponde a ninguna opción anterior
   header("HTTP/1.1 400 Bad Request");