<<<<<<< HEAD
<?php

class Template {

    function getContents($cadena){
        return file_get_contents($cadena);
    }
    
    function replace($cadena, $valor, $variable_contentenedora){
        return str_replace("{".$cadena."}", $valor, $variable_contentenedora);
    }
    
    function insertTemplate($variableTemplate, $arrayElementoTemplate){
        foreach ($arrayElementoTemplate as $key => $value) {
            $variableTemplate=  $this->replace($key, $value, $variableTemplate);
        }
        return $variableTemplate;
    }
    
    
    
    
}
=======
<?php

class Template {

    function getContents($cadena){
        return file_get_contents($cadena);
    }
    
    function replace($cadena, $valor, $variable_contentenedora){
        return str_replace("{".$cadena."}", $valor, $variable_contentenedora);
    }
    
    function insertTemplate($variableTemplate, $arrayElementoTemplate){
        foreach ($arrayElementoTemplate as $key => $value) {
            $variableTemplate=  $this->replace($key, $value, $variableTemplate);
        }
        return $variableTemplate;
    }
    
    
    
    
}
>>>>>>> ff3f3ddc08a5ef4a24ee6e6a74ad38820b1cb951
