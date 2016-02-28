<?php

require '../clases/AutoCarga.php';
$bd = new BaseDatos();
$gestor = new ManejoUsuario($bd);
$email = Request::post("email");
$clave = Request::post("clave");
$alias = Request::post("alias");
$fecha = Request::post("fecha");
$hora = Request::post("hora");
$fecha_alta = $fecha." ".$hora;
$activo = Request::post("activo");
$personal = Request::post("personal");
$administrador=Request::post("administrador");
if($activo==null){ 
    $activo=0;
}
if($administrador==null){
    $administrador=0;
}
if($personal==null){
   $personal=0;
}
$usuario = new Usuario($email, sha1($clave), $alias, $fecha_alta, $activo, $personal, $administrador);
$gestor->insert($usuario);

$bd->close();
$mensaje=$bd->getError();

if($mensaje==""){
 header("Location:admin.php?op=No insertado&r=$mensaje[2]");
}else{
 header("Location:admin.php?op=Insertado&r=$mensaje[2]");   
}


