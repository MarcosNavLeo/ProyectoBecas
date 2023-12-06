<?php
class item_barenables implements JsonSerializable{
    // Propiedades de la clase
    private $idItemBarenables;
    private $nombre;

    // Constructor
    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    // Métodos para establecer y obtener valores
    public function setIdItemBarenables($idItemBarenables) {
        $this->idItemBarenables = $idItemBarenables;
    }

    public function getIdItemBarenables() {
        return $this->idItemBarenables;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }

    // Método de la interfaz JsonSerializable para serializar el objeto a JSON
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars; 
    }
}
?>
