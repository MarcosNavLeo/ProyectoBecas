<?php
class RepositorioConvocatoriaBaremo
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function insertarConvocatoriaBaremo($convocatoriaBaremo) {
        $query = "INSERT INTO convocatoria_baremo (idItemBaremo, idConvocatoria, maximoPuntos, requisito, minimo, presenta) 
                  VALUES (:idItemBaremo, :idConvocatoria, :maximoPuntos, :requisito, :minimo, :presenta)";

        $statement = $this->db->prepare($query);

        $idItemBaremo = $convocatoriaBaremo->getIdItemBaremo();
        $idConvocatoria = $convocatoriaBaremo->getIdConvocatoria();
        $maximoPuntos = $convocatoriaBaremo->getMaximoPuntos();
        $requisito = $convocatoriaBaremo->getRequisito();
        $minimo = $convocatoriaBaremo->getMinimo();
        $presenta = $convocatoriaBaremo->getPresenta();

        $statement->bindParam(':idItemBaremo', $idItemBaremo, PDO::PARAM_INT);
        $statement->bindParam(':idConvocatoria', $idConvocatoria, PDO::PARAM_INT);
        $statement->bindParam(':maximoPuntos', $maximoPuntos, PDO::PARAM_INT);
        $statement->bindParam(':requisito', $requisito);
        $statement->bindParam(':minimo', $minimo);
        $statement->bindParam(':presenta', $presenta);

        return $statement->execute();
    }

    public function borrarConvocatoriaBaremo($convocatoriaBaremo) {
        $idItemBaremo = $convocatoriaBaremo->getIdItemBaremo();
        $idConvocatoria = $convocatoriaBaremo->getIdConvocatoria();

        $query = "DELETE FROM convocatoria_baremo 
                  WHERE idItemBaremo = :idItemBaremo 
                  AND idConvocatoria = :idConvocatoria";

        $statement = $this->db->prepare($query);

        $statement->bindParam(':idItemBaremo', $idItemBaremo, PDO::PARAM_INT);
        $statement->bindParam(':idConvocatoria', $idConvocatoria, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function actualizarConvocatoriaBaremo($convocatoriaBaremo) {
        $idItemBaremo = $convocatoriaBaremo->getIdItemBaremo();
        $idConvocatoria = $convocatoriaBaremo->getIdConvocatoria();
        $nuevoIdItemBaremo = $convocatoriaBaremo->getNuevoIdItemBaremo();
        $nuevoIdConvocatoria = $convocatoriaBaremo->getNuevoIdConvocatoria();
        $nuevosMaximoPuntos = $convocatoriaBaremo->getNuevosMaximoPuntos();
        $nuevoRequisito = $convocatoriaBaremo->getNuevoRequisito();
        $nuevoMinimo = $convocatoriaBaremo->getNuevoMinimo();
        $nuevoPresenta = $convocatoriaBaremo->getNuevoPresenta();

        $query = "UPDATE convocatoria_baremo 
                  SET idItemBaremo = :nuevoIdItemBaremo, 
                      idConvocatoria = :nuevoIdConvocatoria, 
                      maximoPuntos = :nuevosMaximoPuntos, 
                      requisito = :nuevoRequisito, 
                      minimo = :nuevoMinimo, 
                      presenta = :nuevoPresenta 
                  WHERE idItemBaremo = :idItemBaremo 
                  AND idConvocatoria = :idConvocatoria";

        $statement = $this->db->prepare($query);

        $statement->bindParam(':idItemBaremo', $idItemBaremo, PDO::PARAM_INT);
        $statement->bindParam(':idConvocatoria', $idConvocatoria, PDO::PARAM_INT);
        $statement->bindParam(':nuevoIdItemBaremo', $nuevoIdItemBaremo, PDO::PARAM_INT);
        $statement->bindParam(':nuevoIdConvocatoria', $nuevoIdConvocatoria, PDO::PARAM_INT);
        $statement->bindParam(':nuevosMaximoPuntos', $nuevosMaximoPuntos, PDO::PARAM_INT);
        $statement->bindParam(':nuevoRequisito', $nuevoRequisito);
        $statement->bindParam(':nuevoMinimo', $nuevoMinimo);
        $statement->bindParam(':nuevoPresenta', $nuevoPresenta);

        return $statement->execute();
    }

    public function leerTodos() {
        $query = "SELECT idItemBaremo, idConvocatoria, maximoPuntos, requisito, minimo, presenta FROM convocatoria_baremo";
        $statement = $this->db->prepare($query);
        $statement->execute();
    
        $convocatoriaBaremoList = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        $convocatoriaBaremo = array();
    
        foreach ($convocatoriaBaremoList as $convocatoriaBaremoData) {
            $convocatoriaBaremo[] = new ConvocatoriaBaremo(
                $convocatoriaBaremoData['idItemBaremo'],
                $convocatoriaBaremoData['idConvocatoria'],
                $convocatoriaBaremoData['maximoPuntos'],
                $convocatoriaBaremoData['requisito'],
                $convocatoriaBaremoData['minimo'],
                $convocatoriaBaremoData['presenta']
            );
        }
    
        return $convocatoriaBaremo;
    }

    public function leerConvocatoriaBaremo($idItemBaremo, $idConvocatoria) {
        $query = "SELECT * FROM convocatoria_baremo WHERE idItemBaremo = :idItemBaremo AND idConvocatoria = :idConvocatoria";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':idItemBaremo', $idItemBaremo, PDO::PARAM_INT);
        $statement->bindParam(':idConvocatoria', $idConvocatoria, PDO::PARAM_INT);
        $statement->execute();
    
        $convocatoriaBaremoData = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($convocatoriaBaremoData) {
            return new ConvocatoriaBaremo(
                $convocatoriaBaremoData['idItemBaremo'],
                $convocatoriaBaremoData['idConvocatoria'],
                $convocatoriaBaremoData['maximoPuntos'],
                $convocatoriaBaremoData['requisito'],
                $convocatoriaBaremoData['minimo'],
                $convocatoriaBaremoData['presenta']
            );
        }
    
        return null;
    }
}

