document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita que el formulario recargue la página

    const formData = new FormData(e.target); // Captura los datos del formulario

    fetch('./php/tarjetas_api.php', {
        method: 'POST',
        body: formData, // Enviar los datos del formulario
    })
        .then(response => response.json()) // Procesar la respuesta como JSON
        .then(data => {
            if (data.message) {
                showSuccessMessage(data.message); // Mostrar mensaje de éxito
            } else if (data.error) {
                showErrorMessage(data.error); // Mostrar mensaje de error
            }
        })
        .catch(error => console.error('Error:', error));
});

function showSuccessMessage(message) {
    const messageContainer = document.createElement('div');
    messageContainer.className = 'alert alert-success'; // Clase de Bootstrap
    messageContainer.textContent = message;

    document.body.appendChild(messageContainer);

    // Eliminar el mensaje después de 3 segundos
    setTimeout(() => {
        messageContainer.remove();
    }, 3000);
}

function showErrorMessage(message) {
    const messageContainer = document.createElement('div');
    messageContainer.className = 'alert alert-danger'; // Clase de Bootstrap
    messageContainer.textContent = message;

    document.body.appendChild(messageContainer);

    // Eliminar el mensaje después de 3 segundos
    setTimeout(() => {
        messageContainer.remove();
    }, 3000);
}
