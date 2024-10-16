<?php
 include 'backEnd.php';
 $xajax->printJavascript(APP."app/plugins/xajax/");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet"/>
        <link href="<?php echo APP;?>app/plugins/css/style.css" rel="stylesheet"/>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/fontawesome.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/fontawesome.min.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/solid.css"/>
        <link rel = "stylesheet" href = "https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css"/>
        <link href="<?php echo APP;?>app/plugins/css/style.css" rel="stylesheet"/>
        <link href="<?php echo APP;?>app/plugins/css/registro_alumno.css" rel="stylesheet"/>
        <!-- Custom CSS -->
        <link href="<?php echo APP;?>app/pplugins/css/user_1.css" rel="stylesheet">
        <link href="<?php echo APP;?>app/pugins/css/item_1.css" rel="stylesheet">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href = "user_3"><?php echo $_SESSION["usuario"]?></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav  ms-md-0 me-3 me-lg-" style = "margin-right: 400px;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="update3">Editar Perfil</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
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
                            <a class="nav-link" href="user_3">
                                <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                                Home
                            </a>
                            <div class="sb-sidenav-menu-heading">Estudiante</div>
                            <a class="nav-link" href="consulta_rol3">Consulta Estudiante</a>
                            <div class="sb-sidenav-menu-heading">Alumno Por Secciones</div>
                            <a class="nav-link" href="listar_estudiantes3">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Secciones
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <strong><?php echo $_SESSION["d_rol"];?></strong>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content" style= "">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4" style =  "">Actualizar Perfil</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $_SESSION["usuario"]?></li>
                            <li class="breadcrumb-item active"><?php echo $_SESSION["email"]?></li>
                        </ol>
                        <div class="row">
                            <img class="image" id = "img" src="<?php echo APP;?>app/public/images/User1.png" alt=""style="margin-left: 530px; height: 200px; width: 200px;"/><br>
                        </div><br>
                        <div class="card-body_1" style = "margin-top: 200px;">
                            <form id = "form" class = "form" style = "margin-left: 20px;">
        						<fieldset>
            						<label for = "nombre">Nombre</label>
            						<input id = "usuario" name = "usuario" value = "<?php echo $_SESSION["nombre"]?>" type = "tex"/>
        						</fieldset><br>
        						<fieldset><br>
            						<label for = "apellido">Apellido</label>
            						<input id = "apellido" name = "apellido" value = "<?php echo $_SESSION["apellido"]?>" type = "text"/>
        						</fieldset><br>
        						<fieldset><br>
            						<label fo r= "email" id = "email">email</label>
            						<input id = "email" name = "email" value = "<?php echo $_SESSION["email"]?>" type = "Email"/>
        						</fieldset><br>
        						<fieldset><br>
            						<label for = "pass" id = "pass">Contraseña</label>
            						<input id = "pass" name = "pass" type = "text"/>
       							</fieldset></br>
                                <p style = "margin-left: 480px; position: absolute; color: red;">¡Se redirecionar&aacute la p&aacutegina al Login!</p><br>
   					 		</form>
   					 		<div class="wrapper">
            					<button id = "form_button">
                					Actualizar
            					</button>
            				</div>
						</main>                        
					</div>
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
    <script src = "<?php echo APP;?>app/plugins/Chart.js/Chart.min.js"></script>
    <script src = "<?php echo APP;?>app/plugins/jquery/jquery-3.5.1.js"></script>
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
    <script src = "<?php echo APP;?>app/plugins/devoops-master/plugins/maskedinput/src/jquery.maskedinput.js"></script>
    <!--  SweetAlert   -->
    <script src = "<?php echo APP;?>app/plugins/sweetalert2/sweetalert2.js"></script>
    <script src = "<?php echo APP;?>app/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!--MASCARAS JQUERY-->
    <script src = "<?php echo APP;?>app/plugins/devoops-master/plugins/maskedinput/src/jquery.maskedinput.js"></script>
    <!--JQuery-confirm JS-->
    <script src = "<?php echo APP;?>app/plugins/jquery-confirm-master/dist/jquery-confirm.min.js"></script>
    <?php  
      if (isset($this->js)){
        foreach ($this->js as $js){
          echo '<script type="text/javascript" src="'.APP.'app/views/'.$js.'"></script>'; 
        }
      }
    ?>
</body>
</html>	