const validaciones = {
    nombres: {
        regex: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,30}$/,
        mensaje: "El nombre debe tener entre 3 y 30 caracteres"
    },
    apellidoPaterno: {
        regex: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,30}$/,
        mensaje: "El apellido debe tener entre 3 y 30 caracteres"
    },
    apellidoMaterno: {
        regex: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,30}$/,
        mensaje: "El apellido debe tener entre 3 y 30 caracteres"
    },
    numeroTelefono: {
        regex: /^[0-9]{10}$/,
        mensaje: "El teléfono debe tener exactamente 10 dígitos"
    },
    correoElectronico: {
        regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        mensaje: "El correo debe ser válido"
    },
    contraseña: {
        regex: /^.{8,}$/,
        mensaje: "La contraseña debe tener al menos 8 caracteres"
    }
};

function validarCampo(campo) {
    if (campo.type === 'file' || !campo.offsetParent || campo.style.display === 'none') {
        return true;
    }

    const tipo = campo.id;
    const valor = campo.value.trim();
    const validacion = validaciones[tipo];

    if (!validacion) {
        return true; 
    }

    const esValido = validacion.regex.test(valor);
    const errorDiv = campo.nextElementSibling;

    if (esValido) {
        campo.classList.remove('is-invalid');
        campo.classList.add('is-valid');
        errorDiv.textContent = '';
    } else {
        campo.classList.remove('is-valid');
        campo.classList.add('is-invalid');
        errorDiv.textContent = validacion.mensaje;
    }
    return esValido;
}

function validarConfirmacionContraseña() {
    const contraseña = document.getElementById('contraseña').value.trim();
    const confirmarContraseña = document.getElementById('confirmarContraseña').value.trim();
    const errorDiv = document.getElementById('confirmarContraseña').nextElementSibling;

    if (contraseña !== confirmarContraseña) {
        document.getElementById('confirmarContraseña').classList.remove('is-valid');
        document.getElementById('confirmarContraseña').classList.add('is-invalid');
        errorDiv.textContent = "Las contraseñas no coinciden";
        return false;
    } else {
        document.getElementById('confirmarContraseña').classList.remove('is-invalid');
        document.getElementById('confirmarContraseña').classList.add('is-valid');
        errorDiv.textContent = '';
        return true;
    }
}

function mostrarModal(mensaje, exito = true) {
    const modal = new bootstrap.Modal(document.getElementById('mensajeModal'));
    const modalTexto = document.getElementById('mensajeModalTexto');
    modalTexto.textContent = mensaje;

    // Opcional: Cambiar color del texto según el resultado
    modalTexto.style.color = exito ? 'green' : 'red';

    modal.show();
}


function validarFormulario(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    if (!validarConfirmacionContraseña()) {
        return;
    }

    fetch('./php/registro_prueba.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            mostrarModal("¡Registro exitoso!");
            setTimeout(() => {
                window.location.href = './inicio.php';
            }, 2000);
        } else {
            mostrarModal(data.message, false);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarModal("Ocurrió un error en el servidor. Inténtalo más tarde.", false);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registroForm');
    form.addEventListener('submit', validarFormulario);

    const inputs = document.querySelectorAll('#registroForm input');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            validarCampo(input);
            if (input.id === 'contraseña' || input.id === 'confirmarContraseña') {
                validarConfirmacionContraseña();
            }
        });
    });


    /*
    // Lógica para alternar visibilidad de la contraseña
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('contraseña');
    
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPassword = document.getElementById('confirmarContraseña');

  if (togglePassword && password) {
        togglePassword.addEventListener('click', function () {
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }

    if (toggleConfirmPassword && confirmPassword) {
        toggleConfirmPassword.addEventListener('click', function () {
            const type = confirmPassword.type === 'password' ? 'text' : 'password';
            confirmPassword.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }
    */
});



