<?php

class Request {
    /*
     * Devuelve el valor requerido de forma limpia, es decir, evitando 
     * devolver valores con caracteres especiales
     */

    private static function clean($valor, $filtrar) {
        //limpiamos
        if ($filtrar === true) {
            $valor = htmlspecialchars($valor);
            return trim($valor);
        }
        return trim($valor);
    }

    static function devuelveIndice($nombre) {
        if (self::req($nombre)) {
            if (is_array(self::req($nombre))) {
                return count(self::req($nombre));
            }
            return -1;
        }
        return NULL;
    }

    private static function read($parametro, $filtrar = true, $indice = NULL) {
        if (is_array($parametro)) {
            if ($indice === NULL) {
                $array = array();
                foreach ($parametro as $value) {
                    $r = self::clean($value, $filtrar);
                    if ($r === "") {
                        $r = NULL;
                    }
                    $array[] = $r;
                }
                return $array;
            } else {
                if (isset($parametro[$indice])) {
                    $r= self::clean($parametro[$indice], $filtrar);
                    if ($r === "") {
                        $r = NULL;
                    }
                    return $r;
                }
            }
        } else {
            $r = self::clean($parametro, $filtrar);
            if ($r === "") {
                $r = NULL;
            }
            return $r;
        }
    }

    /*
     * Devuelve el parámetro get solicitado
     * Retorna NULL en caso de no existir el parámetro
     */

    static function get($nombre, $indice = NULL) {
        if (isset($_GET[$nombre])) {
            return self::read($_GET[$nombre], $indice);
        }
        return NULL;
    }

    /*
     * Devuelve el parámetro post solicitado
     * Retorna NULL en caso de no existir el parámetro
     */

    static function post($nombre, $indice = NULL) {

        if (isset($_POST[$nombre])) {
            return self::read($_POST[$nombre], $indice);
        }
        return NULL;
    }

    /*
     * Devuelve el parámetro get o post solicitado
     * Retorna NULL en caso de no existir el parámetro
     */

    static function req($nombre, $indice = NULL) {

//           
//        if (Server::isPost() && self::post($nombre) != NULL) {
//            return self::post($nombre);
//        }
//        return self::get($nombre);
        $valor = self::post($nombre, $indice);
        if ($valor !== NULL) {
            return $valor;
        }
        return self::get($nombre, $indice);
    }

}
