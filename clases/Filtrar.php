<?php

class Filtrar {

    static function isEmail($valor) {
        return filter_var($valor, FILTER_VALIDATE_EMAIL);
    }

    static function isIp($valor) {
        return filter_var($valor, FILTER_VALIDATE_IP);
    }

    static function isInt($valor) {
        return filter_var($valor, FILTER_VALIDATE_INT);
    }

    static function isFloat($valor) {
        return filter_var($valor, FILTER_VALIDATE_FLOAT);
    }

    static function isUrl($valor) {
        return filter_var($valor, FILTER_VALIDATE_URL);
    }

    static function isBool($valor) {
        return filter_var($valor, FILTER_VALIDATE_BOOLEAN);
    }

    static function isMinLength($valor, $longitude) {
        return strlen($valor) >= $longitude;
    }
    
    static function isMaxLength($valor, $longitude) {
        return strlen($valor) < $longitude;
    }

    static function isLogin($valor) {
       return preg_match('/^[A-Za-z][A-Za-z0-9]{5,9}$/', $valor);
    }
    
    

}
