<?php 
session_start();

if (!isset($_SESSION['nivel'])) 
    {header("Location: login.php");}
elseif ($_SESSION['nivel']=="usuario") 
    {header("Location: user/userAccess.php");}
?>

<!DOCTYPE html>
<html>
    <style>
        .error{
            color: red !important;
        }
    </style>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include 'cuerpo/header.php'; ?>
              <!-- Left side column. contains the logo and sidebar -->
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
                <form action="../logica/control/controlWorker.php" id="form-register" method="POST">
                    <div class="row col-md-offset-1">
                        <h4 class="e1">DATOS PERNONALES DEL EMPLEADO</h4><br><br>
                        <div class="row">
                            <?php if (isset($_GET['valida'])) {
                                echo "<div class='col-md-8 alert alert-danger alert-dismissable'>";
                                echo "<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                                echo "<strong>Danger!</strong>Lo sentimos la cedula ya se encuentra registrada</div>";
                            }?>
                        </div>
                        <div class="col-md-3 col-sm-8">
                            <div class="form-group">
                                <label class="e3" for="name">Nombres Del Empleado:</label>
                                <input name="name" type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label class="e3" for="lastname">Apellidos Del Empleado:</label>
                                <input name="lastname" type="text" class="form-control" id="lastname">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-8">
                            <div class="form-group">
                                <label class="e3" for="cedula">Cedula Del Empleado:</label>
                                <input name="cedula" type="text" class="form-control" id="cedula">
                            </div>
                            <div class="form-group">
                                <label class="e3" for="thelfone">Telefono Del Empleado:</label>
                                <input name="thelfone" type="text" class="form-control" id="thelfone">
                            </div>
                        </div>
                         <div class="col-md-3 col-sm-8">
                            <div class="form-group">
                                <label class="e3" for="address">Direccion Del Empleado:</label>
                                <input name="address" type="text" class="form-control" id="address">
                            </div>
                            <div class="form-group">
                                <label class="e3" for="email">Corre Electronico:</label>
                                <input name="email" type="email" class="form-control" id="email">
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-offset-1">
                        <h4 class="e1"><i>DATOS LABORALES DEL EMPLEADO</i></h4><br>
                        <div class="col-md-3 col-sm-8">
                            <div class="form-group">
                                <label class="e3" for="count">Nº Cuenta Bancaria:</label>
                                <input name="count" type="number" class="form-control" id="count">
                            </div>
                            <div class="form-group">
                                <label class="e3" for="date">FechaIngreso Del Empleado:</label>
                                <input name="date" type="date" id="date" class="form-control">   
                            </div>                           
                        </div>
                        <div class="col-md-3 col-sm-8">
                             <label class="e3" for="charge">Seleccione El Cargo:</label>
                            <select class="form-control" id="charge" name="charge">
                            
                            <?php
                              require_once '../logica/control/model/modeloCargo.php';  
                              $resultado = modeloCargo::selectPartial();          
                              while ($row = $resultado->fetch_array(MYSQLI_NUM)){   
                                echo "<option value ='$row[0]'>$row[0]</option>";  
                              }     
                            ?>
                            </select>  
                        </div>
                         <div class="col-md-3 col-sm-8">
                            <div class="form-group">
                                <label class="e3" for="count">Dependencias:</label>
                                <select class="form-control" name="dependency">
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
                            </div>
                        </div>
                    </div><br>
                    <div class="col-md-offset-1">
                        <input type="hidden" name="operationWorker" value="InsertIntoWorker">
                        <input type="submit" value="GuardarEmpleado" class="btn btn-primary">
                    </div>
                </form>  
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
                                      $resultado = modeloCargo::fechasGeneradas();          
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

        </div>  
        <?php include 'cuerpo/footer.php'; ?>
        <script src="../js/validate.min.js"></script>
        <script src="../js/trabajador.js"></script>
    </body>
</html>
