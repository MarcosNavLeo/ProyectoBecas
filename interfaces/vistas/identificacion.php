<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="interfaces\estilos\stylesIdentificacion.css">
    <title>Inicio de Sesión - Consultorio Becas</title>
</head>
<?php
//creamos validator
$valida = new Validator();
//comprobamos que se ha hecho el post de formulario
if (isset($_POST['login'])) {
    //creamos conexion y login
    $conn = db::abreConexion();
    $login = new login($conn);

    //validamos
    $valida->Requerido('nombre');
    $valida->Requerido('pass');
    //Comprobamos validacion
    if ($valida->ValidacionPasada()) {
        if (!empty($_POST['nombre']) && !empty($_POST['pass'])) {
            $logged_in = $login->user_login($_POST['nombre'], $_POST['pass']);

            if (!$logged_in) {
                $valida->ErrorAutenticacion();
            }
        }
    }
}
?>

<body>
    <div class="login-container">
        <h2>CONSULTORIO DE BECAS</h2>
        <form action="index.php" method="post">
            <input type="text" id="usuario" name="nombre" placeholder="Usuario">
            <?= $valida->ImprimirError('nombre') ?>
            <input type="password" id="contraseña" name="pass" placeholder="Contraseña">
            <?= $valida->ImprimirError('pass') ?>
            <?= $valida->ImprimirError('autenticacion') ?>
            <div id="abajo">
                <button id="ini" type="submit" name="login">INICIAR SESION</button>
                <a href="index.php?menu=registro">REGISTRARSE</a></button>
                <a href="index.php?menu=olvido">¿Olvidó su contraseña?</a>
            </div>
        </form>
    </div>
</body>

</html>