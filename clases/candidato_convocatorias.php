<?php
class candidato_convocatorias implements JsonSerializable{
    private $idConvocatoria;
    private $idCandidato;
    private $DNI;
    private $Nombre;
    private $Apellidos;
    private $Telefono;
    private $Correo;
    private $Domicilio;


    public function __construct($idConvocatoria, $idCandidato, $DNI, $Nombre, $Apellidos, $Telefono, $Correo, $Domicilio) {
        $this->idConvocatoria = $idConvocatoria;
        $this->idCandidato = $idCandidato;
        $this->DNI = $DNI;
        $this->Nombre = $Nombre;
        $this->Apellidos = $Apellidos;
        $this->Telefono = $Telefono;
        $this->Correo = $Correo;
        $this->Domicilio = $Domicilio;
    }

    public function getIdConvocatoria() {
        return $this->idConvocatoria;
    }

    public function getIdCandidato() {
        return $this->idCandidato;
    }

    public function setIdConvocatoria($idConvocatoria) {
        $this->idConvocatoria = $idConvocatoria;
    }

    public function setIdCandidato($idCandidato) {
        $this->idCandidato = $idCandidato;
    }

    public function getDNI() {
        return $this->DNI;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getApellidos() {
        return $this->Apellidos;
    }

    public function getTelefono() {
        return $this->Telefono;
    }

    public function getCorreo() {
        return $this->Correo;
    }

    public function getDomicilio() {
        return $this->Domicilio;
    }

    public function setDNI($DNI) {
        $this->DNI = $DNI;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function setApellidos($Apellidos) {
        $this->Apellidos = $Apellidos;
    }

    public function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    public function setCorreo($Correo) {
        $this->Correo = $Correo;
    }

    public function setDomicilio($Domicilio) {
        $this->Domicilio = $Domicilio;
    }

    // Método de la interfaz JsonSerializable para serializar el objeto a JSON
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars; 
    }
}
