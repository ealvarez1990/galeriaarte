<?php

class ControladorFrontEnd {

    static function handle() {
        $action = Request::req("action");
        $do = Request::req("do");
        $metodo = $action . ucfirst($do);
        
        if (method_exists(get_class(), $metodo)) {
            echo 'método existe: ';
            self::$metodo();
        } else {
                self::readView();
        }
    }

private static function readView() {
        $plantilla = new Template();
        $bd = new BaseDatos();
        $vista = $plantilla->getContents("../_plantilla1/_index.html");
        $nav = $plantilla->getContents("../_plantilla1/_nav.html");
        $login = $plantilla->getContents("../_plantilla1/_login.html");
        $gallery = $plantilla->getContents("../_plantilla1/_gallery.html");
        $gestor=new ManageArtist($bd);
        //Todos los Artistas
        $gestorimagenes=new ManageGallery($bd);
        $imagenes=$gestorimagenes->getList();
        $elementos="";
        
        
       
         foreach ($imagenes as $key => $imagen) {
                $album = $imagen->getId();
                $elemento = $plantilla->replace("src", $imagen->getImagen(), $gallery);
                $elemento = $plantilla->replace("piefoto", $imagen->getDescripcion(), $elemento);
                $elemento = $plantilla->replace("id_imagen", $imagen->getId_imagen(), $elemento);
                $elemento = $plantilla->replace("album", $imagen->getId(), $elemento);
                $elementos.= $elemento;
        }

        
        $datos = array(
            "nav" => $nav,
            "work"=>"",
            "edit"=>"",
            "titulo" =>"Galeria de Arte",
            "formulario"=>"",
            "mensajes" => "",
            "descripcion" => 'Arte por todas partes',
            "login"=>$login,
            "profile"=>"",
            "upload"=>"",
            "gallery" => "$elementos",
            "contact"=>""
            
        );
        echo $plantilla->insertTemplate($vista, $datos);
    }
    function loginSet() {
        echo 'LOGIN';
        $email = Request::req("email");
        var_dump($email);
        $clave = sha1(Request::req("clave"));
        var_dump($clave);
        header("Location: ../login/index.php?email=$email&clave=$clave");
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