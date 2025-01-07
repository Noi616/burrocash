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


        <li class="nav-item <?php echo $current_page == 'notificaciones.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="notifications.html">
                <i class="fas fa-bell"></i>
                <span>Notificaciones</span>
            </a>
        </li>

            <!-- Reportes -->
        <li class="nav-item <?php echo $current_page == 'reportes.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="reportes.php">
                <i class="fas fa-file-alt"></i>
                <span>Reportes</span>
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

                <div class="container mt-5">
        <h1 class="text-center mb-4">Reportes</h1>

                    <?php
            if (isset($_SESSION['mensaje'])) {
                $tipo = $_SESSION['tipo_mensaje']; // 'exito' o 'error'
                $mensaje = $_SESSION['mensaje'];

                // Mostrar mensaje con estilo
                echo "
                <div id='mensaje-flash' class='alert alert-" . ($tipo === 'exito' ? 'success' : 'danger') . " alert-dismissible fade show' role='alert'>
                    $mensaje
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";

                // Limpiar el mensaje después de mostrarlo
                unset($_SESSION['mensaje']);
                unset($_SESSION['tipo_mensaje']);
            }
            ?>


        
        
        <!-- Navegación por pestañas -->
        <ul class="nav nav-tabs" id="reportTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="adeudos-tab" data-bs-toggle="tab" data-bs-target="#adeudos" type="button" role="tab">Adeudos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="deudas-tab" data-bs-toggle="tab" data-bs-target="#deudas" type="button" role="tab">Deudas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="presupuestos-tab" data-bs-toggle="tab" data-bs-target="#presupuestos" type="button" role="tab">Presupuestos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ingresos-tab" data-bs-toggle="tab" data-bs-target="#ingresos" type="button" role="tab">Ingresos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="inversiones-tab" data-bs-toggle="tab" data-bs-target="#inversiones" type="button" role="tab">Inversiones</button>
            </li>
        </ul>

        <!-- Contenido de las pestañas -->
        <div class="tab-content" id="reportTabsContent">
            <div class="tab-pane fade show active" id="adeudos" role="tabpanel" aria-labelledby="adeudos-tab">
                <div class="mt-4">
                    <h3>Adeudos</h3>
                    <button class="btn btn-outline-primary mb-3">Exportar a CSV</button>
                    <button class="btn btn-outline-danger mb-3">Exportar a PDF</button>
                    <table class="table table-striped" id="adeudos-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descripción</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos dinámicos -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show active" id="deudas" role="tabpanel" aria-labelledby="deudas-tab">
                <div class="mt-4">
                    <h3>Deudas</h3>

                    <button onclick="window.location.href='php/reporte_deuda.php'" class="btn btn-outline-primary">Exportar todas a CSV</button>


                    <button onclick="window.location.href='php/exportar_deudas_pdf.php'" class="btn btn-outline-danger">Exportar a PDF</button>

                    <table class="table table-bordered table-striped">
                        <thead style="background-color: #2D5C47; color: white;">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Entidad Acreedora</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Fecha de Vencimiento</th>
                                <th scope="col">Tasa de Interés</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT id_deuda, acreedor, monto_total, fecha_vencimiento, tasa_interes, descripcion, estado FROM deudas WHERE id_usuario = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('i', $_SESSION['id_usuario']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<th scope='row'>{$row['id_deuda']}</th>";
                                    echo "<td>" . htmlspecialchars($row['acreedor']) . "</td>";
                                    echo "<td>$" . number_format($row['monto_total'], 2) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['fecha_vencimiento']) . "</td>";
                                    echo "<td>" . number_format($row['tasa_interes'], 2) . "%</td>";
                                    echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
                                    if ($row['estado'] === 'Pagado') {
                                        echo "<td><button class='btn btn-success btn-sm' disabled>Pagado</button></td>";
                                    } else {
                                        echo "<td><button class='btn btn-primary btn-sm pay-btn' data-id='{$row['id_deuda']}'>Pagar</button></td>";
                                    }
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No hay deudas registradas.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show active" id="presupuestos" role="tabpanel" aria-labelledby="presupuestos-tab">
                <div class="mt-4">
                    <h3>Presupuestos</h3>
                    <button onclick="window.location.href='php/reporte_presupuestos.php'" class="btn btn-outline-primary">Exportar todas a CSV</button>
                    <button onclick="window.location.href='php/exportar_presupuestos_pdf.php'" class="btn btn-outline-danger">Exportar a PDF</button>
                    <table class="table table-bordered table-striped">
                        <thead style="background-color: #264d3e; color: white;">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Ingresos</th>
                                <th scope="col">Gastos</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Fecha Fin</th>
                                <th scope="col">Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT id_presupuesto, nombre, ingresos, gastos, (ingresos - gastos) AS balance, fecha_inicio, fecha_fin, descripcion FROM presupuestos WHERE id_usuario = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('i', $_SESSION['id_usuario']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<th scope='row'>{$row['id_presupuesto']}</th>";
                                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                                    echo "<td>$" . number_format($row['ingresos'], 2) . "</td>";
                                    echo "<td>$" . number_format($row['gastos'], 2) . "</td>";
                                    echo "<td>$" . number_format($row['balance'], 2) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['fecha_inicio']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['fecha_fin']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9' class='text-center'>No hay presupuestos registrados.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show active" id="ingresos" role="tabpanel" aria-labelledby="ingresos-tab">
                <div class="mt-4">
                    <h3>Ingresos</h3>
                    <button onclick="window.location.href='php/reporte_ingresos.php'" class="btn btn-outline-primary">Exportar todas a CSV</button>
                    <button onclick="window.location.href='php/exportar_ingresos_pdf.php'" class="btn btn-outline-danger">Exportar a PDF</button>
                    <table class="table table-bordered table-striped">
                        <thead style="background-color: #264d3e; color: white;">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT id_ingreso, monto, fecha, categoria, descripcion FROM ingreso WHERE id_usuario = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('i', $_SESSION['id_usuario']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<th scope='row'>{$row['id_ingreso']}</th>";
                                    echo "<td>$" . number_format($row['monto'], 2) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No hay ingresos registrados.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show active" id="inversiones" role="tabpanel" aria-labelledby="inversiones-tab">
                <div class="mt-4">
                    <h3>Inversiones</h3>
                    <button onclick="window.location.href='php/reporte_inversiones.php'" class="btn btn-outline-primary">Exportar todas a CSV</button>
                    <button onclick="window.location.href='php/exportar_inversiones_pdf.php'" class="btn btn-outline-danger">Exportar a PDF</button>
                    <table class="table table-bordered table-striped">
                        <thead style="background-color: #264d3e; color: white;">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Estado</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT id_inversion, descripcion, monto, tipo, estado FROM inversiones WHERE id_usuario = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('i', $_SESSION['id_usuario']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<th scope='row'>{$row['id_inversion']}</th>";
                                    echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
                                    echo "<td>$" . number_format($row['monto'], 2) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['estado']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No hay inversiones registradas.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: center; align-items: center; height: 20vh;">
    <form action="./php/compartir_archivo.php" method="post" enctype="multipart/form-data" style="background-color: #f8f9fa; padding: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 400px;">
        <h3 style="text-align: center; margin-bottom: 20px; color: #264d3e;">Compartir Archivo</h3>
        
        <div style="margin-bottom: 15px;">
            <label for="destinatario" style="display: block; margin-bottom: 5px; font-weight: bold;">Correo del destinatario:</label>
            <input type="email" name="destinatario" id="destinatario" required style="padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 5px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="archivo" style="display: block; margin-bottom: 5px; font-weight: bold;">Selecciona el archivo:</label>
            <input type="file" name="archivo" id="archivo" required style="padding: 5px; width: 100%; border: 1px solid #ccc; border-radius: 5px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);">
        </div>

        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; font-size: 16px;">Compartir Archivo</button>
        </div>
    </form>
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


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
    // Hacer que el mensaje desaparezca después de 5 segundos
    setTimeout(() => {
        const mensajeFlash = document.getElementById('mensaje-flash');
        if (mensajeFlash) {
            mensajeFlash.style.transition = 'opacity 0.5s ease';
            mensajeFlash.style.opacity = '0';
            setTimeout(() => mensajeFlash.remove(), 500); // Remover del DOM
        }
    }, 5000);
</script>




</body>

</html>