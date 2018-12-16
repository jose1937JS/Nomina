<?php 
session_start();
 
include './model/conexion.php';
$user 	= $_POST['username'];
$passw 	= $_POST['password'];

if ($user=="" || $passw=="") {header('Location: ../../templates/login.php');}

$link 		= Conexion::enlace();
$sql 		="SELECT nivel FROM usuarios WHERE nombre='$user' AND passw='$passw' AND estado=1";  
$resultado 	= mysqli_query($link,$sql) or trigger_error($mysqli->error."[$sql]");
if ($resultado) 
	{
		$row 	= $resultado->fetch_array(MYSQLI_NUM);
		$actual = getdate();
		$fecha 	= $actual["year"]."-".$actual["mon"]."-".$actual["mday"]; 
		$sql	= "UPDATE usuarios SET  entrada= '$fecha' WHERE nombre='$user' AND passw='$passw'";
		$result = mysqli_query($link,$sql) or trigger_error($mysqli->error."[$sql]");
		if ($result) {
			switch ($row[0]) {
			case 'Administrador':
				$_SESSION['nivel'] = $user;
				header('Location: ../../templates/workerView.php');
				break;
			
			case 'Usuario':
				$_SESSION['nivel'] = "Usuario";
				header('Location: ../../templates/workerView.php');
				break;
			case '':
				header('Location: ../../templates/login.php');
			}

		}
	}







?>