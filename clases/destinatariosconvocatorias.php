<?php
class destinatariosconvocatorias {
    // Propiedades de la clase
    private $idDestinatarios;
    private $idConvocatorias;

    // Constructor
    public function __construct($idDestinatarios, $idConvocatorias) {
        $this->idDestinatarios = $idDestinatarios;
        $this->idConvocatorias = $idConvocatorias;
    }

    // Métodos para establecer y obtener valores
    public function setIdDestinatarios($idDestinatarios) {
        $this->idDestinatarios = $idDestinatarios;
    }

    public function getIdDestinatarios() {
        return $this->idDestinatarios;
    }

    public function setIdConvocatorias($idConvocatorias) {
        $this->idConvocatorias = $idConvocatorias;
    }

    public function getIdConvocatorias() {
        return $this->idConvocatorias;
    }
}
?>
