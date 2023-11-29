<?php
class CandidatoConvocatoria implements JsonSerializable{
    private $idConvocatoria;
    private $idCandidato;

    public function __construct($idConvocatoria, $idCandidato) {
        $this->idConvocatoria = $idConvocatoria;
        $this->idCandidato = $idCandidato;
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

    // Método de la interfaz JsonSerializable para serializar el objeto a JSON
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars; 
    }
}
