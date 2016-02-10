<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gallery
 *
 * @author Yahiko
 */
class Gallery {

    private $id, $id_imagen,$imagen, $descripcion;
    
     function __construct($id=null, $id_imagen=null, $imagen=null, $descripcion=null) {
        $this->id = $id;
        $this->id_imagen = $id_imagen;
        $this->imagen = $imagen;
        $this->descripcion = $descripcion;
    }
    function getId_imagen() {
        return $this->id_imagen;
    }

    function setId_imagen($id_imagen) {
        $this->id_imagen = $id_imagen;
    }

    function getId() {
        return $this->id;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function set($valores, $inicio = 0) {
        $i = 0;
        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i + $inicio];
            $i++;
        }
    }

    public function __toString() {
        $r = '';
        foreach ($this as $key => $valor) {
            $r .= "$valor ";
        }
        return $r.="<br>";
    }

    function get() {
        $params = array();
        foreach ($this as $key => $value) {
            $params[$key] = $value;
        }
        return $params;
    }

}
