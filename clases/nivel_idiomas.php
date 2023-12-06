<?php
class nivel_idiomas implements JsonSerializable{
    private $nivel;

    public function __construct($nivel) {
        $this->nivel = $nivel;
    }

    // Métodos setters y getters
    public function getNivel() {
        return $this->nivel;
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    // Método de la interfaz JsonSerializable para serializar el objeto a JSON
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars; 
    }
}

?>
