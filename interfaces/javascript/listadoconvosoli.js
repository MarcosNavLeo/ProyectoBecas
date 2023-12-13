window.addEventListener("load", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const idCandidato = urlParams.get('id');

    // Hacer una solicitud al servidor para obtener las convocatorias
    fetch(`http://virtual.local.marcos.com/api/apiconvocatorias.php?convocatoriasSolicitadas&id=${idCandidato}`)
        .then(response => response.json())
        .then(data => {
            // Aquí se asume que el servidor devuelve un array de convocatorias en la variable 'data'
            const listaSoli = document.getElementById('listasoli');

            // Recorrer las convocatorias y agregarlas a la lista en tu HTML
            data.forEach(convocatoria => {
                const li = document.createElement('li');
                let texto = `ID: ${convocatoria.convocatoria.idConvocatorias}, Tipo: ${convocatoria.convocatoria.tipo}, Movilidades: ${convocatoria.convocatoria.movilidades}, Fecha de fin: ${convocatoria.convocatoria.fechaFin}, Destino: ${convocatoria.convocatoria.destino}`;

                if (convocatoria.baremos_idiomas && convocatoria.baremos_idiomas.length > 0) {
                    texto += `, Idioma: `;
                    convocatoria.baremos_idiomas.forEach(baremo => {
                        texto += `${baremo.nivelIdioma} (${baremo.puntos} puntos) `;
                    });
                }

                li.textContent = texto;
                listaSoli.appendChild(li);
            });
        })
        .catch(error => console.error('Error al obtener convocatorias:', error));
});
