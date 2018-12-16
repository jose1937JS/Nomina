<?php 

include 'conexion.php';
class modeloUser extends Conexion
{
	public static function insertInto($name,$passw,$fecha,$date,$nivel)
	{
		$link = self::enlace();		
		$sql = "INSERT INTO usuarios(nombre,passw,fechac,entrada,nivel,estado) VALUES ('$name','$passw','$fecha','$date','$nivel',1)";
		$result = mysqli_query($link,$sql) or trigger_error($mysqli->error."[$sql]");	
		if ($result){header("Location: ../../templates/userRegister.php");}
		else{echo "kdjfkls";}

	}
	
	public static function selectInto()
	{

		$link = self::enlace();
		$sql ="SELECT id,nombre,passw,nivel,fechac,entrada FROM usuarios WHERE estado=1";  
		$resultado = mysqli_query($link,$sql);		
		return $resultado;
	}

	public static function fechasGeneradas(){
		$link = self::enlace();
		$sql ="SELECT DISTINCT fecha FROM nomina";  
		$resultado = mysqli_query($link,$sql);
		return $resultado;
	}	


	

	// public static function updateInto($name,$passw,$fecha,$date,$codigo,$nivel)
	// {
	// 	$link = self::enlace();
	// 	$sql="UPDATE usuarios SET nombre='$name',passw='$passw',fechac='$fecha',entrada='$date',nivel='$nivel' WHERE id=$codigo";
	// 	$resultado = mysqli_query($link,$sql);
	// 	if($resultado){header("Location: ../../templates/chargeRegister");}
	// 	else{echo "kdjfkls";}
	// }
 	
 	public static function deleteInto($codigo)
	{
		$link = self::enlace();
		$sql="UPDATE usuarios SET estado = 0  WHERE id= $codigo";
		$result = mysqli_query($link,$sql) or trigger_error($mysqli->error."[$sql]");
		if($result){header("Location: ../../templates/userRegister.php");}
		else{echo "kdjfkls";}
	}
}
?>