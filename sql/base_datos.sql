CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY, -- ID único para cada usuario
    nombre VARCHAR(50) NOT NULL,               -- Nombre del usuario
    apellido_paterno VARCHAR(50) NOT NULL,    -- Apellido paterno
    apellido_materno VARCHAR(50),             -- Apellido materno (puede ser opcional)
    numero_telefono VARCHAR(15),              -- Número de teléfono
    correo VARCHAR(100) NOT NULL UNIQUE,      -- Correo electrónico (debe ser único)
    contraseña VARCHAR(255) NOT NULL          -- Contraseña (encriptada si es posible)
);

CREATE TABLE registraradeudo (
    id_adeudo INT AUTO_INCREMENT PRIMARY KEY,  -- ID único para cada adeudo
    acreedor VARCHAR(50) NOT NULL,             
    descripcion VARCHAR(100) NOT NULL,
    monto INT,
    fecha DATE,
    categoria VARCHAR(50) NOT NULL,
    estado VARCHAR(50)
);

CREATE TABLE registrarsubadeudo (
    id_subadeudo INT AUTO_INCREMENT PRIMARY KEY,  -- ID único para cada subadeudo
    id_adeudo INT,                                -- A que adeudo pertenece
    acreedor VARCHAR(50) NOT NULL,             
    descripcion VARCHAR(100) NOT NULL,
    monto INT,
    fecha DATE, 
    FOREIGN KEY (id_adeudo) REFERENCES registraradeudo(id_adeudo) -- Llave foránea
);

CREATE TABLE ingreso (
    id_ingreso INT AUTO_INCREMENT PRIMARY KEY,
    monto INT,
    descripcion VARCHAR(100) NOT NULL,
    fecha DATE
);

CREATE TABLE tarjeta (
    id_tarjeta INT AUTO_INCREMENT PRIMARY KEY,
    numero INT NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    banco VARCHAR(50) NOT NULL,
    limite INT NOT NULL, 
    nombre_titular VARCHAR(100) NOT NULL
);

CREATE TABLE presupuestos (
    id_presupuesto INT AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(100) NOT NULL, 
    descripcion VARCHAR(100), 
    monto INT, 
    fecha_inicio DATE NOT NULL, 
    fecha_fin DATE NOT NULL, 
    categoria_id INT, 
    FOREIGN KEY (categoria_id) REFERENCES categorias(id_categoria)
);

CREATE TABLE inversiones (
    id_inversion INT AUTO_INCREMENT PRIMARY KEY, 
    monto INT NOT NULL, 
    tipo VARCHAR(100) NOT NULL, 
    plazo INT NOT NULL, 
    rendimiento DECIMAL(5, 2) NOT NULL, 
    fecha_inicio DATE NOT NULL, 
    fecha_fin DATE
);

CREATE TABLE fondos (
    id_fondo INT AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(100) NOT NULL, 
    descripcion VARCHAR(100) NOT NULL, 
    monto_actual DECIMAL(10, 2) NOT NULL, 
    categoria_id INT, 
    FOREIGN KEY (categoria_id) REFERENCES categorias(id_categoria)
);

CREATE TABLE deudas (
    id_deuda INT AUTO_INCREMENT PRIMARY KEY,
    acreedor VARCHAR(100) NOT NULL,
    descripcion VARCHAR(100),  -- Falta la coma
    monto_total DECIMAL(10, 2) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_vencimiento DATE NOT NULL,
    tasa_interes DECIMAL(5, 2)  -- en porcentaje
);

CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(100) NOT NULL
);

CREATE TABLE transacciones (
    id_transaccion INT AUTO_INCREMENT PRIMARY KEY,
    monto INT NOT NULL,
    fecha DATE NOT NULL,
    tipo VARCHAR(50) NOT NULL,  -- ingreso o egreso
    descripcion VARCHAR(100) NOT NULL,
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id_categoria)
);

CREATE TABLE notificaciones (
    id_notificacion INT AUTO_INCREMENT PRIMARY KEY,
    mensaje VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    tipo VARCHAR(50),  -- tipo de notificación, por ejemplo, alerta, recordatorio
    estado VARCHAR(50)  -- estado de la notificación, por ejemplo, leída, no leída
);

CREATE TABLE reportes (
    id_reporte INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    fecha_creacion DATE NOT NULL,
    fecha_actualizacion DATE
);
