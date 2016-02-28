<?php

require '../clases/AutoCarga.php';
$bd = new BaseDatos();
$gestor = new ManejoUsuario($bd);
$email = Request::get("email");
$r = $gestor->delete($email);
//var_dump($bd->getError());
$bd->close();
header("Location: admin.php?op=Borrado&r=$r");