<?php
 include 'backEnd.php';
 $xajax->printJavascript(APP."app/plugins/xajax/");
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" href="<?php echo APP;?>app/public/images/Logo_fe_y_alegria.png" type="image/x-icon">
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Consulta</title>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/css/style.css"  />
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/fontawesome.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/fontawesome.min.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/solid.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/datatables/DataTables-1.12.1/css/dataTables.dataTables.min.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/css/consulta.css"/>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="user_1"><?php echo $_SESSION["usuario"]?></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav  ms-md-0 me-3 me-lg-">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="update">Editar Perfil</a></li>
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
                            <a class="nav-link" href="user_1">
                                <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                     <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                                    </svg>
                                </div>
                                Home
                            </a>
                            <div class="sb-sidenav-menu-heading">Estudiante</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backpack-fill" viewBox="0 0 16 16">
                                        <path d="M5 13v-3h4v.5a.5.5 0 0 0 1 0V10h1v3z"/>
                                        <path d="M6 2v.341C3.67 3.165 2 5.388 2 8v5.5A2.5 2.5 0 0 0 4.5 16h7a2.5 2.5 0 0 0 2.5-2.5V8a6 6 0 0 0-4-5.659V2a2 2 0 1 0-4 0m2-1a1 1 0 0 1 1 1v.083a6 6 0 0 0-2 0V2a1 1 0 0 1 1-1m0 3a4 4 0 0 1 3.96 3.43.5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14A4 4 0 0 1 8 4M4.5 9h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                </div>
                                Gesti&oacute;n Estudiantil
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="registro_alumno">Registro Estudiantil</a>
                                    <a class="nav-link" href="consulta">Consulta Estudiante</a>
                                    <a class="nav-link" href="consulta_inasistencia">Consulta Inasistencias</a>
                                    <a class="nav-link" href="estadistica_alumno">Estadistica Inasistencia Por Secciones</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Docente</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                            <!----- ICON CARNET ------>
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi    bi-person-badge-fill" viewBox="0 0 16 16">
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z"/>
                                </svg>
                            </div>  
                            <!----- END ICON CARNET ------>                                
                            Gesti&oacute;n Docente
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion1">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="registro_profesor">Registro Docente</a>
                                    <a class="nav-link" href="asignacion_materia">Asignar Materia</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Solicitud</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                 <!----- ICON MESSAGE ------>
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
                                </svg>
                            </div>
                            <!----- END ICON MESSAGE ------>  
                                <div class="sb-nav-link-icon"></div>
                                Gesti&oacute;n Solicitud
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href =" pase" data-bs-toggle="" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Crear Solicitud
                                    </a>
                                    <a class="nav-link" href="cita_alumno">
                                        <div class="sb-nav-link"></div>
                                        Citas Por Alumnos
                                    </a>
                                    <a class="nav-link" href="cita_secciones">
                                        <div class="sb-nav-link"></div>
                                        Estad&iacutesticas de Citas Por Secciones
                                    </a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Psicopedagogia</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages14" aria-expanded="false" aria-controls="collapsePages">

                            <!----- ICON MESSAGE ------>
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                                    <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                    <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z"/>
                                </svg>
                            </div>
                            <!----- END ICON MESSAGE ------>  

                            Gesti&oacute;n  Pedagogica
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                            <div class="collapse" id="collapsePages14" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed5" href = "pedagogia" data-bs-toggle="" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Personal/Consulta
                                    </a>
                                    <a class="nav-link" href="cita_alumno">
                                        <div class="sb-nav-link"></div>
                                        Citas Por Estudiante
                                    </a>
                                    <a class="nav-link" href="cita_secciones">
                                        <div class="sb-nav-link"></div>
                                        Estad&iacutesticas Solicitudes
                                    </a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Secciones</div>
                            <a class="nav-link" href="lista_estudiantes">
                                <div class="sb-nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                    </svg>
                                </div>
                                 Gesti&oacute;n Secciones
                            </a>
                            <div class="sb-sidenav-menu-heading">Administrador</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts17" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="white" class="bi bi-person-gear" viewBox="0 0 16 16">
                                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                                    </svg>
                                </div>
                                Gesti&oacute;n Administrador
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts17" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="registro_materia">Registro Materias</a>
                                    <a class="nav-link" href="registro_hora">Registro Horas</a>                                    
                                    <a class="nav-link" href="registro_anoseccion">Registro de A&ntildeo y Secci&oacuten</a>
                                </nav>
                            </div>
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
                        <h1 class="mt-4">Consulta Estudiante</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $_SESSION["usuario"]?></li>
                            <li class="breadcrumb-item active"><?php echo $_SESSION["email"]?></li>
                        </ol>
                        <form class = "formulario3" id= "formulario3"><br>       					      
          					<div id = "cedula_boton" class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><strong>Cedula:</strong></span>
                                </div>
                                <input  type="text" class="form-control" aria-label = "Username" aria-describedby="basic-addon1" id = "cedula" name = "cedula">
                            </div>
        				</form>
       					<button sclass = "button"  id = "button"> Buscar</button><br>
                       
                        <br><div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-user"></i>
                                Estudiante
                            </div>

                            <!------ CUADRO BUSCAR ALUMNO ----->
                            <div id = "hola" name= "hola"></div>
                            <!--------------- END ------------->
                            
                        </div>
                        <!--form class = "Form3" id = "form3"></form>
                        <button id = "BtnQr" class = "BtnQr" onclick>Generar QR</button> 
                        <--img id = "Img" class = "Img" src="app/lib/QR.png" onclick = "pedirVoto()" style= "height: 300px; width: 300px;"-->
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
    <script src = "<?php echo APP;?>app/plugins/jquery/jquery.min.js"></script>
    <script src = "<?php echo APP;?>app/plugins/fontawesome-free/js/solid.js"></script>
    <script src = "<?php echo APP;?>app/plu gins/fontawesome-free/js/fontawesome.min.js"></script> 
    <script src = "<?php echo APP;?>app/plugins/fontawesome-free/js/fontawesome.js"></script>
    <script src = "<?php echo APP;?>app/plugins/js/bootstrap.bundle.min.js"></script>
    <script src = "<?php echo APP;?>app/plugins/sweetalert2/sweetalert2.js"></script>
    <script src = "<?php echo APP;?>app/plugins/sweetalert2/sweetalert2.all.js"></script>
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