<?php

class BaseDatos {

    private $conexion;
    private $consulta;

    function __construct() {
        try {
            $this->conexion = new PDO(
                    'mysql:host=' . Configuracion::SERVER .
                    ';dbname=' . Configuracion::DATABASE, Configuracion::DBUSER, Configuracion::DBPASS, array(
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
            );
            return true;
        } catch (PDOException $ex) {
            var_dump($ex);
            exit();
        }
    }

    function close() {
        $this->conexion = NULL;
    }

    function getCount() {
        return $this->consulta->rowCount();
    }

    function getID() {
        return $this->conexion->lastInsertId();
    }

    function getErrorConection() {
        return $this->conexion->errorInfo();
    }

    function getError() {
        return $this->consulta->errorInfo();
    }

    function send($sql, $parametros = array()) {
        $this->consulta = $this->conexion->prepare($sql);
        foreach ($parametros as $nombreParametro => $valorParametro) {
            $this->consulta->bindValue($nombreParametro, $valorParametro);
        }
        return $this->consulta->execute();
    }

    function getRow() {
        $r = $this->consulta->fetch();
        if ($r === NULL) {
            $r->closeCursor();
        }
        return $r;
    }

    function count($tabla,$condicion = "1=1", $parametros=array()) { //obtener numero de registros de la tabla
        $sql="select count(*) from $tabla where $condicion";
        $this->send($sql, $parametros);
        $fila = $this->getRow();
        return $fila[0];
    }

    function delete($tabla, $params = array()) {

        $campoWhere = "";
        foreach ($params as $nombreParametro => $valorParametro) {
            $campoWhere.=$nombreParametro . " = :" . $nombreParametro . " and";
        }
        $campoWhere = substr($campoWhere, 0, -4);
        $sql = "delete from $tabla where $campoWhere;";
        if ($this->send($sql, $params)) {
            return $this->getCount();
        }
        return false;
    }

    function erase($tabla, $condicion, $params = array()) {
        // delete from TABLA where CONDICION;
        $sql = "delete from $tabla where $condicion";
        if ($this->send($sql, $params)) {
            return $this->getCount();
        }
        return false;
    }

    function insert($tabla, $params = array(), $auto = true) {
        // insert into TABLA(CAMPOS) values (VALORES);
        // si la tabla tiene un autonumerico, devuelvo el id
        // si no devuelvo el numero de filas insertadas
        // si error devuelvo false
        $campos = "";
        $valores = "";
        foreach ($params as $nombreParametro => $valorParametro) {
            $campos .=$nombreParametro . ",";
            $valores .=":" . $nombreParametro . ",";
        }
        $campos = substr($campos, 0, -1);
        $valores = substr($valores, 0, -1);
        $sql = "insert into $tabla ($campos) values ($valores)";
        if ($this->send($sql, $params)) {
            if ($auto) {
                return $this->getID();
            }
            return $this->getCount();
        }
        return false;
    }

    function update($tabla, $paramsSet = array(), $paramsWhere = array()) {

// update TABLA set (valores) where CONDICION;
// update TABLA set (c1=:c1, c2=:c2) where c1=:cv1 and c3=:cv3;
// UPDATE `city` SET `ID`=[value-1],`Name`=[value-2],`CountryCode`=[value-3],
// `District`=[value-4],`Population`=[value-5] WHERE 1

        $camposSet = "";
        $camposWhere = "";
        $parametros = array();
        foreach ($paramsSet as $nombre => $valor) {
            $camposSet .=" " . $nombre . "=:" . $nombre . ",";
            $parametros[$nombre] = $valor;
        }
        $camposSet = substr($camposSet, 0, -1);

        foreach ($paramsWhere as $nombre => $valor) {
            $camposWhere.=" " . $nombre . "=:" . $nombre . ",";
            $parametros["_" . $nombre] = $valor;
        }
        $camposWhere = substr($camposWhere, 0, -1);
        $sql = "update $tabla set $camposSet where $camposWhere";
     
        if ($this->send($sql, $parametros)) {

            return $this->getCount();
        }
        return false;
    }

    function query($tabla, $proyeccion = "*", $params = array(), $orden = "1", $limite = "") {
        //select CAMPOS from TABLA where condicion order by ORDEN LIMIT
        //select c1, c2 from TABLA where c3=$c3 and c4=:c4 order by c2 desc
        //el limit 8,25

        $campos = "";

        foreach ($params as $nombreParametros => $valorParamatro) {
            $campos.=$nombreParametros . " = :" . $nombreParametros . " and ";
        }
        $campos.="1=1";
        //$campos = substr($campos, 0, -4);

        $limit = "";
        if ($limite !== "") {
            $limit = "limit $limite";
        }

        $sql = "select $proyeccion from $tabla where $campos order by $orden $limit";
        return $this->send($sql, $params);
    }

    function select($tabla, $proyeccion = "*", $condicion = "1=1", $parametros = array(), $orden = "1", $limite = "") {

        $limit = "";
        if ($limite !== "") {
            $limit = "limit $limite";
        }
        $sql = "select $proyeccion from $tabla where $condicion order by $orden $limit";
        return $this->send($sql, $parametros);
    }

}
