<?php
class RepositoriobaremoIdioma
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function insertarNivelIdioma($nivelIdioma) {
        $query = "INSERT INTO nivel_idiomas (nivel) 
                  VALUES (:nivel)";

        $statement = $this->db->prepare($query);

        $nivel = $nivelIdioma->getNivel();
        $statement->bindParam(':nivel', $nivel, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function borrarNivelIdioma($idNivelIdioma) {
        $query = "DELETE FROM nivel_idiomas 
                  WHERE idNivelIdioma = :idNivelIdioma";

        $statement = $this->db->prepare($query);

        $statement->bindParam(':idNivelIdioma', $idNivelIdioma, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function actualizarNivelIdioma($nivelIdioma) {
        $query = "UPDATE nivel_idiomas 
                  SET nivel = :nivel
                  WHERE idNivelIdioma = :idNivelIdioma";

        $statement = $this->db->prepare($query);

        $idNivelIdioma = $nivelIdioma->getIdNivelIdioma();
        $nivel = $nivelIdioma->getNivel();

        $statement->bindParam(':idNivelIdioma', $idNivelIdioma, PDO::PARAM_INT);
        $statement->bindParam(':nivel', $nivel, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function leerTodos() {
        $query = "SELECT idNivelIdioma, nivel FROM nivel_idiomas";
        $statement = $this->db->prepare($query);
        $statement->execute();
    
        $nivelIdiomasList = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        $nivelIdiomas = array();
    
        foreach ($nivelIdiomasList as $nivelIdiomaData) {
            $nivelIdiomas[] = new NivelIdiomas(
                $nivelIdiomaData['nivel']
            );
        }
    
        return $nivelIdiomas;
    }

    public function leerNivelIdioma($idNivelIdioma) {
        $query = "SELECT * FROM nivel_idiomas WHERE idNivelIdioma = :idNivelIdioma";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':idNivelIdioma', $idNivelIdioma, PDO::PARAM_INT);
        $statement->execute();
    
        $nivelIdiomaData = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($nivelIdiomaData) {
            return new NivelIdiomas(
                $nivelIdiomaData['nivel']
            );
        }
    
        return null;
    }
}

