<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

// Obtiene el método de la solicitud HTTP (GET, POST, PUT, DELETE)
$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo == 'GET') {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $idCandidato = $_GET['id'];
    
        $dbConnection = DB::abreconexion();
        $repositorioCandidato = new RepositorioCandidato($dbConnection);
    
        // Obtener el candidato por su ID
        $candidato = $repositorioCandidato->getCandidatoPorid($idCandidato);
    
        if ($candidato !== null) {
            // Si se encontró el candidato, devolver sus datos en formato JSON
            http_response_code(200);
            echo json_encode($candidato);
        } else {
            // Si no se encontró el candidato, devolver un mensaje de error en JSON
            http_response_code(404);
            echo json_encode(array("message" => "No se encontró ningún candidato con ese ID."));
        }
    } else {
        // Si no se proporcionó un ID válido, devolver un mensaje de error en JSON
        http_response_code(400);
        echo json_encode(array("message" => "Se requiere un ID válido en la URL."));
    }
}
?>

