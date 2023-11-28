<!DOCTYPE html>
<html>
<head>
  <title>CRUD de Convocatorias</title>
  <link rel="stylesheet" href="../interfaces\estilos\stylesConvocatorias.css">
</head>
<body>
  <h1>CRUD de Convocatorias</h1>

  <div id="convocatorias-list">
    dsfdf
  </div>

  <form id="convocatoria-form">
    <input type="hidden" id="convocatoria-id">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" required>
    <label for="fechaIni">Fecha de Inicio:</label>
    <input type="date" id="fechaIni" required>
    <label for="fechaFin">Fecha de Fin:</label>
    <input type="date" id="fechaFin" required>

    <button type="submit" id="guardar-btn">Guardar</button>
  </form>
</body>
</html>
