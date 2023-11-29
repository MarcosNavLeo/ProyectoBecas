window.addEventListener("load", function() {
    // Obtener el idCandidato de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const idCandidato = urlParams.get('id');

    if (idCandidato) {
        const apiUrl = `http://virtual.local.marcos.com/api/apiconvocatorias.php?idCandidato=${idCandidato}`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const convocatoriasList = document.getElementById('listaconvo');

                // Limpiar la lista antes de agregar nuevos elementos
                convocatoriasList.innerHTML = '';

                // Iterar sobre los datos recibidos y crear elementos li para cada convocatoria
                data.forEach(convocatoria => {
                    console.log(convocatoria)
                    const listItem = document.createElement('li');
                    listItem.textContent = `id Convocatoria=${convocatoria.idConvocatorias}: ${convocatoria.movilidades}`; // Personaliza según tus datos
                    convocatoriasList.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error al obtener las convocatorias:', error));
    } else {
        console.error('No se encontró el idCandidato en la URL');
    }
});




