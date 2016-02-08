<?php
class Session {
    
    private static $iniciada = false;
    //private $trusted=true;
    
    function __construct($nombre=NULL) {
        if($nombre!=NULL){
            session_name($nombre);
        }
        if (!self::$iniciada) {
            session_start();
            $ip = $this->get('_ip');
            $cliente = $this->get('_cliente');

            if ($ip == null && $cliente == null) {
                $this->set('_ip', Server::getClientAddress());
                $this->set('_cliente', Server::getUserAgent());
            } else {
                if ($ip !== Server::getClientAddress() || $cliente !== Server::getUserAgent()) {
                    session_destroy();
                    //$this->trusted=false;
                }
            }
        }
        self::$iniciada = true;
       
    }

    function get($nombre) {
        if (isset($_SESSION[$nombre])) {
            return $_SESSION[$nombre];
        }
        return null;
    }

    function set($nombre, $valor) {
        $_SESSION[$nombre] = $valor;
    }

    function delete($nombre) {
        if (isset($_SESSION[$nombre])) {
            unset($_SESSION[$nombre]);
        }
    }

    function destroy() {
        session_unset();
        session_destroy();
    }
    
    
    function setUser(Usuario $usuario){
        $this->set('_usuario',$usuario);
    }
    
     function getUser(){
        return $this->get('_usuario');
    }
    
    function isLogged(){
        return $this->getUser()!=NULL;
    }
    
    function sendRedirect($destiny="index.php", $final = true){
        header("Location:$destiny");
        if($final===true){
            exit();
        }
    }
    
   

}
