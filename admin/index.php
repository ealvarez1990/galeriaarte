<?php
require '../clases/AutoCarga.php';
$bd = new BaseDatos();
$modelo = new ManageUser($bd);
$usuario = new Usuario();
$usuarios = $modelo->getList();
$sesion = new Session();

if (!$sesion->isLogged()) {
    header("Location: ../frontend/index.php");
    exit();
} else {
    if ($sesion->getUser()->getAdministrador() != 1 || $sesion->getUser()->getActivo() != 1) {
         header("Location: ../frontend/index.php");
    } else {
        ?>
        <!DOCTYPE HTML>
        <html>
            <head>
                <title>Admin</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                 <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

                <!-- MetisMenu CSS -->
                <link href  ="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        
                <!-- Timeline CSS -->
                <link href  ="../dist/css/timeline.css" rel="stylesheet">
        
                <!-- Custom CSS -->
                <link href  ="../dist/css/sb-admin-2.css" rel="stylesheet">
        
                <!-- Morris Charts CSS -->
                <link href  ="../bower_components/morrisjs/morris.css" rel="stylesheet">
        
                <!-- Custom Fonts -->
                <link href  ="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
                <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                <!--[if lt IE 9]>
                <script src ="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src ="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->
                <!-- jQuery -->
                <script src ="../bower_components/jquery/dist/jquery.min.js"></script>
        
                <!-- AngularJS -->
                <script src ="../js/jquery.js"></script>
        
                <!-- Bootstrap Core JavaScript -->
                <script src ="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
                <!-- Metis Menu Plugin JavaScript -->
                <script src ="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
        
                <!-- Morris Charts JavaScript -->
                <script src ="../bower_components/raphael/raphael-min.js"></script>
        
        
        
                <!-- Custom Theme JavaScript -->
                <script src ="../dist/js/sb-admin-2.js"></script>
                <script src ="../js/ajax.js"></script>
                <script src ="../js/codigo.js"></script>


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
                            <div class="clearfix"> </div>
                            <div class="col-md-3 widget widget1">
                                <?php
                                $op = Request::get("op");
                                $r = Request::get("r");

                                if ($r == null) {
                                    $r = "Ninguno";
                                    echo '<span class="alert-success">Operacion: ' . $op . ' Errores: ' . $r . '</span>';
                                } else {
                                    echo '<span class=" alert-warning">Operacion: ' . $op . ' Errores: ' . $r . '</span>';
                                }
                                ?> 
                                <div class="clearfix"> </div>
                            </div>
                            <div class="content_bottom">
                                <div class="col-md-12 span_3">
                                    <div class="bs-example5" data-example-id="contextual-table">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Email</th>
                                                    <th>Clave</th>
                                                    <th>Alias</th>
                                                    <th>Fecha Alta</th>
                                                    <th>Activo</th>
                                                    <th>Personal</th>
                                                    <th>Admin</th>
                                                    <th>Editar</th>
                                                    <th>Borrar</th>
                                                    <th>Activar</th>
                                                    <th>Desactivar</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($usuarios as $key => $usuario) {
                                                    if ($usuario->getActivo() == 0) {
                                                        echo '<tr class="alert-danger">';
                                                    } else {
                                                        ?>
                                                        <tr class="active">
                                                            <?php
                                                        }
                                                        ?>
                                                        <td class="row"><span><?= $usuario->getEmail(); ?></span></td>
                                                        <td class="row"><?= $usuario->getClave(); ?></td>
                                                        <td class="row"><?= $usuario->getAlias(); ?></td>
                                                        <td class="row"><?= $usuario->getFecha_alta(); ?></td>
                                                        <td class="row"><?= $usuario->getActivo(); ?></td>
                                                        <td class="row"><?= $usuario->getPersonal(); ?></td>
                                                        <td class="row"><?= $usuario->getAdministrador(); ?></td>
                                                        <td class="row"><a href="editar.php?email=<?= $usuario->getEmail(); ?>"><i class="fa fa-edit"></i></a></td>
                                                        <td class="row"><a href="phpborrar.php?email=<?= $usuario->getEmail(); ?>"><i class="fa fa-eraser"></i></a></td>
                                                        <?php
                                                        if ($usuario->getActivo() == 1) {
                                                        ?>
                                                        <td class="row"><i class="fa fa-unlock-alt"></i></td>
                                                        <td class="row"><a href="phpdesactivar.php?email=<?= $usuario->getEmail(); ?>"><i class="fa fa-lock"></i></a></td>
                                                         <?php       
                                                            }else{
                                                        ?>
                                                         <td class="row"><a href="phpactivar.php?email=<?= $usuario->getEmail(); ?>"><i class="fa fa-unlock-alt"></i></a></td>
                                                         <td class="row"><i class="fa fa-lock"></i></td>
                                                    </tr>
                                                    <?php
                                                            }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                       <?php
        include '../paginas/footer.php';
    }
}?>