window.addEventListener("load", function () {
    const selectproyecto = document.getElementById("proyecto");
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
    const destinatariosContainer = document.getElementById("destinatariosCheckboxes");
    const apiUrldestinatarios = "http://virtual.local.marcos.com/api/apidestinatarios.php";

    // Realiza una solicitud para obtener los proyectos y crear los checkboxes
    fetch(apiUrldestinatarios)
        .then(response => response.json())
        .then(proyectos => {
            // Crear checkboxes para cada destinatario
            proyectos.forEach(destinatario => {
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'destinatarios[]';
                checkbox.value = destinatario.idDestinatarios;

                const label = document.createElement('label');
                label.textContent = destinatario.codGrupo + " " + destinatario.nombre;
                label.appendChild(checkbox);
                destinatariosContainer.appendChild(label);
            });
        })
        .catch(error => {
            console.error('Error al obtener los proyectos:', error);
        });


    const apiUrlItem = "http://virtual.local.marcos.com/api/apitem_barenables.php";

    const tablaItem = document.querySelector('.baremable tbody');

    fetch("/interfaces/plantillas/tablaItem.html")
        .then(x => x.text())
        .then(y => {
            plantillaItem = document.createElement("tr");
            plantillaItem.innerHTML = y;

            fetch(apiUrlItem)
                .then(x => x.json())
                .then(y => {
                    for (let i = 0; i < y.length; i++) {
                        var itemBaremable = plantillaItem.cloneNode(true);

                        var item = itemBaremable.querySelector(".item");
                        item.textContent = y[i].nombre;

                        var inputhidden = itemBaremable.querySelector('input[type="hidden"][name="item[]"]');
                        inputhidden.value = y[i].idItemBarenables;

                        var aporta = itemBaremable.querySelector('input[type="checkbox"][name="aporta[]"]');
                        aporta.value = y[i].idItemBarenables;

                        var label = itemBaremable.querySelector('label');
                        if (label) {
                            label.htmlFor = y[i].nombre + "CB";
                        }

                        // Añadir funcionalidad de deshabilitar/enabled para el checkbox 'requisito[]' y el input 'minimo[]'
                        var minInput = itemBaremable.querySelector('input[type="number"][name="minimo[]"]');
                        if (minInput) {
                            minInput.setAttribute('disabled', '');
                            minInput.parentNode.classList.add('disabled');
                        }

                        const checkboxRequisito = itemBaremable.querySelector('input[type="checkbox"][name="requisito[]"]');
                        if (checkboxRequisito) {
                            checkboxRequisito.addEventListener('change', function () {
                                const inputMinimo = this.parentNode.parentNode.querySelector("input[name='minimo[]']");
                                if (this.checked) {
                                    inputMinimo.removeAttribute('disabled');
                                    inputMinimo.parentNode.classList.remove('disabled');
                                } else {
                                    inputMinimo.value = "";
                                    inputMinimo.setAttribute('disabled', '');
                                    inputMinimo.parentNode.classList.add('disabled');
                                }
                            });
                        }

                        tablaItem.appendChild(itemBaremable);
                    }
                });
        });
    // Obtener los elementos del DOM para cada campo de fecha por su ID
    var fechaInicioSolicitud = document.getElementById('fechaInicioSolicitud');
    var fechaFinalSolicitud = document.getElementById('fechaFinalSolicitud');
    var fechaInicioPrueba = document.getElementById('fechaInicioPrueba');
    var fechaFinPrueba = document.getElementById('fechaFinPrueba');
    var fechaListadoProvisional = document.getElementById('fechaListadoProvisional');
    var fechaListadoDefinitivo = document.getElementById('fechaListadoDefinitivo');

    var errorFechaInicioSolicitud = document.getElementById('errorFechaInicioSolicitud');
    var errorFechaFinalSolicitud = document.getElementById('errorFechaFinalSolicitud');
    var errorFechaInicioPrueba = document.getElementById('errorFechaInicioPrueba');
    var errorFechaFinPrueba = document.getElementById('errorFechaFinPrueba');
    var errorFechaListadoProvisional = document.getElementById('errorFechaListadoProvisional');
    var errorFechaListadoDefinitivo = document.getElementById('errorFechaListadoDefinitivo');


    // Inicialmente, deshabilitar todos los campos de fecha excepto el primero
    fechaFinalSolicitud.disabled = true;
    fechaInicioPrueba.disabled = true;
    fechaFinPrueba.disabled = true;
    fechaListadoProvisional.disabled = true;
    fechaListadoDefinitivo.disabled = true;

    // Event listeners para cada par de fechas

    fechaInicioSolicitud.addEventListener('change', function () {
        if (fechaFinalSolicitud.value && !this.esFechaMenorQue('fechaFinalSolicitud')) {
            errorFechaInicioSolicitud.textContent = 'La fecha de inicio de solicitud debe ser menor que la fecha final.';
            this.value = '';
        } else {
            errorFechaInicioSolicitud.textContent = '';
            fechaFinalSolicitud.disabled = !this.value;
        }
    });

    fechaFinalSolicitud.addEventListener('change', function () {
        if (fechaInicioSolicitud.value && !fechaInicioSolicitud.esFechaMenorQue('fechaFinalSolicitud')) {
            errorFechaFinalSolicitud.textContent = 'La fecha final de solicitud debe ser mayor que la fecha de inicio.';
            this.value = '';
        } else {
            errorFechaFinalSolicitud.textContent = '';
            fechaInicioPrueba.disabled = !this.value;
        }
    });

    fechaInicioPrueba.addEventListener('change', function () {
        if (fechaFinPrueba.value && !this.esFechaMenorQue('fechaFinPrueba')) {
            errorFechaInicioPrueba.textContent = 'La fecha de inicio de prueba debe ser menor que la fecha final.';
            this.value = '';
        } else {
            errorFechaInicioPrueba.textContent = '';
            fechaFinPrueba.disabled = !this.value;
        }
    });

    fechaFinPrueba.addEventListener('change', function () {
        if (fechaInicioPrueba.value && !fechaInicioPrueba.esFechaMenorQue('fechaFinPrueba')) {
            errorFechaFinPrueba.textContent = 'La fecha final de prueba debe ser mayor que la fecha de inicio.';
            this.value = '';
        } else {
            errorFechaFinPrueba.textContent = '';
            fechaListadoProvisional.disabled = !this.value;
        }
    });

    fechaListadoProvisional.addEventListener('change', function () {
        if (fechaListadoDefinitivo.value && !this.esFechaMenorQue('fechaListadoDefinitivo')) {
            errorFechaListadoProvisional.textContent = 'La fecha de listado provisional debe ser menor que la fecha de listado definitivo.';
            this.value = '';
        } else {
            errorFechaListadoProvisional.textContent = '';
            fechaListadoDefinitivo.disabled = !this.value;
        }
    });

    fechaListadoDefinitivo.addEventListener('change', function () {
        if (fechaListadoProvisional.value && !fechaListadoProvisional.esFechaMenorQue('fechaListadoDefinitivo')) {
            errorFechaListadoDefinitivo.textContent = 'La fecha de listado definitivo debe ser mayor que la fecha de listado provisional.';
            this.value = '';
        } else {
            errorFechaListadoDefinitivo.textContent = '';
            // Aquí puedes habilitar cualquier otro campo que dependa de este
        }
    });

    // var form = document.getElementById('formulario');
    // var mensaje = document.getElementById('errorFormulario');

    // form.addEventListener('submit', function (event) {
    //     event.preventDefault();
    //     if (!this.valida()) {
    //         mensaje.textContent = "EL FORMULARIO DEBE TENER TODOS LOS CAMPOS RELLENOS";
    //         this.classList.remove("valido");
    //         this.classList.add("invalido");
    //     } else {
    //         this.classList.add("valido");
    //         this.classList.remove("invalido");
    //     }
    // });

    const bodyIdioma = document.querySelector('.idioma tbody tr');
    const theadIdioma = document.querySelector('.idioma thead tr');
    // Cargar la plantilla de idiomas una vez
    fetch("/interfaces/plantillas/tablaidioma.html")
        .then(x => x.text())
        .then(y => {
            plantillaIdioma = document.createElement("tr");
            plantillaIdioma.innerHTML = y;
        })
        //cargar idiomas
        .then(() => {
            fetch('http://virtual.local.marcos.com/api/apiIdioma.php')
                .then(x => x.json())
                .then(y => {
                    for (let i = 0; i < y.length; i++) {
                        var idiomas = plantillaIdioma.cloneNode(true);

                        var th = document.createElement('th');
                        var nivel = idiomas.querySelector(".nIdioma");

                        var inputhidden = idiomas.querySelector('input[type="hidden"][name="nivel[]"]');
                        inputhidden.value = y[i].nivel;

                        nivel.textContent = y[i].nivel;
                        th.appendChild(nivel);
                        theadIdioma.appendChild(th);

                        var nota = document.createElement('td');
                        nota = idiomas.querySelector("td");
                        nota.querySelector('input').id = y[i].nivel;
                        nota.querySelector('input').setAttribute('data-valida', 'numero');
                        bodyIdioma.appendChild(nota);
                    }
                });
        }
        );
});


