<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    // Redirigir al login si no hay sesión activa
    header("Location: login.html");
    exit;
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

    <link rel="stylesheet" href="./estilos/perfil.css">


    <script>
        // Cargar datos en el formulario desde las variables de sesión de PHP
        window.onload = function() {
            // Las variables de sesión se manejan directamente en el HTML
        };

        // Habilitar edición del formulario
        function enableEdit() {
            const inputs = document.querySelectorAll(".form-control");
            inputs.forEach(input => input.removeAttribute("disabled"));
            document.getElementById("save-button").classList.remove("d-none");
            document.getElementById('upload-button').style.display = 'inline'; // Mostrar el botón "Cambiar Foto"
        }

        // Guardar cambios del perfil
        function saveProfile() {
            const inputs = document.querySelectorAll(".form-control");
            inputs.forEach(input => input.setAttribute("disabled", "true"));
            document.getElementById("save-button").classList.add("d-none");
            document.getElementById('upload-button').style.display = 'none'; // Ocultar el botón "Cambiar Foto"
            alert("¡Perfil actualizado con éxito!");
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Habilitar edición del formulario
            document.getElementById('edit-button').addEventListener('click', function() {
                // Habilitar campos para edición
                document.getElementById('usuario').disabled = false;
                // Habilitar otros campos similares
                document.getElementById('photo-upload').style.display = 'block';
                document.getElementById('edit-button').classList.add('d-none');
                document.getElementById('save-button').classList.remove('d-none');
                document.getElementById('upload-button').style.display = 'inline'; // Mostrar el botón "Cambiar Foto"
            });

            document.getElementById('upload-button').addEventListener('click', function() {
              
            });
        });

        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-image').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        function enableEdit() {
    const editButton = document.getElementById('edit-button');
    const inputs = document.querySelectorAll('.form-control');
    const uploadButton = document.getElementById('upload-button'); // Botón de cambiar foto

    if (editButton.textContent.trim() === 'Editar') {
        // Cambiar a "Cancelar", habilitar campos y mostrar botón "Cambiar Foto"
        editButton.textContent = 'Cancelar';
        inputs.forEach(input => input.removeAttribute('disabled'));
        document.getElementById('save-button').classList.remove('d-none'); // Mostrar "Guardar Cambios"
        uploadButton.style.display = 'inline-block'; // Mostrar botón "Cambiar Foto"
    } else {
        // Cambiar a "Editar", deshabilitar campos y ocultar botón "Cambiar Foto"
        editButton.textContent = 'Editar';
        inputs.forEach(input => input.setAttribute('disabled', 'true'));
        document.getElementById('save-button').classList.add('d-none'); // Ocultar "Guardar Cambios"
        uploadButton.style.display = 'none'; // Ocultar botón "Cambiar Foto"
    }
}

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



                    <!-- Perfil Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Mi Perfil</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card p-4 shadow-sm">
                                <form id="profile-form" method="POST" action="./php/modificarPerfil.php" enctype="multipart/form-data">
                <section class="profile-photo">
                    <div class="photo-container">
                        <img id="profile-image" src="php/<?php echo $_SESSION['foto_perfil']; ?>" alt="Foto de perfil" class="rounded-circle" style="object-fit: cover;">
                        <br>
                        <input type="file" accept=".PNG, .JPG, .JPEG" name="foto_perfil" id="photo-upload" accept="image/*" style="display: none;" onchange="previewImage(event)">
                        <button type="button" id="upload-button" style="display: none;" onclick="document.getElementById('photo-upload').click()">Cambiar Foto</button>
                    </div>
                </section>
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="name" class="form-control" value="<?php echo $_SESSION['nombre']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" value="<?php echo $_SESSION['apellido_paterno']; ?>" disabled>
                </div>                            
                <div class="mb-3">
                    <label for="apellido_materno" class="form-label">Apellido Materno</label>
                    <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" value="<?php echo $_SESSION['apellido_materno']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="correo" id="email" class="form-control" value="<?php echo $_SESSION['correo']; ?>" disabled>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" id="phone" class="form-control" value="<?php echo $_SESSION['numero_telefono']; ?>" disabled>
                </div>  
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" id="edit-button" onclick="enableEdit()" style="color: black;">Editar</button>
                    <button type="submit" class="btn btn-success d-none" id="save-button">Guardar Cambios</button>
                </div>
            </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>




                    
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


</body>

</html>