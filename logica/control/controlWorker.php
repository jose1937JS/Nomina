<?php 
include './model/ModeloTrabajador.php';

extract($_POST);



if ($_POST['operationWorker']=="InsertIntoWorker") {
	$objeto = ModeloTrabajador::insertInto($name,$lastname,$cedula,$thelfone,$address,$email,$count,$date,$charge,$dependency);	
}

if ($_POST['operationWorker']=="UpdateIntoWorker") {
	$objeto = modeloTrabajador::updateInto($name,$lastname,$cedula,$thelfone,$email,$count,$charge,$dependency);
		
}
if ($_POST['operationWorker']=="DeleteIntoWorker") {
	$objeto = modeloTrabajador::deleteInto($codigo);
}
 
?>