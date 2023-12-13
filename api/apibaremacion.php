<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

// Obtener el método de la solicitud HTTP (GET, POST, PUT, DELETE)
$metodo = $_SERVER['REQUEST_METHOD'];

// Función para devolver una respuesta JSON con código de estado
function enviarRespuesta($codigo, $mensaje)
{
    http_response_code($codigo);
    echo json_encode(["mensaje" => $mensaje]);
    exit();
}

if ($metodo === 'POST') {
    // Si la solicitud es POST y se espera un archivo PDF
    if (isset($_GET['pdf'])) {
        $dir_pdf = '../interfaces/pdf/';
        foreach ($_FILES as $nombreCampo => $archivo) {
            $fichero_nombre = $archivo['name'];
            $fichero_tipo = $archivo['type'];
            $fichero_temporal = $archivo['tmp_name'];

            // Verificar si es un archivo PDF por su tipo MIME
            if ($fichero_tipo === 'application/pdf') {
                $fichero_subido = $dir_pdf . basename($fichero_nombre);

                // Mover archivo a la carpeta correspondiente
                if (move_uploaded_file($fichero_temporal, $fichero_subido)) {
                    enviarRespuesta(201, "El archivo $fichero_nombre se ha cargado correctamente.");
                } else {
                    enviarRespuesta(500, "Hubo un error al cargar el archivo $fichero_nombre.");
                }
            } else {
                enviarRespuesta(400, "El archivo $fichero_nombre no es un PDF válido.");
            }
        }
    } else {
        // Manejo de la lógica para procesar la solicitud de baremación
        $dbConnection = DB::abreconexion();
        $repositoriobaremacion = new repositoriobaremacion($dbConnection);
        $baremaciondata = json_decode(file_get_contents('php://input'), true);
        $baremacion = new baremacion(
            $baremaciondata['idBaremacion'],
            $baremaciondata['iditem_barenables'],
            $baremaciondata['idConvocatorias'],
            $baremaciondata['url'],
            $baremaciondata['Candidatos_idCandidato']
        );
        $nuevabaremacion = $repositoriobaremacion->createBaremacion($baremacion);
        // Puedes ajustar el código de respuesta según la lógica de tu aplicación
        if ($nuevabaremacion) {
            enviarRespuesta(201, "Baremación creada exitosamente.");
        } else {
            enviarRespuesta(500, "Error al crear la baremación.");
        }
    }
} else {
    enviarRespuesta(405, "Método no permitido");
}
?>
