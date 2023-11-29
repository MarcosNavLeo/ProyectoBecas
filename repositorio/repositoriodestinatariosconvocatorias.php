<?php
class RepositorioDestinatariosConvocatorias
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function insertarDestinatariosConvocatorias($destinatariosConvocatorias)
    {
        $query = "INSERT INTO destinatarios_convocatorias (idDestinatarios, idConvocatorias) 
                  VALUES (:idDestinatarios, :idConvocatorias)";

        $statement = $this->db->prepare($query);

        $idDestinatarios = $destinatariosConvocatorias->getIdDestinatarios();
        $idConvocatorias = $destinatariosConvocatorias->getIdConvocatorias();

        $statement->bindParam(':idDestinatarios', $idDestinatarios, PDO::PARAM_INT);
        $statement->bindParam(':idConvocatorias', $idConvocatorias, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function borrarDestinatariosConvocatorias($destinatariosConvocatorias)
    {
        $query = "DELETE FROM destinatarios_convocatorias 
                  WHERE idDestinatarios = :idDestinatarios 
                  AND idConvocatorias = :idConvocatorias";

        $idDestinatarios = $destinatariosConvocatorias->getIdDestinatarios();
        $idConvocatorias = $destinatariosConvocatorias->getIdConvocatorias();

        $statement = $this->db->prepare($query);

        $statement->bindParam(':idDestinatarios', $idDestinatarios, PDO::PARAM_INT);
        $statement->bindParam(':idConvocatorias', $idConvocatorias, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function actualizarDestinatariosConvocatorias($destinatariosConvocatorias)
    {
        $query = "UPDATE destinatarios_convocatorias 
                  SET idDestinatarios = :nuevoIdDestinatarios, idConvocatorias = :nuevoIdConvocatorias 
                  WHERE idDestinatarios = :idDestinatarios AND idConvocatorias = :idConvocatorias";

        $idDestinatarios = $destinatariosConvocatorias->getIdDestinatarios();
        $idConvocatorias = $destinatariosConvocatorias->getIdConvocatorias();
        $nuevoIdDestinatarios = $destinatariosConvocatorias->getNuevoIdDestinatarios();
        $nuevoIdConvocatorias = $destinatariosConvocatorias->getNuevoIdConvocatorias();

        $statement = $this->db->prepare($query);

        $statement->bindParam(':idDestinatarios', $idDestinatarios, PDO::PARAM_INT);
        $statement->bindParam(':idConvocatorias', $idConvocatorias, PDO::PARAM_INT);
        $statement->bindParam(':nuevoIdDestinatarios', $nuevoIdDestinatarios, PDO::PARAM_INT);
        $statement->bindParam(':nuevoIdConvocatorias', $nuevoIdConvocatorias, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function leerTodos()
    {
        $query = "SELECT idDestinatarios, idConvocatorias FROM destinatarios_convocatorias";
        $statement = $this->db->prepare($query);
        $statement->execute();

        $destinatariosConvocatoriasList = $statement->fetchAll(PDO::FETCH_ASSOC);

        $destinatariosConvocatorias = array();

        foreach ($destinatariosConvocatoriasList as $destinatariosConvocatoriasData) {
            $destinatariosConvocatorias[] = new DestinatariosConvocatorias(
                $destinatariosConvocatoriasData['idDestinatarios'],
                $destinatariosConvocatoriasData['idConvocatorias']
            );
        }

        return $destinatariosConvocatorias;
    }

    public function leerDestinatariosConvocatorias($idDestinatarios, $idConvocatorias)
    {
        $query = "SELECT * FROM destinatarios_convocatorias WHERE idDestinatarios = :idDestinatarios AND idConvocatorias = :idConvocatorias";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':idDestinatarios', $idDestinatarios, PDO::PARAM_INT);
        $statement->bindParam(':idConvocatorias', $idConvocatorias, PDO::PARAM_INT);
        $statement->execute();

        $destinatariosConvocatoriasData = $statement->fetch(PDO::FETCH_ASSOC);

        if ($destinatariosConvocatoriasData) {
            return new DestinatariosConvocatorias(
                $destinatariosConvocatoriasData['idDestinatarios'],
                $destinatariosConvocatoriasData['idConvocatorias']
            );
        }

        return null;
    }
}

