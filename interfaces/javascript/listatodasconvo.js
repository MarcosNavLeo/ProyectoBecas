window.addEventListener("load", function () {
    fetch(`http://virtual.local.marcos.com/api/apiconvocatorias.php?todas`)
        .then(response => response.json())
        .then(data => {
            data.forEach(convocatoria => {
                const convocatoriaInfo = convocatoria.convocatoria;
                const movilidades = convocatoriaInfo.movilidades;
                const tipo = convocatoriaInfo.tipo;
                const fechaFin = convocatoriaInfo.fechaFin;
                const destino = convocatoriaInfo.destino;
                const id = convocatoriaInfo.idConvocatorias;

                const listaconvo = document.getElementById('listaconvo');

                // Crear un nuevo <li> para la convocatoria
                const li = document.createElement('li');
                li.style.display = 'flex'; // Para mantener los elementos en línea

                const btnver = document.createElement('button');
                btnver.id = 'btnver';
                btnver.setAttribute('value', convocatoriaInfo.idConvocatorias);

                // Crear un elemento <img> para la imagen
                const imagenCV = document.createElement('img');
                imagenCV.src = 'imagenes/cv.png'; // Ruta de la imagen relativa a la carpeta raíz del proyecto
                imagenCV.alt = 'CV Image'; // Texto alternativo para la imagen

                // Agregar la imagen al botón
                btnver.appendChild(imagenCV);

                btnver.addEventListener('click', () => {
                    fetch(`http://virtual.local.marcos.com/api/apicandidatoconvo.php?idConvocatorias=${id}`)
                        .then(response => response.json())
                        .then(data => {
                            const modalContent = document.querySelector('.modal-content');
                            modalContent.innerHTML = ''; // Limpiar el contenido del modal

                            if (data.length === 0) {
                                const noSolicitudes = document.createElement('p');
                                noSolicitudes.textContent = 'No hay solicitudes para esta convocatoria';
                                modalContent.appendChild(noSolicitudes);
                            } else {
                                data.forEach(solicitud => {
                                    const solicitudInfo = document.createElement('p');
                                    const titulo = document.createElement('h3');
                                    solicitudInfo.id = 'solicitudInfo';
                                    titulo.textContent = `Solicitud del candidato: ${solicitud.idCandidato}`;
                                    solicitudInfo.textContent = `Nombre: ${solicitud.Nombre}, Apellidos: ${solicitud.Apellidos}, DNI: ${solicitud.DNI}, Domicilio: ${solicitud.Domicilio}`;
                                    
                                    modalContent.appendChild(titulo); // Agregar título al modal
                                    modalContent.appendChild(solicitudInfo); // Agregar información de la solicitud al modal
                                });
                            }

                            // Mostrar la ventana modal
                            const modal = document.getElementById('myModal');
                            modal.style.display = "block";
                        })
                        .catch(error => {
                            console.error('Ha ocurrido un error:', error);
                        });
                });

                
                let texto = `id:${id}, Movilidades: ${movilidades}, Tipo: ${tipo}, Destino: ${destino}, Fecha Fin: ${fechaFin}`;

                // Crear un elemento para mostrar la información
                const textoInfo = document.createElement('span');
                textoInfo.textContent = texto;

                // Agregar el texto y el botón al <li>
                li.appendChild(textoInfo);
                li.appendChild(btnver);

                // Agregar el elemento <li> a la lista
                listaconvo.appendChild(li);
            });
        })
        .catch(error => {
            console.error('Ha ocurrido un error:', error);
        });

    // Obtener la referencia al botón y la ventana modal
    const modal = document.getElementById('myModal');
    const spanClose = document.getElementsByClassName('close')[0];

    // Cerrar la ventana modal al hacer clic en la 'x'
    spanClose.addEventListener('click', function () {
        modal.style.display = 'none';
    });
});

