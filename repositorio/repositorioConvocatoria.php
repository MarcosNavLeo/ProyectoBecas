<?php
class RepositorioConvocatoria
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function obtenerConvocatoriasActivas($idCandidato) {
        $query = "SELECT *
            FROM Convocatorias
            WHERE idCandidato = :idCandidato";

        $statement = $this->db->prepare($query);
        $statement->bindParam(':idCandidato', $idCandidato, PDO::PARAM_INT);
        $statement->execute();

        $convocatoriasActivas = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $convocatoria = new Convocatorias(
                $row['idConvocatorias'],
                $row['Movilidades'],
                $row['Tiipo'],
                $row['Fecha_ini'],
                $row['Fecha_fin'],
                $row['Fecha_ini_baremacion'],
                $row['Fecha_fin_baremacion'],
                $row['Fecha_lis_provisional'],
                $row['Fecha_lis_definitiva'],
                $row['Proyectos_CodProyecto'],
                $row['idCandidato']
            );

            // Agregar el objeto convocatoria al array
            $convocatoriasActivas[] = $convocatoria;
        }

        return $convocatoriasActivas;
    }
}
?>