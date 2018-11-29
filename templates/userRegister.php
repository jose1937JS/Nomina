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
             <form action="../logica/control/controlUser.php" id="form-register" method="POST">
                <div class="row col-md-offset-1">
                   <h4 class="e1">Registro De Usuarios Al Sistema</h4><br>                                       
                    <div class="col-md-4 col-sm-5">
                        <div class="form-group">
                            <label class="e2" for="name">Nombre Del Usuario:</label>
                            <input name="name" type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label class="e2" for="smensual">Clave Del Usuario:</label>
                            <input name="passw" type="text" class="form-control" id="passw">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-5">                      
                        <div class="form-group">
                            <label class="e2" for="squincenal">Fecha De Creacion:</label>
                            <input  type="text" disabled="true" class="form-control" id="fhanton1">
                            <input name="fecha"  type="hidden" id="fecha">
                        </div>
                        <div class="form-group">
                            <label class="e2" for="squincenal">Nivel De Permisos:</label>
                            
                            <select name="nivel" class="form-control">
                                <option value="Administrador">Administrador</option>
                                <option value="Usuario">Usuario</option>
                            </select>                            
                        </div>
                    </div>                  
                </div><br>
                <div class="row col-md-offset-1">
                    <h4 class="e1">Listado De Usuarios</h4>
                    <div class="col-md-9" style="overflow: scroll; height: 240px;">
                        <div class="table-responsive" id="general">
                            <table class="table table-bordered table-hover" id="table">
                                <tr class="info">                                           
                                    <th class="e3">Cod</th>
                                    <th class="e3">Usuario</th>                                                     
                                    <th class="e3">Clave</th>
                                    <th class="e3">Nivel</th>
                                    <th class="e3">Creado</th>
                                    <th class="e3">Entrada</th>
                                    <th class="e3">Delete</th>   
                                </tr>
                            <?php
                            require_once '../logica/control/model/modeloUser.php';  
                            $resultado = modeloUser::selectInto();          
                            while ($row = $resultado->fetch_array(MYSQLI_NUM)){   
                                echo "<tr class ='rowList'>";  
                                echo "<td>$row[0]</td>"; 
                                echo "<td>$row[1]</td>";  
                                echo "<td>$row[2]</td>";  
                                echo "<td>$row[3]</td>";
                                echo "<td>$row[4]</td>";
                                echo "<td>$row[5]</td>";
                                echo "<td><a href='#modalDelete' data-toggle ='modal' class='btn text-danger bg-danger'> <i class='fa fa-trash-o' aria-hidden='true'></i> </a></td>";
                                echo "</tr>";  
                              }     
                            ?>  
                            </table>
                        </div>
                    </div>
                </div><br>
                <div class="col-md-offset-1">
                    <input type="hidden" name="operation" value="save">
                    <input type="submit" id="envio" value="GuardarUsuario" class="btn btn-primary">
                </div>
            </form>
        </div>
      <!--   <div class="modal fade" id="modalEdit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button tyle ="button" class="close" data-dismiss="modal" aria-hidden ="true">&times;</button>
                        <h4 class="modal-title">Edicion Del Usuario</h4>         
                    </div>
                    <div class="modal-body">
                        <form action="../logica/control/controlCharge.php" method="POST">                    

                            Nombre:     <input class="form-control" type="text" id="user" name="name">
                            Password:   <input class="form-control" type="number" id="passwd" name="passw">
                            <input type="hidden" name="codigo" id="codigo">
                            <input type="hidden" name="operation" value="update"><br><br>
                            <input type="submit" class="btn btn-primary" value="Editar" name="">                     
                        </form>  
                    </div>             
                </div>
            </div>
        </div> -->
        <div class="modal fade" id="modalDelete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button tyle ="button" class="close" data-dismiss="modal" aria-hidden ="true">&times;</button>
                        <h4 class="modal-title">Eliminacion De Usuario</h4>         
                    </div>
                    <div class="modal-body">                  
                        <form action="../logica/control/controlUser.php" method="POST">
                            <h5><i>SEGURO QUE DESEA ELIMINAR EL USUARIO:</i></h5>
                            <input type="text" id="chargeName" class="form-control" >                    
                            <input type="hidden" name="operation" value="delete">
                            <input type="hidden" name="codigo" id="codigoDelete" ><br><br>
                            <input type="submit" class="btn btn-primary" value="Eliminar" name="">                                  
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
                                  $resultado = modeloUser::fechasGeneradas();          
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
    <script>
      $(document).ready(function(){
            let fhamton = document.getElementById("fhanton1"),
            fecha   = document.getElementById("fecha");

           
            var f = new Date();
            let date = f.getFullYear()+ "-" + (f.getMonth() +1) + "-" +f.getDate() ;
            fhamton.value   = date;
            fecha.value     = date;
            
            $(".rowList").click(function(){
            let i = $(this).index();              
            document.getElementById("chargeName").value= table.rows[i].cells[1].innerHTML;
            document.getElementById("codigoDelete").value= table.rows[i].cells[0].innerHTML;  
        });
      })
    </script>
</body>
</html>
