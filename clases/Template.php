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
