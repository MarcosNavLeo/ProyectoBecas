<?php
class RepositorioItemBarenables {
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function insertarItemBarenable($itemBarenable) {
        $query = "INSERT INTO item_barenables (nombre) 
                  VALUES (:nombre)";

        $statement = $this->db->prepare($query);

        $nombre = $itemBarenable->getNombre();

        $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function borrarItemBarenable( $itemBarenable) {
        $query = "DELETE FROM item_barenables 
                  WHERE idItemBarenables = :idItemBarenables";

        $idItemBarenables = $itemBarenable->getIdItemBarenables();

        $statement = $this->db->prepare($query);

        $statement->bindParam(':idItemBarenables', $idItemBarenables, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function actualizarItemBarenable( $itemBarenable) {
        $query = "UPDATE item_barenables 
                  SET nombre = :nuevoNombre
                  WHERE idItemBarenables = :idItemBarenables";

        $idItemBarenables = $itemBarenable->getIdItemBarenables();
        $nuevoNombre = $itemBarenable->getNombre();

        $statement = $this->db->prepare($query);

        $statement->bindParam(':idItemBarenables', $idItemBarenables, PDO::PARAM_INT);
        $statement->bindParam(':nuevoNombre', $nuevoNombre, PDO::PARAM_STR);

        return $statement->execute();
    }

    public function leerTodos() {
        $query = "SELECT idItemBarenables, nombre FROM item_barenables";
        $statement = $this->db->prepare($query);
        $statement->execute();
    
        $itemBarenablesList = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        $itemBarenables = array();
    
        foreach ($itemBarenablesList as $itemBarenableData) {
            $itemBarenable = new ItemBarenables(
                $itemBarenableData['nombre']
            );
            $itemBarenable->setIdItemBarenables($itemBarenableData['idItemBarenables']);
            $itemBarenables[] = $itemBarenable;
        }
    
        return $itemBarenables;
    }

    public function leerItemBarenable($idItemBarenables) {
        $query = "SELECT * FROM item_barenables WHERE idItemBarenables = :idItemBarenables";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':idItemBarenables', $idItemBarenables, PDO::PARAM_INT);
        $statement->execute();
    
        $itemBarenableData = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($itemBarenableData) {
            $itemBarenable = new ItemBarenables(
                $itemBarenableData['nombre']
            );
            $itemBarenable->setIdItemBarenables($itemBarenableData['idItemBarenables']);
            return $itemBarenable;
        }
    
        return null;
    }
}
