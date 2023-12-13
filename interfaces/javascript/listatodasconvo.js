window.addEventListener("load", function () {
    const listaConvo = document.getElementById('listaconvo');
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

                const btnver = document.createElement('button');
                btnver.textContent = 'Ver Solicitudes';
                btnver.id = 'btnver';
                btnver.setAttribute('value', convocatoriaInfo.idConvocatorias);

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
                                    solicitudInfo.textContent = `Id Candidato: ${solicitud.idCandidato} , Nombre: ${solicitud.Nombre}, Apellidos: ${solicitud.Apellidos}, DNI: ${solicitud.DNI}, Domicilio: ${solicitud.Domicilio} `;

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

                // Crear un nuevo <li> para la convocatoria
                const li = document.createElement('li');
                li.textContent = `id:${id}, Movilidades: ${movilidades}, Tipo: ${tipo}, Destino: ${destino}, Fecha Fin: ${fechaFin}`;
                li.appendChild(btnver); // Agregar el botón al <li>

                // Agregar el <li> a la lista
                listaConvo.appendChild(li);
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

