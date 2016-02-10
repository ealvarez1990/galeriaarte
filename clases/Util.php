<<<<<<< HEAD
<?php

class Util {
   static function getSelect($name, $parametros, $valorSeleccionado=NULL, $blanco=TRUE, $atributos="", $id=NULL){
       if($id!=NULL){
           $id="id='$id'";
       }else{
           $id="";
       }
       $r="<select class="."'form-group input-group'"."name='$name' $id $atributos> \n";
       if($blanco){
           $r.="<option value=''>&nbsp;</option>\n";
       }
       foreach ($parametros as $indice => $valor) {
           $selected="";
           if($valorSeleccionado!=null && $indice===$valorSeleccionado){
               $selected="selected";
           }
           $r.="<option $selected value='$indice'>$valor</option>\n";
       }
       $r .="</select>\n";
       return $r;
   }
}
=======
<?php

class Util {
   static function getSelect($name, $parametros, $valorSeleccionado=NULL, $blanco=TRUE, $atributos="", $id=NULL){
       if($id!=NULL){
           $id="id='$id'";
       }else{
           $id="";
       }
       $r="<select class="."'form-group input-group'"."name='$name' $id $atributos> \n";
       if($blanco){
           $r.="<option value=''>&nbsp;</option>\n";
       }
       foreach ($parametros as $indice => $valor) {
           $selected="";
           if($valorSeleccionado!=null && $indice===$valorSeleccionado){
               $selected="selected";
           }
           $r.="<option $selected value='$indice'>$valor</option>\n";
       }
       $r .="</select>\n";
       return $r;
   }
}
>>>>>>> ff3f3ddc08a5ef4a24ee6e6a74ad38820b1cb951
