<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    // Redirigir al login si no hay sesión activa
    header("Location: login.html");
    exit;
}

// Configurar la conexión a la base de datos
$servername = "localhost"; // Cambiar si es necesario
$username = "root";        // Usuario de la base de datos
$password = "";            // Contraseña de la base de datos
$dbname = "burrocash"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>



<?php
$current_page = basename($_SERVER['PHP_SELF']); // Obtiene el nombre del archivo actual
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!--Css propio-->
    <link rel="stylesheet" href="./estilos/prueba3.css">

  

    <script>
// Detectar el tipo de tarjeta
function detectCardType() {
    const cardNumberInput = document.getElementById('numero').value;
    const cardTypeSelect = document.getElementById('tipo');

    if (cardNumberInput.startsWith('4')) {
        cardTypeSelect.value = 'Visa'; // Las tarjetas que empiezan con "4" son Visa
    } else if (cardNumberInput.startsWith('5')) {
        cardTypeSelect.value = 'Mastercard'; // Las tarjetas que empiezan con "5" son Mastercard
    } else {
        cardTypeSelect.value = ''; // Vaciar el campo si no coincide
    }
}

// Enviar el formulario para registrar una tarjeta
function submitForm(event) {
    event.preventDefault();

    const form = document.getElementById('formularioTarjeta');
    const formData = new FormData(form);

    fetch('./php/tarjetas_api.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert(data.message); // Mostrar mensaje de éxito
                location.reload(); // Recargar la tabla
            } else {
                alert("Error: " + data.message); // Mostrar mensaje de error
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al procesar tu solicitud.');
        });
}

// Editar una tarjeta
function editCard(event) {
    const idTarjeta = event.target.getAttribute('data-id');

    // Obtener los datos de la tarjeta desde el servidor
    fetch(`./php/tarjetas_api.php?id_tarjeta=${idTarjeta}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data) {
                // Prellenar el modal con los datos de la tarjeta
                document.getElementById('edit-id_tarjeta').value = data.id_tarjeta;
                document.getElementById('edit-numero').value = data.numero;
                document.getElementById('edit-tipo').value = data.tipo;
                document.getElementById('edit-banco').value = data.banco;
                document.getElementById('edit-limite').value = data.limite;
                document.getElementById('edit-nombre_titular').value = data.nombre_titular;
                $('#editCardModal').modal('show'); // Mostrar el modal
            } else {
                alert('No se pudo obtener la información de la tarjeta.');
            }
        })
        .catch(error => console.error('Error:', error));
}

// Guardar los cambios al editar una tarjeta
function saveEditForm(event) {
    event.preventDefault();

    const form = document.getElementById('editCardForm');
    const formData = new FormData(form);
    const jsonData = {};

    formData.forEach((value, key) => {
        jsonData[key] = value;
    });

    fetch('./php/tarjetas_api.php', {
        method: 'PUT', // Método PUT para editar
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(jsonData),
    })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message); // Mostrar mensaje de éxito
                location.reload(); // Recargar la tabla
            } else {
                alert(data.error); // Mostrar mensaje de error
            }
        })
        .catch(error => console.error('Error:', error));
}

// Asignar eventos a los botones dinámicos
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', editCard); // Abrir modal de edición
    });

    const editForm = document.getElementById('editCardForm');
    if (editForm) {
        editForm.addEventListener('submit', saveEditForm); // Guardar cambios
    }

    const registerForm = document.getElementById('formularioTarjeta');
    if (registerForm) {
        registerForm.addEventListener('submit', submitForm); // Registrar tarjeta
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const bancos = [
        "Banco Nacional",
        "Banco Azteca",
        "BBVA",
        "Banamex",
        "Santander",
        "HSBC",
        "Scotiabank",
        "Inbursa",
        "Banorte"
    ];

    const bancoSelect = document.getElementById('banco');
    bancos.forEach(banco => {
        const option = document.createElement('option');
        option.value = banco;
        option.textContent = banco;
        bancoSelect.appendChild(option);
    });

    const editBancoSelect = document.getElementById('edit-banco');
    bancos.forEach(banco => {
        const option = document.createElement('option');
        option.value = banco;
        option.textContent = banco;
        editBancoSelect.appendChild(option);
    });
});




</script>


</head>

<body id="page-top">


  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Burrocash</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Dashboard -->
        <li class="nav-item <?php echo $current_page == 'inicio.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="inicio.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Inicio</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Shortcuts -->
        <li class="nav-item <?php echo $current_page == 'perfil.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="perfil.php">
                <i class="fas fa-user"></i>
                <span>Mi Perfil</span>
            </a>
        </li>
        <!-- Tarjetas -->
        <!-- Sección activa: Tarjetas -->
        <!-- Tarjetas -->
        <li class="nav-item <?php echo $current_page == 'tarjetas.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="tarjetas.php">
                <i class="fas fa-credit-card"></i>
                <span>Tarjetas</span>
            </a>
        </li>


        <li class="nav-item <?php echo $current_page == 'configuracion.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="settings.html">
                <i class="fas fa-cog"></i>
                <span>Configuración</span>
            </a>
        </li>
        <li class="nav-item <?php echo $current_page == 'notificaciones.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="notifications.html">
                <i class="fas fa-bell"></i>
                <span>Notificaciones</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- New Sections -->
        <li class="nav-item <?php echo $current_page == 'adeudos.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="adeudos.html">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Adeudos</span>
            </a>
        </li>
        <li class="nav-item <?php echo $current_page == 'deudas.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="deudas.html">
                <i class="fas fa-hand-holding-usd"></i>
                <span>Deudas</span>
            </a>
        </li>
        <li class="nav-item <?php echo $current_page == 'inversiones.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="inversiones.html">
                <i class="fas fa-chart-line"></i>
                <span>Inversiones</span>
            </a>
        </li>
        
            <!-- Ingresos -->
            <li class="nav-item <?php echo $current_page == 'ingresos.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="ingresos.html">
                <i class="fas fa-wallet"></i>
                <span>Ingresos</span>
            </a>
        </li>

        <!-- Presupuestos -->
        <li class="nav-item <?php echo $current_page == 'presupuestos.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="presupuestos.html">
                <i class="fas fa-file-invoice"></i>
                <span>Presupuestos</span>
            </a>
        </li>



        

    </ul>

    <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                

                  
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Búsqueda"
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Notificaciones -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Notificaciones</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <span class="font-weight-bold">Nueva notificación</span>
                    </div>
                </a>
            </div>
        </li>

        <!-- Mensajes -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger badge-counter">7</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">Mensajes</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                        <span class="text-truncate">¡Hola! Necesito ayuda...</span>
                    </div>
                </a>
            </div>
        </li>

        <!-- Información de usuario -->

<li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php echo htmlspecialchars($_SESSION['nombre']); ?>
                </span>

                <img src="php/<?php echo htmlspecialchars($_SESSION['foto_perfil']); ?>" alt="Foto de perfil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">

        </a>
            <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Perfil
        </a>
        <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Configuración
        </a>
        <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Registro de Actividad
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Cerrar Sesión
        </a>
    </div>
</li>

    </ul>

</nav>
<!-- End of Topbar -->


                <!-- Begin Page Content -->
                <div class="container-fluid">
    <!-- Encabezado -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-green-900">Gestión de Tarjetas</h1>
    <!-- Botón para abrir el modal -->
    <button class="btn" id="addCardButton" data-toggle="modal" data-target="#registerCardModal" style="background-color: #2D5C47; color: white;">
    <i class="fas fa-plus-circle"></i> Registrar Nueva Tarjeta
</button>
</div>


<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="cardTable" width="100%" cellspacing="0">
            <thead style="background-color: #2D5C47; color: white;">
                <tr>
                    <th>Tipo de Tarjeta</th>
                    <th>Número</th>
                    <th>Banco Emisor</th>
                    <th>Límite de Crédito</th>
                    <th>Titular de Tarjeta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
<?php
$query = "SELECT id_tarjeta, numero, tipo, banco, limite, nombre_titular FROM tarjeta";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    // Generar filas dinámicas
    while ($row = $result->fetch_assoc()) {
        $logoPath = ($row['tipo'] === 'Visa') 
        ? 'https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png' 
        : 'https://upload.wikimedia.org/wikipedia/commons/b/b7/MasterCard_Logo.svg';
        echo "<tr>";
        echo "<td class='text-center'><img src='$logoPath' alt='{$row['tipo']}' style='width: 40px;'></td>";
        echo "<td>**** **** **** " . substr($row['numero'], -4) . "</td>";
        echo "<td>" . htmlspecialchars($row['banco']) . "</td>";
        echo "<td>$" . number_format($row['limite'], 2) . "</td>";
        echo "<td>" . htmlspecialchars($row['nombre_titular']) . "</td>";
        echo "<td class='text-center'>
                    <button class='btn btn-warning btn-sm edit-btn' data-id='{$row['id_tarjeta']}'><i class='fas fa-edit'></i> Editar</button>
                    <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id_tarjeta']}'><i class='fas fa-trash'></i> Eliminar</button>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No hay tarjetas registradas.</td></tr>";
}
?>
</tbody>


        </table>
    </div>
</div>

<!-- Modal para editartarjetas -->
<div class="modal fade" id="editCardModal" tabindex="-1" role="dialog" aria-labelledby="editCardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCardModalLabel">Editar Tarjeta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCardForm">
                    <!-- ID oculto para identificar la tarjeta -->
                    <input type="hidden" id="edit-id_tarjeta" name="id_tarjeta">

                    <div class="form-group">
                        <label for="edit-numero">Número</label>
                        <input type="text" class="form-control" id="edit-numero" name="numero" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-tipo">Tipo</label>
                        <select class="form-control" id="edit-tipo" name="tipo" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Visa">Visa</option>
                            <option value="Mastercard">Mastercard</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="edit-banco">Banco Emisor</label>
                    <select class="form-control" id="edit-banco" name="banco" required>
                        <option value="">Seleccione un banco</option>
                        <!-- Opciones dinámicas -->
                    </select>
                </div>

                    <div class="form-group">
                        <label for="edit-limite">Límite</label>
                        <input type="number" class="form-control" id="edit-limite" name="limite" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-nombre_titular">Titular</label>
                        <input type="text" class="form-control" id="edit-nombre_titular" name="nombre_titular" required>
                    </div>

                    <!-- Botones de acción -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- Modal para registrar tarjetas -->

<div class="modal fade" id="registerCardModal" tabindex="-1" role="dialog" aria-labelledby="registerCardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green-800 text-white">
                <h5 class="modal-title" id="registerCardModalLabel">
                    <i class="fas fa-credit-card"></i> Registrar Nueva Tarjeta
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="./php/tarjetas_api.php">
                    <div class="form-group">
                        <label for="numero">Número de Tarjeta</label>
                        <input type="text" class="form-control" id="numero" name="numero" required oninput="detectCardType()">
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Tarjeta</label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="Visa">Visa</option>
                            <option value="Mastercard">Mastercard</option>
                        </select>
                    </div>
                                <div class="form-group">
                <label for="banco">Banco Emisor</label>
                <select class="form-control" id="banco" name="banco" required>
                    <option value="">Seleccione un banco</option>
                    <!-- Opciones dinámicas -->
                </select>
            </div>

                            <div class="form-group">
                    <label for="limite">Límite de Crédito</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control" id="limite" name="limite" required>
                    </div>
                </div>

                    <div class="form-group">
                        <label for="nombre_titular">Nombre del Titular</label>
                        <input type="text" class="form-control" id="nombre_titular" name="nombre_titular" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <!-- Botón para cancelar -->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <!-- Botón para guardar -->
                        <button type="submit" class="btn btn-success">Guardar Tarjeta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



        </div>
    </div>
</div>

  </div>



                    




                    
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
         </div>
         <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
         <div class="modal-footer">
             <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
             <a class="btn btn-primary" href="./php/logout.php">Logout</a>
         </div>
     </div>
 </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<script>
$(document).ready(function() {
    // Al hacer clic en un botón de edición
    $('.edit-btn').on('click', function() {
        // Recuperar el ID de la tarjeta del atributo data-id
        const idTarjeta = $(this).data('id');

        // Realizar una solicitud AJAX para obtener los datos de la tarjeta
        $.ajax({
            url: './php/tarjetas_api.php', // Ruta del API
            method: 'GET',
            data: { id_tarjeta: idTarjeta }, // Enviar el ID como parámetro
            success: function(response) {
                // Verificar si se recibieron datos correctamente
                if (response && response.length > 0) {
                    const tarjeta = response[0]; // Primer objeto en el array de resultados
                    // Rellenar los campos del modal con los datos de la tarjeta
                    $('#edit-id_tarjeta').val(tarjeta.id_tarjeta);
                    $('#edit-numero').val(tarjeta.numero);
                    $('#edit-tipo').val(tarjeta.tipo);
                    $('#edit-banco').val(tarjeta.banco);
                    $('#edit-limite').val(tarjeta.limite);
                    $('#edit-nombre_titular').val(tarjeta.nombre_titular);
                } else {
                    alert('No se pudieron cargar los datos de la tarjeta.');
                }
            },
            error: function() {
                alert('Hubo un error al obtener los datos de la tarjeta.');
            }
        });
    });
});
</script>



</body>

</html>