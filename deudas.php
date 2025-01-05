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



        <h1 class="text-center mb-4">Registro de Deudas</h1>
        <div class="mb-3 text-right">
            <button class="btn" id="addCardButton" data-toggle="modal" data-target="#registerDebtModal" style="background-color: #2D5C47; color: white;">
                <i class="fas fa-plus-circle"></i> Registrar Nuevo Deuda
            </button>
        </div>
        <table class="table table-bordered">
            <thead style="background-color: #2D5C47; color: white;">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Entidad Acreedora</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Fecha de Vencimiento</th>
                    <th scope="col">Tasa de Interés</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            


            <tbody>
    <?php
    // Consulta para obtener las deudas del usuario actual
    $query = "SELECT id_deuda, acreedor, monto_total, fecha_vencimiento, tasa_interes, descripcion,estado FROM deudas WHERE id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $_SESSION['id_usuario']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Generar filas dinámicas
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th scope='row'>{$row['id_deuda']}</th>";
            echo "<td>" . htmlspecialchars($row['acreedor']) . "</td>";
            echo "<td>$" . number_format($row['monto_total'], 2) . "</td>";
            echo "<td>" . htmlspecialchars($row['fecha_vencimiento']) . "</td>";
            echo "<td>" . number_format($row['tasa_interes'], 2) . "%</td>";
            echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";

                // Botón de estado (Pagar o Pagado)
    if ($row['estado'] === 'Pagado') {
        echo "<td><button class='btn btn-success btn-sm' disabled>Pagado</button></td>";
    } else {
        echo "<td><button class='btn btn-primary btn-sm pay-btn' data-id='{$row['id_deuda']}'>Pagar</button></td>";
    }

            // Botones de acciones (Editar y Eliminar)
            echo "<td class='text-center'>
                    <button class='btn btn-success btn-sm edit-btn' data-id='{$row['id_deuda']}'><i class='fas fa-edit'></i> Editar</button>
                    <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id_deuda']}'><i class='fas fa-trash'></i> Eliminar</button>
                  </td>";
            echo "</tr>";
        }
    } else {
        // Mensaje si no hay deudas
        echo "<tr><td colspan='8' class='text-center'>No hay deudas registradas.</td></tr>";
    }
    ?>
</tbody>




        </table>

        <!-- Modal para registrar una nueva deuda -->
<div class="modal fade" id="registerDebtModal" tabindex="-1" role="dialog" aria-labelledby="registerDebtModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerDebtModalLabel">Registrar Nueva Deuda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registerDebtForm" method="POST" action="./php/registrar_deuda.php">
                    <div class="form-group">
                        <label for="creditorName">Acreedor</label>
                        <input type="text" class="form-control" id="creditorName" name="acreedor" placeholder="Nombre del acreedor" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Monto</label>
                        <input type="number" class="form-control" id="amount" name="monto_total" placeholder="Monto en pesos" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="dueDate">Fecha de Vencimiento</label>
                        <input type="date" class="form-control" id="dueDate" name="fecha_vencimiento" required>
                    </div>
                    <div class="form-group">
                        <label for="interestRate">Tasa de Interés (%)</label>
                        <input type="number" class="form-control" id="interestRate" name="tasa_interes" placeholder="Ejemplo: 5.00" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" id="description" name="descripcion" placeholder="Detalles sobre la deuda" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para editar deuda -->
<!-- Modal para editar deuda -->
<div class="modal fade" id="editDebtModal" tabindex="-1" role="dialog" aria-labelledby="editDebtModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDebtModalLabel">Editar Deuda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editDebtForm">
                    <input type="hidden" id="editDebtId" name="id_deuda">
                    <div class="form-group">
                        <label for="editCreditorName">Acreedor</label>
                        <input type="text" class="form-control" id="editCreditorName" name="acreedor" required>
                    </div>
                    <div class="form-group">
                        <label for="editAmount">Monto</label>
                        <input type="number" class="form-control" id="editAmount" name="monto_total" required>
                    </div>
                    <div class="form-group">
                        <label for="editDueDate">Fecha de Vencimiento</label>
                        <input type="date" class="form-control" id="editDueDate" name="fecha_vencimiento" required>
                    </div>
                    <div class="form-group">
                        <label for="editInterestRate">Tasa de Interés (%)</label>
                        <input type="number" class="form-control" id="editInterestRate" name="tasa_interes" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Descripción</label>
                        <textarea class="form-control" id="editDescription" name="descripcion"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para realizar el pago -->
<div class="modal fade" id="payDebtModal" tabindex="-1" role="dialog" aria-labelledby="payDebtModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payDebtModalLabel">Realizar Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="payDebtForm">
                    <input type="hidden" id="payDebtId">
                    <div class="form-group">
                        <label for="selectCard">Selecciona una Tarjeta</label>
                        <select class="form-control" id="selectCard" required>
                            <option value="">Seleccionar...</option>
                            <!-- Las tarjetas se cargarán dinámicamente -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cvc">CVC</label>
                        <input type="text" class="form-control" id="cvc" placeholder="Código de seguridad" maxlength="3" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Pagar</button>
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


<!-- Editar adeudo-->
<script >


document.addEventListener("DOMContentLoaded", () => {
    const editButtons = document.querySelectorAll(".edit-btn");
    const editForm = document.getElementById("editDebtForm");

    // Manejar clic en los botones "Editar"
    editButtons.forEach(button => {
        button.addEventListener("click", () => {
            const idDeuda = button.getAttribute("data-id");

            // Realizar la solicitud a get_deuda.php
            fetch(`./php/get_deuda.php?id_deuda=${idDeuda}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        // Cargar los datos en el formulario del modal
                        document.getElementById("editDebtId").value = data.id_deuda;
                        document.getElementById("editCreditorName").value = data.acreedor;
                        document.getElementById("editAmount").value = data.monto_total;
                        document.getElementById("editDueDate").value = data.fecha_vencimiento;
                        document.getElementById("editInterestRate").value = data.tasa_interes;
                        document.getElementById("editDescription").value = data.descripcion;

                        // Mostrar el modal
                        $('#editDebtModal').modal('show');
                    }
                })
                .catch(error => console.error("Error al cargar los datos:", error));
        });
    });

    // Manejar el envío del formulario de edición
    editForm.addEventListener("submit", (e) => {
        e.preventDefault(); // Prevenir la recarga de la página

        // Obtener los datos del formulario
        const idDeuda = document.getElementById("editDebtId").value;
        const acreedor = document.getElementById("editCreditorName").value;
        const montoTotal = document.getElementById("editAmount").value;
        const fechaVencimiento = document.getElementById("editDueDate").value;
        const tasaInteres = document.getElementById("editInterestRate").value;
        const descripcion = document.getElementById("editDescription").value;

        // Enviar los datos al servidor
        fetch("./php/editar_deuda.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                id_deuda: idDeuda,
                acreedor: acreedor,
                monto_total: montoTotal,
                fecha_vencimiento: fechaVencimiento,
                tasa_interes: tasaInteres,
                descripcion: descripcion
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload(); // Recargar la página para reflejar los cambios
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error al guardar los cambios:", error));
    });
});



</script>
<!-- Eliminar adeudo-->
<script>

document.addEventListener("DOMContentLoaded", () => {
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach(button => {
        button.addEventListener("click", () => {
            const idDeuda = button.getAttribute("data-id");

            if (confirm("¿Estás seguro de que deseas eliminar esta deuda?")) {
                fetch("./php/eliminar_deuda.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ id_deuda: idDeuda })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload(); // Recargar la página
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }
        });
    });
});

</script>

<!-- Manejar metodo de pago-->

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const payButtons = document.querySelectorAll(".pay-btn");
    const payForm = document.getElementById("payDebtForm");
    const selectCard = document.getElementById("selectCard");

    // Manejar clic en los botones "Pagar"
    payButtons.forEach(button => {
        button.addEventListener("click", () => {
            const idDeuda = button.getAttribute("data-id");
            document.getElementById("payDebtId").value = idDeuda;

            // Cargar las tarjetas en el selector
            fetch("./php/get_tarjetas.php")
                .then(response => response.json())
                .then(data => {
                    selectCard.innerHTML = '<option value="">Seleccionar...</option>'; // Limpiar el select
                    data.forEach(card => {
                        selectCard.innerHTML += `<option value="${card.id_tarjeta}">${card.tipo} - **** ${card.numero.slice(-4)} (${card.banco})</option>`;
                    });

                    // Mostrar el modal
                    $('#payDebtModal').modal('show');
                })
                .catch(error => console.error("Error al cargar las tarjetas:", error));
        });
    });

    // Manejar el envío del formulario de pago
    payForm.addEventListener("submit", (e) => {
        e.preventDefault(); // Prevenir la recarga de la página

        const idDeuda = document.getElementById("payDebtId").value;
        const idTarjeta = selectCard.value;
        const cvc = document.getElementById("cvc").value;

        // Enviar los datos al servidor
        fetch("./php/pagar_deuda.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                id_deuda: idDeuda,
                id_tarjeta: idTarjeta,
                cvc: cvc // Solo visual, no se validará
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload(); // Recargar la página para reflejar los cambios
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error al procesar el pago:", error));
    });
});

</script>


</body>

</html>