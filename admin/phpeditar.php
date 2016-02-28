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
$usuario = new Usuario($email,sha1($clave),$alias, $fecha_alta, $activo, $personal, $administrador);
$gestor->set($usuario);

$bd->close();
$mensaje=$bd->getError();

if($mensaje==""){
 header("Location:admin.php?op=No editado&r=$mensaje[2]");
}else{
 header("Location:admin.php?op=Editado&r=$mensaje[2]");   
}


