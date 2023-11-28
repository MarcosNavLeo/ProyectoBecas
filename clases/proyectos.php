<?php
class Proyectos {
    // Propiedades de la clase
    private $codProyecto;
    private $nombre;
    private $fechaIni;
    private $fechaFin;

    // Constructor
    public function __construct($nombre, $fechaIni, $fechaFin) {
        $this->nombre = $nombre;
        $this->fechaIni = $fechaIni;
        $this->fechaFin = $fechaFin;
    }

    // Métodos para establecer y obtener valores
    public function setCodProyecto($codProyecto) {
        $this->codProyecto = $codProyecto;
    }

    public function getCodProyecto() {
        return $this->codProyecto;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setFechaIni($fechaIni) {
        $this->fechaIni = $fechaIni;
    }

    public function getFechaIni() {
        return $this->fechaIni;
    }

    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    public function getFechaFin() {
        return $this->fechaFin;
    }
}
?>