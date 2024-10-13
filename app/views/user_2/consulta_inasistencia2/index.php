<?php
 include 'backEnd.php';
 $xajax->printJavascript(APP."app/plugins/xajax/");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" href="<?php echo APP;?>app/public/images/Logo_fe_y_alegria.png" type="image/x-icon">
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Consulta Inasistencias-2v</title>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/css/style.css"  />
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/fontawesome.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/fontawesome.min.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/solid.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/datatables/DataTables-1.12.1/css/dataTables.dataTables.min.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/css/consulta_rol3.css"/>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="user_2"><?php echo $_SESSION["usuario"]?></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav  ms-md-0 me-3 me-lg-">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="update2">Editar Perfil</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" onclick = "xajax_volver()">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Inicial</div>
                            <a class="nav-link" href="user_2">
                                <div class="sb-nav-link-icon">
                                	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                     <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                                    </svg>
                                </div>
                                Home
                            </a>
                            <div class="sb-sidenav-menu-heading">Estudiante</div>
                            <a class="nav-link" href="consulta_rol2"><div class="sb-nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                    </svg>
                                </div>Consulta Estudiante</a>
                            </a>
                            <a class="nav-link" href="consulta_inasistencia2">
                                <div class="sb-nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                    </svg>
                                </div>Consulta Inasistencia</a>
                            </a>
                            <div class="sb-sidenav-menu-heading">Secciones</div>
                            <a class="nav-link" href="lista_estudiantes2">
                                <div class="sb-nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                    </svg>
                                </div>
                                 Gesti&oacute;n Secciones
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <strong><?php echo $_SESSION['d_rol'];?></strong>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Consulta Inasistencia</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $_SESSION["usuario"]?></li>
                            <li class="breadcrumb-item active"><?php echo $_SESSION["email"]?></li>
                        </ol>
                        <form class = "formulario4" id= "formulario4"><br>       					      
          					<input  id = "cedula" placeholder = "VE-9999999" class = "cedula" name = "cedula"></input>
        				</form>
       					<button class = "button2"  id = "button2"> Buscar</button><br>
                       
                        <br><div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Alumno
                            </div>

                            <!------ CUADRO BUSCAR ALUMNO ----->
                            <div id = "hola2" name= "hola2"></div>
                            <!--------------- END ------------->   
                        </div>

                         <!----------------------- MODAL PARA ACTUALIZAR ESTUDIANTE --------------------->
                     <form id = "ModalForm" name = "ModalForm" class = "ModalForm">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" style = "color:green">Actualizar Datos Inasistencia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <input type = "hidden" id = "id_inas" name = "id_inas"></input>
                                            <input type = "hidden" id = "id_student" name = "id_student"></input>
                                            <label style = "margin-left: 160px;" class = "col-form-label">Status Inasistecia</label>
                                            <Select onchange = "funcSelect(this.value)" style = "width: 160px; margin-left: 140px;" id = "SelectStInas" name = "SelectStInas" class = "form-select"></Select>
                                        </div>
                                        <div style = "margin-left: 100px;" id="Message"></div>

                                        <div class = 'modal-footer'>
                                            <button type = 'button' class = 'btn btn-danger' data-dismiss='modal'>Cerrar</button>
                                            <button type = 'button' id = 'BtnActua' class = 'btn btn-success'>Actualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                       <!----------------------- MODAL PARA ACTUALIZAR ESTUDIANTE --------------------->
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    <!--script src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src = "https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src = "https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"--></script>
    <script src = "<?php echo APP;?>app/plugins/chart.js/Chart.min.js"></script>
    <script src = "<?php echo APP;?>app/plugins/jquery/jquery.min.js"></script>
    <script src = "<?php echo APP;?>app/plugins/fontawesome-free/js/solid.js"></script>
    <script src = "<?php echo APP;?>app/plugins/fontawesome-free/js/fontawesome.min.js"></script> 
    <script src = "<?php echo APP;?>app/plugins/fontawesome-free/js/fontawesome.js"></script>
    <script src = "<?php echo APP;?>app/plugins/js/bootstrap.bundle.min.js"></script>
    <script src = "<?php echo APP;?>app/plugins/sweetalert2/sweetalert2.js"></script>
    <script src = "<?php echo APP;?>app/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src = "<?php echo APP;?>app/plugins/js/demo/chart-area-demo.js"></script>
    <script src = "<?php echo APP;?>app/plugins/js/demo/chart-bar-demo.js"></script>
    <script src = "<?php echo APP;?>app/plugins/js/demo/chart-pie-demo.js"></script>
    <script src = "<?php echo APP;?>app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>  
    <script src = "<?php echo APP;?>app/plugins/datatables/datatables.min.js"></script>
    <script src = "<?php echo APP;?>app/plugins/fontawesome-free/js/all.js"></script>
    <script src = "<?php echo APP;?>app/plugins/devoops-master/plugins/maskedinput/src/jquery.maskedinput.js"></script>
<?php
  if (isset($this->js)){
    foreach ($this->js as $js){
        echo '<script type="text/javascript" src="'.APP.'app/views/'.$js.'"></script>'; 
    }
}
?>
    </body>
</html>