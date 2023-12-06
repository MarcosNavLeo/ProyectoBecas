<?php
class Destinatarios implements JsonSerializable{
    // Propiedades de la clase
    private $idDestinatarios;
    private $codGrupo;
    private $nombre;

    // Constructor
    public function __construct($codGrupo, $nombre) {
        $this->codGrupo = $codGrupo;
        $this->nombre = $nombre;
    }

    // Métodos para establecer y obtener valores
    public function setIdDestinatarios($idDestinatarios) {
        $this->idDestinatarios = $idDestinatarios;
    }

    public function getIdDestinatarios() {
        return $this->idDestinatarios;
    }

    public function setCodGrupo($codGrupo) {
        $this->codGrupo = $codGrupo;
    }

    public function getCodGrupo() {
        return $this->codGrupo;
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
