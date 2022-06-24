function confirmNewRequest() {
    let answer = confirm("Confirmar solicitud");
    if(answer == true) {
        return true;
    } else {
        return false;
    }
}

function confirmUpdateRequest() {
    let answer = confirm("Confirmar cambios");
    if(answer == true) {
        return true;
    } else {
        return false;
    }
}