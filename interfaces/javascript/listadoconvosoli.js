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
                // Crear un nuevo <li> para la convocatoria
                const li = document.createElement('li');
                li.style.display = 'flex'; // Para mantener los elementos en línea

                const verpdf = document.createElement('button');
                verpdf.id = 'btnpdf';
                verpdf.setAttribute('value', convocatoria.idConvocatorias);

                // Crear un elemento <img> para la imagen
                const imagenCV = document.createElement('img');
                imagenCV.src = 'imagenes/pdf.png'; // Ruta de la imagen relativa a la carpeta raíz del proyecto
                imagenCV.alt = 'CV Image'; // Texto alternativo para la imagen

                // Agregar la imagen al botón
                verpdf.appendChild(imagenCV);

                let texto = `ID: ${convocatoria.convocatoria.idConvocatorias}, Tipo: ${convocatoria.convocatoria.tipo}, Movilidades: ${convocatoria.convocatoria.movilidades}, Fecha de fin: ${convocatoria.convocatoria.fechaFin}, Destino: ${convocatoria.convocatoria.destino}`;

                if (convocatoria.baremos_idiomas && convocatoria.baremos_idiomas.length > 0) {
                    texto += `, Idioma: `;
                    convocatoria.baremos_idiomas.forEach(baremo => {
                        texto += `${baremo.nivelIdioma} (${baremo.puntos} puntos) `;
                    });
                }

                // Crear un elemento para mostrar la información
                const textoInfo = document.createElement('span');
                textoInfo.textContent = texto;

                // Agregar el botón y el texto al <li>
                li.appendChild(textoInfo);
                li.appendChild(verpdf);
                
                // Agregar el elemento <li> a la lista
                listaSoli.appendChild(li);
            });
        })
        .catch(error => console.error('Error al obtener convocatorias:', error));
});

