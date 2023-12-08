<?php
class RepositorioCandidatoConvocatorias
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function insertarCandidatoConvocatoria($candidatoConvocatoria) {
        
        $idConvocatoria = $candidatoConvocatoria->getIdConvocatoria();
        $idCandidato = $candidatoConvocatoria->getIdCandidato();
        $DNI = $candidatoConvocatoria->getDNI();
        $Nombre = $candidatoConvocatoria->getNombre();
        $Apellidos = $candidatoConvocatoria->getApellidos();
        $Telefono = $candidatoConvocatoria->getTelefono();
        $Correo = $candidatoConvocatoria->getCorreo();
        $Domicilio = $candidatoConvocatoria->getDomicilio();
        
        $query = "INSERT INTO candidato_convocatorias (Convocatorias_idConvocatorias, Candidatos_idCandidato,DNI,Nombre,Apellidos,Telefono,Correo,Domicilio) 
                  VALUES (:idConvocatoria, :idCandidato,:DNI,:Nombre,:Apellidos,:Telefono,:Correo,:Domicilio)";

        $statement = $this->db->prepare($query);


        $statement->bindParam(':idConvocatoria', $idConvocatoria, PDO::PARAM_INT);
        $statement->bindParam(':idCandidato', $idCandidato, PDO::PARAM_INT);
        $statement->bindParam(':DNI', $DNI, PDO::PARAM_STR);
        $statement->bindParam(':Nombre', $Nombre, PDO::PARAM_STR);
        $statement->bindParam(':Apellidos', $Apellidos, PDO::PARAM_STR);
        $statement->bindParam(':Telefono', $Telefono, PDO::PARAM_STR);
        $statement->bindParam(':Correo', $Correo, PDO::PARAM_STR);
        $statement->bindParam(':Domicilio', $Domicilio, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function borrarCandidatoConvocatoria($candidatoConvocatoria) {
        $query = "DELETE FROM candidato_convocatorias 
                  WHERE Convocatorias_idConvocatorias = :idConvocatoria 
                  AND Candidatos_idCandidato = :idCandidato";

        $statement = $this->db->prepare($query);

        $idConvocatoria = $candidatoConvocatoria->getIdConvocatoria();
        $idCandidato = $candidatoConvocatoria->getIdCandidato();

        $statement->bindParam(':idConvocatoria', $idConvocatoria, PDO::PARAM_INT);
        $statement->bindParam(':idCandidato', $idCandidato, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function actualizarCandidatoConvocatoria($candidatoConvocatoria) {
        $query = "UPDATE candidato_convocatorias 
                  SET Convocatorias_idConvocatorias = :nuevoIdConvocatoria, Candidatos_idCandidato = :nuevoIdCandidato 
                  WHERE Convocatorias_idConvocatorias = :idConvocatoria AND Candidatos_idCandidato = :idCandidato";
    
        $statement = $this->db->prepare($query);
    
        $idConvocatoria = $candidatoConvocatoria->getIdConvocatoria();
        $idCandidato = $candidatoConvocatoria->getIdCandidato();
        $nuevoIdConvocatoria = $candidatoConvocatoria->getNuevoIdConvocatoria();
        $nuevoIdCandidato = $candidatoConvocatoria->getNuevoIdCandidato();
    
        $statement->bindParam(':idConvocatoria', $idConvocatoria, PDO::PARAM_INT);
        $statement->bindParam(':idCandidato', $idCandidato, PDO::PARAM_INT);
        $statement->bindParam(':nuevoIdConvocatoria', $nuevoIdConvocatoria, PDO::PARAM_INT);
        $statement->bindParam(':nuevoIdCandidato', $nuevoIdCandidato, PDO::PARAM_INT);
    
        return $statement->execute();
    }
    

    public function leerTodos() {
        $query = "SELECT Convocatorias_idConvocatorias, Candidatos_idCandidato FROM candidato_convocatorias";
        $statement = $this->db->prepare($query);
        $statement->execute();
    
        $candidatoConvocatoriasList = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        $candidatoConvocatorias = array();
    
        foreach ($candidatoConvocatoriasList as $candidatoConvocatoriaData) {
            $candidatoConvocatoria = new CandidatoConvocatoria($candidatoConvocatoriaData['Convocatorias_idConvocatorias'], $candidatoConvocatoriaData['Candidatos_idCandidato']);
            $candidatoConvocatorias[] = $candidatoConvocatoria;
        }
    
        return $candidatoConvocatorias;
    }

    public function leerCandidatoConvocatoria($candidatoConvocatoria) {
        $query = "SELECT * FROM candidato_convocatorias WHERE Convocatorias_idConvocatorias = :idConvocatoria AND Candidatos_idCandidato = :idCandidato";
        $statement = $this->db->prepare($query);

        $idConvocatoria = $candidatoConvocatoria->getIdConvocatoria();
        $idCandidato = $candidatoConvocatoria->getIdCandidato();

        $statement->bindParam(':idConvocatoria', $idConvocatoria, PDO::PARAM_INT);
        $statement->bindParam(':idCandidato', $idCandidato, PDO::PARAM_INT);
        $statement->execute();
    
        $candidatoConvocatoriaData = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($candidatoConvocatoriaData) {
            return new CandidatoConvocatoria(
                $candidatoConvocatoriaData['Convocatorias_idConvocatorias'],
                $candidatoConvocatoriaData['Candidatos_idCandidato']
            );
        }
    
        return null;
    }
    
}

?>
