window.addEventListener("load", function() {
    const selectproyecto=document.getElementById("proyecto");
    var apiUrlproyecto = "http://virtual.local.marcos.com/api/apiproyecto.php";

     // Realiza una solicitud para obtener los proyectos y llena el select
     fetch(apiUrlproyecto)
     .then(response => response.json())
     .then(proyectos => {
         // Añadir opciones de proyectos al select
         proyectos.forEach(opcion => {
             var option = document.createElement('option');
             option.value = opcion.codProyecto;
             option.text = opcion.nombre;
             selectproyecto.appendChild(option);
         });
     })
     .catch(error => {
         console.error('Error al obtener los proyectos:', error);
     });
});




