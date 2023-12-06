<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';
// Obtiene el método de la solicitud HTTP (GET, POST, PUT, DELETE)
$metodo = $_SERVER['REQUEST_METHOD'];

// Función para devolver una respuesta JSON con código de estado
function enviarRespuesta($codigo, $datos = null)
{
    http_response_code($codigo);
    echo json_encode($datos);
    exit();
}


if ($metodo == 'GET') {
    try {
        $dbConnection = DB::abreconexion();
        $repositoriodestinatarios = new RepositorioDestinatarios($dbConnection);

        $destinatarios = $repositoriodestinatarios->leerTodos();

        if ($destinatarios) {
            enviarRespuesta(200, $destinatarios);
        } else {
            enviarRespuesta(404, ["error" => "No se encontraron destinatarios"]);
        }
    } catch (Exception $e) {
        enviarRespuesta(500, ["error" => "Error interno del servidor"]);
    }
} else {
    enviarRespuesta(405, ["error" => "Método no permitido"]);
}
?>