<?php
class RepositorioDestinatarios
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function insertarDestinatario($destinatario)
    {
        $query = "INSERT INTO destinatarios (codGrupo, nombre) 
                  VALUES (:codGrupo, :nombre)";

        $statement = $this->db->prepare($query);

        $codGrupo = $destinatario->getCodGrupo();
        $nombre = $destinatario->getNombre();

        $statement->bindParam(':codGrupo', $codGrupo, PDO::PARAM_INT);
        $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function borrarDestinatario($destinatario)
    {
        $query = "DELETE FROM destinatarios 
                  WHERE idDestinatarios = :idDestinatarios";

        $idDestinatarios = $destinatario->getIdDestinatarios();

        $statement = $this->db->prepare($query);
        $statement->bindParam(':idDestinatarios', $idDestinatarios, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function actualizarDestinatario($destinatario)
    {
        $query = "UPDATE destinatarios 
                  SET codGrupo = :codGrupo, nombre = :nombre
                  WHERE idDestinatarios = :idDestinatarios";

        $idDestinatarios = $destinatario->getIdDestinatarios();
        $codGrupo = $destinatario->getCodGrupo();
        $nombre = $destinatario->getNombre();

        $statement = $this->db->prepare($query);
        $statement->bindParam(':idDestinatarios', $idDestinatarios, PDO::PARAM_INT);
        $statement->bindParam(':codGrupo', $codGrupo, PDO::PARAM_INT);
        $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function leerTodos()
    {
        $query = "SELECT idDestinatarios, codGrupo, nombre FROM destinatarios";
        $statement = $this->db->prepare($query);
        $statement->execute();

        $destinatariosList = $statement->fetchAll(PDO::FETCH_ASSOC);

        $destinatarios = array();

        foreach ($destinatariosList as $destinatarioData) {
            $destinatario = new Destinatarios(
                $destinatarioData['codGrupo'],
                $destinatarioData['nombre']
            );
            $destinatario->setIdDestinatarios($destinatarioData['idDestinatarios']);
            $destinatarios[] = $destinatario;
        }

        return $destinatarios;
    }

    public function leerDestinatario($idDestinatarios)
    {
        $query = "SELECT * FROM destinatarios WHERE idDestinatarios = :idDestinatarios";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':idDestinatarios', $idDestinatarios, PDO::PARAM_INT);
        $statement->execute();

        $destinatarioData = $statement->fetch(PDO::FETCH_ASSOC);

        if ($destinatarioData) {
            $destinatario = new Destinatarios(
                $destinatarioData['codGrupo'],
                $destinatarioData['nombre']
            );
            $destinatario->setIdDestinatarios($destinatarioData['idDestinatarios']);
            return $destinatario;
        }

        return null;
    }
}

