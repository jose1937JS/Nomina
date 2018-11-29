<?php 
include 'model/ModeloCargo.php';
extract($_POST);

// if ($_POST['operationCharge']=="InsertIntoCharge") {
// 	$objeto = ModeloCargo::insertInto($name,$smensual,$squincenal,$dependency);
// }

if ($_POST['operationCharge']=="UpdateIntoCharge") {
	$objeto = ModeloCargo::updateInto($name,$smensual,$squincenal,$ticket);
}
// if ($_POST['operationCharge']=="DeleteIntoCharge") {
// 	$objeto = modeloCargo::deleteInto($codigoDelete);
// }

 ?>