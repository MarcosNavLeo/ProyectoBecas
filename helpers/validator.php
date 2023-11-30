<?php
class Validator
{
    //Array de errores
    private $errores;

    //Constructor
    public function __construct()
    {
        $this->errores = array();
    }
    public function Requerido($campo)
    {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $this->errores[$campo] = "El campo $campo no puede estar vacio";
            return false;
        }
        return true;
    }


    //funcion que valida un email
    public function validaEmail($email)
    {
        // Utilizando una expresión regular para validar el formato del correo electrónico
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true; // El correo electrónico es válido
        } else {
            return false; // El correo electrónico no es válido
        }
    }

    public function validaDNI($dni)
{
    // Validación básica de longitud y estructura del DNI
    if (preg_match('/^[0-9]{8}[A-Za-z]$/', $dni)) {
        $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $dniNumero = substr($dni, 0, 8);
        $letraValida = $letras[$dniNumero % 23];

        // Verificar si la letra introducida coincide con la letra esperada
        if (strtoupper($letraValida) === strtoupper(substr($dni, -1))) {
            return true; // El DNI es válido
        }
    }
    return false; // El DNI no es válido
}


    //funcion que valida el rango de edad valido
    public function validaEdad($clave, $valor, $min, $max)
    {
    }
    //funcion que comprueba si hay errores
    public function hayErrores()
    {
    }
    //funcion que devuelve un array de errores
    public function getErrores()
    {

    }

    //por comentar
    public function getValor($campo)
    {
        return
            isset($_POST[$campo]) ? $_POST[$campo] : '';
    }

    public function getSelected($campo, $valor)
    {
        return
            isset($_POST[$campo]) && $_POST[$campo] == $valor ? 'selected' : '';
    }

    public function getChecked($campo, $valor)
    {
        return
            isset($_POST[$campo]) && $_POST[$campo] == $valor ? 'checked' : '';
    }
    //----

    //cuenta los errores del array
    public function ValidacionPasada()
    {
        if (count($this->errores) != 0) {
            return false;
        }
        return true;
    }
    //imprime los errores segun el campo
    public function ImprimirError($campo = null)
    {
        if ($campo !== null && isset($this->errores[$campo])) {
            return '<span class="error_mensaje">' . $this->errores[$campo] . '</span>';
        }
    }
    public function ErrorAutenticacion()
    {
        $this->errores['autenticacion'] = "El usuario o la contraseña son incorrectos";
    }





}
?>