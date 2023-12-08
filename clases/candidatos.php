<?php
class Candidatos implements JsonSerializable {
    private $idCandidato;
    private $DNI;
    private $Apellidos;
    private $Nombre;
    private $curso;
    private $Telefono;
    private $correo;
    private $Domicilio;
    private $Fecha_nacimiento;
    private $password;
    private $rol;

    public function __construct($idCandidato, $DNI, $Apellidos, $Nombre, $curso, $Telefono, $correo, $Domicilio, $Fecha_nacimiento, $password, $rol) {
        $this->idCandidato = $idCandidato;
        $this->DNI = $DNI;
        $this->Apellidos = $Apellidos;
        $this->Nombre = $Nombre;
        $this->curso = $curso;
        $this->Telefono = $Telefono;
        $this->correo = $correo;
        $this->Domicilio = $Domicilio;
        $this->Fecha_nacimiento = $Fecha_nacimiento;
        $this->password = $password;
        $this->rol = $rol;
    }
    
    
    public function getIdCandidato() {
        return $this->idCandidato;
    }

    public function setIdCandidato($idCandidato) {
        $this->idCandidato = $idCandidato;
    }

    public function getDNI() {
        return $this->DNI;
    }

    public function setDNI($DNI) {
        $this->DNI = $DNI;
    }

    public function getApellidos() {
        return $this->Apellidos;
    }

    public function setApellidos($Apellidos) {
        $this->Apellidos = $Apellidos;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function getTelefono() {
        return $this->Telefono;
    }

    public function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getDomicilio() {
        return $this->Domicilio;
    }

    public function setDomicilio($Domicilio) {
        $this->Domicilio = $Domicilio;
    }

    public function getFecha_nacimiento() {
        return $this->Fecha_nacimiento;
    }

    public function setFecha_nacimiento($Fecha_nacimiento) {
        $this->Fecha_nacimiento = $Fecha_nacimiento;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    // Método de la interfaz JsonSerializable para serializar el objeto a JSON
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars; 
    }
}
