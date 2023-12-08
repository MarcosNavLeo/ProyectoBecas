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

    public function insertarConvocatoria($convocatoria) {
        $query = "INSERT INTO Convocatorias 
                  (Movilidades, Tiipo, Fecha_ini, Fecha_fin, Fecha_ini_baremacion, 
                  Fecha_fin_baremacion, Fecha_lis_provisional, Fecha_lis_definitiva,Destino,
                  Proyectos_CodProyecto)
                  VALUES 
                  (:movilidades, :tiipo, :fechaIni, :fechaFin, :fechaIniBaremacion, 
                  :fechaFinBaremacion, :fechaLisProvisional, :fechaLisDefinitiva,:destino,
                  :codProyecto)";
    
        $statement = $this->db->prepare($query);
    
        $movilidades = $convocatoria->getMovilidades();
        $tiipo = $convocatoria->getTipo();
        $fechaIni = $convocatoria->getFechaIni();
        $fechaFin = $convocatoria->getFechaFin();
        $fechaIniBaremacion = $convocatoria->getFechaIniBaremacion();
        $fechaFinBaremacion = $convocatoria->getFechaFinBaremacion();
        $fechaLisProvisional = $convocatoria->getFechaLisProvisional();
        $fechaLisDefinitiva = $convocatoria->getFechaLisDefinitiva();
        $destino = $convocatoria->getDestino();
        $codProyecto = $convocatoria->getProyectosCodProyecto();
    
        $statement->bindParam(':movilidades', $movilidades);
        $statement->bindParam(':tiipo', $tiipo);
        $statement->bindParam(':fechaIni', $fechaIni);
        $statement->bindParam(':fechaFin', $fechaFin);
        $statement->bindParam(':fechaIniBaremacion', $fechaIniBaremacion);
        $statement->bindParam(':fechaFinBaremacion', $fechaFinBaremacion);
        $statement->bindParam(':fechaLisProvisional', $fechaLisProvisional);
        $statement->bindParam(':fechaLisDefinitiva', $fechaLisDefinitiva);
        $statement->bindParam(':destino', $destino);
        $statement->bindParam(':codProyecto', $codProyecto);
    
        return $statement->execute();
    }
    
    public function borrarConvocatoria($idConvocatoria) {
        $query = "DELETE FROM Convocatorias WHERE idConvocatorias = :idConvocatoria";

        $statement = $this->db->prepare($query);
        $statement->bindParam(':idConvocatoria', $idConvocatoria, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function actualizarConvocatoria($convocatoria) {
        $query = "UPDATE Convocatorias 
                  SET Movilidades = :movilidades,
                      Tiipo = :tiipo,
                      Fecha_ini = :fechaIni,
                      Fecha_fin = :fechaFin,
                      Fecha_ini_baremacion = :fechaIniBaremacion,
                      Fecha_fin_baremacion = :fechaFinBaremacion,
                      Fecha_lis_provisional = :fechaLisProvisional,
                      Fecha_lis_definitiva = :fechaLisDefinitiva,
                      Proyectos_CodProyecto = :codProyecto,
                      Candidatos_idCandidato = :idCandidato
                  WHERE idConvocatorias = :idConvocatoria";

        $statement = $this->db->prepare($query);

        $statement->bindParam(':movilidades', $convocatoria->getMovilidades());
        $statement->bindParam(':tiipo', $convocatoria->getTiipo());
        $statement->bindParam(':fechaIni', $convocatoria->getFechaIni());
        $statement->bindParam(':fechaFin', $convocatoria->getFechaFin());
        $statement->bindParam(':fechaIniBaremacion', $convocatoria->getFechaIniBaremacion());
        $statement->bindParam(':fechaFinBaremacion', $convocatoria->getFechaFinBaremacion());
        $statement->bindParam(':fechaLisProvisional', $convocatoria->getFechaLisProvisional());
        $statement->bindParam(':fechaLisDefinitiva', $convocatoria->getFechaLisDefinitiva());
        $statement->bindParam(':codProyecto', $convocatoria->getCodProyecto());
        $statement->bindParam(':idCandidato', $convocatoria->getIdCandidato());
        $statement->bindParam(':idConvocatoria', $convocatoria->getIdConvocatoria(), PDO::PARAM_INT);

        return $statement->execute();
    }

    public function obtenerUltimoIDInsertado() {
        // Suponiendo que estás usando PDO
        $lastID = $this->db->lastInsertId();

        return $lastID;
    }

    public function crearconvocatoriaentera($convocatoria,$destinatarios,$convocatoria_baremo){
        

    }

    public function leerConvocatoriasActivas()
{
    $currentDate = date('Y-m-d'); // Obtener la fecha actual

    $query = "SELECT * FROM Convocatorias 
              WHERE Fecha_ini = :fechaActual AND Fecha_fin >= :fechaActual";

    $statement = $this->db->prepare($query);
    $statement->bindParam(':fechaActual', $currentDate);
    $statement->execute();

    $convocatorias = [];

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
            $row['Destino'],
            $row['Proyectos_CodProyecto']
        );

        $convocatorias[] = $convocatoria;
    }

    return $convocatorias;
}

}
?>