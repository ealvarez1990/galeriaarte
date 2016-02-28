<?php

require '../clases/AutoCarga.php';
$bd = new BaseDatos();
$gestor = new ManejoUsuario($bd);
$email=  Request::get("email");
$usuario=$gestor->get($email);


if($email==$usuario->getEmail()){
    $usuario->setActivo(1);
    $gestor->set($usuario);
}
$bd->close();
$mensaje=$bd->getError();

if($mensaje==""){
 header("Location:admin.php?op=Activado correctamente&r=$mensaje[2]");
}else{
 header("Location:admin.php?op=No activado&r=$mensaje[2]");   
}

