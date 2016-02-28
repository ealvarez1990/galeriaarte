<?php
require '../clases/AutoCarga.php';
$bd = new BaseDatos();
$modelo = new ManejoUsuario($bd);
$usuario = $modelo->get(Request::get("email"));
$sesion = new Session();
if (!$sesion->isLogged()) {
    header("Location: ../redireccion/phpredireccion.php");
    exit();
} else {
    if ($sesion->getUser()->getAdministrador() != 1 || $sesion->getUser()->getActivo()!=1) {
        header("Location: ../redireccion/phpredireccion.php");
    } else {
        ?>
        <!DOCTYPE HTML>
        <html>
            <head>
                <title>Admin</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
                <!-- Bootstrap Core CSS -->
                <link href="../css/bootstrap.min.css" rel='stylesheet' type='text/css' />
                <!-- Custom CSS -->
                <link href="../css/style.css" rel='stylesheet' type='text/css' />
                <!-- Graph CSS -->
                <link href="../css/lines.css" rel='stylesheet' type='text/css' />
                <link href="../css/font-awesome.css" rel="stylesheet"> 
                <!-- jQuery -->
                <script src="../js/jquery.min.js"></script>
                <!----webfonts--->
                <link href='//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
                <!---//webfonts--->    
                <!-- Nav CSS -->
                <link href="../css/custom.css" rel="stylesheet">
                <!-- Metis Menu Plugin JavaScript -->
                <script src="../js/metisMenu.min.js"></script>
                <script src="../js/custom.js"></script>
                <!-- Graph JavaScript -->
                <script src="../js/d3.v3.js"></script>
                <script src="../js/rickshaw.js"></script>
            </head>
            <body>
                <div id="wrapper">
                    <?php include '../paginas/nav.php'; ?>
                    <div id="page-wrapper">
                        <div class="graphs">
                            <div class="col_3">
                                <div class="col-md-3 widget widget1">
                                    <span><h3><i class="fa fa-user">&nbsp;</i>Usuario:&nbsp;<?= $sesion->getUser()->getAlias(); ?> </h3></span>
                                </div>
                                <div class="tab-pane active" id="horizontal-form">
                                    <form class="form-horizontal" method="post" action="phpeditar.php">
                                        <div class="form-group">
                                        </div>
                                        <div class="form-group">
                                            <label for="focusedinput" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-8">
                                                <input  type="text" name="email" value="<?= $sesion->getUser()->getEmail() ?>" class="form-control1" id="focusedinput" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword" class="col-sm-2 control-label">Clave</label>
                                            <div class="col-sm-8">
                                                <input type="hidden" name="clave" value="<?= $sesion->getUser()->getClave() ?>" class="form-control1" id="inputPassword" placeholder="Password" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAlias" class="col-sm-2 control-label">Alias</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $sesion->getUser()->getAlias() ?>" name="alias" class="form-control1" id="inputAlias" placeholder="Password">
                                            </div>
                                        </div>

                                        <?php
                                        $fechayhora = $sesion->getUser()->getFecha_alta();
                                        $fecha = substr($fechayhora, 0, 10);
                                        $hora = substr($fechayhora, 11, 19);
                                        ?>
                                        <div class="form-group">
                                            <label for="inputFecha" class="col-sm-2 control-label">Fecha de Alta</label>
                                            <div class="col-sm-8">
                                                <input type="date" name="fecha" value="<?= $fecha; ?>" class="form-control1" id="inputFecha">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputHora" class="col-sm-2 control-label">Hora de Alta</label>
                                            <div class="col-sm-8">
                                                <input type="time" name="hora" value="<?= $hora; ?>" class="form-control1" id="inputHora">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="checkbox" class="col-sm-2 control-label">Activo</label>
                                            <div class="col-sm-8">
                                                <div class="checkbox-inline1">
                                                    <?php
                                                    if ($sesion->getUser()->getActivo() == 1) {
                                                        echo '<label><input name="activo" type="checkbox" value="1" checked> Marcar para activar</label></div>';
                                                    } else {
                                                        ?>
                                                        <label><input name="activo" type="checkbox" value="1">Marcar para activar</label></div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="checkbox" class="col-sm-2 control-label">Personal</label>
                                            <div class="col-sm-8">
                                                <div class="checkbox-inline">
                                                    <?php
                                                    if ($sesion->getUser()->getPersonal() == 1) {
                                                        echo '<label><input name="personal" type="checkbox" value="1" checked> Marcar para acceso personal</label></div>';
                                                    } else {
                                                        ?>
                                                        <label><input name="personal" type="checkbox" value="1"> Marcar para acceso personal</label></div>
                                                    <?php
                                                }
                                                ?>  
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="checkbox" class="col-sm-2 control-label">Administrador</label>
                                            <div class="col-sm-8">
                                                <div class="checkbox-inline">
                                                    <?php
                                                    if ($sesion->getUser()->getAdministrador() == 1) {
                                                        echo '<label><input name="administrador" type="checkbox" value="1" checked> Marcar para acceso ADMIN</label></div>';
                                                    } else {
                                                        ?>
                                                        <label><input name="administrador" type="checkbox" value="1"> Marcar para acceso ADMIN</label></div>
                                                    <?php
                                                }
                                                ?>  
                                            </div>
                                        </div>

                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <input type="submit" class="btn-success btn">
                                                    <input type="reset" class="btn-default btn">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /#page-wrapper -->
                    </div>
                           <?php
        include '../paginas/footer.php';
    }
}?>