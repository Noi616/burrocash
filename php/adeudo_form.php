<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Adeudo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
        }
        .form-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-actions .save-btn {
            background-color: #28a745;
            color: white;
        }
        .form-actions .cancel-btn {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registrar Adeudo</h2>
        <form action="reg-adeudo.php" method="post">
            <div class="form-group">
                <label for="acreedor">Acreedor:</label>
                <input type="text" id="acreedor" name="acreedor" placeholder="Ingrese el acreedor" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese una descripción" required>
            </div>
            <div class="form-group">
                <label for="monto">Monto ($):</label>
                <input type="number" id="monto" name="monto" value="0" placeholder="Ingrese el monto" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria" required>
                    <option value="" disabled selected>--</option>
                    <option value="Personal">Personal</option>
                    <option value="Hogar">Hogar</option>
                    <option value="Vehicular">Vehicular</option>
                    <option value="Educación">Educación</option>
                    <option value="Salud">Salud</option>
                </select>
            </div>            
            
            <div class="form-actions">
                <button type="submit" class="save-btn">Guardar</button>
                <button type="reset" class="cancel-btn">Cancelar</button>
            </div>
        </form>
    </div>
</body>
</html>
