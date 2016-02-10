<?php

class Usuario {
	    
    /*TODOS LOS CAMPOS SON REQUERIDOS
     * 
     * email varchar (80) primary key
     *clave varchar (40) [hash]->sha1
     *alias varchar (20) 
     * fecha alta   date timestap 
     * activo tynint(1)           ┌ 0 (predeterminado)
     * administrador tynint(1)  --┤     
     * personal tynint(1)         └ 1
     * 
     */
private $email, $clave, $alias, $fecha_alta, $activo, $personal, $administrador;

function __construct($email=NULL, $clave=NULL, $alias=NULL, 
        $fecha_alta=NULL, $activo=NULL, $personal=NULL, 
        $administrador=NULL) {
    $this->email = $email;
    $this->clave = $clave;
    $this->alias = $alias;
    $this->fecha_alta = $fecha_alta;
    $this->activo = $activo;
    $this->personal = $personal;
    $this->administrador = $administrador;
}

function getEmail() {
    return $this->email;
}

function getClave() {
    return $this->clave;
}

function getAlias() {
    return $this->alias;
}

function getFecha_alta() {
    return $this->fecha_alta;
}

function getActivo() {
    return $this->activo;
}

function getPersonal() {
    return $this->personal;
}

function getAdministrador() {
    return $this->administrador;
}

function setEmail($email) {
    $this->email = $email;
}

function setClave($clave) {
    $this->clave = sha1($clave);
}

function setAlias($alias) {
    $this->alias = $alias;
}

function setFecha_alta($fecha_alta) {
    $this->fecha_alta = $fecha_alta;
}

function setActivo($activo) {
    $this->activo = $activo;
}

function setPersonal($personal) {
    $this->personal = $personal;
}

function setAdministrador($administrador) {
    $this->administrador = $administrador;
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
