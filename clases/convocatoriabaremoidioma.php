<?php
class ConvocatoriaBaremoIdioma implements JsonSerializable{
    // Propiedades de la clase
    private $idItemBaremo;
    private $idConvocatoria;
    private $nivelIdioma;
    private $puntos;

    // Constructor
    public function __construct($idItemBaremo, $idConvocatoria, $nivelIdioma, $puntos) {
        $this->idItemBaremo = $idItemBaremo;
        $this->idConvocatoria = $idConvocatoria;
        $this->nivelIdioma = $nivelIdioma;
        $this->puntos = $puntos;
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

    public function setNivelIdioma($nivelIdioma) {
        $this->nivelIdioma = $nivelIdioma;
    }

    public function getNivelIdioma() {
        return $this->nivelIdioma;
    }

    public function setPuntos($puntos) {
        $this->puntos = $puntos;
    }

    public function getPuntos() {
        return $this->puntos;
    }

    // Método de la interfaz JsonSerializable para serializar el objeto a JSON
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars; 
    }

}
?>
