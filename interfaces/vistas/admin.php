<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://virtual.local.marcos.com/interfaces/estilos/stylesAdmin.css">
    <script src="http://virtual.local.marcos.com/interfaces/javascript/convocatoria.js"></script>
    <title>CREAR CONVOCATORIA</title>
</head>

<body>
    <?php
    Session::inicia_sesion();
    $user = Session::lee_sesion('user');
    if (!Login::estaalogeado()) {
        header('Location:index.php?menu=login');
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
            <a>HOME</a>
            <form name="formulario" method="post">
                <button type="submit" value="CERRAR SESION" name="Logaout" id="Cierrasesion">CERRAR SESION</button>
            </form>
        </div>

    </nav>
    <div class="formulario">
        <h1 id="TituloCrear">CREAR CONVOCATORIA</h1>

        <fieldset>
            <label for="proyecto">Seleccionar Proyecto:</label>
            <select id="proyecto" name="proyecto">
                <option value="" selected>Seleccionar Proyecto</option>
            </select>

            <label for="movilidades">Movilidades:</label>
            <input type="text" id="movilidades" name="movilidades" placeholder="Movilidades">
        </fieldset>


        <fieldset>
            <label for="duracion">Duración:</label>
            <select id="duracion" name="duracion">
                <option value="" selected>Seleccionar Duracion</option>
                <option value="larga">Larga duración</option>
                <option value="corta">Corta duración</option>
            </select>

            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" placeholder="Destino">
        </fieldset>

        <!-- Fechas -->
        <fieldset>
            <label for="fechaInicioSolicitud">Fecha Inicio Solicitud:</label>
            <input type="date" id="fechaInicioSolicitud" name="fechaInicioSolicitud">

            <label for="fechaInicioPrueba">Fecha Inicio Prueba:</label>
            <input type="date" id="fechaInicioPrueba" name="fechaInicioPrueba">

            <label for="fechaListadoProvisional">Fecha Listado Provisional:</label>
            <input type="date" id="fechaListadoProvisional" name="fechaListadoProvisional">
        </fieldset>

        <fieldset>
            <label for="fechaFinalSolicitud">Fecha Final Solicitud:</label>
            <input type="date" id="fechaFinalSolicitud" name="fechaFinalSolicitud">

            <label for="fechaFinPrueba">Fecha Fin Prueba:</label>
            <input type="date" id="fechaFinPrueba" name="fechaFinPrueba">

            <label for="fechaListadoDefinitivo">Fecha Listado Definitivo:</label>
            <input type="date" id="fechaListadoDefinitivo" name="fechaListadoDefinitivo">
        </fieldset>

        <!-- Tabla -->
        <table>
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Items</th>
                    <th>Nota Máxima</th>
                    <th>Requisito</th>
                    <th>Nota Mínima</th>
                    <th>Aporta Alumno</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fila Nota -->
                <tr>
                    <td><input type="checkbox" name="seleccionarNota"></td>
                    <td><label for="nota">Nota</label></td>
                    <td><input type="text" id="notaMaxima1" name="notaMaxima1" class="notaMaxima"></td>
                    <td>
                        <select id="requisito1" name="requisito1">
                            <option value="si">Sí</option>
                            <option value="no" selected>No</option>
                        </select>
                    </td>
                    <td><input type="text" id="notaMinima1" name="notaMinima1" class="notaMinima"></td>
                    <td>
                        <select id="aportaAlumno1" name="aportaAlumno1">
                            <option value="si">Sí</option>
                            <option value="no" selected>No</option>
                        </select>
                    </td>
                </tr>

                <!-- Fila Entrevista -->
                <tr>
                    <td><input type="checkbox" name="seleccionarEntrevista"></td>
                    <td><label for="entrevista">Entrevista</label></td>
                    <td><input type="text" id="notaMaxima3" name="notaMaxima3" class="notaMaxima"></td>
                    <td>
                        <select id="requisito3" name="requisito3">
                            <option value="si">Sí</option>
                            <option value="no" selected>No</option>
                        </select>
                    </td>
                    <td><input type="text" id="notaMinima3" name="notaMinima3" class="notaMinima"></td>
                    <td>
                        <select id="aportaAlumno3" name="aportaAlumno3">
                            <option value="si">Sí</option>
                            <option value="no" selected>No</option>
                        </select>
                    </td>
                </tr>

                <!-- Fila Idioma -->
                <tr>
                    <td><input type="checkbox" name="seleccionarIdioma"></td>
                    <td><label for="idioma">Idioma</label></td>
                    <td><input type="text" id="notaMaxima2" name="notaMaxima2" class="notaMaxima"></td>
                    <td>
                        <select id="requisito2" name="requisito2">
                            <option value="si">Sí</option>
                            <option value="no" selected>No</option>
                        </select>
                    </td>
                    <td><input type="text" id="notaMinima2" name="notaMinima2" class="notaMinima"></td>
                    <td>
                        <select id="aportaAlumno2" name="aportaAlumno2">
                            <option value="si">Sí</option>
                            <option value="no" selected>No</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th>Nivel</th>
                    <th>Puntos</th>
                    <th>Nivel</th>
                    <th>Puntos</th>
                    <th>Nivel</th>
                    <th>Puntos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>A1</td>
                    <td><input type="text" name="notaA1" class="puntos"></td>
                    <td>B1</td>
                    <td><input type="text" name="notaB1" class="puntos"></td>
                    <td>C1</td>
                    <td><input type="text" name="notaC1" class="puntos"></td>
                </tr>
                <tr>
                    <td>A2</td>
                    <td><input type="text" name="notaA2" class="puntos"></td>
                    <td>B2</td>
                    <td><input type="text" name="notaB2" class="puntos"></td>
                    <td>C2</td>
                    <td><input type="text" name="notaC1" class="puntos"></td>
                </tr>
            </tbody>
        </table>


    </div>


</body>

</html>