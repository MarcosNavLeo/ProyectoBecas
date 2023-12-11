window.addEventListener("load", function () {
    function openPDF(inputId) {
        var fichero = document.getElementById(inputId);
        if (fichero.files.length == 1 && fichero.files[0].type == "application/pdf") {
            var url = URL.createObjectURL(fichero.files[0]);
            var iframe = document.createElement("iframe");
            iframe.style.width = "100%";
            iframe.style.height = "100%";
            iframe.src = url;

            var modal = document.createElement("div");
            modal.style.position = "fixed";
            modal.style.top = "0";
            modal.style.left = "0";
            modal.style.width = "100%";
            modal.style.height = "100%";
            modal.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
            modal.style.zIndex = 99;

            var visualizador = document.createElement("div");
            visualizador.style.position = "fixed";
            visualizador.style.top = "15%";
            visualizador.style.left = "20%";
            visualizador.style.width = "60%";
            visualizador.style.height = "60%";
            visualizador.style.backgroundColor = "white";
            visualizador.style.zIndex = 100;

            var cruz = document.createElement("span");
            cruz.style.backgroundImage = "url('cerrar.png')";
            cruz.style.backgroundSize = "cover";
            cruz.style.position = "fixed";
            cruz.style.padding = "5px";
            cruz.style.top = "0";
            cruz.style.right = "0";
            cruz.style.zIndex = 101;
            cruz.style.width = "3%";
            cruz.style.height = "3%";

            cruz.onclick = function () {
                contenedor.removeChild(modal);
                contenedor.removeChild(visualizador);
                contenedor.removeChild(this);
            };

            modal.appendChild(cruz);
            visualizador.appendChild(iframe);
            modal.appendChild(visualizador);
            contenedor.appendChild(modal);
        } else {
            alert("DEBE SELECCIONAR UN PDF");
        }
    }

    const abrirNotaBtn = document.getElementById('abrirNota');
    const abrirEntrevistaBtn = document.getElementById('abrirEntrevista');
    const abrirIdiomaBtn = document.getElementById('abrirIdioma');

    abrirNotaBtn.addEventListener('click', () => openPDF('nota'));
    abrirEntrevistaBtn.addEventListener('click', () => openPDF('entrevista'));
    abrirIdiomaBtn.addEventListener('click', () => openPDF('idioma'));
});

