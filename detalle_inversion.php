<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "burrocash";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID de la inversión desde la URL
if (!isset($_GET['id'])) {
    die("ID de inversión no especificado.");
}

$id_inversion = $_GET['id'];
$id_usuario = $_SESSION['id_usuario'];

// Consulta para obtener los detalles de la inversión
$query = "SELECT * FROM inversiones WHERE id_inversion = ? AND id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_inversion, $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $inversion = $result->fetch_assoc();
} else {
    die("Inversión no encontrada o no tienes permisos para verla.");
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


    <style>
    .chart-area {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

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

                <div class="container my-5">
    <h1 class="text-center text-success mb-4">Detalles de la Inversión</h1>
    <div class="card shadow p-4">
        <h3 class="text-success"><?php echo htmlspecialchars($inversion['descripcion']); ?></h3>
        <hr>
        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>ID:</strong> <?php echo htmlspecialchars($inversion['id_inversion']); ?></p>
                <p><strong>Monto:</strong> $<?php echo number_format($inversion['monto'], 2); ?></p>
                <p><strong>Tipo:</strong> <?php echo htmlspecialchars($inversion['tipo']); ?></p>
                <p><strong>Estado:</strong> <?php echo htmlspecialchars($inversion['estado']); ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Fecha de inicio:</strong> <?php echo htmlspecialchars($inversion['fecha_inicio']); ?></p>
                <p><strong>Rendimiento:</strong> <?php echo htmlspecialchars($inversion['rendimiento']); ?>% anual</p>
                <p><strong>Duración:</strong> <?php echo htmlspecialchars($inversion['plazo']); ?> años</p>
                <p><strong>Plataforma:</strong> <?php echo htmlspecialchars($inversion['plataforma']); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p><strong>Descripción:</strong> <?php echo htmlspecialchars($inversion['detalles']); ?></p>
            </div>
        </div>
    </div>
</div>









<div class="container-fluid">
    <!-- Earnings Overview Card -->
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rendimiento</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="text-center mt-4">
    <a href="inversiones.php" class="btn btn-success">Volver</a>
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



<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>












<script>
    // Función para obtener el valor de un parámetro de la URL
    const obtenerParametroURL = (parametro) => {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(parametro);
    };

    // Obtener el ID de la inversión desde la URL
    const idInversion = obtenerParametroURL('id');

    // Verificar que se haya proporcionado un ID válido
    if (idInversion) {
        // Función para calcular el rendimiento mensual
        const calcularRendimientoMensual = (montoInicial, tasaAnual, fechaInicio, fechaFin) => {
            const tasaMensual = tasaAnual / 12;
            const fechaInicioObj = new Date(fechaInicio);
            const fechaFinObj = new Date(fechaFin);
            const meses = (fechaFinObj.getFullYear() - fechaInicioObj.getFullYear()) * 12 +
                          (fechaFinObj.getMonth() - fechaInicioObj.getMonth());

            const datos = [];
            let monto = montoInicial;
            for (let i = 0; i <= meses; i++) {
                datos.push(monto.toFixed(2)); // Guardar el monto para cada mes
                monto *= 1 + tasaMensual; // Actualizar el monto con el rendimiento mensual
            }
            return datos;
        };

        // Función para cargar datos y generar la gráfica
        const cargarDatosYActualizarGrafica = (idInversion) => {
            fetch(`php/get_inversiones.php?id_inversion=${idInversion}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const inversion = data.inversion;

                        // Extraer datos de la inversión
                        const montoInicial = parseFloat(inversion.monto);
                        const tasaAnual = parseFloat(inversion.rendimiento) / 100; // Convertir porcentaje
                        const fechaInicio = inversion.fecha_inicio;
                        const fechaFin = inversion.fecha_fin;

                        // Calcular datos mensuales
                        const datosRendimiento = calcularRendimientoMensual(montoInicial, tasaAnual, fechaInicio, fechaFin);

                        // Generar etiquetas para cada mes
                        const etiquetas = [];
                        const fechaActual = new Date(fechaInicio);
                        while (fechaActual <= new Date(fechaFin)) {
                            etiquetas.push(fechaActual.toLocaleDateString('en-US', { month: 'short', year: 'numeric' }));
                            fechaActual.setMonth(fechaActual.getMonth() + 1);
                        }

                        // Crear la gráfica
                        const ctx = document.getElementById('myAreaChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: etiquetas,
                                datasets: [{
                                    label: 'Rendimiento Mensual',
                                    data: datosRendimiento,
                                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                                    borderColor: 'rgba(78, 115, 223, 1)',
                                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                                    fill: true,
                                    tension: 0.3
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        grid: { display: false },
                                        ticks: { maxTicksLimit: 12 }
                                    },
                                    y: {
                                        ticks: {
                                            maxTicksLimit: 5,
                                            callback: function(value) {
                                                return '$' + value.toLocaleString();
                                            }
                                        },
                                        grid: {
                                            color: 'rgba(234, 236, 244, 1)',
                                            zeroLineColor: 'rgba(234, 236, 244, 1)',
                                            drawBorder: false,
                                            borderDash: [2],
                                            zeroLineBorderDash: [2]
                                        }
                                    }
                                },
                                plugins: {
                                    legend: { display: false },
                                    tooltip: {
                                        backgroundColor: 'rgb(255,255,255)',
                                        bodyColor: '#858796',
                                        borderColor: '#dddfeb',
                                        borderWidth: 1,
                                        titleColor: '#6e707e',
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return '$' + tooltipItem.raw.toLocaleString();
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    } else {
                        console.error('Error:', data.message);
                    }
                })
                .catch(error => console.error('Error al obtener los datos:', error));
        };

        // Llamar a la función para cargar los datos y actualizar la gráfica
        cargarDatosYActualizarGrafica(idInversion);
    } else {
        console.error('No se proporcionó un ID de inversión en la URL');
    }
</script>



</body>

</html>