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
            <form action="../logica/control/controlCharge.php" id="form-register" method="POST">
                <div class="row col-md-offset-1">
                   <h4 class="e1">Administracion De Cargos Del Sistema</h4><br>
                    <div class="col-md-4 col-sm-5">
                        <div class="form-group">
                            <label class="e2" for="name">Nombre Del Cargo:</label>
                            <select class="form-control" id="cargo" name="name">
                                <option value="Administracion">Administrador</option>
                                <option value="Obrero">Obrero</option>
                                <option value="Seguridad">Seguridad</option>
                                <option value="Trasporte">Trasporte</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="e2" for="smensual">Salario Mensual:</label>
                            <input name="smensual" type="number" class="form-control" id="smensual">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-5">                      
                        <div class="form-group">
                            <label class="e2" for="squincenal">Salario Quincenal:</label>
                            <input  type="number" disabled="true" class="form-control" id="fhanton1">
                            <input name="squincenal"  type="hidden" id="squincenal">
                        </div>
                        <label class="e2" for="smensual">Ticket:</label>
                            <input name="ticket" type="number" class="form-control" id="ticket">
                        </div>
                </div><br>
                <div class="row col-md-offset-1">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="e2" for="smensual">F.A.O.V</label>
                            <input  disabled="true" class="form-control" id="faov">
                        </div>
                    </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label class="e2" for="smensual">RET.S.S.O</label>
                            <input  disabled="true" class="form-control" id="retsso">
                        </div>
                    </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label class="e2" for="smensual">APT.S.S.O</label>
                            <input  disabled="true" class="form-control" id="aptsso">
                        </div>
                    </div>
                </div>
                 <div class="col-md-offset-1">
                    <input type="hidden" name="operationCharge" value="UpdateIntoCharge">
                    <input type="submit" id="envio" value="Editar" class="btn btn-primary">
                    <a href='#formulas' data-toggle ='modal' class='btn text-danger bg-danger'>Formulas</a>
                </div><br><br>
                <div class="row col-md-offset-1">
                    <div class="col-md-9">
                        <div class="table-responsive" id="general">
                            <table class="table table-bordered table-hover" id="table">
                                <tr class="info">                                           
                                    <th class="e3">Cod</th>
                                    <th class="e3">Cargo</th>                                                   
                                    <th class="e3">Salario/M</th>
                                    <th class="e3">Salario/Q</th>
                                    <th class="e3">Tickets</th>   
                                </tr>
                            <?php
                            require_once '../logica/control/model/ModeloCargo.php';  
                            $resultado = modeloCargo::selectInto();          
                            while ($row = $resultado->fetch_array(MYSQLI_NUM)){   
                                echo "<tr class ='rowList'>";  
                                echo "<td>$row[0]</td>"; 
                                echo "<td>$row[1]</td>";  
                                echo "<td>$row[2]</td>";  
                                echo "<td>$row[3]</td>";
                                echo "<td>$row[4]</td>";
                                echo "</tr>";  
                              }     
                            ?>  
                            </table>
                        </div>
                    </div>
                </div><br>               
            </form>


        <!-- MODAL DE FORMULAS DEL IVSS -->
        <div class="modal fade" id="formulas">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button tyle ="button" class="close" data-dismiss="modal" aria-hidden ="true">&times;</button>
                        <h4 class="modal-title">Formulas De Seguro Social</h4>         
                    </div>
                    <div class="modal-body">                  
                        <form action="../logica/control/controlUser.php" method="POST">
                            <h5><i>Modal De Edicion De Formulas:</i></h5>
                            <label>F.A.O.V   :<input class="form-control" value="0.01" type="text" id="faov_"></label><br>
                            <label>RET.S.S.O :<input class="form-control" value="0.045" type="text" id="retsso_"></label><br>
                            <label>APT.S.S.O :<input class="form-control" value="0.10" type="text" id="aptsso_"></label><br>
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
                        <form action="../logica/control/controlWorker.php" method="POST">
                            <h5><i>Selecione Una Fecha</i></h5>
                             <select class="form-control" name="fecha">
                                <?php
                                  $resultado = modeloCargo::fechasGeneradas();          
                                  while ($row = $resultado->fetch_array(MYSQLI_NUM)){   
                                    echo "<option value ='$row[0]'>$row[0]</option>";  
                                  }     
                                ?>
                            </select>
                            <input type="hidden" name="choice" value="fechas">
                        </form>
                        <a href="../logica/templateExcel.php">excel</a>  
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
    <script src="../js/cargo.js"></script>
</body>
</html>
