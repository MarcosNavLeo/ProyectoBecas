<?php
class Session{
    public static function inicia_sesion(){
        session_start();
    }
    
    public static function cierra_sesion(){
        session_destroy();
    }
    public static function guarda_sesion($clave,$valor){
        $_SESSION[$clave]=$valor;
    }
    
    public static function lee_sesion($clave){
        if (isset($_SESSION[$clave])){
            return $_SESSION[$clave];
        }else{
            return "";
        }
        
    }
    
    public static function loginsession($user){
        self::inicia_sesion(); 
        self::guarda_sesion('user', $user);
    }
}