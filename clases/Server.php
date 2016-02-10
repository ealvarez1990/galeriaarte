<?php

class Server {

//    private static function get($valor){
//        return $_SERVER[$valor];
//    }

    static function getServerName() {
        return $_SERVER["SERVER_NAME"];
    }

    static function getRootPath() {
        return $_SERVER["CONTEXT_DOCUMENT_ROOT"];
    }

    static function getPort() {
        return $_SERVER["SERVER_PORT"];
    }

    static function getUserAgent() {
        return $_SERVER ["HTTP_USER_AGENT"];
    }

    static function getQueryString() {
        return $_SERVER ["QUERY_STRING"];
    }

    static function getFileName() {
        return $_SERVER ["SCRIPT_FILENAME"];
    }

    static function getMethod() {
        return $_SERVER ["REQUEST_METHOD"];
    }

    static function isGet() {
        return self::getMethod() == "GET";
    }

    static function isPost() {
        return self::getMethod() == "POST";
    }

    static function getClientAddress() {
        return $_SERVER ["REMOTE_ADDR"];
    }

    static function getHttpReferer() {
       return $cadena= $_SERVER ["HTTP_REFERER"];
       
        //$pos= strripos($cadena,".php");
        //$cadena = substr($cadena, 0, $pos );
        //$pos2= strpos(strrev($cadena), "/");
       // return $cadena = substr($cadena, 0, $pos2 );
    }

    static function getRequestDate($valor = NULL) {
        date_default_timezone_set('Europe/Madrid');
        $fecha = $_SERVER["REQUEST_TIME"];
        $fechaform = NULL;
        switch ($valor) {
            case "Y":
                return date("Y", $fecha);
            case "M":
                return date("m", $fecha);
            case "D":
                return date("d", $fecha);
            case "h":
                return date("H", $fecha);
            case "m":
                return date("i", $fecha);
            case "s":
                return date("s", $fecha);
            case "F":
                return date("Y-m-d", $fecha);
            case "H":
                return date("H:i:s", $fecha);
            case "FH":
                return date("Y-m-d H:i:s", $fecha);
            case "F_NOT_UTC":
                return date("d-m-Y", $fecha);
            case "F_NOT_UTC_H":
                return date("d-m-Y H:i:s", $fecha);
        }
        return $_SERVER ["REQUEST_TIME"];
    }

    static function getClientLanguage() {
        return $_SERVER ["HTTP_ACCEPT_LANGUAGE"];
    }

}
