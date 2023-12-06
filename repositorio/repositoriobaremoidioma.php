<?php
class RepositoriobaremoIdioma
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }
    public function leerTodos() {
        $query = "SELECT * FROM `Nivel idiomas`";
        $statement = $this->db->prepare($query);
        $statement->execute();

        $nivelIdiomasList = $statement->fetchAll(PDO::FETCH_ASSOC);

        $nivelIdiomas = array();

        foreach ($nivelIdiomasList as $nivelIdiomaData) {
            $nivelIdiomas[] = new nivel_idiomas(
                $nivelIdiomaData['Nivel'],
            );
        }

        return $nivelIdiomas;
    }
}

