<?php 
include 'conexion.php';
class modeloTrabajador extends Conexion
{
	public static function insertInto($nombre,$apellido,$cedula,$telefono,$direccion,$correo,$cuenta,$fecha,$cargo,$dependency)
	{

		$link = self::enlace();

		$sql ="SELECT id FROM trabajadores WHERE cedula='$cedula'";  
		$resultado = mysqli_query($link,$sql);
		$row = $resultado->fetch_array(MYSQLI_NUM);
		if ($row[0]!="") {header('Location: ../../templates/workerRegister.php?valida="7"');}

		$sql ="SELECT id FROM cargos WHERE nombre='$cargo'";  
		$resultado = mysqli_query($link,$sql);
		$row = $resultado->fetch_array(MYSQLI_NUM);

	//Busqueda De Registros De Insertion

		$sql="INSERT INTO trabajadores(nombre, apellido, cedula, telefono, direccion, correo, cuenta,fechaingreso, idcargos,dependencia,".
			"estado) VALUES ('$nombre','$apellido','$cedula','$telefono','$direccion','$correo','$cuenta','$fecha',$row[0],'$dependency',1)";				
		$result = mysqli_query($link,$sql) or trigger_error($mysqli->error."[$sql]");	
		if ($result){header("Location: ../../templates/workerView.php?INFOR=Insert");}
		else{}

	}
	
	public static function selectPartial()
	{

		$link = self::enlace();
		$sql ="SELECT nombre FROM cargos WHERE estado=1";  
		$resultado = mysqli_query($link,$sql);		
		return $resultado;
	}

	public static function fechasGeneradas(){
		$link = self::enlace();
		$sql ="SELECT DISTINCT fecha FROM nomina";  
		$resultado = mysqli_query($link,$sql);
		return $resultado;
	}	
	
	public static function selectNomina()
	{

		$link = self::enlace();
		$sql ="SELECT trabajadores.nombre, apellido,cedula,telefono,dependencia,correo,cuenta,cargos.nombre FROM trabajadores INNER JOIN cargos ON 	trabajadores.idcargos=cargos.id WHERE trabajadores.estado = 1";  
		$resultado = mysqli_query($link,$sql);
		return $resultado;
	}
	

	public static function updateInto($nombre,$apellido,$cedula,$telefono,$correo,$cuenta,$cargo,$dependency)
	{		
		$link = self::enlace();
		$sql ="SELECT id FROM cargos WHERE nombre='$cargo'";  
		$result = mysqli_query($link,$sql);
		$row = $result->fetch_array(MYSQLI_NUM);
		$sql = "UPDATE trabajadores as T INNER JOIN cargos as C ON T.idcargos=C.id SET T.nombre='$nombre',T.apellido='$apellido',T.cedula='$cedula',T.telefono='$telefono',T.correo='$correo',T.cuenta='$cuenta',T.dependencia='$dependency', T.idcargos='$row[0]' WHERE T.cedula = '$cedula'"; 
		// echo $sql;
		$resultado = mysqli_query($link,$sql);
		if($resultado){header("Location: ../../templates/workerView.php?INFOR=Edit");}
	}
 	
 	public static function deleteInto($delete)
	{
		$link = self::enlace();
		$sql="UPDATE trabajadores SET estado = 0 WHERE cedula= '$delete'";
		$result = mysqli_query($link,$sql) or trigger_error($mysqli->error."[$sql]");
		if($result){header("Location: ../../templates/workerView.php");}

	}



}

 ?>