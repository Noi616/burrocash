<?php
session_start();

// Destruir la sesión
session_unset(); // Elimina las variables de sesión
session_destroy(); // Destruye la sesión actual

// Redirigir al usuario a la página de inicio o de login
header("Location: ../login.html");
exit();
?>
