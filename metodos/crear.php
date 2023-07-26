<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

	include '../conexion.php';
	$pdo = new Conexion();
	$nombreTabla = 'artista';
	
//Insertar registro
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$sql = "INSERT INTO $nombreTabla (nombre, genero, descripcion) VALUES(:nombre, :genero, :descripcion)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':nombre', $_POST['nombre']);
	$stmt->bindValue(':genero', $_POST['genero']);
	$stmt->bindValue(':descripcion', $_POST['descripcion']);
	$stmt->execute();
	$idPost = $pdo->lastInsertId(); 
	if($idPost)
	{
		header("HTTP/1.1 200 Ok");
		echo json_encode($idPost);
		exit;
	}
}

?>