HTMLInputElement.prototype.estaRelleno = function () {
    var respuesta = false;
    if (this.value != "") {
        respuesta = true;
    }
    return respuesta;
}

HTMLInputElement.prototype.esDNI = function () {
    var letras = ["TRWAGMYFPDXBNJZSQVHLCKET"];
    var respuesta = false;
    if (this.value != "") {
        var partes = (/^(\d{8}[TRWAGMYFPDXBNJZSQVHLCKET])$/i).exec(this.value);
        if (partes > 0) {
            respuesta = [partes[1] % 23] == partes[2].toUpperCase();
        }

    }
    return respuesta;
}

HTMLInputElement.prototype.esEdad = function () {
    var respuesta = false;
    if (this.value == parseInt(this.value) && this.value >= 0 && this.value < 150) {
        respuesta = true;
    }
    return respuesta;
}


HTMLInputElement.prototype.esFecha = function () {
    var regex = /^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[012])\/\d{4}$/;
    return regex.test(this.value);
};

HTMLFormElement.prototype.alMenosUnCheckbox = function () {
    const checkboxes = Array.from(this.querySelectorAll('input[type="checkbox"]'));
    var respuesta = false;

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            respuesta = true;
        }
    });

    return respuesta;
};

HTMLInputElement.prototype.esFechaMenorQue = function (idFechaComparar) {
    // Asegúrate de que ambos inputs estén rellenos antes de comparar
    if (!this.value || !document.getElementById(idFechaComparar).value) {
        return false; // Si uno de los dos campos está vacío, devuelve falso.
    }
    
    // Convierte los valores de fecha a objetos Date para poder compararlos
    var fechaActual = new Date(this.value);
    var fechaAComparar = new Date(document.getElementById(idFechaComparar).value);

    // Compara las fechas y devuelve true si la fecha actual es menor que la fecha a comparar
    return fechaActual < fechaAComparar;
};

HTMLSelectElement.prototype.estaSeleccionado = function () {
    return this.value !== "";
};

// Función para verificar si el input de tipo date tiene una fecha
HTMLInputElement.prototype.tieneFecha = function() {
    const valor = this.value;
    return valor !== '' && valor !== null;
};

HTMLFormElement.prototype.valida = function () {
    var elementos = this.querySelectorAll("input[data-valida]");
    var respuesta = false;
    let n = elementos.length;

    for (let i = 0; i < n; i++) {
        let tipo = elementos[i].getAttribute("data-valida");
        var aux = true;
        switch (tipo) {
            case "relleno": {
                aux = elementos[i].estaRelleno();
                break;
            }
            case "edad": {
                aux = elementos[i].esEdad();
                break;
            }
            case "dni": {
                aux = elementos[i].esDNI();
                break;
            }
            case "fecha": {
                aux = elementos[i].esFecha();
                break;
            }
            case "checkbox": {
                aux = this.alMenosUnCheckbox();
                break;
            }
            case "fechaMenorQue": {
                aux = elementos[i].esFechaMenorQue(elementos[i].getAttribute("data-comparar"));
                break;
            }
            case "seleccionado": {
                aux = elementos[i].estaSeleccionado();
                break;
            }
            case "fechaObligatoria": {
                aux = elementos[i].tieneFecha();
                break;
            }
        }
        if (aux) {
            elementos[i].classList.add("valido");
        }else{
            elementos[i].classList.add("invalido");
        }

        respuesta=respuesta&&aux;
    }
    return respuesta;
}