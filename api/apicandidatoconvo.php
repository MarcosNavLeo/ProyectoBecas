<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo == 'POST') {
    // Recibe los datos del cuerpo de la solicitud en formato JSON
    $datos_json = file_get_contents('php://input');
    $datos = json_decode($datos_json, true);

    // Verifica si los datos requeridos están presentes
    if (
        isset($datos['Convocatorias_idConvocatorias']) &&
        isset($datos['Candidatos_idCandidato']) &&
        isset($datos['DNI']) &&
        isset($datos['Nombre']) &&
        isset($datos['Apellidos']) &&
        isset($datos['Telefono']) &&
        isset($datos['Correo']) &&
        isset($datos['Domicilio'])
    ) {
        $idConvocatoria = $datos['Convocatorias_idConvocatorias'];
        $idCandidato = $datos['Candidatos_idCandidato'];
        $DNI = $datos['DNI'];
        $Nombre = $datos['Nombre'];
        $Apellidos = $datos['Apellidos'];
        $Telefono = $datos['Telefono'];
        $Correo = $datos['Correo'];
        $Domicilio = $datos['Domicilio'];
        $foto=$datos['foto'];

        $dbConnection = DB::abreconexion();
        $repositorioCandidatoConvocatorias = new RepositorioCandidatoConvocatorias($dbConnection);

        // Crear un objeto CandidatoConvocatoria
        $candidatoConvocatoria = new candidato_convocatorias($idConvocatoria, $idCandidato, $DNI, $Nombre, $Apellidos, $Telefono, $Correo, $Domicilio,$foto);

        // Insertar el candidato en la base de datos
        $resultado = $repositorioCandidatoConvocatorias->insertarCandidatoConvocatoria($candidatoConvocatoria);

        if ($resultado) {
            // Si se insertó correctamente, devolver un mensaje de éxito en JSON
            http_response_code(201);
            echo json_encode(array("message" => "Candidato insertado correctamente."));
        } else {
            // Si ocurrió un error al insertar, devolver un mensaje de error en JSON
            http_response_code(500);
            echo json_encode(array("message" => "Error al insertar el candidato."));
        }
    } else {
        // Si no se proporcionaron todos los datos requeridos, devolver un mensaje de error en JSON
        http_response_code(400);
        echo json_encode(array("message" => "Se requieren todos los campos."));
    }
} elseif ($metodo == 'GET') {
    $dbConnection = DB::abreconexion();
    $repositorioCandidatoConvocatorias = new RepositorioCandidatoConvocatorias($dbConnection);

    // Verificar si se proporcionó el parámetro 'Convocatorias_idConvocatorias' en la solicitud GET
    if (isset($_GET['idConvocatorias'])) {
        $idConvocatoria = $_GET['idConvocatorias'];

        // Obtener todas las solicitudes para la convocatoria específica
        $solicitudes = $repositorioCandidatoConvocatorias->leersolicitudesconvo($idConvocatoria);

        if ($solicitudes !== null) {
            // Si se encontraron solicitudes, devolverlas como respuesta en formato JSON
            http_response_code(200);
            echo json_encode($solicitudes);
        } else {
            // Si no se encontraron solicitudes para esa convocatoria, devolver un mensaje de error en JSON
            http_response_code(404);
            echo json_encode(array("message" => "No se encontraron solicitudes para la convocatoria especificada."));
        }
    } else {
        // Si no se proporcionó el parámetro 'Convocatorias_idConvocatorias', devolver un mensaje de error en JSON
        http_response_code(400);
        echo json_encode(array("message" => "Se requiere el parámetro 'Convocatorias_idConvocatorias' en la solicitud."));
    }
}

?>