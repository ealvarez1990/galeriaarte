<?php

class ControladorLogin {

    static function handle() {
        $action = Request::req("action");
        $do = Request::req("do");
        $metodo = $action . ucfirst($do);
        self::doLogin();
    }

    private static function doLogin() {
        $bd = new BaseDatos();
        $email = Request::req("email");
        $clave = Request::req("clave");
        $bd = new BaseDatos();
        $template= new Template();
        $sesion = new Session();
        $modelo = new ManageUser($bd);
        $usuario = $modelo->get($email);
        $sesion->setUser($usuario);
        if (isset($usuario) && $clave == $sesion->getUser()->getClave()) {
            header("Location: ../artista/index.php");
        } else {
            $sesion->destroy();
            $bd->close();
            $error=$template->getContents("../_pantilla1/_error.html");
            $datos = array(
            "tipo" => "BAD LOGIN",
            "detalles" =>"No se logueo correctamente",
        );
            $error=$template->insertTemplate($error, $datos);
        }
    }

}

/*
----------------------------------------------
| action  |   do   |   id    |   r   |   op  |                       
----------------------------------------------
|   edit  |  view  |    v    |   0   |   0   |                       
----------------------------------------------
|   edit  | set |    v    |   0   |   0   |                       
----------------------------------------------
| insert  |  view  |    -    |   0   |   0   |                       
----------------------------------------------
| insert  |  set   |    -    |   0   |   0   |                       
----------------------------------------------
| delete  | set |    v    |   0   |   0   |                      
----------------------------------------------
|  read   |  view  |   id    |   0   |   0   |                        
----------------------------------------------
*/