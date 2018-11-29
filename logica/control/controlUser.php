<?php 
include './model/modeloUser.php';
extract($_POST);

if ($_POST['operation']=="save") {
	$objeto = modeloUser::insertInto($name,$passw,$fecha,$fecha,$nivel);
}
// if ($_POST['operation']=="update") {
// 	$objeto = modeloUser::updateInto($name,$passw,$fecha,$fecha,$codigo,$nivel);
// }
if ($_POST['operation']=="delete") {
	$objeto = modeloUser::deleteInto($codigo);
}

 ?>