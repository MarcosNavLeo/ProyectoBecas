<?php
class Login
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }
    //funcion que inicia sesion del usuario
    public function user_login($nombre, $contrasena)
    {
        $repositorio = new repositorioCandidato($this->conexion);
        $userData = $repositorio->getCandidatoPorNombre($nombre);

        if ($userData != null && $userData->getPassword() == $contrasena) {
            if ($userData->getRol() == "admin") {
                header("location:?menu=PrinAdmin");
            } else if ($userData->getRol() == "alumno") {
                header("location:?menu=PrinAlum");
            }
            Session::loginsession($userData);
            return true;
        } else {
            return false;
        }
    }


    public static function estaalogeado()
    {
        return isset($_SESSION['user']);
    }
}