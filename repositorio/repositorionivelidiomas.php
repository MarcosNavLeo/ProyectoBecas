<?php
class RepositorioNivelIdiomas
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function insertarNivelIdioma($nivelIdioma)
    {
        $query = "INSERT INTO nivel_idiomas (nivel) 
                  VALUES (:nivel)";

        $statement = $this->db->prepare($query);

        $nivel = $nivelIdioma->getNivel();

        $statement->bindParam(':nivel', $nivel, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function borrarNivelIdioma($nivelIdioma)
    {
        $query = "DELETE FROM nivel_idiomas 
                  WHERE nivel = :nivel";

        $nivel = $nivelIdioma->getNivel();

        $statement = $this->db->prepare($query);

        $statement->bindParam(':nivel', $nivel, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function actualizarNivelIdioma($nivelIdioma)
    {
        $query = "UPDATE nivel_idiomas 
                  SET nivel = :nuevoNivel
                  WHERE nivel = :nivel";

        $nivel = $nivelIdioma->getNivel();
        $nuevoNivel = $nivelIdioma->getNivel();

        $statement = $this->db->prepare($query);

        $statement->bindParam(':nivel', $nivel, PDO::PARAM_STR);
        $statement->bindParam(':nuevoNivel', $nuevoNivel, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function leerTodos()
    {
        $query = "SELECT nivel FROM nivel_idiomas";
        $statement = $this->db->prepare($query);
        $statement->execute();

        $nivelesIdiomasList = $statement->fetchAll(PDO::FETCH_ASSOC);

        $nivelesIdiomas = array();

        foreach ($nivelesIdiomasList as $nivelIdiomaData) {
            $nivelIdioma = new NivelIdiomas(
                $nivelIdiomaData['nivel']
            );
            $nivelesIdiomas[] = $nivelIdioma;
        }

        return $nivelesIdiomas;
    }

    public function leerNivelIdioma($nivel)
    {
        $query = "SELECT * FROM nivel_idiomas WHERE nivel = :nivel";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':nivel', $nivel, PDO::PARAM_STR);
        $statement->execute();

        $nivelIdiomaData = $statement->fetch(PDO::FETCH_ASSOC);

        if ($nivelIdiomaData) {
            $nivelIdioma = new NivelIdiomas(
                $nivelIdiomaData['nivel']
            );
            return $nivelIdioma;
        }

        return null;
    }
}

