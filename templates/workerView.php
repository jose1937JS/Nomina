<?php 
session_start();

if (!isset($_SESSION['nivel'])) 
    {header("Location: login.php");}

?>
<!DOCTYPE html>
<html>  
  	<body class="hold-transition skin-blue sidebar-mini" >
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
			<div class="content-wrapper" style="height: 808px !important;">
				<div class="col-md-12">
			   		<h3 class="e6">Listado de trabajadores en nomina.</h3><br>
                    
                    <?php 
                        if(isset($_GET['INFOR']) && $_GET['INFOR'] == "Edit"){
                            echo "<div class='alert alert-success'>";
                            echo "<strong>Exito!</strong> Edicion Realizada!.";
                            echo "</div>";              
                        }
                     ?>
                      <?php 
                        if(isset($_GET['INFOR']) && $_GET['INFOR'] == "Insert" ){
                            echo "<div class='alert alert-success'>";
                            echo "<strong>Exito!</strong> Registro Ingresado!.";
                            echo "</div>";              
                        }
                     ?>                   
					<div class="table-responsive" id="general">
					  	<table class="table table-bordered table-hover" id="table">
							<tr class="info">          
								<th style="width: 125px; display: block;">Nombre</th>
								<th class="e3">Cedula</th>
								<th class="e3">Telefono</th>
								<th class="e3">Dependencia</th>                 
								<th class="e3">Correo</th> 
								<th class="e3">Cuenta</th>
								<th class="e3">Cargo</th>
								<th style="width: 125px; display: block;" class="e3">Operaciones</th>   
							</tr>
						<?php
						require_once '../logica/control/model/ModeloTrabajador.php';						
						$resultado = modeloTrabajador::selectNomina();          
						while ($row = $resultado->fetch_array(MYSQLI_NUM)){   
							echo "<tr class ='rowList'>";  
							echo "<td>$row[0] $row[1]</td>"; 
							echo "<td>$row[2]</td>";  
							echo "<td>$row[3]</td>";  
							echo "<td>$row[4]</td>";
							echo "<td>$row[5]</td>";
							echo "<td>$row[6]</td>";
							echo "<td>$row[7]</td>";
							echo "<td>
                                      <a href='#modalEdit' onclick='change(true);' data-toggle ='modal' class='btn text-info bg-info'>
                                          <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                                      </a>
                                      <a onclick ='change(false);' href='#modalDelete' data-toggle ='modal' class='btn text-danger bg-danger'>
                                          <i class='fa fa-trash-o' aria-hidden='true'></i> </a>
                                  </td>";
							echo "</tr>";  
						  }     
					  	?>  
					 	</table>              
				  	</div>
			   	</div> 
	  		</div>
	  	</div>
	  	<div class="modal fade" id="modalEdit">
          	<div class="modal-dialog">
	            <div class="modal-content">
	              	<div class="modal-header">
	                	<button tyle ="button" class="close" data-dismiss="modal" aria-hidden ="true">&times;</button>
		                <h4 class="modal-title">EDICION DEL TRABAJADOR</h4>         
	              	</div>
	              	<div class="modal-body">
		                <form action="../logica/control/controlWorker.php" method="POST">                    

			                Nombre: 	<input class="form-control" type="text" id="name" name="name"><br>
			                Apellidos: 	<input class="form-control" type="text" id="lastname" name="lastname"><br>
			              	Cedula: 	<input class="form-control" disabled="true" type="text" id="fhanton"><br>
			              				<input class="form-control" type="hidden" id="cedula" name="cedula" >    <br>
			                Telefono: 	<input class="form-control" type="number" id="thelfone" name="thelfone"><br>
			                Correo: 	<input class="form-control" type="email" id="email" name="email"><br>
			                Cuenta: 	<input class="form-control" type="number" id="count" name="count" >    <br>
			                Cargo Ejercido:<select class="form-control" id="charge" name="charge">            <br>  
			                <?php
	                        	$resultado2 = modeloTrabajador::selectPartial();  
		                        while ($row = $resultado2->fetch_array(MYSQLI_NUM)){echo "<option value ='$row[0]'>$row[0]</option>";}      
                            ?>
		                  	</select>
                            <br>

                            Dependencias:  <select class="form-control" id="dependency" name="dependency">
                                    <option value="CCSEDUCCALABOZO">CCS. DE LA EDUC.CALABOZO</option>
                                    <option value="POSTGRADOCALABOZO">POSTGRADO CALABOZO</option>
                                    <option value="SERVICIOSGENERALESCE">SERVICIOS GENERALES C.E</option>
                                    <option value="CICNCIAS ECONOMICAS">CICNCIAS ECONOMICAS</option>
                                    <option value="CIENCIAS">CIENCIAS</option>
                                    <option value="FUNDACLIU">FUNDACLIU</option>
                                    <option value="RADIODIAGNOSTICO">RADIODIAGNOSTICO</option>

                                    <option value="DIRDEPORTES">DIR DEPORTES</option>
                                    <option value="SERVICIOGENERALS">SERVICIOS GENERALES</option>
                                    <option value="SERRESERMED">SERV.RESERV.MED</option>
                                    <option value="FUNDESUR">FUNDESURG</option>
                                    <option value="EMISORA98">EMISORA 92.7FM</option>
                                    <option value="DIRCULTURA">DIR CULTURA</option>
                                    <option value="BIBLIOTECAINFORM">BIBLIOTECA INFORMATICA</option>

                                    <option value="SERVATENESTUDIANTIL">SERVI(ATC.ESTUDIANTIL)</option>
                                    <option value="RADIODIAGNOSTICO(PASANTI)">RADIODIAGN(PASANTI)</option>
                                    <option value="DPTSALUDMENTAL">DPT SALUD MENTAL</option>
                                    <option value="ODONTOLOGIA">ODONTOLOGIA</option>
                                    <option value="RECTORADO">RECTORADO</option>
                                    <option value="POSGRADOAPURE">POSGRADOAPURE</option>
                                    <option value="CENTROPRODUCCRUMINATES">CETNROPRODUCC.RUMIANTES</option>

                                    <option value="VALLELAPASCUA">VALLE DE LA PASCUA</option>
                                    <option value="LABMICROBIOLOGIAAGRONOMI">LAB.MICROBIOLOGIA AGRNOMI</option>
                                    <option value="CONTROLESTUDIOSCASONA">CONTROL ESTUDIO CASONA</option>
                                    <option value="VICRECTORADADOADMINISTRA">VIC.RECTORADOADMINISTRA</option>
                                    <option value="MAPIRE">MAPIRE</option>
                                    <option value="AREADERECHOCALABAZO">AREA DERECHO CALABOZO</option>
                                    <option value="MISIOSUCRE">MISIO SUCRE</option>
                                </select>
		                  	<input type="hidden" name="operationWorker" value="UpdateIntoWorker"><br><br>                
		                  	<input type="submit" class="btn btn-primary" value="Editar" name="">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		              	</form>  
	              	</div>             
	          	</div>
	        </div>
    	</div>
    	<div class="modal fade" id="modalDelete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button tyle ="button" class="close" data-dismiss="modal" aria-hidden ="true">&times;</button>
                        <h4 class="modal-title">Eliminacion De Trabajador</h4>         
                    </div>
                    <div class="modal-body">                  
                        <form action="../logica/control/controlWorker.php" method="POST">
                            <h5><i>SEGURO QUE DESEA ELIMINAR EL TRABAJADOR:</i></h5>
                            <input type="text" id="nameWorker" class="form-control" >                    
                            <input type="hidden" name="operationWorker" value="DeleteIntoWorker">
                            <input type="hidden" name="codigo" id="cedulaDelete" ><br><br>
                            <input type="submit" class="btn btn-primary" value="Eliminar" name="">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>                                  
                        </form>  
                    </div>             
                </div>
            </div>
        </div>
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
                                  $resultado = modeloTrabajador::fechasGeneradas();          
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
	<script src="../js/listado.js"></script>
  </body>
</html>
