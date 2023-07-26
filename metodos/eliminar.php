<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

	include '../conexion.php';
	$pdo = new Conexion();
	$nombreTabla = 'artista';
		//Eliminar registro
        if($_SERVER['REQUEST_METHOD'] == 'DELETE')
        {
            $sql = "DELETE FROM $nombreTabla WHERE id=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $_GET['id']);
            $stmt->execute();
            header("HTTP/1.1 200 Ok");
            exit;
        }