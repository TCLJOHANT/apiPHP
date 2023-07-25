<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

	include 'conexion.php';
	$pdo = new Conexion();
	$nombraTabla = 'artista';
	//Listar registros y consultar registro
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['id']))
		{
			$sql = $pdo->prepare("SELECT * FROM $nombraTabla WHERE id=:id");
			$sql->bindValue(':id', $_GET['id']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.1 200 hay datos");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			
			$sql = $pdo->prepare("SELECT * FROM $nombraTabla");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.1 200 hay datos");
			echo json_encode($sql->fetchAll());
			exit;		
		}
	}
	
	//Insertar registro
	 if($_SERVER['REQUEST_METHOD'] == 'POST')
	 {
		$data = json_decode(file_get_contents('php://input'), true);
     $nombre = $data['nombre'];
     $genero = $data['genero'];
     $descripcion = $data['descripcion'];
	 	$sql = "INSERT INTO $nombraTabla (nombre, genero, descripcion) VALUES(:nombre, :genero, :descripcion)";
	 	$stmt = $pdo->prepare($sql);
	 	$stmt->bindValue(':nombre', $_POST['nombre']);
	 	$stmt->bindValue(':genero', $_POST['genero']);
	 	$stmt->bindValue(':descripcion', $_POST['descripcion']);
		$stmt->execute();
	 	header("HTTP/1.1 200 Ok");
	 	echo json_encode($pdo->lastInsertId());
	 	exit;
		
	 }
// Insertar registro2
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $data = json_decode(file_get_contents('php://input'), true);
//     $nombre = $data['nombre'];
//     $genero = $data['genero'];
//     $descripcion = $data['descripcion'];
//      $sql = "INSERT INTO $nombraTabla (nombre, genero, descripcion) VALUES(:nombre, :genero, :descripcion)";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(':nombre', $nombre);
//     $stmt->bindValue(':genero', $genero);
//     $stmt->bindValue(':descripcion', $descripcion);
//     $stmt->execute();
//      header("HTTP/1.1 200 Ok");
//     echo json_encode($pdo->lastInsertId());
//     exit;
// }


	//Actualizar registro
	if($_SERVER['REQUEST_METHOD'] == 'PUT')
	 {		
	 	$sql = "UPDATE $nombraTabla SET nombre=:nombre, genero=:genero, descripcion=:descripcion WHERE id=:id";
	 	$stmt = $pdo->prepare($sql);
	 	$stmt->bindValue(':nombre', $_GET['nombre']);
	 	$stmt->bindValue(':genero', $_GET['genero']);
	 	$stmt->bindValue(':descripcion', $_GET['descripcion']);
		$stmt->bindValue(':id', $_GET['id']);
	 	$stmt->execute();
		header("HTTP/1.1 200 Ok");
	 	exit;
	 }
	
	//Eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM $nombraTabla WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");
?>