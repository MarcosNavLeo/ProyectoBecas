<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="interfaces\estilos\stylesIdentificacion.css">
    <title>Inicio de Sesión - Consultorio Becas</title>
</head>

<body>
    <div class="login-container">
        <h2>CONSULTORIO DE BECAS</h2>
        <form action="index.php" method="post">
            <input type="text" id="usuario" name="nombre" placeholder="Usuario">
            <input type="password" id="contraseña" name="pass" placeholder="Contraseña">
            <div id="abajo">
                <button id="ini" type="submit" name="login">INICIAR SESION</button>
                    <a href="index.php?menu=registro">REGISTRARSE</a></button>
                    <a href="index.php?menu=olvido">¿Olvidó su contraseña?</a>
            </div>
        </form>
    </div>
</body>

</html>