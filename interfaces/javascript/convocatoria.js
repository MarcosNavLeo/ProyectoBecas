window.addEventListener("load", function() {
    // Verificar si se obtuvo el idCandidato
    if (typeof idCandidato !== 'undefined' && idCandidato !== null) {
        fetch(`http://virtual.local.marcos.com/api/apiconvocatorias.php?idCandidato=${idCandidato}`)
            .then(response => response.json())
            .then(data => {
                const convocatoriasList = document.getElementById('convocatorias-list');

                // Limpiamos la lista antes de agregar nuevos elementos
                convocatoriasList.innerHTML = '';

                // Iteramos sobre los datos recibidos y creamos elementos li para cada convocatoria
                data.forEach(convocatoria => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${convocatoria.idConvocatoria}: ${convocatoria.nombre}`; // Personaliza esto según tus datos
                    convocatoriasList.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error al obtener las convocatorias:', error));
    } else {
        console.error('No se encontró el idCandidato definido en el script');
    }
});


