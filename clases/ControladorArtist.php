<?php

class ControladorArtist {

    private $id = NULL;

    static function handle() {
        $bd = new BaseDatos();
        $gestor = new ManageArtist($bd);
        $sesion = new Session();
        $action = Request::req("action");
        $do = Request::req("do");
        $metodo = $action . ucfirst($do);

        if (!$sesion->isLogged()) {
            header("Location:../frontend/index.php");
            exit();
        } else {
            if ($sesion->getUser()->getPersonal() != 1 || $sesion->getUser()->getActivo() != 1) {
                //header("Location:../frontend/index.php");
                echo 'NO SESSION';
            } else {
                if (method_exists(get_class(), $metodo)) {
                    echo 'método existe: ';
                    self::$metodo($gestor);
                } else {
                    self::readView($gestor);
                }
            }
        }
        $bd->close();
    }

    private static function readView(ManageArtist $gestor) {
        $plantilla = new Template();
        $bd = new BaseDatos();
        $sesion = new Session();
        $usuario = $sesion->getUser();
        $gestorgalerias = new ManageGallery($bd);
        $vista = $plantilla->getContents("../_plantilla1/_index.html");
        $nav = $plantilla->getContents("../_plantilla1/_nav.html");
        $profile = $plantilla->getContents("../_plantilla1/_profile.html");
        $upload = $plantilla->getContents("../_plantilla1/_upload.html");
        $gallery = $plantilla->getContents("../_plantilla1/_gallery.html");
        $trabajo = $plantilla->getContents("../_plantilla1/_work.html");
        $edit = $plantilla->getContents("../_plantilla1/_edit.html");
        $contact = $plantilla->getContents("../_plantilla1/_contact.html");
//VARIABLES DEL ARTISTA
        $email = $usuario->getEmail();
        $alias = $usuario->getAlias();
        $artista = self::getArtist($sesion);
        $input = '<label>Gallery: <input type="text" class="form-control" name="id" value="' . $artista->getGaleria() . '" placeholder="Galeria: ' . $artista->getGaleria() . '"></label>';
        $upload = $plantilla->replace("select_galeria", $input, $upload);



//CREACION DE GALERIA SEGUN EL ALBUM
        //ALBUM
        //GALERIA

        $galerias = $gestorgalerias->getList();
        $elementos = "";
        foreach ($galerias as $key => $imagen) {
            if ($imagen->getId() === $artista->getGaleria()) {
                $elemento = $plantilla->replace("src", $imagen->getImagen(), $gallery);
                $elemento = $plantilla->replace("piefoto", $imagen->getDescripcion(), $elemento);
                $elemento = $plantilla->replace("id_imagen", $imagen->getId_imagen(), $elemento);
                $elemento = $plantilla->replace("album", $imagen->getId(), $elemento);
                $elementos.= $elemento;
            }
        }
//RELLENO PAGINA
        $info = "<br>Artista: " . $alias . "<br> Galeria: " . $artista->getTitulo();
        $profile = $plantilla->replace("perfil", $artista->getPerfil(), $profile);
        $men="";
        if(Request::req("op")==""){
            $men="";
        }else{
            if(Request::req("r")>=0)
            $men="Operacion: ".Request::req("op")." Resultado: Exito";
        }
        
        
        
        $datos = array(
            "nav" => $nav,
            "work" => $trabajo,
            "edit" => $edit,
            "titulo" => $info,
            "nombre" => $alias,
            "descripcion" => $artista->getDescripcion(),
            "login" => "",
            "formulario" => "",
            "mensajes" => "$men",
            "profile" => $profile,
            "upload" => $upload,
            "gallery" => $elementos,
            "contact" => $contact,
        );
       echo $plantilla->insertTemplate($vista, $datos);
    }

//------------------------------------------------------------------------------
    //LOGOUT

    private static function logoutSet() {
        $sesion = new Session();
        $sesion->destroy();
        header('Location:../frontend/index.php');
    }


//EDIT VIEW
    private static function editView($gestor) {
        $plantilla_editar = new Template();
        $sesion = new Session();
        $artista = self::getArtist($sesion);
        $formulario = $plantilla_editar->getContents("../_plantilla1/_form.html");
        $vista = $plantilla_editar->getContents("../_plantilla1/_index.html");
        $trabajo = $plantilla_editar->getContents("../_plantilla1/_work.html");
        $edit = $plantilla_editar->getContents("../_plantilla1/_edit.html");
        $nav = $plantilla_editar->getContents("../_plantilla1/_nav.html");
        $textarea = $plantilla_editar->getContents("../_plantilla1/_textarea.html");


        $textarea = $plantilla_editar->replace("value3", $artista->getPerfil(), $textarea);
        $datos_form_textarea = array(
            "label3" => "Enter profile description:",
            "campo3" => "perfil",
            "value3" => $artista->getPerfil()
        );

        foreach ($datos_form_textarea as $key => $value) {
            $textarea = $plantilla_editar->replace($key, $value, $textarea);
        }

        $datos_form = array(
            "action" => "?action=edit&do=Set",
            "type1" => "text",
            "type2" => "text",
            "type3" => "textarea",
            "label1" => "Enter title",
            "label2" => "Enter description",
            "label3" => "Enter profile",
            "campo1" => "titulo",
            "campo2" => "descripcion",
            "campo_3" => "",
            "value1" => $artista->getTitulo(),
            "value2" => $artista->getDescripcion(),
            "textarea" => $textarea,
        );

        foreach ($datos_form as $key => $value) {
            $formulario = $plantilla_editar->replace($key, $value, $formulario);
        }


        $datos = array(
            "nav" => $nav,
            "work" => $trabajo,
            "edit" => $edit,
            "titulo" => "EDIT PROFILE ARTIST",
            "nombre" => "",
            "descripcion" => $sesion->getUser()->getAlias(),
            "login" => "",
            "formulario" => $formulario,
            "profile" => "",
            "upload" => "",
            "gallery" => "",
            "contact" => ""
        );
        echo $plantilla_editar->insertTemplate($vista, $datos);
    }

    private static function editSet() {
        $bd = new BaseDatos(); 
        $sesion=new Session();
        $artista=self::getArtist($sesion);
        $gestor_artista=new ManageArtist();
        $titulo=Request::post("titulo"); 
        $descripcion = Request::post("descripcion");
        $galeria = Request::post("galeria");
        $style = Request::post("style");
        
        $artista = new Artist($artista->getEmail(), $titulo, $descripcion, $galeria, $style);
        $r = $gestor_artista->set($artista);
        header("Location:?op=edit&r=$r&action=read&do=View");
    }

    private static function insertSet() {
        $bd = new BaseDatos();
        $gestor_galeria = new ManageGallery($bd);
        $sesion = new Session();
        $artista = self::getArtist($sesion);
        $descripcion = Request::post("descripcion");
        $id = Request::post("id");

        $file = new FileUpload("imagen");
        $nombre = $artista->getGaleria() . "_" . ($gestor_galeria->count() + 1);
        $file->setNombre($nombre);
        $file->setDestino("../img/");
        $file->setTamanio(52428800);
        $file->addTipo("gif");
        var_dump($file->upload());
        $imagen_ruta = "../img/" . $nombre. "." . $file->getExtension();
        $gallery = new Gallery($id, 0, $imagen_ruta, $descripcion);
        $r = $gestor_galeria->insert($gallery);
        header("Location:?op=insert&r=$r&action=read&do=View");
    }
//DELETE
    private static function deleteSet() {
        $bd = new BaseDatos();
        $gestor_galeria = new ManageGallery($bd);
        $r=$gestor_galeria->delete(Request::req("id"));
        header("Location:?op=insert&r=$r&action=read&do=View#section3");
    }
//CONSULTA A LA SESION POR EL USUARIO, ESTRAE EMAIL, Y BUSCA EN LA TABLA ARTISTA
    private static function getArtist(Session $sesion) {
        $bd = new BaseDatos();
        $gestor = new ManageArtist($bd);
        return $artista = $gestor->get($sesion->getUser()->getEmail());
    }

}
