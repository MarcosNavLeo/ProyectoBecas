<?php
class repositoriobaremacion{
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createBaremacion(baremacion $baremacion) {
        $query = "INSERT INTO Baremacion (idBaremacion, iditem_barenables, idConvocatorias, url, Candidatos_idCandidato)
                  VALUES (:idBaremacion, :iditem_barenables, :idConvocatorias, :url, :Candidatos_idCandidato)";

        $stmt = $this->conn->prepare($query);

        $idBaremacion = $baremacion->getIdbaremacion();
        $iditem_barenables = $baremacion->getIditem_barenables();
        $idConvocatorias = $baremacion->getIdConvocatorias();
        $url = $baremacion->getUrl();
        $Candidatos_idCandidato = $baremacion->getCandidatos_idCandidato();

        $stmt->bindParam(':idBaremacion', $idBaremacion);
        $stmt->bindParam(':iditem_barenables', $iditem_barenables);
        $stmt->bindParam(':idConvocatorias', $idConvocatorias);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':Candidatos_idCandidato', $Candidatos_idCandidato);

        if ($stmt->execute()) {
            return true; // Éxito al insertar la baremación
        } else {
            return false; // Error al insertar la baremación
        }
    }
    public function updateBaremacion(baremacion $baremacion) {
        $query = "UPDATE Baremacion SET iditem_barenables = :iditem_barenables, idConvocatorias = :idConvocatorias,
                  url = :url, Candidatos_idCandidato = :Candidatos_idCandidato
                  WHERE idBaremacion = :idBaremacion";

        $stmt = $this->conn->prepare($query);

        $idBaremacion = $baremacion->getIdbaremacion();
        $iditem_barenables = $baremacion->getIditem_barenables();
        $idConvocatorias = $baremacion->getIdConvocatorias();
        $url = $baremacion->getUrl();
        $Candidatos_idCandidato = $baremacion->getCandidatos_idCandidato();

        $stmt->bindParam(':idBaremacion', $idBaremacion);
        $stmt->bindParam(':iditem_barenables', $iditem_barenables);
        $stmt->bindParam(':idConvocatorias', $idConvocatorias);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':Candidatos_idCandidato', $Candidatos_idCandidato);

        if ($stmt->execute()) {
            return true; // Éxito al actualizar la baremación
        } else {
            return false; // Error al actualizar la baremación
        }
    }

    public function deleteBaremacion($idBaremacion) {
        $query = "DELETE FROM Baremacion WHERE idBaremacion = :idBaremacion";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idBaremacion', $idBaremacion);

        if ($stmt->execute()) {
            return true; // Éxito al borrar la baremación
        } else {
            return false; // Error al borrar la baremación
        }
    }
}