function validarFormulario(tabla) {
    const inputs = document.querySelectorAll("input[type='text']");
    for (let input of inputs) {
        if (input.value.trim() === "") {
            alert("Todos los campos deben ser completados.");
            return false;
        }
    }
    return true;
}
