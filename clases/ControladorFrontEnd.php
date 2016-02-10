<<<<<<< HEAD
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
        $gestor = new ManageArtist($bd);
        $gestorUsuario = new ManageUser($bd);
        $gestorimagenes = new ManageGallery($bd);

        //Carga de plantillas
        $vista = $plantilla->getContents("../_plantilla1/_index.html");
        $nav = $plantilla->getContents("../_plantilla1/_nav.html");
        $login = $plantilla->getContents("../_plantilla1/_login.html");
        $gallery = $plantilla->getContents("../_plantilla1/_gallery.html");
        $artistas_plantilla = $plantilla->getContents("../_plantilla1/_artistas.html");
        $lista_artistas = $plantilla->getContents("../_plantilla1/_lista-artistas.html");


        //Todos los Artistas -------------------------------------
        $usuarios = $gestorUsuario->getList();
        $imagenes = $gestorimagenes->getList();
        $elementos = "";
        $elementos_a = "";

        foreach ($usuarios as $key => $artista) {
            if ($artista->getPersonal() == 1 && $artista->getAdministrador() == 0) {
                $elemento_i = $plantilla->replace("nombre_artista", $artista->getAlias(), $lista_artistas);
                $elemento_i = $plantilla->replace("mail_artista", $artista->getEmail(), $elemento_i);
                $elementos_a.=$elemento_i;
            }
        }

        if (Request::req("email") == "") {
            $elementos = self::loadImage($plantilla, $gallery, $imagenes, $elementos);
        } else {
            $email = Request::req("email");
            $email_artista = $gestorUsuario->get($email)->getEmail();
            $art_album = $gestor->get($email_artista)->getGaleria();
            $galeria_personalizada = $gestorimagenes->getList();

            
            foreach ($galeria_personalizada as $key => $imagen) {
                if ($imagen->getId() == $art_album) {
                    $elemento = $plantilla->replace("src", $imagen->getImagen(), $gallery);
                    $elemento = $plantilla->replace("piefoto", $imagen->getDescripcion(), $elemento);
                    $elemento = $plantilla->replace("id_imagen", $imagen->getId_imagen(), $elemento);
                    $elemento = $plantilla->replace("album", $imagen->getId(), $elemento);
                    $elementos.= $elemento;
                }
            }
        }


        $artistas_plantilla = $plantilla->replace("lista_artistas", $elementos_a, $artistas_plantilla);
        $datos = array(
            "nav" => $nav,
            "work" => "",
            "edit" => "",
            "titulo" => "Galeria de Arte",
            "formulario" => "",
            "mensajes" => "",
            "descripcion" => 'Arte por todas partes',
            "login" => $login,
            "profile" => "",
            "upload" => "",
            "artistas" => $artistas_plantilla,
            "gallery" => "$elementos",
            "contact" => ""
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

    private static function loadImage($plantilla = NULL, $galeria = NULL, $array = NULL, $variable = NULL) {
        foreach ($array as $key => $imagen) {
            $elemento = $plantilla->replace("src", $imagen->getImagen(), $galeria);
            $elemento = $plantilla->replace("piefoto", $imagen->getDescripcion(), $elemento);
            $elemento = $plantilla->replace("id_imagen", $imagen->getId_imagen(), $elemento);
            $elemento = $plantilla->replace("album", $imagen->getId(), $elemento);
            $variable.= $elemento;
        }
        return $variable;
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
=======
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
        $gestor = new ManageArtist($bd);
        $gestorUsuario = new ManageUser($bd);
        $gestorimagenes = new ManageGallery($bd);

        //Carga de plantillas
        $vista = $plantilla->getContents("../_plantilla1/_index.html");
        $nav = $plantilla->getContents("../_plantilla1/_nav.html");
        $login = $plantilla->getContents("../_plantilla1/_login.html");
        $gallery = $plantilla->getContents("../_plantilla1/_gallery.html");
        $artistas_plantilla = $plantilla->getContents("../_plantilla1/_artistas.html");
        $lista_artistas = $plantilla->getContents("../_plantilla1/_lista-artistas.html");

        //Todos los Artistas
        $usuarios = $gestorUsuario->getList();
        $imagenes = $gestorimagenes->getList();
        $elementos = "";
        $elementos_a = "";

        foreach ($usuarios as $key => $artista) {
            if ($artista->getPersonal() == 1 && $artista->getAdministrador() == 0) {
                $elemento_i = $plantilla->replace("nombre_artista", $artista->getAlias(), $lista_artistas);
                $elemento_i = $plantilla->replace("mail_artista", $artista->getEmail(), $elemento_i);
                $elementos_a.=$elemento_i;
            }
        }

        if (Request::req("email") == "") {
            $elementos = self::loadImage($plantilla, $gallery, $imagenes, $elementos);
        } else {
            $email = Request::req("email");
            $email_artista = $gestorUsuario->get($email)->getEmail();
            $art_album = $gestor->get($email_artista)->getGaleria();
            $galeria_personalizada = $gestorimagenes->getList();

            
            foreach ($galeria_personalizada as $key => $imagen) {
                if ($imagen->getId() == $art_album) {
                    $elemento = $plantilla->replace("src", $imagen->getImagen(), $gallery);
                    $elemento = $plantilla->replace("piefoto", $imagen->getDescripcion(), $elemento);
                    $elemento = $plantilla->replace("id_imagen", $imagen->getId_imagen(), $elemento);
                    $elemento = $plantilla->replace("album", $imagen->getId(), $elemento);
                    $elementos.= $elemento;
                }
            }
        }


        $artistas_plantilla = $plantilla->replace("lista_artistas", $elementos_a, $artistas_plantilla);
        $datos = array(
            "nav" => $nav,
            "work" => "",
            "edit" => "",
            "titulo" => "Galeria de Arte",
            "formulario" => "",
            "mensajes" => "",
            "descripcion" => 'Arte por todas partes',
            "login" => $login,
            "profile" => "",
            "upload" => "",
            "artistas" => $artistas_plantilla,
            "gallery" => "$elementos",
            "contact" => ""
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

    private static function loadImage($plantilla = NULL, $galeria = NULL, $array = NULL, $variable = NULL) {
        foreach ($array as $key => $imagen) {
            $elemento = $plantilla->replace("src", $imagen->getImagen(), $galeria);
            $elemento = $plantilla->replace("piefoto", $imagen->getDescripcion(), $elemento);
            $elemento = $plantilla->replace("id_imagen", $imagen->getId_imagen(), $elemento);
            $elemento = $plantilla->replace("album", $imagen->getId(), $elemento);
            $variable.= $elemento;
        }
        return $variable;
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
>>>>>>> ff3f3ddc08a5ef4a24ee6e6a74ad38820b1cb951
