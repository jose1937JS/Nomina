<?php
/** Incluir la libreria PHPExcel */
require_once '../phpExcel/Classes/PHPExcel.php';
require_once './control/model/modeloNomina.php';
// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

//OBJETO NOMINA
$result = modeloNomina::selectNomina($_POST['fecha']);
$resultado = $result[1];





// Establecer propiedades

$objPHPExcel->getProperties()
->setCreator("Cattivo")
->setLastModifiedBy("Cattivo")
->setTitle("nomina General De Fundesur")
->setSubject("Documento Excel de Prueba")
->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Pruebas de Excel");

//Objeto De Nomina



function cellColor($cells,$color){
		global $objPHPExcel;

		$objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
						 'rgb' => $color
				)
		));
}

//Formato De Texto
$estilo = array(
		'font'  => array(
				'bold'  => true,
				'size'  => 11,
				'name'  => 'Verdana'
		));

$estilo2 = array(
		'font'  => array(
				'bold'  => true,
				'size'  => 10,
				'name'  => 'Arial'
		));

//Titulos De Cabezera

$list1    =["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];
$fecha    = "";
$rango    = explode("-", $_POST['fecha']);
$mes	  = str_replace("0","",$rango[1]);

	if ($rango[2]=="15") 
		{$fecha = "1RA QUINCENA DE ".$list1[$mes-1]." DEL ".$rango[0];}         
	else
		{$fecha = "2DA QUINCENA DE ".$list1[$mes-1]." DEL ".$rango[0];}



$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1',"FUNDESUR")
->setCellValue('A2',"RIF.:J-30666809-8")
->setCellValue('F3',"NOMINA GENERAL DEL PERSONAL FUNDESUR")
->setCellValue('F4',$fecha)
->setCellValue('A5',"Nº")
->setCellValue('B5',"NOMBRE Y APELLIDO")
->setCellValue('C5',"CEDULA")
->setCellValue('D5',"F/ING")
->setCellValue('E5',"CARGO")
->setCellValue('F5',"S/MENSUAL")
->setCellValue('G5',"DEPENDENCIA")
->setCellValue('H5',"S/QUINAL")
->setCellValue('I5',"BONO")
->setCellValue('J5',"BONO VACACIONAL")
->setCellValue('K5',"INASISTENCIA")
->setCellValue('L5',"RECTROACTIVO")
->setCellValue('M5',"TICKETS")
->setCellValue('N5',"F.A.O.V")
->setCellValue('O5',"RET.S.S.O")
->setCellValue('P5',"APT.S.S.O")
->setCellValue('Q5',"QNA");

$listado = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q'];
//Formato De Titulos
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($estilo);
$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($estilo);
$objPHPExcel->getActiveSheet()->getStyle('F3')->applyFromArray($estilo);
$objPHPExcel->getActiveSheet()->getStyle('F4')->applyFromArray($estilo);
//Formato A Las Cabezeras
for ($i=0; $i < count($listado); $i++) { 
	cellColor($listado[$i].'5', 'F28A8C');
	$objPHPExcel->getActiveSheet()->getStyle($listado[$i].'1')->applyFromArray($estilo);	
}


//Formato De Texto A Las Celdas Comunes
$filas = mysqli_num_rows($resultado)+5;


//Alineacion Horizontal
$objPHPExcel->getActiveSheet()->getStyle('A5:Q'.$filas)->getAlignment()->setWrapText(true);


for ($i=0; $i <count($listado); $i++) { 
	for ($j=5; $j <=$filas; $j++) { 			
			$objPHPExcel->getActiveSheet()->getStyle($listado[$i].$j)->applyFromArray($estilo2);
		}	
}


//	Estilos Extra De Titulos De Cabezera

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(24);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(13);

// //Border Estilos
$bordes = array( 
	'borders' => array(
		'inside' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
);

$bordesDefinidos = $filas;
$objPHPExcel->getActiveSheet()->getStyle('A5:Q'.$bordesDefinidos)->applyFromArray($bordes);


function redondear_dos_decimal($valor) { 
   $float_redondeado=round($valor * 100) / 100; 
   return $float_redondeado; 
}


// Agregar Informacion
$i = 6;
$J = 1;

if($result[0] == "31" || $result[0] == "28"):

	while ($row = $resultado->fetch_array(MYSQLI_NUM)) {
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i, $J)
	->setCellValue('B'.$i, $row[0].$row[1])
	->setCellValue('C'.$i, $row[2])
	->setCellValue('D'.$i, $row[3])
	->setCellValue('E'.$i, $row[4])
	->setCellValue('F'.$i, $row[5])
	->setCellValue('G'.$i, $row[6])
	->setCellValue('H'.$i, $row[7])
	->setCellValue('I'.$i, $row[8])
	->setCellValue('J'.$i, $row[9])
	->setCellValue('K'.$i, redondear_dos_decimal($row[10] * ($row[7]/15)))
	->setCellValue('L'.$i, $row[11])
	->setCellValue('M'.$i, $row[12])
	->setCellValue('N'.$i, $row[13])
	->setCellValue('O'.$i, $row[14])
	->setCellValue('P'.$i, $row[15])
	->setCellValue('Q'.$i, $row[16]+$row[12]);
	$i++;
	$J++;
	}
	
endif;

while ($row = $resultado->fetch_array(MYSQLI_NUM)) {
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A'.$i, $J)
->setCellValue('B'.$i, $row[0].$row[1])
->setCellValue('C'.$i, $row[2])
->setCellValue('D'.$i, $row[3])
->setCellValue('E'.$i, $row[4])
->setCellValue('F'.$i, $row[5])
->setCellValue('G'.$i, $row[6])
->setCellValue('H'.$i, $row[7])
->setCellValue('I'.$i, $row[8])
->setCellValue('J'.$i, $row[9])
->setCellValue('K'.$i, redondear_dos_decimal($row[10] * ($row[7]/15)))
->setCellValue('L'.$i, $row[11])
->setCellValue('M'.$i, $row[12])
->setCellValue('N'.$i, $row[13])
->setCellValue('O'.$i, $row[14])
->setCellValue('P'.$i, $row[15])
->setCellValue('Q'.$i, $row[16]);
$i++;
$J++;
}
// Renombrar Hoja

$objPHPExcel->getActiveSheet()->setTitle('NOMINA DE GESTION DE FUNDESUR');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pruebaReal.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>