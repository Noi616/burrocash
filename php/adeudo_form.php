<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Adeudos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .form-container, .form-container-subadeudo {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: none;
        }
        .form-container h2, .form-container-subadeudo h2 {
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
        .form-group input, .form-group select {
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
        .debt-list {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .debt-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .debt-list th, .debt-list td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .debt-list th {
            background-color: #f4f4f4;
        }
        .actions-btn {
            display: flex;
            justify-content: space-between;
        }
        .actions-btn button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .actions-btn .filter-btn {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Gestión de Adeudos</h1>
            <div class="actions-btn">
                <button onclick="mostrarFormulario('.form-container')">Registrar Nuevo Adeudo</button>
            </div>
        </div>

        <!-- Formulario de registrar adeudo -->
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
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" required>
                        <option value="" disabled selected>--</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Pagado">Pagado</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="save-btn">Guardar</button>
                    <button type="reset" class="cancel-btn">Cancelar</button>
                </div>
            </form>
        </div>

        <!-- Formulario de registrar subadeudo -->
        <div class="form-container-subadeudo">
            <h2>Registrar Subadeudo</h2>
            <form method="POST" action="reg-subadeudo.php">
                <input type="hidden" name="id_adeudo" id="id_adeudo">
                <div class="form-group">
                    <label for="id_categoria">Categoría de origen:</label>
                    <select id="id_categoria" name="id_categoria" required>
                        <option value="" disabled selected>Seleccione la categoría de origen</option>
                        <option value="Personal">Personal</option>
                        <option value="Hogar">Hogar</option>
                        <option value="Vehicular">Vehicular</option>
                        <option value="Educacion">Educación</option>
                        <option value="Salud">Salud</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="acreedor">Acreedor:</label>
                    <input type="text" name="acreedor" id="acreedor" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="descripcion" id="descripcion" required>
                </div>
                <div class="form-group">
                    <label for="monto">Monto:</label>
                    <input type="number" name="monto" id="monto" required>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" required>
                </div>
                <button type="submit" class="save-btn">Guardar</button>
                <button type="reset" class="cancel-btn">Cancelar</button>
            </form>
        </div>

        <!-- Lista de adeudos existente -->
        <div class="debt-list">
            <h2>Lista de Adeudos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Acreedor</th>
                        <th>Monto ($)</th>
                        <th>Fecha</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se insertarán los adeudos registrados -->
                    <?php
                        // Conectar a la base de datos y obtener los registros
                        $conexion = mysqli_connect('localhost', 'root', '', 'burrocash');
                        if (!$conexion) {
                            die("Conexión fallida: " . mysqli_connect_error());
                        }
                        $result = $conexion->query("SELECT * FROM registraradeudo");
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($row['acreedor'] ?? '') . "</td>
                                        <td>" . htmlspecialchars($row['monto'] ?? '') . "</td>
                                        <td>" . htmlspecialchars($row['fecha'] ?? '') . "</td>
                                        <td>" . htmlspecialchars($row['categoria'] ?? '') . "</td>
                                        <td>" . htmlspecialchars($row['estado'] ?? '') . "</td>
                                        <td>
                                            <button onclick=\"registrarSubadeudo(" . $row['id_adeudo'] . ")\">Registrar Subadeudo</button>
                                            <button onclick=\"verSubadeudos(" . $row['id_adeudo'] . ")\">Ver Subadeudos</button>
                                        </td>
                                        <td>
                                            <button class='btn btn-success btn-sm edit-btn' data-id='{$row['id_adeudo']}'><i class='fas fa-edit'></i> Editar</button>
                                            <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id_adeudo']}'><i class='fas fa-trash'></i> Eliminar</button>
                                        </td>
                                    </tr>
                                    <tr id=\"subadeudos-" . $row['id_adeudo'] . "\" style=\"display:none;\">
                                        <td colspan='7'>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Descripción</th>
                                                        <th>Monto</th>
                                                        <th>Fecha</th>
                                                    </tr>
                                                </thead>
                                                <tbody id=\"subadeudos-body-" . $row['id_adeudo'] . "\">
                                                    <!-- Los subadeudos se insertarán aquí -->
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No hay adeudos registrados.</td></tr>";
                        }
                        $conexion->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function mostrarFormulario(selector) {
            document.querySelectorAll('.form-container, .form-container-subadeudo').forEach(form => form.style.display = 'none');
            document.querySelector(selector).style.display = 'block';
        }

        function registrarSubadeudo(idAdeudo) {
            document.getElementById('id_adeudo').value = idAdeudo;
            mostrarFormulario('.form-container-subadeudo');
        }

        function verSubadeudos(idAdeudo) {
            const subadeudoRow = document.getElementById('subadeudos-' + idAdeudo);
            if (subadeudoRow.style.display === 'none') {
                fetch('ver_subadeudos.php?id_adeudo=' + idAdeudo)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('subadeudos-body-' + idAdeudo).innerHTML = data;
                        subadeudoRow.style.display = 'table-row';
                    })
                    .catch(error => {
                        alert('Error al cargar los subadeudos.');
                        console.error('Error:', error);
                    });
            } else {
                subadeudoRow.style.display = 'none';
            }
        }
    </script>

        <!-- Filtrar adeudos -->
<div class="filter-container">
    <h2>Filtrar Adeudos</h2>
    <label for="filtro-categoria">Categoría:</label>
    <select id="filtro-categoria">
        <option value="">Todas</option>
        <option value="Personal">Personal</option>
        <option value="Hogar">Hogar</option>
        <option value="Vehicular">Vehicular</option>
        <option value="Educación">Educación</option>
        <option value="Salud">Salud</option>
    </select>
    
    <label for="filtro-estado">Estado:</label>
    <select id="filtro-estado">
        <option value="">Todos</option>
        <option value="Pendiente">Pendiente</option>
        <option value="Pagado">Pagado</option>
    </select>
    
    <button class="filter-btn" onclick="filtrarAdeudos()">Filtrar</button>
</div>


<script>
    function filtrarAdeudos() {
        const categoria = document.getElementById('filtro-categoria').value;
        const estado = document.getElementById('filtro-estado').value;

        fetch(`filtrar_adeudos.php?categoria=${categoria}&estado=${estado}`)
            .then(response => response.text())
            .then(data => {
                document.querySelector('tbody').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

<!-- Modal content --> 
<div class="modal-content"> 
    <span class="close">&times;</span> 
    <form id="editForm"> 
        <!-- Campos del formulario de edición --> 
        <input type="hidden" id="editIdAdeudo" name="id_adeudo"> 
        <label for="editAcreedor">Acreedor:</label> 
        <input type="text" id="editAcreedor" name="acreedor"> 
        <label for="editMonto">Monto:</label> 
        <input type="number" id="editMonto" name="monto"> 
        <label for="editFecha">Fecha:</label> 
        <input type="date" id="editFecha" name="fecha"> 
        <label for="editCategoria">Categoría:</label> 
        <input type="text" id="editCategoria" name="categoria"> 
        <label for="editEstado">Estado:</label> 
        <input type="text" id="editEstado" name="estado"> 
        <button type="submit">Guardar Cambios</button> 
        </form> 
        </div> 
        </div> 
        
        <!-- JavaScript para manejar los eventos de clic y el modal --> 
         <script> 
         document.addEventListener('DOMContentLoaded', function() { 
            const editBtns = document.querySelectorAll('.edit-btn'); 
            const editModal = document.getElementById('editModal'); 
            const editForm = document.getElementById('editForm'); 
            const closeModal = document.getElementsByClassName('close')[0]; 
        
            editBtns.forEach(
                btn => { btn.addEventListener('click', function() { 
                    const id = this.getAttribute('data-id'); 
                    // Hacer una solicitud para obtener los detalles del adeudo 
                    fetch(`get_adeudo.php?id_adeudo=${id}`) 
                    .then(response => response.json()) 
                    .then(data => { 
                    // Rellenar el formulario con los datos del adeudo 
                    document.getElementById('editIdAdeudo').value = data.id_adeudo; 
                    document.getElementById('editAcreedor').value = data.acreedor; 
                    document.getElementById('editMonto').value = data.monto; document.getElementById('editFecha').value = data.fecha; document.getElementById('editCategoria').value = data.categoria; document.getElementById('editEstado').value = data.estado; 
                    // Mostrar el modal 
                    editModal.style.display = 'block'; }); }); }); 
                    // // Manejar el cierre del modal 
                    closeModal.addEventListener('click', function() { editModal.style.display = 'none'; }); 
                    // Manejar el envío del formulario de edición 
                    editForm.addEventListener('submit', function(e) { e.preventDefault(); const formData = new FormData(editForm); 
     
                    //Hacer una solicitud para actualizar el adeudo 
                    fetch('editar_adeudo.php', { method: 'POST', body: formData }) 
                    .then(response => response.json()) 
                    .then(data => { if (data.success) { alert('Adeudo actualizado correctamente'); 
                    location.reload(); } else { alert('Error al actualizar el adeudo'); } }); }); }); 
                </script>
</body>
</html>