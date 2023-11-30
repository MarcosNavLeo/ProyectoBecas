<?php
class RepositorioProyectos
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function insertarProyecto($proyecto)
    {
        $query = "INSERT INTO proyectos (nombre, fechaIni, fechaFin) 
                  VALUES (:nombre, :fechaIni, :fechaFin)";

        $statement = $this->db->prepare($query);

        $nombre = $proyecto->getNombre();
        $fechaIni = $proyecto->getFechaIni();
        $fechaFin = $proyecto->getFechaFin();

        $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $statement->bindParam(':fechaIni', $fechaIni, PDO::PARAM_STR);
        $statement->bindParam(':fechaFin', $fechaFin, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function borrarProyecto($proyecto)
    {
        $query = "DELETE FROM proyectos 
                  WHERE codProyecto = :codProyecto";

        $codProyecto = $proyecto->getCodProyecto();

        $statement = $this->db->prepare($query);

        $statement->bindParam(':codProyecto', $codProyecto, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function actualizarProyecto($proyecto)
    {
        $query = "UPDATE proyectos 
                  SET nombre = :nombre, fechaIni = :fechaIni, fechaFin = :fechaFin
                  WHERE codProyecto = :codProyecto";

        $codProyecto = $proyecto->getCodProyecto();
        $nombre = $proyecto->getNombre();
        $fechaIni = $proyecto->getFechaIni();
        $fechaFin = $proyecto->getFechaFin();

        $statement = $this->db->prepare($query);

        $statement->bindParam(':codProyecto', $codProyecto, PDO::PARAM_INT);
        $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $statement->bindParam(':fechaIni', $fechaIni, PDO::PARAM_STR);
        $statement->bindParam(':fechaFin', $fechaFin, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function leerTodos()
    {
        $query = "SELECT CodProyecto, Nombre, fecha_Ini, fecha_Fin FROM proyectos";
        $statement = $this->db->prepare($query);
        $statement->execute();

        $proyectosList = $statement->fetchAll(PDO::FETCH_ASSOC);

        $proyectos = array();

        foreach ($proyectosList as $proyectoData) {
            $proyecto = new Proyectos(
                $proyectoData['CodProyecto'],
                $proyectoData['Nombre'],
                $proyectoData['fecha_Ini'],
                $proyectoData['fecha_Fin']
            );
            $proyectos[] = $proyecto;
        }

        return $proyectos;
    }

    public function leerProyecto($codProyecto)
    {
        $query = "SELECT * FROM proyectos WHERE codProyecto = :codProyecto";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':codProyecto', $codProyecto, PDO::PARAM_INT);
        $statement->execute();

        $proyectoData = $statement->fetch(PDO::FETCH_ASSOC);

        if ($proyectoData) {
            $proyecto = new Proyectos(
                $proyectoData['nombre'],
                $proyectoData['fechaIni'],
                $proyectoData['fechaFin']
            );
            $proyecto->setCodProyecto($proyectoData['codProyecto']);
            return $proyecto;
        }

        return null;
    }
}
