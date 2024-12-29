



CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY, -- ID único para cada usuario
    nombre VARCHAR(50) NOT NULL,               -- Nombre del usuario
    apellido_paterno VARCHAR(50) NOT NULL,    -- Apellido paterno
    apellido_materno VARCHAR(50),             -- Apellido materno (puede ser opcional)
    numero_telefono VARCHAR(15),              -- Número de teléfono
    correo VARCHAR(100) NOT NULL UNIQUE,      -- Correo electrónico (debe ser único)
    contraseña VARCHAR(255) NOT NULL          -- Contraseña (encriptada si es posible)
);
