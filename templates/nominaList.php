<?php 
session_start();

if (!isset($_SESSION['nivel'])) 
    {header("Location: login.php");}
elseif ($_SESSION['nivel']=="usuario") 
    {header("Location: user/userAccess.php");}
?>

<!DOCTYPE html>
<html>	
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include 'cuerpo/header.php'; ?>
	
			<aside class="main-sidebar">
		  		<?php 
                    if ($_SESSION['nivel']=="Usuario"):
                        include 'cuerpo/userAside.php';  
                    else:
                        include 'cuerpo/aside.php';
                    endif;
                 ?>
		  	</aside>
		
		<div class="content-wrapper">
			<div class="row">				
				<div class="col-md-12">
					<h3 class="e6">Nomina General Del Sistema</h3>
					<div class="col-md-5">
						<label class="e6">Opciones De Filtrado:</label>
						<select class="form-control" id="filtro">
                            <?php
                            	require_once '../logica/control/model/modeloNomina.php';
                            	$resultado = modeloNomina::selectPartial();          
                              	while ($row = $resultado->fetch_array(MYSQLI_NUM))
                              		{echo "<option value ='$row[0]'>$row[0]</option>";}     
                            ?>
	                    </select>
					</div>
					<div class="col-md-2">
						<label class="e6">Dia:</label>
						<select id="dia" class="form-control">
							<option value="15">15</option>
							<option value="31"> 30</option>
						</select>
					</div>
					<div class="col-md-2">
						<label class="e6">Mes:</label>
						<select id="mes" class="form-control">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>			
						</select>
					</div>
					<div class="col-md-2">
						<label class="e6">Año:</label>
						<select id="ano" class="form-control">
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
						</select>
					</div>
				</div>				
			</div>
			
			<div class="col-md-12"  style="overflow: scroll; height: 270px;">
				<div class="table-responsive">
					
					<table class="table table-bordered table-hover" id="table">
						<thead style="background:#07D1E8;">          
							<th style="width: 125px;" >Nombre</th>
							<th class="e3">Cedula</th>                 
							<th class="e3">Cargo</th> 
							<th class="e3">Salario/M</th>
							<th class="e3">Bono</th>
							<th class="e3">B/Vacacional</th>
							<th class="e3">Retroactivo</th>
							<th class="e3">Inasistencias</th>
						</thead>
						<tbody id="tableBody">
							<?php
						$resultado = modeloNomina::selectInto();          
						while ($row = $resultado->fetch_array(MYSQLI_NUM)){   
							echo "<tr class ='rowList'>";  
							echo "<td>$row[0] $row[1]</td>"; 
							echo "<td>$row[2]</td>";  
							echo "<td>$row[3]</td>";  
							echo "<td>$row[4]</td>";
					echo "<td><input  class='x1 form-control' style='width: 85px;height: 23px; display: block;' type='number'></td>";
					echo "<td><input  class='x2 form-control' style='width: 85px;height: 23px; display: block;' type='number'></td>";
					echo "<td><input  class='x3 form-control' style='width: 85px;height: 23px; display: block;' type='number'></td>";
					echo "<td><input  class='x4 form-control' style='width: 85px;height: 23px; display: block;' type='number'></td>";
					echo "</tr>"; }     
						?>  
						</tbody>
					</table>
					
				</div>      
			</div>
			<div class="col-md-12">
				<h4 class="e6">Selectores De Agregado</h3>
				<div class="col-md-3 col-sm-8">
					<label class="">Opciones De Nomina</label>
					<select class="form-control" id="opciones">
						<option value="bono">Bono</option>	
						<option value="vacacional">B/Vacacional</option>
						<option value="retroactivo">Retroactivo</option>
						<option value="inacistencia">Inasistencias</option>
					</select><br>
					<button id="agregar" class="btn btn-primary" title="Selector">
						<i class="fa fa-pencil "  aria-hidden="true"></i>
					</button>
					<button id="generar" class="btn btn-success" title="Generar Nomina">
						<i class="fa fa-database " aria-hidden="true"></i>
					</button>
					<button id="todos"   class="btn btn-warning" title="Refrescar">
						<i class="fa fa-refresh" aria-hidden="true"></i>
					</button>
				</div>
				<div class="col-md-3 col-sm-8">
					<label>Valor General</label>
					<input type="number" id="general" class="form-control">				
				</div>
				<div class="col-md-4" id="msj"></div>
			</div>
		</div> 
	</div>
	<!-- MODAL DE NOMINA EXCEL  -->
	<div class="modal fade" id="excelG">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<button tyle ="button" class="close" data-dismiss="modal" aria-hidden ="true">&times;</button>
	        		<h4 class="modal-title">Generacion De Archivo CSV</h4>         
	      		</div>
	          	<div class="modal-body">                  
	                <form action="../logica/templateExcel.php" method="POST">
	                    <h5><i>Selecione Una Fecha</i></h5>
	                     <select class="form-control" name="fecha">
                            <?php
                              $resultado = modeloNomina::fechasGeneradas();          
                              while ($row = $resultado->fetch_array(MYSQLI_NUM)){   
                                echo "<option value ='$row[0]'>$row[0]</option>";  
                              }     
                            ?>
                        </select><br>
	              		<input type="submit" class="btn btn-primary" value="excel">
	              	</form> 
	          	</div>             
	  		</div>
		</div>
	</div>
	<!-- MODAL DE CONSTANCIA -->
	<div class="modal fade" id="constancia">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<button tyle ="button" class="close" data-dismiss="modal" aria-hidden ="true">&times;</button>
	        		<h4 class="modal-title">Generacion De Constancia</h4>         
	      		</div>
	          	<div class="modal-body">                  
	                <form action="../logica/constanciaPdf.php" method="POST">
	                    <h5><i>Ingrese una cedula para la generacion de constancia</i></h5>
	                    <input type="text" class="form-control" name="cedula"><br>
	              		<input type="submit" class="btn btn-danger" value="Pdf">
	              	</form> 
	          	</div>             
	  		</div>
		</div>
	</div>
<?php include 'cuerpo/footer.php'; ?>   
<script src="../js/nomina.js"></script>
<script>
	let f = new Date();
	
	if(f.getDate()>15){
		document.getElementById('dia').value = 31;
	}else{
		document.getElementById('dia').value = 15;
	}

	document.getElementById('mes').value = f.getMonth()+1;
	document.getElementById('ano').value = f.getFullYear();


</script>
</body>
</html>
