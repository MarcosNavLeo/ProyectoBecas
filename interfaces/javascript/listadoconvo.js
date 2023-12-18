window.addEventListener('load', function () {
    const archivosDiv = document.getElementById('archivos');
    const botonimg=document.getElementById("fotoSelect");

    function crearCampoAdjunto(nombre, id) {
        const label = document.createElement('label');
        label.textContent = nombre + ':';

        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'fichero.' + id;
        input.setAttribute('data-id', id);
        input.id = 'fichero.' + id;

        const abrirPDFButton = document.createElement('button');
        abrirPDFButton.textContent = 'Abrir PDF';
        abrirPDFButton.id = 'btnAbrirPDF';
        abrirPDFButton.className = 'ficheros';


        archivosDiv.appendChild(label);
        archivosDiv.appendChild(input);
        archivosDiv.appendChild(abrirPDFButton);
        archivosDiv.appendChild(document.createElement('br'));

        abrirPDFButton.addEventListener('click', function () {
            abrirPDF(input.id);
        });
    }

    fetch('http://virtual.local.marcos.com/api/apitem_barenables.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                crearCampoAdjunto(item.nombre, item.idItemBarenables);
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

                // Aquí se asume que el servidor devuelve un array de convocatorias en la variable 'data'
                const listaSoli = document.getElementById('listaconvo');

                // Crear un nuevo <li> para la convocatoria
                const li = document.createElement('li');
                li.style.display = 'flex'; // Para mantener los elementos en línea

                const btnSolicitar = document.createElement('button');
                btnSolicitar.id = 'btnSolicitar';
                btnSolicitar.setAttribute('value', convocatoriaInfo.idConvocatorias);

                // Crear un elemento <img> para la imagen
                const imagenCV = document.createElement('img');
                imagenCV.src = 'imagenes/solicitar.png';
                imagenCV.alt = 'CV Image'; 

                // Agregar la imagen al botón
                btnSolicitar.appendChild(imagenCV);

                let texto = `Movilidades: ${movilidades}, Tipo: ${tipo}, Destino: ${destino}, Fecha Fin: ${fechaFin}`;

                // Crear un elemento para mostrar la información
                const textoInfo = document.createElement('span');
                textoInfo.textContent = texto;

                // Agregar el texto y el botón al <li>
                li.appendChild(textoInfo);
                li.appendChild(btnSolicitar);

                // Agregar el elemento <li> a la lista
                listaSoli.appendChild(li);


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
                            document.getElementById('imgFotoPerfil').value = data.foto;
                            document.getElementById('blob').value = data.foto;
                        })
                        .catch(error => {
                            console.error('Error al obtener los datos del candidato:', error);
                        });

                    // Mostrar la ventana modal al hacer clic en "Solicitar"
                    modal.style.display = 'block';

                    const modalForm = document.getElementById('modalForm');

                    modalForm.addEventListener('submit', function (event) {
                        event.preventDefault(); // Evitar el comportamiento de envío predeterminado del formulario

                        const formData = new FormData();
                        const urlsArchivos = []; // Arreglo para almacenar las URLs de los archivos
                        const idItemBarenables = []; // Arreglo para almacenar los IDs de los campos adjuntos
                        let archivosSeleccionados = 0; // Contador de campos de archivo seleccionados

                        const inputs = archivosDiv.getElementsByTagName('input');
                        for (let i = 0; i < inputs.length; i++) {
                            if (inputs[i].type === 'file') {
                                const archivos = inputs[i].files;
                                const dataId = inputs[i].getAttribute('data-id');

                                if (archivos.length > 0) {
                                    archivosSeleccionados++;

                                    for (let j = 0; j < archivos.length; j++) {
                                        formData.append(inputs[i].name + '_' + j, archivos[j]);
                                        urlsArchivos.push('pdf/' + archivos[j].name); // Agregar cada URL al arreglo
                                        idItemBarenables.push(dataId); // Agregar cada ID al arreglo
                                    }
                                }
                            }
                        }

                        if (archivosSeleccionados === 3) {
                            fetch('http://virtual.local.marcos.com/api/apibaremacion.php?pdf', {
                                method: 'POST',
                                body: formData
                            })
                                .then(response => response.text())
                                .then(() => {
                                    // Utilizar el arreglo de URLs para procesar las inserciones
                                    for (let k = 0; k < urlsArchivos.length; k++) {
                                        const baremacion = {
                                            idBaremacion: null,
                                            iditem_barenables: idItemBarenables[k], // Usar el idItemBarenable correspondiente
                                            idConvocatorias: convocatoriaId,
                                            url: urlsArchivos[k], // Usar la URL correspondiente
                                            Candidatos_idCandidato: idCandidato,
                                        };

                                        fetch('http://virtual.local.marcos.com/api/apibaremacion.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify(baremacion)
                                        })
                                            .then(response => response.text())
                                    }
                                })

                            // Recopilar los datos de los campos del formulario
                            const form = {
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
                                body: JSON.stringify(form)
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
                                });
                        } else {
                            const mensajeError = document.createElement('p');
                            mensajeError.textContent = 'Selecciona los tres archivos requeridos antes de enviar el formulario.';
                            mensajeError.style.color = 'red';

                            // Agregar el mensaje de error al DOM
                            const divError = document.getElementById('mensajeError');
                            divError.innerHTML = '';
                            divError.appendChild(mensajeError);

                            // Borra el mensaje de error después de 5 segundos
                            setTimeout(function () {
                                divError.removeChild(mensajeError);
                            }, 5000);
                        }

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
function abrirPDF(inputId) {
    var fichero = document.getElementById(inputId);
    if (fichero.files.length === 1 && fichero.files[0].type === 'application/pdf') {

        var url = URL.createObjectURL(fichero.files[0]);
        var iframe = document.createElement('iframe');
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        iframe.src = url;
        iframe.style.zIndex = 105;

        var modal = document.createElement('div');
        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100%';
        modal.style.height = '100%';
        modal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        modal.style.zIndex = 99;

        var viewer = document.createElement('div');
        viewer.style.position = 'fixed';
        viewer.style.top = '15%';
        viewer.style.left = '20%';
        viewer.style.width = '60%';
        viewer.style.height = '60%';
        viewer.style.backgroundColor = 'white';
        viewer.style.zIndex = 100;

        var close = document.createElement('span');
        close.textContent = 'X';
        close.style.position = 'fixed';
        close.style.padding = '5px';
        close.style.top = '0';
        close.style.right = '0';
        close.style.zIndex = 101;
        close.style.cursor = 'pointer';
        close.style.width = '3%';
        close.style.height = '3%';

        close.onclick = function () {
            document.body.removeChild(modal);
            document.body.removeChild(viewer);
            document.body.removeChild(this);
        };

        modal.appendChild(close);
        viewer.appendChild(iframe);
        modal.appendChild(viewer);
        document.body.appendChild(modal);
    } else {
        alert('DEBE SELECCIONAR UN PDF');
    }
}

