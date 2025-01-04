document.querySelector("form").addEventListener("submit", async (event) => {
    event.preventDefault(); // Evita el envío por defecto del formulario

    const form = event.target; // Selecciona el formulario que dispara el evento
    const formData = new FormData(form); // Recopila los datos del formulario

    try {
        const response = await fetch("./php/login.php", { // Envío al servidor
            method: "POST",
            body: formData
        });

        const data = await response.json(); // Procesa la respuesta JSON del servidor

        if (data.success) {
            alert(data.message); // Opcional: Muestra el mensaje de éxito
            window.location.href = data.redirect; // Redirige a la página especificada
        } else {
            // Muestra el mensaje de error en el modal
            const errorModalBody = document.getElementById("errorModalBody");
            errorModalBody.textContent = data.message;

            // Activa el modal
            const errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
            errorModal.show();
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);

        // Muestra un mensaje de error genérico en el modal
        const errorModalBody = document.getElementById("errorModalBody");
        errorModalBody.textContent = "Ocurrió un error inesperado. Por favor, inténtalo más tarde.";

        const errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
        errorModal.show();
    }
});
