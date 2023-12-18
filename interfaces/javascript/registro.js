window.addEventListener("load", function() {
    var form = document.getElementById('formulario');
    var mensaje = document.getElementById('errorFormulario');

    // Controlamos el evento de envío del formulario
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Comprobamos los valores    
        if (form.valida()) {
            form.submit();
        } else {
            // Mostramos mensaje de error
            mensaje.textContent = "¡Por favor completa correctamente todos los campos!";
            // Agregamos la clase 'invalido' al formulario
            form.classList.add('invalido');
        }
    });
});