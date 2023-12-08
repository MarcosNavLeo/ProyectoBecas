<?php

class ConvocatoriaBaremo implements JsonSerializable{
    // Propiedades de la clase
    private $idItemBaremo;
    private $idConvocatoria;
    private $maximoPuntos;
    private $requisito;
    private $minimo;
    private $presenta;

    // Constructor
    public function __construct($idItemBaremo, $idConvocatoria, $maximoPuntos, $requisito, $minimo, $presenta) {
        $this->idItemBaremo = $idItemBaremo;
        $this->idConvocatoria = $idConvocatoria;
        $this->maximoPuntos = $maximoPuntos;
        $this->requisito = $requisito;
        $this->minimo = $minimo;
        $this->presenta = $presenta;
    }

    // Métodos para establecer y obtener valores
    public function setIdItemBaremo($idItemBaremo) {
        $this->idItemBaremo = $idItemBaremo;
    }

    public function getIdItemBaremo() {
        return $this->idItemBaremo;
    }

    public function setIdConvocatoria($idConvocatoria) {
        $this->idConvocatoria = $idConvocatoria;
    }

    public function getIdConvocatoria() {
        return $this->idConvocatoria;
    }

    public function setMaximoPuntos($maximoPuntos) {
        $this->maximoPuntos = $maximoPuntos;
    }

    public function getMaximoPuntos() {
        return $this->maximoPuntos;
    }

    public function setRequisito($requisito) {
        $this->requisito = $requisito;
    }

    public function getRequisito() {
        return $this->requisito;
    }

    public function setMinimo($minimo) {
        $this->minimo = $minimo;
    }

    public function getMinimo() {
        return $this->minimo;
    }

    public function setPresenta($presenta) {
        $this->presenta = $presenta;
    }

    public function getPresenta() {
        return $this->presenta;
    }

    // Método de la interfaz JsonSerializable para serializar el objeto a JSON
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars; 
    }
}
?>
