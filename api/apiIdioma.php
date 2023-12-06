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
        $repositorioidioma = new RepositoriobaremoIdioma($dbConnection);

        $idioma = $repositorioidioma->leerTodos();

        if ($idioma) {
            enviarRespuesta(200, $idioma);
        } else {
            enviarRespuesta(404, ["error" => "No se encontraron idiomas"]);
        }
    } catch (Exception $e) {
        enviarRespuesta(500, ["error" => $e->getMessage()]);
    }
} else {
    enviarRespuesta(405, ["error" => "Método no permitido"]);
}
?>
