window.addEventListener('load', function () {
    const archivosDiv = document.getElementById('archivos');

    function crearCampoAdjunto(nombre,id) {
        const label = document.createElement('label');
        label.textContent = nombre + ':';

        const input = document.createElement('input');
        input.type = 'file';
        input.name = nombre;
        input.setAttribute('data-id',id); // Guardar el ID del item_barenable en un atributo data


        archivosDiv.appendChild(label);
        archivosDiv.appendChild(input);
        archivosDiv.appendChild(document.createElement('br'));
    }

    fetch('http://virtual.local.marcos.com/api/apitem_barenables.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                crearCampoAdjunto(item.nombre,item.idItemBarenables);
            });
        })
        .catch(error => {
            console.error('Error al obtener los datos de la API:', error);
        });

    const urlParams = new URLSearchParams(window.location.search);
    const idCandidato = urlParams.get('id');
    fetch(`http://virtual.local.marcos.com/api/apiconvocatorias.php?todasConvocatorias&id=${idCandidato}`)
        .then(response => response.json())
        .then(data => {
            const listaConvo = document.getElementById('listaconvo');

            data.forEach(convocatoria => {
                const convocatoriaInfo = convocatoria.convocatoria;
                const movilidades = convocatoriaInfo.movilidades;
                const tipo = convocatoriaInfo.tipo;
                const fechaFin = convocatoriaInfo.fechaFin;
                const destino = convocatoriaInfo.destino;


                const btnSolicitar = document.createElement('button');
                btnSolicitar.textContent = 'Solicitar';
                btnSolicitar.id = 'btnSolicitar';
                btnSolicitar.setAttribute('value', convocatoriaInfo.idConvocatorias);
                // Crear un nuevo <li> para la convocatoria
                const li = document.createElement('li');
                li.textContent = `Movilidades: ${movilidades}, Tipo: ${tipo}, Destino: ${destino}, Fecha Fin: ${fechaFin}`;
                li.appendChild(btnSolicitar); // Agregar el botón al <li>

                btnSolicitar.addEventListener('click', function () {
                    const convocatoriaId = this.value;
                    // Realizar la solicitud fetch a la API del candidato con el ID correspondiente
                    fetch(`http://virtual.local.marcos.com/api/apicandidatos.php?id=${idCandidato}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('dni').value = data.DNI;
                            document.getElementById('nombre').value = data.Nombre;
                            document.getElementById('apellidos').value = data.Apellidos;
                            document.getElementById('correo').value = data.correo;
                            document.getElementById('telefono').value = data.Telefono;
                            document.getElementById('domicilio').value = data.Domicilio;
                        })
                        .catch(error => {
                            console.error('Error al obtener los datos del candidato:', error);
                        });

                    // Mostrar la ventana modal al hacer clic en "Solicitar"
                    modal.style.display = 'block';

                    const modalForm = document.getElementById('modalForm');

                    modalForm.addEventListener('submit', function (event) {
                        event.preventDefault(); // Evitar el comportamiento de envío predeterminado del formulario

                        // Recopilar los datos de los campos del formulario
                        const formData = {
                            Convocatorias_idConvocatorias: convocatoriaId,
                            Candidatos_idCandidato: idCandidato,
                            DNI: document.getElementById('dni').value,
                            Nombre: document.getElementById('nombre').value,
                            Apellidos: document.getElementById('apellidos').value,
                            Telefono: document.getElementById('telefono').value,
                            Correo: document.getElementById('correo').value,
                            Domicilio: document.getElementById('domicilio').value
                        };

                        // Realizar la solicitud fetch para insertar el candidato
                        fetch('http://virtual.local.marcos.com/api/apicandidatoconvo.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(formData)
                        })
                            .then(response => {
                                if (response.ok) {
                                    alert('Beca solicitada correctamente.');
                                    modal.style.display = 'none'; // Cerrar la ventana modal
                                    window.location.reload(); // Recargar la página
                                } else {
                                    throw new Error('Error al insertar el candidato');
                                }
                            })
                            .catch(error => {
                                console.error('Error al insertar el candidato:', error);
                                alert('Hubo un error al guardar los datos. Por favor, inténtalo de nuevo.');
                                // Manejar el error apropiadamente, mostrar un mensaje al usuario, etc.
                            });
                    });
                });


                listaConvo.appendChild(li);
            });
        })
        .catch(error => {
            console.error('Error al obtener las convocatorias:', error);
        });

    // Obtener la referencia al botón y la ventana modal
    const modal = document.getElementById('myModal');
    const spanClose = document.getElementsByClassName('close')[0];

    // Cerrar la ventana modal al hacer clic en la 'x'
    spanClose.addEventListener('click', function () {
        modal.style.display = 'none';
    });

});


