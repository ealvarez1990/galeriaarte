<?php

class Pager {

    private $registros, $rpp, $paginaActual;

    function __construct($registros = NULL, $rpp = Configuracion::NRPP, $paginaActual = 1) {
        if($rpp===null){
            $rpp=  Configuracion::NRPP;
        }
        if($paginaActual===null){
            $paginaActual= 1;
        }
        
        $this->registros = $registros;
        $this->rpp = $rpp;
        $this->paginaActual = $paginaActual;
    }

    function getRegistros() {
        return $this->registros;
    }

    function getRpp() {
        return $this->rpp;
    }

    function getPaginaActual() {
        return $this->paginaActual;
    }

    function setRegistros($registros) {
        $this->registros = $registros;
    }

    function setRpp($rpp) {
        $this->rpp = $rpp;
    }

    function setPaginaActual($paginaActual) {
        $this->paginaActual = $paginaActual;
    }

    function getPrimera() { //devuelve la primera pagina
        return 1;
    }

    function getPaginas() { //devuelve el numero total de paginas getUltima()
        return ceil($this->registros/$this->rpp);
    }

    function getAnterior() { //calcula la pagina anterior a la actual;
        return max(1, $this->paginaActual-1);
    }

    function getSiguiente() {//calcula la pagina siguiente a la actual;
        return min($this->getPaginas(), $this->paginaActual+1);
    }

    function getSelect($id, $name = null) { //construye el select ej: ver 10, 50, 100 
        if($name===null){
            $name=$id;
        }
        $array = array(10=>"10 rpp", 50=>"50 rpp", 100=>"100 rpp");
        return Util::getSelect($name, $array, $this->rpp, false, "", $id);
    }

    function getEnlacesPaginas($rango, $enlace, $nombreParametroPagina, $pagina = 0) {
        
    }

}
