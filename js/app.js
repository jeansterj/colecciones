


function cambiarEstadoElementos(id, deshabilitar) {
    let elementos = ["nivel", "atributo", "nombre", "descripcion", "tipo", "atkBut", "defBut", "img"];

    elementos.forEach(elemento => {
        let elementoActual = document.getElementById(elemento + id);
        elementoActual.disabled = deshabilitar;
    });
}



function habilitarBotones(id) {
    
    let botonH = "habilitar" + id
    let botonD = "deshabilitar" + id
    let botonB = "borrar" + id


    cambiarEstadoElementos(id, false);
    document.getElementById(botonH).style.display = "none";
    document.getElementById(botonB).style.display = "none";

    document.getElementById(botonD).style.display = "block";


}

function deshabilitarBotones(id) {
  
    let botonH = "habilitar" + id
    let botonD = "deshabilitar" + id
    let botonB = "borrar" + id

    cambiarEstadoElementos(id, true);
    document.getElementById(botonD).style.display = "none";

    document.getElementById(botonH).style.display = "block";
    document.getElementById(botonB).style.display = "block";

}
