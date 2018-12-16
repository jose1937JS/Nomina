<?php 

include 'conexion.php';
class modeloCargo extends Conexion
{
	// public static function insertInto($nombre,$smensual,$squincenal)
	// {
	// 	$link = self::enlace();
	// 	$sql = "INSERT INTO cargos(nombre, smensual,squincenal,estado) VALUES ('$nombre',$smensual,$squincenal,1)";
	// 	$result = mysqli_query($link,$sql) or trigger_error($mysqli->error."[$sql]");	
	// 	if ($result){header("Location: ../../templates/chargeRegister.php");}
	// 	else{echo "kdjfkls";}

	// }
	
	public static function selectInto()
	{

		$link = self::enlace();
		$sql ="SELECT id,nombre,smensual,squincenal,tickets FROM cargos WHERE estado=1";  
		$resultado = mysqli_query($link,$sql);		
		return $resultado;
	}

	public static function fechasGeneradas(){
		$link = self::enlace();
		$sql ="SELECT DISTINCT fecha FROM nomina";  
		$resultado = mysqli_query($link,$sql);
		return $resultado;
	}	

	public static function selectPartial()
	{

		$link = self::enlace();
		$sql ="SELECT nombre FROM cargos WHERE estado=1";  
		$resultado = mysqli_query($link,$sql);		
		return $resultado;
	}
	

	public static function updateInto($name,$smensual,$squincenal,$ticket)
	{
		$link = self::enlace();
		$sql="UPDATE cargos SET nombre='$name',smensual='$smensual',squincenal='$squincenal',tickets=$ticket WHERE nombre='$name'";
		// echo $sql;
		$resultado = mysqli_query($link,$sql);
		if($resultado){header("Location: ../../templates/chargeRegister.php");}
		else{echo "kdjfkls";}
	}
 	
 // 	public static function deleteInto($codigo)
	// {
	// 	$link = self::enlace();
	// 	$sql="UPDATE cargos SET estado = 0  WHERE id= $codigo";
	// 	$result = mysqli_query($link,$sql) or trigger_error($mysqli->error."[$sql]");
	// 	if($result){header("Location: ../../templates/chargeRegister.php");}
	// 	else{echo "kdjfkls";}
	// }
}
?>