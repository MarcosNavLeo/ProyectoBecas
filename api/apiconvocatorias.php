<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

// Obtiene el método de la solicitud HTTP (GET, POST, PUT, DELETE)
$metodo = $_SERVER['REQUEST_METHOD'];

// Manejo de solicitudes GET
if ($metodo == 'GET') {
    // Si se solicita un listado de todas las convocatorias con sus destinatarios, baremos y baremos de idiomas
    if (isset($_GET['todasConvocatorias'])) {
        try {
            // Obtiene el id del candidato
            $idCandidato = $_GET['id'];
            $dbConnection = DB::abreconexion();
            $repositorioConvocatoria = new RepositorioConvocatoria($dbConnection);
            $repositorioDestinatariosConvocatorias = new RepositorioDestinatariosConvocatorias($dbConnection);
            $repositorioConvocatoriaBaremo = new RepositorioConvocatoriaBaremo($dbConnection);
            $repositorioConvocatoriaBaremoIdioma = new RepositorioConvocatoriaBaremoIdioma($dbConnection);

            // Consulta para obtener todas las convocatorias
            $todasConvocatorias = $repositorioConvocatoria->leerConvocatoriasActivas($idCandidato);

            // Array para almacenar todas las convocatorias con su información relacionada
            $convocatoriasConInfo = [];

            foreach ($todasConvocatorias as $convocatoria) {
                $idConvocatoria = $convocatoria->getIdConvocatorias();

                // Obtener destinatarios de la convocatoria
                $destinatariosConvocatoria = $repositorioDestinatariosConvocatorias->leertodosdestina($idConvocatoria);

                // Obtener baremos de la convocatoria
                $convocatoriaBaremos = $repositorioConvocatoriaBaremo->leerConvocatoriasBaremo($idConvocatoria);

                // Obtener baremos de idiomas de la convocatoria
                $convocatoriaBaremosIdiomas = $repositorioConvocatoriaBaremoIdioma->leerTodosConvo($idConvocatoria);

                // Construir información completa de la convocatoria
                $infoConvocatoria = [
                    'convocatoria' => $convocatoria,
                    'destinatarios' => $destinatariosConvocatoria,
                    'baremos' => $convocatoriaBaremos,
                    'baremos_idiomas' => $convocatoriaBaremosIdiomas
                ];

                // Agregar información de la convocatoria al array
                $convocatoriasConInfo[] = $infoConvocatoria;
            }

            // Si se encuentran convocatorias, las devuelve como JSON
            if (!empty($convocatoriasConInfo)) {
                echo json_encode($convocatoriasConInfo);
            } else {
                echo json_encode(array('mensaje' => 'No se encontraron convocatorias.'));
            }
        } catch (Exception $e) {
            // Manejo de excepciones: Si ocurre un error inesperado, se captura y se imprime un mensaje de error
            echo json_encode(array('error' => 'Error al obtener las convocatorias: ' . $e->getMessage()));
        }
    } elseif (isset($_GET['convocatoriasSolicitadas'])) {
        try {
            // Obtiene el id del candidato
            $idCandidato = $_GET['id'];
            $dbConnection = DB::abreconexion();
            $repositorioConvocatoria = new RepositorioConvocatoria($dbConnection);
            $repositorioDestinatariosConvocatorias = new RepositorioDestinatariosConvocatorias($dbConnection);
            $repositorioConvocatoriaBaremo = new RepositorioConvocatoriaBaremo($dbConnection);
            $repositorioConvocatoriaBaremoIdioma = new RepositorioConvocatoriaBaremoIdioma($dbConnection);

            // Consulta para obtener todas las convocatorias
            $todasConvocatorias = $repositorioConvocatoria->leerconvocoli($idCandidato);

            // Array para almacenar todas las convocatorias con su información relacionada
            $convocatoriasConInfo = [];

            foreach ($todasConvocatorias as $convocatoria) {
                $idConvocatoria = $convocatoria->getIdConvocatorias();

                // Obtener destinatarios de la convocatoria
                $destinatariosConvocatoria = $repositorioDestinatariosConvocatorias->leertodosdestina($idConvocatoria);

                // Obtener baremos de la convocatoria
                $convocatoriaBaremos = $repositorioConvocatoriaBaremo->leerConvocatoriasBaremo($idConvocatoria);

                // Obtener baremos de idiomas de la convocatoria
                $convocatoriaBaremosIdiomas = $repositorioConvocatoriaBaremoIdioma->leerTodosConvo($idConvocatoria);

                // Construir información completa de la convocatoria
                $infoConvocatoria = [
                    'convocatoria' => $convocatoria,
                    'destinatarios' => $destinatariosConvocatoria,
                    'baremos' => $convocatoriaBaremos,
                    'baremos_idiomas' => $convocatoriaBaremosIdiomas
                ];

                // Agregar información de la convocatoria al array
                $convocatoriasConInfo[] = $infoConvocatoria;
            }

            // Si se encuentran convocatorias, las devuelve como JSON
            if (!empty($convocatoriasConInfo)) {
                echo json_encode($convocatoriasConInfo);
            } else {
                echo json_encode(array('mensaje' => 'No se encontraron convocatorias.'));
            }
        } catch (Exception $e) {
            // Manejo de excepciones
            echo json_encode(array('error' => 'Error al obtener las convocatorias solicitadas: ' . $e->getMessage()));
        }
    } elseif (isset($_GET['todas'])) {
        $dbConnection = DB::abreconexion();
        $repositorioConvocatoria = new RepositorioConvocatoria($dbConnection);
        $repositorioDestinatariosConvocatorias = new RepositorioDestinatariosConvocatorias($dbConnection);
        $repositorioConvocatoriaBaremo = new RepositorioConvocatoriaBaremo($dbConnection);
        $repositorioConvocatoriaBaremoIdioma = new RepositorioConvocatoriaBaremoIdioma($dbConnection);

        // Consulta para obtener todas las convocatorias
        $todasConvocatorias = $repositorioConvocatoria->leertodas();

        // Array para almacenar todas las convocatorias con su información relacionada
        $convocatoriasConInfo = [];

        foreach ($todasConvocatorias as $convocatoria) {
            $idConvocatoria = $convocatoria->getIdConvocatorias();

            // Obtener destinatarios de la convocatoria
            $destinatariosConvocatoria = $repositorioDestinatariosConvocatorias->leertodosdestina($idConvocatoria);

            // Obtener baremos de la convocatoria
            $convocatoriaBaremos = $repositorioConvocatoriaBaremo->leerConvocatoriasBaremo($idConvocatoria);

            // Obtener baremos de idiomas de la convocatoria
            $convocatoriaBaremosIdiomas = $repositorioConvocatoriaBaremoIdioma->leerTodosConvo($idConvocatoria);

            // Construir información completa de la convocatoria
            $infoConvocatoria = [
                'convocatoria' => $convocatoria,
                'destinatarios' => $destinatariosConvocatoria,
                'baremos' => $convocatoriaBaremos,
                'baremos_idiomas' => $convocatoriaBaremosIdiomas
            ];

            // Agregar información de la convocatoria al array
            $convocatoriasConInfo[] = $infoConvocatoria;
        }

        // Si se encuentran convocatorias, las devuelve como JSON
        if (!empty($convocatoriasConInfo)) {
            echo json_encode($convocatoriasConInfo);
        } else {
            echo json_encode(array('mensaje' => 'No se encontraron convocatorias.'));
        }
    }
} else {
    echo json_encode(array('error' => 'Método no permitido.'));
}
?>