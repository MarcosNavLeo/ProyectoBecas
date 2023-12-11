<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>MIS CONVOCATORIAS</title>
    <link rel="stylesheet" type="text/css" href="http://virtual.local.marcos.com/interfaces/estilos/stylesSoli.css">
    <script src="http://virtual.local.marcos.com/interfaces/javascript/listadoconvosoli.js"></script>

</head>

<body>
    <?php
    $id = $_GET['id'];
    ?>

    <nav>
        <img src="/interfaces/Imagenes/logo2.png" alt="Logo" />
        <div id="enlacesNav">
            <a href="?menu=PrinAlum&id=<?php echo $id; ?>">HOME</a>
        </div>

    </nav>

    <main>
        <div class="contenido">
            <h1>SOLICITUDES</h1>
            <ul id="listasoli"></ul>
        </div>
    </main>

</body>

</html>