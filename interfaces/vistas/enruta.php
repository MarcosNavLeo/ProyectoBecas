<?php
if (!isset($_GET['menu'])) {
    $_GET['menu'] = "login";
}
if (isset($_GET['menu'])) {
    if ($_GET['menu'] == "inicio") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/index.php';
    }
    if ($_GET['menu'] == "login") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/interfaces/vistas/identificacion.php';
    }
    if ($_GET['menu'] == "registro") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/interfaces/vistas/registrarse.php';
    }
    if ($_GET['menu'] == "PrinAlum") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/interfaces/vistas/principal.php';
    }
    if ($_GET['menu'] == "PrinAdmin") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/interfaces/vistas/admin.php';
    }
    if ($_GET['menu'] == "Solicitudes") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/interfaces/vistas/solicitudes.php';
    }
    if ($_GET['menu'] == "listaconvo") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/interfaces/vistas/convocatorias.php';
    }
    if ($_GET['menu'] == "editar") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/interfaces/vistas/editarconvo.php';
    }
}
?>