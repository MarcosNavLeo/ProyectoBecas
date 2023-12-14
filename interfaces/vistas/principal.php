<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CONSULTORIO DE BECAS</title>
    <link rel="stylesheet" type="text/css" href="http://virtual.local.marcos.com/interfaces/estilos/stylesPrinAlum.css">
    <script src="http://virtual.local.marcos.com/interfaces/javascript/listadoconvo.js"></script>

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
    $id=$user->getIdCandidato();

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
            <a href="?menu=Solicitudes&id=<?php echo $id; ?>">MIS CONVOCATORIAS</a>
            <form name="formulario" method="post">
                <button type="submit" value="CERRAR SESION" name="Logaout" id="Cierrasesion">CERRAR SESION</button>
            </form>
        </div>

    </nav>

    <main>

        <div class="contenido">
            <h1>CONVOCATORIAS</h1>
            <ul id="listaconvo"></ul>

        </div>

        <!-- Ventana modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Datos Personales</h2>
                <form id="modalForm">
                    <label for="dni">DNI:</label>
                    <input type="text" id="dni" name="dni" disabled><br>

                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" disabled><br>

                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" disabled><br>

                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" ><br>

                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" ><br>

                    <label for="domicilio">Domicilio:</label>
                    <input type="text" id="domicilio" name="domicilio" ><br>

                    <div id="archivos">
                        <h3>Archivos Adjuntos</h3>
                    </div>
                    <div id="mensajeError"></div>

                    <input type="submit" value="Guardar">
                </form>
            </div>
        </div>
    </main>

</body>

</html>