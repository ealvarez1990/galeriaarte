<<<<<<< HEAD
<?php

class Galleta {

    static function set($nombre, $valor, $tiempo = null) {
        if ($tiempo == null) {
            $tiempo = time() + 60 + 60 * 24 * 5;
        }
        setcookie($name, $valor, $tiempo);
    }

    static function get($nombre) {
        if (isset($_COOKIE[$nombre])) {
            return $_COOKIE[$nombre];
        }
        return null;
    }

    static function delete($nombre) {
        setcookie($name, "", time() - 3600);
    }

}
=======
<?php

class Galleta {

    static function set($nombre, $valor, $tiempo = null) {
        if ($tiempo == null) {
            $tiempo = time() + 60 + 60 * 24 * 5;
        }
        setcookie($name, $valor, $tiempo);
    }

    static function get($nombre) {
        if (isset($_COOKIE[$nombre])) {
            return $_COOKIE[$nombre];
        }
        return null;
    }

    static function delete($nombre) {
        setcookie($name, "", time() - 3600);
    }

}
>>>>>>> ff3f3ddc08a5ef4a24ee6e6a74ad38820b1cb951
