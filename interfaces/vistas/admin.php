<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://virtual.local.marcos.com/interfaces/estilos/stylesAdmin.css">
    <script src="http://virtual.local.marcos.com/interfaces/javascript/convocatoria.js"></script>
    <script src="http://virtual.local.marcos.com/interfaces/javascript/validaciones.js"></script>
    <title>CREAR CONVOCATORIA</title>
</head>

<body>
    <?php
    $dbConnection = DB::abreconexion();
    Session::inicia_sesion();
    $user = Session::lee_sesion('user');

    if (!Login::estaalogeado()) {
        header('Location:index.php?menu=login');
        exit;
    }

    $nombre = $user->getNombre();
    $nombreEnMayuscula = strtoupper($nombre);



    if (isset($_POST['Logaout'])) {
        Session::cierra_sesion();
        header('Location:?menu=login');
        exit;
    }
    ?>
    <nav>
        <img src="/interfaces/Imagenes/logo2.png" alt="Logo" />
        <?php
        echo '<h1 id="titulo">BIENVENIDO ' . $nombreEnMayuscula . '</h1>';
        ?>
        <div id="enlacesNav">
            <a href="?menu=listaconvo">CONVOCATORIAS</a>
            <form name="formulario" method="post">
                <button type="submit" value="CERRAR SESION" name="Logaout" id="Cierrasesion">CERRAR SESION</button>
            </form>
        </div>

    </nav>
    <div class="formulario">
        <form name="formulario" method="post" id="formulario">
            <h1 id="TituloCrear">CREAR CONVOCATORIA</h1>

            <fieldset>
                <label for="proyecto">Seleccionar Proyecto:</label>
                <select id="proyecto" name="proyecto" data-valida="relleno">
                    <option value="" selected disabled>Seleccionar Proyecto</option>
                </select>

                <label for="movilidades">Movilidades:</label>
                <input type="number" id="movilidades" name="movilidades" placeholder="Movilidades" data-valida="numero">
            </fieldset>


            <fieldset>
                <label for="duracion">Duración:</label>
                <select id="duracion" name="duracion" data-valida="relleno">
                    <option value="" selected disabled>Seleccionar Duracion</option>
                    <option value="larga">Larga duración</option>
                    <option value="corta">Corta duración</option>
                </select>

                <label for="destino">Destino:</label>
                <input type="text" id="destino" name="destino" placeholder="Destino" data-valida="relleno">
            </fieldset>

            <!-- Fechas -->
            <fieldset>
                <label for="fechaInicioSolicitud">Fecha Inicio Solicitud:</label>
                <input type="date" id="fechaInicioSolicitud" name="fechaInicioSolicitud" data-valida="fecha">
                <div id="errorFechaInicioSolicitud" class="error-fecha"></div>

                <label for="fechaInicioPrueba">Fecha Inicio Prueba:</label>
                <input type="date" id="fechaInicioPrueba" name="fechaInicioPrueba" data-valida="fecha">
                <div id="errorFechaInicioPrueba" class="error-fecha"></div>

                <label for="fechaListadoProvisional">Fecha Listado Provisional:</label>
                <input type="date" id="fechaListadoProvisional" name="fechaListadoProvisional" data-valida="fecha">

                <div id="errorFechaListadoProvisional" class="error-fecha"></div>
            </fieldset>

            <fieldset>
                <label for="fechaFinalSolicitud">Fecha Final Solicitud:</label>
                <input type="date" id="fechaFinalSolicitud" name="fechaFinalSolicitud" data-valida="fecha">
                <div id="errorFechaFinalSolicitud" class="error-fecha"></div>

                <label for="fechaFinPrueba">Fecha Fin Prueba:</label>
                <input type="date" id="fechaFinPrueba" name="fechaFinPrueba" data-valida="fecha">
                <div id="errorFechaFinPrueba" class="error-fecha"></div>

                <label for="fechaListadoDefinitivo">Fecha Listado Definitivo:</label>
                <input type="date" id="fechaListadoDefinitivo" name="fechaListadoDefinitivo" data-valida="fecha">
                <div id="errorFechaListadoDefinitivo" class="error-fecha"></div>
            </fieldset>

            <div id="destinatariosCheckboxes">
                <label for="destinatarios">Destinatarios:</label>
            </div>

            <!-- Tabla -->
            <table class="baremable">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Nota Máxima</th>
                        <th>Requisito</th>
                        <th>Nota Mínima</th>
                        <th>Aporta Alumno</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>


            <table class="idioma">
                <thead>
                    <tr></tr>
                </thead>
                <tbody>
                    <tr></tr>
                </tbody>
            </table>
            <button type="submit" id="crear" name="Crear">CREAR CONVOCATORIA</button>
            <div class="mensaje">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $errores = [];

                    // Validación de campos requeridos
                    $camposRequeridos = ['proyecto', 'movilidades', 'duracion', 'destino', 'fechaInicioSolicitud', 'fechaFinalSolicitud', 'fechaInicioPrueba', 'fechaFinPrueba', 'fechaListadoProvisional', 'fechaListadoDefinitivo'];
                    foreach ($camposRequeridos as $campo) {
                        if (empty($_POST[$campo])) {
                            $errores[$campo] = ucfirst($campo) . " es un campo requerido.";
                        }
                    }

                    // Validación específica para números y fechas
                    if (!is_numeric($_POST['movilidades'])) {
                        $errores['movilidades'] = "Movilidades debe ser un número.";
                    }

                    $fechas = ['fechaInicioSolicitud', 'fechaFinalSolicitud', 'fechaInicioPrueba', 'fechaFinPrueba', 'fechaListadoProvisional', 'fechaListadoDefinitivo'];
                    foreach ($fechas as $fecha) {
                        $fechaIngresada = $_POST[$fecha];
                        $fechaValida = DateTime::createFromFormat('Y-m-d', $fechaIngresada);
                        if (!$fechaValida) {
                            $errores[$fecha] = "La fecha ingresada en $fecha no es válida.";
                        }
                    }

                    // Si hay errores, mostrarlos
                    if (!empty($errores)) {
                        echo "<div class='error'>";
                        foreach ($errores as $error) {
                            echo "<p>$error</p>";
                        }
                        echo "</div>";
                    } else {
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Comenzar la transacción
                            $dbConnection->beginTransaction();

                            try {
                                // Creación de una nueva instancia de Convocatorias con los datos del formulario
                                $convocatoria = new Convocatorias(
                                    null,
                                    $_POST['movilidades'],
                                    $_POST['duracion'] === 'larga' ? 'Larga Duración' : 'Corta Duración',
                                    $_POST['fechaInicioSolicitud'],
                                    $_POST['fechaFinalSolicitud'],
                                    $_POST['fechaInicioPrueba'],
                                    $_POST['fechaFinPrueba'],
                                    $_POST['fechaListadoProvisional'],
                                    $_POST['fechaListadoDefinitivo'],
                                    $_POST['destino'],
                                    $_POST['proyecto']
                                );

                                // Repositorio para manejar las convocatorias
                                $repositorioConvocatoria = new RepositorioConvocatoria($dbConnection);

                                // Insertar la convocatoria en la base de datos
                                $resultado = $repositorioConvocatoria->insertarConvocatoria($convocatoria);

                                if ($resultado) {
                                    // Obtener el ID de la convocatoria recién insertada
                                    $idConvocatoriaInsertada = $repositorioConvocatoria->obtenerUltimoIDInsertado();

                                    // Procesamiento de destinatarios asociados a la convocatoria
                                    $destinatarios = [];
                                    if (isset($_POST['destinatarios'])) {
                                        $destinatarios = $_POST['destinatarios'];
                                    }

                                    foreach ($destinatarios as $idDestinatario) {
                                        // Asociar destinatarios con la convocatoria
                                        $destinatarioConvocatoria = new destinatariosconvocatorias($idDestinatario, $idConvocatoriaInsertada);
                                        $repositorioDestinatariosConvocatorias = new repositorioDestinatariosconvocatorias($dbConnection);
                                        $resultadoDestinatarios = $repositorioDestinatariosConvocatorias->insertarDestinatariosConvocatorias($destinatarioConvocatoria);
                                        if (!$resultadoDestinatarios) {
                                            throw new Exception("Error al asociar los destinatarios con la convocatoria.");
                                        }
                                    }

                                    // Procesamiento de ítems baremables
                                    if (isset($_POST['item']) && is_array($_POST['item'])) {
                                        foreach ($_POST['item'] as $index => $item) {
                                            // Procesar los ítems baremables
                                            $idItemBaremo = $item;
                                            $notaMaxima = !empty($_POST['maximo'][$index]) ? $_POST['maximo'][$index] : null;
                                            $requisito = !empty($_POST['requisito'][$index]) ? 1 : null;
                                            $notaMinima = !empty($_POST['minimo'][$index]) ? $_POST['minimo'][$index] : null;
                                            $aportaAlumno = !empty($_POST['aporta'][$index]) ? 1 : null;


                                            // Crear la instancia de ConvocatoriaBaremo
                                            $itemBaremo = new ConvocatoriaBaremo(
                                                $idItemBaremo,
                                                $idConvocatoriaInsertada,
                                                $notaMaxima,
                                                $requisito,
                                                $notaMinima,
                                                $aportaAlumno
                                            );

                                            $repositorioConvocatoriaBaremo = new RepositorioConvocatoriaBaremo($dbConnection);
                                            // Insertar ítem baremable en la base de datos
                                            $resultadoItemBaremo = $repositorioConvocatoriaBaremo->insertarConvocatoriaBaremo($itemBaremo);
                                            if (!$resultadoItemBaremo) {
                                                throw new Exception("Error al insertar los datos del ítem baremable.");
                                            }
                                        }
                                        $repositorioitemBaremo = new RepositorioItemBarenables($dbConnection);
                                        $idIdioma = $repositorioitemBaremo->leerid('Idioma');

                                        if (isset($_POST['nivel']) && is_array($_POST['nivel'])) {
                                            foreach ($_POST['nivel'] as $index => $nivel) {
                                                // Obtener los datos de nivel y puntos
                                                $nivelIdioma = $nivel;
                                                $puntos = $_POST['nota'][$index];

                                                // Crear la instancia de ConvocatoriaBaremoIdioma
                                                $convocatoriaBaremoIdioma = new ConvocatoriaBaremoIdioma(
                                                    $idIdioma,
                                                    $idConvocatoriaInsertada,
                                                    $nivelIdioma,
                                                    $puntos
                                                );

                                                $repositorioConvocatoriaBaremoIdioma = new RepositorioConvocatoriaBaremoIdioma($dbConnection);
                                                // Insertar datos en la base de datos
                                                $resultadoConvocatoriaBaremoIdioma = $repositorioConvocatoriaBaremoIdioma->insertarConvocatoriaBaremoIdioma($convocatoriaBaremoIdioma);
                                                if (!$resultadoConvocatoriaBaremoIdioma) {
                                                    throw new Exception("Error al insertar los datos del ítem baremable de idioma.");
                                                }
                                            }
                                        }
                                        // Confirmar la transacción si todas las operaciones fueron exitosas
                                        $dbConnection->commit();
                                        echo "La convocatoria, sus destinatarios y los ítems baremables se crearon exitosamente.";
                                    } else {
                                        throw new Exception("Error al procesar los ítems baremables.");
                                    }
                                } else {
                                    throw new Exception("Error al crear la convocatoria.");
                                }
                            } catch (Exception $e) {
                                // Revertir la transacción en caso de error
                                $dbConnection->rollback();
                                echo "Error: " . $e->getMessage();
                            }
                        }
                    }
                }
                ?>
            </div>
            <div id="errorFormulario" class="error"></div>
        </form>
    </div>


</body>

</html>