<?php

class ControladorLogin {

    static function handle() {
        $action = Request::req("action");
        $do = Request::req("do");
        $metodo = $action . ucfirst($do);
        if (method_exists(get_class(), $metodo)) {
                    self::$metodo();
                } else {
                    self::doLogin();
                }
    }

    private static function doLogin() {
        $bd = new BaseDatos();
        $email = Request::req("email");
        $clave = Request::req("clave");
        $template= new Template();
        $sesion = new Session();
        $modelo = new ManageUser($bd);
        $usuario = $modelo->get($email);
        $sesion->setUser($usuario);
        $error=$template->getContents("../_plantilla1/_error.html");
        $datos = array("tipo" => "BAD LOGIN", "detalles" =>"No se logueo correctamente");
        if (isset($usuario) && $clave == $sesion->getUser()->getClave()) {
            header("Location: ../artista/index.php");
        } else {
            $sesion->destroy();
            $bd->close();
            echo $error=$template->insertTemplate($error, $datos);
        }
    }
    
     private static function signSet() {
        $bd = new BaseDatos();
        $email = Request::req("email");
        $clave = Request::req("clave");
        $alias = Request::req("alias");
        $date = date('Y-m-d h:i:s');
        $activo=1;
        $personal=0;
        $administrador=0;
        
       
        //-----------------------------------
        $email_a = $email;
        $titulo = Request::req("titulo");
        $descripcion = Request::req("descripcion");
        $perfil = Request::req("perfil");
        $galeria = Request::req("galeria");
        $style="_plantilla1";
        $usuario = new Usuario($email, sha1($clave), $alias, $fecha, $activo, $personal, $administrador);
        $artista = new Artist($email, $titulo, $descripcion, $perfil, $galeria, $style);
        $manageUsurio=new ManageUser($bd);
        $manageArtist=new ManageArtist($bd);
        $manageUsurio->insert($usuario);
        $manageArtist->insert($artista);
        header("Location: ../frontend/index.php");
        
    }
    
     private static function signView() {
         $plantilla= new Template();
         $vista = $plantilla->getContents("../_plantilla1/_index.html");
         $signin = $plantilla->getContents("../_plantilla1/_signin.html");
         $nav = $plantilla->getContents("../_plantilla1/_nav.html");
         $datos = array(
            "nav" => $nav,
            "work" => "",
            "edit" => "",
            "titulo" => "",
            "nombre" => "",
            "descripcion" => "",
            "login" => "",
            "formulario" => $signin,
            "mensajes" => "",
            "profile" => "",
            "upload" => "",
            "gallery" => "",
            "artistas" => "",
            "contact" => ""
        );
        echo $plantilla->insertTemplate($vista, $datos);
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