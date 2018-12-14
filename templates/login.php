<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../img/favicon.ico">
</head>
<body>
<div class="container">    
    <h3><i class="col-md-offset-4">Ingreso Al Sistema De Nominas</i></h3>
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Ingreso</div>
            </div>     
      
            <div style="padding-top:30px" class="panel-body" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form  action="../logica/control/IngresoControl.php" method="POST" class="form-horizontal" role="form">
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username">
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" class="btn btn-primary" value="Ingresar">
                            <input type="reset" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>                     
        </div>
    </div>
</div>
</body>
</html>