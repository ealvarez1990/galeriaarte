<<<<<<< HEAD
<?php

class AutoCarga {
    static public function cargar($clase) {
        $archivo = "../clases/" . str_replace('\\', '/', $clase) . ".php";
        
        if(file_exists($archivo)){
            require $archivo;
        }else{
             $archivo = "clases/" . str_replace('\\', '/', $clase) . ".php";
        }
    }
}
spl_autoload_register('AutoCarga::cargar');
=======
<?php

class AutoCarga {
    static public function cargar($clase) {
        $archivo = "../clases/" . str_replace('\\', '/', $clase) . ".php";
        
        if(file_exists($archivo)){
            require $archivo;
        }else{
             $archivo = "clases/" . str_replace('\\', '/', $clase) . ".php";
        }
    }
}
spl_autoload_register('AutoCarga::cargar');
>>>>>>> ff3f3ddc08a5ef4a24ee6e6a74ad38820b1cb951
