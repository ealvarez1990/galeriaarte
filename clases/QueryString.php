<?php

class QueryString {

    private $params;

    function __construct($params=null) {
        $this->params = $_GET;
    }

    function get($nombre) {
        //devuelve un parametro del querystring  
        foreach ($this->params as $indice => $valor) {
            if ($indice == $nombre) {
                return $nombre;
            }
        }
    }

    function getParamWithout($paramsDelete) {
        //devuelve el querystring sin parametros  
        return $this->params = '';
    }

    function getParams($paramsAdd = array(), $paramsDelete = array()) {
        //añade y elimina parametros del querystring, y devuelve la cadena  
        $copia = $this->params;
        foreach ($paramsDelete as $parametro => $valor) {
            unset($copia[$parametro]);
        }
        foreach ($paramsAdd as $parametro => $valor) {
            $copia[$parametro] = $valor;
        }
        $r = '';
        foreach ($copia as $key => $value) {
            $r.=$key . "=" . urldecode($value) . "&";
        }
        return substr($r, 0, -1);
    }

    function set($nombre, $valor) {
        //añade parametros al querystring
        $param = array();
        $param = $this->params;
        $param[$nombre] = $valor;
        return $param;
    }

    function delete($nombre) {
        //elimina un parametro del querystring
        unset($this->params[$nombre]);
        return 0;
    }

    function __toString() {//devuelve el querystring formado
        $cadena = "?";
        $parametros = $this->params;
        foreach ($parametros as $nombre => $valor) {
            $cadena.="&" . $nombre . "=" . $valor;
        }
        return "?" . trim($cadena, "?&");
    }

}
