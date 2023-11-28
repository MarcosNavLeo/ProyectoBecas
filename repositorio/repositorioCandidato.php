<?php
class repositorioCandidato
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createCandidato($candidato)
    {
        $query = "INSERT INTO Candidatos (DNI, Apellidos, Nombre, curso, Telefono, correo, Domicilio, Fecha_nacimiento, password)
                  VALUES (:dni, :apellidos, :nombre, :curso, :telefono, :correo, :domicilio, :fechaNacimiento, :password)";

        $stmt = $this->conn->prepare($query);

        $dni = $candidato->getDNI();
        $apellidos = $candidato->getApellidos();
        $nombre = $candidato->getNombre();
        $curso = $candidato->getCurso();
        $telefono = $candidato->getTelefono();
        $correo = $candidato->getCorreo();
        $domicilio = $candidato->getDomicilio();
        $fechaNacimiento = $candidato->getFecha_nacimiento();
        $password = $candidato->getPassword();

        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':curso', $curso);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':domicilio', $domicilio);
        $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            return true; // Éxito al insertar el candidato
        } else {
            return false; // Error al insertar el candidato
        }
    }

    public function getCandidatoPorNombre($nombre)
    {
        $query = "SELECT * FROM Candidatos WHERE Nombre = :nombre";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Aquí creas un objeto Candidato con los datos obtenidos de la base de datos
            $candidato = new Candidatos(
                $row['idCandidato'],
                $row['DNI'],
                $row['Apellidos'],
                $row['Nombre'],
                $row['curso'],
                $row['Telefono'],
                $row['correo'],
                $row['Domicilio'],
                $row['Fecha_nacimiento'],
                $row['password'],
                $row['rol']
            );
            
            return $candidato;
            
        } else {
            return null; // No se encontró ningún candidato con ese nombre
        }
    }

}
?>