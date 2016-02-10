<<<<<<< HEAD
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Artist
 *
 * @author Yahiko
 */
class Artist {
    
    private $email, $titulo, $descripcion, $perfil, $galeria, $style;
    function __construct($email=NULL, $titulo=NULL, $descripcion=NULL, $perfil=NULL, $galeria=NULL, $style=NULL) {
        $this->email = $email;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->perfil = $perfil;
        $this->galeria = $galeria;
        $this->style=$style;
    }
    function getStyle() {
        return $this->style;
    }

    function setStyle($style) {
        $this->style = $style;
    }

        function getEmail() {
        return $this->email;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPerfil() {
        return $this->perfil;
    }

    function getGaleria() {
        return $this->galeria;
    }

    function setCorreo($correo) {
        $this->email = $correo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    function setGaleria($galeria) {
        $this->galeria = $galeria;
    }

        
function set($valores, $inicio = 0){
        $i=0; 
        foreach ($this as $indice => $valor) {
           $this->$indice = $valores[$i+$inicio];
           $i++;
        }
    }
    
    public function __toString() {
        $r='';
        foreach ($this as $key => $valor) {
            $r .= "$valor ";
        }
        return  $r.="<br>";
    }
    
    
    function get(){
        $params=array();
        foreach ($this as $key => $value) {
            $params[$key]=$value;
        }
        return $params;
    }
}
=======
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Artist
 *
 * @author Yahiko
 */
class Artist {
    
    private $email, $titulo, $descripcion, $perfil, $galeria, $style;
    function __construct($email=NULL, $titulo=NULL, $descripcion=NULL, $perfil=NULL, $galeria=NULL, $style=NULL) {
        $this->email = $email;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->perfil = $perfil;
        $this->galeria = $galeria;
        $this->style=$style;
    }
    function getStyle() {
        return $this->style;
    }

    function setStyle($style) {
        $this->style = $style;
    }

        function getEmail() {
        return $this->email;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPerfil() {
        return $this->perfil;
    }

    function getGaleria() {
        return $this->galeria;
    }

    function setCorreo($correo) {
        $this->email = $correo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    function setGaleria($galeria) {
        $this->galeria = $galeria;
    }

        
function set($valores, $inicio = 0){
        $i=0; 
        foreach ($this as $indice => $valor) {
           $this->$indice = $valores[$i+$inicio];
           $i++;
        }
    }
    
    public function __toString() {
        $r='';
        foreach ($this as $key => $valor) {
            $r .= "$valor ";
        }
        return  $r.="<br>";
    }
    
    
    function get(){
        $params=array();
        foreach ($this as $key => $value) {
            $params[$key]=$value;
        }
        return $params;
    }
}
>>>>>>> ff3f3ddc08a5ef4a24ee6e6a74ad38820b1cb951
