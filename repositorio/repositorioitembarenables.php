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
        $query = "SELECT iditem_Barenables, nombre FROM item_barenables";
        $statement = $this->db->prepare($query);
        $statement->execute();
    
        $itemBarenablesList = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        $itemBarenables = array();
    
        foreach ($itemBarenablesList as $itemBarenableData) {
            $itemBarenable = new item_barenables(
                $itemBarenableData['nombre']
            );
            $itemBarenable->setIdItemBarenables($itemBarenableData['iditem_Barenables']);
            $itemBarenables[] = $itemBarenable;
        }
    
        return $itemBarenables;
    }

    public function leerItemBarenable($idItemBarenables) {
        $query = "SELECT * FROM item_barenables WHERE iditem_barenables = :idItemBarenables";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':idItemBarenables', $idItemBarenables, PDO::PARAM_INT);
        $statement->execute();
    
        $itemBarenableData = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($itemBarenableData) {
            $itemBarenable = new item_barenables(
                $itemBarenableData['nombre']
            );
            $itemBarenable->setIdItemBarenables($itemBarenableData['idItemBarenables']);
            return $itemBarenable;
        }
    
        return null;
    }

    public function leerid($nombre) {
        $query = "SELECT iditem_barenables FROM item_barenables WHERE nombre = :nombre";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $statement->execute();
    
        $itemBarenableData = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($itemBarenableData) {
            return $itemBarenableData['iditem_barenables'];
        }
    
        return null;
    }
    
}
