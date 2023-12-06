<?php
class RepositorioConvocatoriaBaremoIdioma
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function insertarConvocatoriaBaremoIdioma($nivel_idiomas)
    {
        $query = "INSERT INTO convocatoria_baremo_idioma (
            convocatoria_baremo_iditem_barenables, convocatoria_baremo_idConvocatorias, `Nivel idiomas_Nivel`, puntos) 
                  VALUES (:iditem_barenables, :idConvocatorias, :nivel, :puntos)";

        $statement = $this->db->prepare($query);

        $iditem_barenables = $nivel_idiomas->getIdItemBaremo();
        $idConvocatorias = $nivel_idiomas->getIdConvocatoria();
        $nivel = $nivel_idiomas->getNivelIdioma();
        $puntos = $nivel_idiomas->getPuntos();

        $statement->bindParam(':iditem_barenables', $iditem_barenables, PDO::PARAM_INT);
        $statement->bindParam(':idConvocatorias', $idConvocatorias, PDO::PARAM_INT);
        $statement->bindParam(':nivel', $nivel, PDO::PARAM_STR);
        $statement->bindParam(':puntos', $puntos, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function borrarConvocatoriaBaremoIdioma($convocatoriaBaremoIdioma)
    {
        $query = "DELETE FROM convocatoria_baremo_idioma 
                  WHERE `Nivel idiomas_Nivel` = :nivel";

        $nivel = $convocatoriaBaremoIdioma->getNivelIdiomasNivel();

        $statement = $this->db->prepare($query);

        $statement->bindParam(':nivel', $nivel, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function actualizarConvocatoriaBaremoIdioma($convocatoriaBaremoIdioma)
    {
        $query = "UPDATE convocatoria_baremo_idioma 
                  SET convocatoria_baremo_iditem_barenables = :iditem_barenables, convocatoria_baremo_idConvocatorias = :idConvocatorias, puntos = :puntos
                  WHERE `Nivel idiomas_Nivel` = :nivel";

        $iditem_barenables = $convocatoriaBaremoIdioma->getIditemBarenables();
        $idConvocatorias = $convocatoriaBaremoIdioma->getIdConvocatorias();
        $nivel = $convocatoriaBaremoIdioma->getNivelIdiomasNivel();
        $puntos = $convocatoriaBaremoIdioma->getPuntos();

        $statement = $this->db->prepare($query);

        $statement->bindParam(':iditem_barenables', $iditem_barenables, PDO::PARAM_INT);
        $statement->bindParam(':idConvocatorias', $idConvocatorias, PDO::PARAM_INT);
        $statement->bindParam(':nivel', $nivel, PDO::PARAM_STR);
        $statement->bindParam(':puntos', $puntos, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function leerTodos()
    {
        $query = "SELECT * FROM convocatoria_baremo_idioma";
        $statement = $this->db->prepare($query);
        $statement->execute();

        $convocatoriasBaremoIdiomaList = $statement->fetchAll(PDO::FETCH_ASSOC);

        $convocatoriasBaremoIdioma = array();

        foreach ($convocatoriasBaremoIdiomaList as $convocatoriaBaremoIdiomaData) {
            $convocatoriaBaremoIdioma = new ConvocatoriaBaremoIdioma(
                $convocatoriaBaremoIdiomaData['convocatoria_baremo_iditem_barenables'],
                $convocatoriaBaremoIdiomaData['convocatoria_baremo_idConvocatorias'],
                $convocatoriaBaremoIdiomaData['Nivel idiomas_Nivel'],
                $convocatoriaBaremoIdiomaData['puntos']
            );
            $convocatoriasBaremoIdioma[] = $convocatoriaBaremoIdioma;
        }

        return $convocatoriasBaremoIdioma;
    }

    public function leerPorNivelIdioma($nivel)
    {
        $query = "SELECT * FROM convocatoria_baremo_idioma WHERE `Nivel idiomas_Nivel` = :nivel";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':nivel', $nivel, PDO::PARAM_STR);
        $statement->execute();

        $convocatoriaBaremoIdiomaData = $statement->fetch(PDO::FETCH_ASSOC);

        if ($convocatoriaBaremoIdiomaData) {
            $convocatoriaBaremoIdioma = new ConvocatoriaBaremoIdioma(
                $convocatoriaBaremoIdiomaData['convocatoria_baremo_iditem_barenables'],
                $convocatoriaBaremoIdiomaData['convocatoria_baremo_idConvocatorias'],
                $convocatoriaBaremoIdiomaData['Nivel idiomas_Nivel'],
                $convocatoriaBaremoIdiomaData['puntos']
            );
            return $convocatoriaBaremoIdioma;
        }

        return null;
    }
}


