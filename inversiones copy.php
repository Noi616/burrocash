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
            <a class="nav-link" href="adeudos.php">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Adeudos</span>
            </a>
        </li>
        <li class="nav-item <?php echo $current_page == 'deudas.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="deudas.php">
                <i class="fas fa-hand-holding-usd"></i>
                <span>Deudas</span>
            </a>
        </li>
        <li class="nav-item <?php echo $current_page == 'inversiones.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="inversiones.php">
                <i class="fas fa-chart-line"></i>
                <span>Inversiones</span>
            </a>
        </li>
        
            <!-- Ingresos -->
            <li class="nav-item <?php echo $current_page == 'ingresos.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="ingresos.php">
                <i class="fas fa-wallet"></i>
                <span>Ingresos</span>
            </a>
        </li>

        <!-- Presupuestos -->
        <li class="nav-item <?php echo $current_page == 'presupuestos.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="presupuestos.php">
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

                <div class="container mt-5">
    <div class="container mt-5 p-4 border rounded">
        <h1 class="text-center mb-4">
            Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>, al apartado de Inversiones
        </h1>

        <!-- Mensajes de éxito o error -->
        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_GET['mensaje']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <div class="mb-3 text-right">
            <button class="btn" id="addInvestmentButton" data-bs-toggle="modal" data-bs-target="#registerInvestmentModal" style="background-color: #264d3e; color: white;">
                <i class="fas fa-plus-circle"></i> Registrar Nueva Inversión
            </button>
        </div>

        <table class="table table-bordered">
            <thead style="background-color: #264d3e; color: white;">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta para obtener las inversiones del usuario actual
                $query = "SELECT id_inversion, descripcion, monto, tipo, estado FROM inversiones WHERE id_usuario = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $_SESSION['id_usuario']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    // Generar filas dinámicas
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>{$row['id_inversion']}</th>";
                        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
                        echo "<td>$" . number_format($row['monto'], 2) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['estado']) . "</td>";

                        // Botones de acciones (Ver Detalles y Eliminar)
                        echo "<td class='text-center'>
                        <button class='btn btn-primary btn-sm details-btn' onclick=\"window.location.href='/burrocash/detalle_inversion.php?id={$row['id_inversion']}'\"><i class='fas fa-eye'></i> Ver Detalles</button>
                        <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id_inversion']}'><i class='fas fa-trash'></i> Eliminar</button>
                      </td>";
                echo "</tr>";
                    }
                } else {
                    // Mensaje si no hay inversiones
                    echo "<tr><td colspan='6' class='text-center'>No hay inversiones registradas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>



<!-- Modal para registrar nueva inversión -->
<div class="modal fade" id="registerInvestmentModal" tabindex="-1" aria-labelledby="registerInvestmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerInvestmentModalLabel">Registrar Nueva Inversión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="./php/registrar_inversion.php">
                    <!-- Descripción -->
                    <div class="mb-3">
                        <label for="investmentDescription" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="investmentDescription" name="descripcion" placeholder="Ingresa una descripción breve" required>
                    </div>
                    <!-- Monto -->
                    <div class="mb-3">
                        <label for="investmentAmount" class="form-label">Monto</label>
                        <input type="number" class="form-control" id="investmentAmount" name="monto" placeholder="Ingresa el monto de la inversión" required>
                    </div>
    <!-- Tipo -->
    <div class="mb-3">
        <label for="investmentType" class="form-label" required>Tipo</label>
        <select class="form-select" id="investmentType" name="tipo" required>
            <option value="">Selecciona el tipo de inversión</option>
            <option value="Acciones">Acciones</option>
            <option value="Bienes Raíces">Bienes Raíces</option>
            <option value="Fondos Mutuos">Fondos Mutuos</option>
            <option value="Criptomonedas">Criptomonedas</option>
            <option value="Otros">Otros</option>
        </select>
    </div>

                    <!-- Plazo -->
                    <div class="mb-3">
                        <label for="investmentPlazo" class="form-label">Plazo (años)</label>
                        <input type="number" class="form-control" id="investmentPlazo" name="plazo" placeholder="Ingresa el plazo en años" required>
                    </div>
                    <!-- Rendimiento -->
                    <div class="mb-3">
                        <label for="investmentRendimiento" class="form-label">Rendimiento (%)</label>
                        <input type="number" step="0.01" class="form-control" id="investmentRendimiento" name="rendimiento" placeholder="Ingresa el rendimiento esperado en porcentaje" required>
                    </div>
     <!-- Fecha de Inicio -->
     <div class="mb-3">
        <label for="investmentStartDate" class="form-label" required>Fecha de Inicio</label>
        <input type="date" class="form-control" id="investmentStartDate" name="fecha_inicio" required>
    </div>
                    <!-- Fecha de fin -->
                    <div class="mb-3">
                        <label for="investmentEndDate" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" id="investmentEndDate" name="fecha_fin">
                    </div>
                    <!-- Estado -->
                    <div class="mb-3">
                        <label for="investmentState" class="form-label">Estado</label>
                        <select class="form-select" id="investmentState" name="estado" required>
                            <option value="">Selecciona el estado</option>
                            <option value="Activa">Activa</option>
                            <option value="Finalizada">Finalizada</option>
                            <option value="En Progreso">En Progreso</option>
                        </select>
                    </div>
                    <!-- Plataforma -->
                    <div class="mb-3">
                        <label for="investmentPlatform" class="form-label">Plataforma</label>
                        <select class="form-select" id="investmentPlatform" name="plataforma" required>
                            <option value="">Selecciona una plataforma</option>
                            <option value="Bolsa Nacional">Bolsa Nacional</option>
                            <option value="NYSE">NYSE</option>
                            <option value="Binance">Binance</option>
                            <option value="eToro">eToro</option>
                            <option value="Otros">Otros</option>
                        </select>
                    </div>
                        <!-- Detalles -->
                        <div class="mb-3">
                            <label for="investmentDetails" class="form-label">Detalles</label>
                            <textarea class="form-control" id="investmentDetails" name="detalles" rows="3" placeholder="Ingresa detalles adicionales sobre la inversión" required></textarea>
                        </div>
                    <!-- Botón para registrar -->
                    <button type="submit" class="btn btn-primary w-100">Registrar Inversión</button>
                </form>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


<script>
    // Seleccionar el mensaje de éxito o error
    const alertBox = document.querySelector('.alert');

    if (alertBox) {
        // Ocultar el mensaje después de 5 segundos
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 5000); // 5000 milisegundos = 5 segundos
    }
</script>

<!-- Eliminar-->

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const deleteButtons = document.querySelectorAll(".delete-btn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", () => {
                const idInversion = button.getAttribute("data-id"); // Cambiar a id_inversion

                if (confirm("¿Estás seguro de que deseas eliminar esta inversión?")) {
fetch("./php/eliminar_inversion.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({ id_inversion: idInversion })
})

                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                location.reload(); // Recargar la página si la eliminación fue exitosa
                            } else {
                                alert(data.message); // Mostrar el mensaje de error
                            }
                        })
                        .catch(error => console.error("Error:", error)); // Mostrar errores en la consola
                }
            });
        });
    });
</script>



</body>

</html>