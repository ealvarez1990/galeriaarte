<?php

class ManageGallery {

    private $bd = NULL;
    private $tabla = 'imagenes';

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function set(Gallery $imagen) {
        //return $this->bd->update($this->tabla, $city->get());
        $paramsWhere = array();
        $paramsWhere["id"] = $imagen->getId_imagen();
        return $this->bd->update($this->tabla, $imagen->get(), $paramsWhere);
    }

    function insert(Gallery $imagen) {
        return $this->bd->insert($this->tabla, $imagen->get());
    }

    function delete($id_imagen) {
        $parametros = array();
        $parametros['id_imagen'] = $id_imagen;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function get($id_imagen) {
        $parametros = array();
        $parametros['id_imagen'] = $id_imagen;
        $this->bd->select($this->tabla, '*', 'id_imagen=:id_imagen', $parametros);
        $fila = $this->bd->getRow();
        $imagen = new Gallery();
        $imagen->set($fila);
        return $imagen;
    }

    function getAlbum($id) {
        $parametros = array();
        $parametros['id'] = $id;
        $this->bd->select($this->tabla, '*', 'id=:id', $parametros);
        $fila = $this->bd->getRow();
        $imagen = new Gallery();
        $imagen->set($fila);
        return $imagen;
    }

    function getList($pagina = 1, $orden = "", $nrpp = Configuracion::NRPP, $condicion = "1=1", $parametros = array()) {
        $ordenPredeterminado = "$orden, id_imagen";
        if (trim($orden) === "" || trim($orden) === NULL) {
            $ordenPredeterminado = "id_imagen";
        }
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", $condicion, $parametros, $ordenPredeterminado, "$registroInicial, $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $imagen = new Gallery();
            $imagen->set($fila);
            $r[] = $imagen;
        }
        return $r;
    }

    function paginacion() {
        $sql = "select count from $this->bd";
    }

    function count($condicion = "1=1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "id");
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }

}
