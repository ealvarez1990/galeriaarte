<?php
class ManageArtist {
    private $bd = NULL;
    private $tabla = 'artista';

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function set(Usuario $usuario) {
        //return $this->bd->update($this->tabla, $city->get());
        $paramsWhere = array();
        $paramsWhere["email"] = $usuario->getEmail();
        return $this->bd->update($this->tabla, $usuario->get(), $paramsWhere);
    }

    function insert(Artist $artista) {
        return $this->bd->insert($this->tabla, $artista->get());
    }

    function delete($email) {
        $parametros = array();
        $parametros['email'] = $email;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function get($email) {
        $parametros = array();
        $parametros['email'] = $email;
        $this->bd->select($this->tabla, '*', 'email=:email', $parametros);
        $fila = $this->bd->getRow();
        $artista = new Artist();
        $artista->set($fila);
        return $artista;
    }
    
        function getArtistaByGallery($galeria) {
        $parametros = array();
        $parametros['galeria'] = $galeria;
        $this->bd->select($this->tabla, '*', 'galeria=:galeria', $parametros);
        $fila = $this->bd->getRow();
        $artista = new Artist();
        $artista->set($fila);
        return $artista;
    }

    function getList($pagina = 1, $orden = "", $nrpp = Configuracion::NRPP, $condicion = "1=1", $parametros = array()) {
        $ordenPredeterminado = "$orden, email";
        if (trim($orden) === "" || trim($orden) === NULL) {
            $ordenPredeterminado = "titulo";
        }
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", $condicion, $parametros, $ordenPredeterminado, "$registroInicial, $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $artista = new Artist();
            $artista->set($fila);
            $r[] = $artista;
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
        $this->bd->query($this->tabla, "email ", array(), "titulo");
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }
}
