<?php 

include 'conexion.php';
class modeloNomina extends Conexion
{
	public static function insertInto($cedula,$bono,$vaciona,$retroac,$faltas,$quincena,$fecha)
	{
		$link = self::enlace();
		
		$sql 		="SELECT id FROM trabajadores WHERE cedula='$cedula'";  
		$resultado 	= mysqli_query($link,$sql);
		$row 		= $resultado->fetch_array(MYSQLI_NUM);

		//LOGICA DE LA ESTRUCTURA DE LOS SALARIOS
		$faov 		= $quincena*0.01;
		$retsso 	= $quincena*0.045;
		$aptsso 	= 1;
		$perDay 	= $quincena/15;
		$descuento 	= $perDay*$faltas;
		$salario	= round($quincena-$descuento, 2);
		$pagos_solci= $faov+$retsso+$aptsso;
		$salario 	= $salario+$bono+$vaciona+$retroac-$pagos_solci;
		
		//INSERTION ON THE DATABASE


		$sql = "INSERT INTO nomina(bono,bono_vac,inasistencia,retroactivo,faov,retsso,idtrabajador,fecha,aptsso,qna) VALUES ($bono,$vaciona,$faltas,$retroac,$faov,$retsso,$row[0],'$fecha',$aptsso,$salario)";
		
		// echo $sql;
		$result = mysqli_query($link,$sql) or trigger_error($mysqli->error."[$sql]");	
		if ($result){echo "Nomina Generada Correctamente!";}
		else{echo "Fallo De Insertion";}

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


	public static function selectNomina($fecha)
	{		
		$fechas = explode("-", $fecha); 
		$link 	= self::enlace();
		$sql 	="SELECT t.nombre, t.apellido,t.cedula,t.fechaingreso,c.nombre,c.smensual,t.dependencia,c.squincenal,n.bono,n.bono_vac,n.inasistencia,n.retroactivo,c.tickets,n.faov,n.retsso,n.aptsso,n.qna FROM trabajadores as t INNER JOIN cargos as c ON t.idcargos=c.id INNER JOIN nomina as n ON t.id=n.idtrabajador WHERE t.estado=1 AND n.fecha = '$fecha'";  
		$resultado = mysqli_query($link,$sql);		
		return array($fechas[2],$resultado);
	}

	public static function selectInto()
	{

		$link 	= self::enlace();
		$sql 	="SELECT t.nombre, t.apellido, t.cedula,c.nombre,c.smensual  FROM trabajadores as t INNER JOIN cargos as c ON t.idcargos=c.id      WHERE   t.estado=1";  
		$resultado = mysqli_query($link,$sql);		
		return $resultado;
	}

	public static function selectByFilter($byFilter)
	{

		$link = self::enlace();
		$sql = "SELECT t.nombre, t.apellido, t.cedula,c.nombre,c.smensual  FROM trabajadores as t INNER JOIN cargos as c ON t.idcargos=c.id      WHERE   t.estado=1  AND c.nombre='$byFilter'";     
		$resultado = mysqli_query($link,$sql);		
		$matrix = [];$cont=0;
		while ($row = $resultado->fetch_array(MYSQLI_NUM)){ 
			$matrix[$cont] = $row;
			$cont++; 
		}
		echo json_encode($matrix);

	}

	public static function selectObrero()
	{

		$link = self::enlace();
		$sql = "SELECT t.nombre, t.apellido, t.cedula,c.nombre,c.smensual  FROM trabajadores as t INNER JOIN cargos as c ON t.idcargos=c.id      WHERE   t.estado=1  AND c.nombre='Obrero'";     
		$resultado = mysqli_query($link,$sql);		
		$matrix = [];$cont=0;
		while ($row = $resultado->fetch_array(MYSQLI_NUM)){ 
			$matrix[$cont] = $row;
			$cont++; 
		}
		echo json_encode($matrix);

	}

	public static function constancia($cedula)
	{

		$link = self::enlace();
		$sql = "SELECT t.nombre, t.apellido, t.cedula,t.fechaingreso,c.nombre,c.smensual FROM trabajadores as t INNER JOIN cargos as c ON t.idcargos=c.id WHERE t.estado=1 AND t.cedula='$cedula'";     
		$resultado = mysqli_query($link,$sql);		
		return $resultado;	
	}



}
?>