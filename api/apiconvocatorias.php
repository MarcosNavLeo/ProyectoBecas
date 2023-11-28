<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

// Obtiene el método de la solicitud HTTP (GET, POST, PUT, DELETE)
$metodo = $_SERVER['REQUEST_METHOD'];

// Manejo de solicitudes GET
if ($metodo == 'GET') {
    // Si se solicita un listado de convocatorias activas para un candidato específico
    if (isset($_GET['idCandidato'])) {
        try {
            $dbConnection = DB::abreconexion();
            $repositorioConvocatoria = new RepositorioConvocatoria($dbConnection);

            $idCandidato = $_GET['idCandidato'];

            // Consulta para obtener convocatorias activas para el candidato
            $convocatoriasActivas = $repositorioConvocatoria->obtenerConvocatoriasActivas($idCandidato);

            // Si se obtienen convocatorias activas, las devuelve como JSON
            if ($convocatoriasActivas) {
                echo json_encode($convocatoriasActivas);
            } else {
                echo json_encode(array('mensaje' => 'No se encontraron convocatorias activas para este candidato.'));
            }
        } catch (Exception $e) {
            // Manejo de excepciones: Si ocurre un error inesperado, se captura y se imprime un mensaje de error
            echo json_encode(array('error' => 'Error al obtener las convocatorias activas: ' . $e->getMessage()));
        }
    } else {
        echo json_encode(array('error' => 'Se requiere el parametro idCandidato.'));
    }
} else {
    echo json_encode(array('error' => 'Método no permitido.'));
}
?>
