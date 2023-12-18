<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="interfaces\estilos\stylesReg.css">
    <script src="http://virtual.local.marcos.com/interfaces/javascript/validaciones.js"></script>
    <script src="http://virtual.local.marcos.com/interfaces/javascript/registro.js"></script>
</head>
<?php
$valida = new Validator();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrarse'])) {
    $conn = db::abreConexion();

    if ($valida->ValidacionPasada() && $valida->validaEmail($_POST['correo']) && $valida->validaDNI($_POST['dni'])) {
        if (!empty($_POST['nombre']) && !empty($_POST['curso']) && !empty($_POST['contraseña']) && !empty($_POST['dni']) && !empty($_POST['apellidos']) && !empty($_POST['telefono']) && !empty($_POST['correo']) && !empty($_POST['domicilio']) && !empty($_POST['fecha_nacimiento'])) {

            // Validar si el campo de rol está vacío y establecerlo como "alumno"
            $rol = !empty($_POST['rol']) ? $_POST['rol'] : "alumno";
            $idCandidato = null;
            // Crear un nuevo objeto User con los datos del formulario y el rol asignado
            $candidato = new Candidatos(
                $idCandidato,
                $_POST['dni'],
                $_POST['apellidos'],
                $_POST['nombre'],
                $_POST['curso'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['domicilio'],
                $_POST['fecha_nacimiento'],
                $_POST['contraseña'],
                $rol
            );

            // Insertar los datos en la base de datos
            $repositorio = new repositorioCandidato($conn);
            $repositorio->createCandidato($candidato);
            header('location:?menu=login');
        }
    }
}

?>

<body>
    <form method="post" action="" id="formulario">
        <h2>Registro</h2>
        <input type="text" id="dni" placeholder="DNI" name="dni" data-valida="relleno">
        <br>
        <input type="text" id="nombre" placeholder="Nombre" name="nombre" data-valida="relleno">
        <br>
        <input type="text" id="correo" placeholder="Correo" name="correo" data-valida="relleno">
        <br>
        <input type="password" id="contrasena" placeholder="Contraseña" name="contraseña" data-valida="relleno">
        <br>
        <input type="submit" value="REGISTRARSE" name="registrarse">
        <div id="errorFormulario"></div>
        <p>¿Ya tienes cuenta? <a href="index.php?menu=login">Inicia sesión aquí</a></p>
    </form>
</body>

</html>