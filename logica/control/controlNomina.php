<?php 
include './model/modeloNomina.php';
extract($_POST);

if ($_POST['choice']=="filtrado") {
	$objeto = modeloNomina::selectByFilter($byFilter);
}

if ($_POST['choice']=="nomina") {
	$objeto = modeloNomina::insertInto($cedula,$bono,$vaciona,$retroac,$faltas,$quincena,$fecha);
}
if ($_POST['choice']=="fechas") {
	$objeto = modeloNomina::generacionExel($fecha);
}

 ?>