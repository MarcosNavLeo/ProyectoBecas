<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CONSULTORIO DE BECAS</title>
    <link rel="stylesheet" type="text/css" href="http://virtual.local.marcos.com/interfaces/estilos/stylesPrinAlum.css">
    
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
            <a href="?menu=examen">MIS CONVOCATORIAS</a>
            <!-- <a><button value="SOLICITAR CONVOCATORIA" name="Solicitar" id="SoliConvo">SOLICITAR CONVOCATORIA</button></a> -->
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
    </main>

</body>

</html>