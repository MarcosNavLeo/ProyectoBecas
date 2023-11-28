<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="http://virtual.local.marcos.com/interfaces/javascript/convocatoria.js"> -->
    <title>Document</title>
</head>

<body>
    <h1>Convocatorias</h1>
    <ul id="convocatorias-list"></ul>
    <script>
        <?php
        Session::inicia_sesion();
        $user = Session::lee_sesion('user');
        $idCandidato = $user->getIdCandidato();
        echo "console.log('ID del Candidato:', $idCandidato);";
        ?>
    </script>

</body>
</body>

</html>