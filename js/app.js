


function cambiarEstadoElementos(id, deshabilitar) {
    let elementos = ["nivel", "atributo", "nombre", "descripcion", "tipo", "atkBut", "defBut"];

    elementos.forEach(elemento => {
        let elementoActual = document.getElementById(elemento + id);
        elementoActual.disabled = deshabilitar;
    });
}



function habilitarBotones(id) {
    
    let botonH = "habilitar" + id
    let botonD = "deshabilitar" + id

    cambiarEstadoElementos(id, false);
    document.getElementById(botonH).style.display = "none";

    document.getElementById(botonD).style.display = "block";


}

function deshabilitarBotones(id) {
  
    let botonH = "habilitar" + id
    let botonD = "deshabilitar" + id

    cambiarEstadoElementos(id, true);
    document.getElementById(botonD).style.display = "none";

    document.getElementById(botonH).style.display = "block";

}
