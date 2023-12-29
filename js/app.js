let botonH = document.getElementById("habilitar")
let botonD = document.getElementById("deshabilitar")

function cambiarEstadoElementos(id, deshabilitar) {
    let elementos = ["nivel", "atributo", "nombre", "descripcion", "tipo", "atkBut", "defBut"];

    elementos.forEach(elemento => {
        let elementoActual = document.getElementById(elemento + id);
        elementoActual.disabled = deshabilitar;
    });
}

function actualizarClases(boton, quitar, agregar) {
    boton.classList.remove(quitar);
    boton.classList.add(agregar);
}

function habilitarBotones(id) {
    cambiarEstadoElementos(id, false);
    actualizarClases(botonH, "habilitar", "deshabilitar");
    actualizarClases(botonD, "deshabilitar", "habilitar");
}

function deshabilitarBotones(id) {
    cambiarEstadoElementos(id, true);
    actualizarClases(botonD, "habilitar", "deshabilitar");
    actualizarClases(botonH, "deshabilitar", "habilitar");
}
