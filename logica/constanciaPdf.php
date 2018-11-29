<?php ob_start();
require_once 'Dompdf/autoload.inc.php';
use Dompdf\Dompdf;


include './control/model/modeloNomina.php';
include './numeroTo_Text.php';


$resultado 	= modeloNomina::constancia($_POST['cedula']);
$row 		= $resultado->fetch_array(MYSQLI_NUM);

$objeto 	= new  NumberToLetterConverter();
$saldo 		= $objeto->to_word((int)$row[5]);
$fecha    	= explode("-", $row[3]);
//--------------------------------------------------
$list    =["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];
$var	 = str_replace("0","",$fecha[1]);
$mes 	 = $list[$var-1];
//--------------------------------------------------
$hoy = getdate();


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>	
</head>
<body onload="imprecion();">

<div>
	<div >
		<h1 style="margin-top: 195px; font-weight: 100 ; text-align: center;"><b>CONSTANCIA</b></h1>
		<br><br>
		<div>
			<article style=" text-align: center;">
				<p style="font-size: 22px; text-align: justify; line-height: 29px;">
					Por medio de la presente, se hace constar que el ciudadano/ana, <b><?php echo $row[0]." ".$row[1]; ?></b>, Portador de la Cédula de Identidad Nº <b>V-<?php echo $row[2]; ?></b>, Presta servicios en el proceso social de trabajo como, <b>PERSONAL DE <?php echo $row[4]; ?></b>, en la Fundación Para el Desarrollo de la Universidad Rómulo Gallegos (FUNDESURG), bajo la relación de Contrato a tiempo determinado, según el artículo N° 62 de la Ley Orgánica del Trabajo, de los Trabajadores y Trabajadoras, devengando  un  sueldo mensual de Bolívares <b><?php echo $saldo ?></b> <b>(<?php echo $row[5]; ?>)</b>,  desde el <?php echo $fecha[2] ?> de <?php echo $mes ?> del <?php echo $fecha[0] ?>
					Constancia que se expide a solicitud de parte interesada en San Juan de los Morros, a los <?php echo $hoy['mday'] ?>  Días del mes de <?php echo $list[$hoy['mon']-1]; ?> del Año <?php echo $hoy['year']; ?>.			
					<p style="text-align: center;">Atentamente</p><br>
					<div style="margin-left: 38%;"><p style="width: 165px; border-bottom: 2px solid black;"></p></div><br><br>
					<div style="text-align: center;"><b>Lcdo. José Ulises Armario</b></div><br>
					<div style="text-align: center;"><b>ADMINISTRADOR </b></div>
				</p>
			</article>
		</div>
	</div>
</div>
</body>
</html>

<?php 
    $dompdf = new Dompdf();
    $dompdf -> load_html(ob_get_clean());   
    $dompdf -> set_paper('A4','portrait'); 
    $dompdf -> render(); 
    $dompdf->stream();         
 
?>