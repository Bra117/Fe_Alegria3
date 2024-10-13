<?php
include 'backEnd.php'; 
$xajax->printJavascript(APP."app/plugins/xajax/");   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link rel="icon" href="<?php echo APP;?>app/public/images/Logo_fe_y_alegria.png" type="image/x-icon">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Ingreso</title>
        <!-- Custom fonts for this template-->
        <link href="<?php echo APP;?>app/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


        <!-- Custom styles for this template-->
        <link href="<?php echo APP;?>app/plugins/css/sb-admin-2.css" rel="stylesheet" type = "text/css">
        <link href="<?php echo APP;?>app/plugins/css/hola.css" rel="stylesheet" type = "text/css">
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css">

        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/fontawesome.min.css">
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css">
    </head>
     
     <!-- NAV BAR PARA UTILIZAR DESPUES ->
    <header class = "header">
        <div class = "logo">
             <img src = "app/public/images/CSSSHOES1 ORIGINAL.png" alt = "Logo de la marca">
        </div>
        <nav>
           <ul class = "nav-links">
                <li><a href = "#">Services</a></li>
                <li><a href = "#">Projects</a></li>
                <li><a href = "#">About</a></li>
           </ul>            
        </nav>
        <a class = "btn" href = "#"><button>Contact</button></a>
    </header-->
    <header>
   <div class="navbar1">
        <!--nav id = "nav" class="navbar navbar-expand-lg"-->
  <!--nav id = "nav" class="navbar navbar-expand-lg">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            </button>
            <form class="form-inline">
                <a class="btn btn-outline-info" href = "login" type="submit">Admin</a>
                <a class="btn btn-outline-danger" href = "login_user"  type="submit">User</a>
          </form>

          <div class="dropdown">

                <button class="btn btn-outline-Success dropdown-toggle" data-toggle = "dropdown">Menu</button>
                <div class="dropdown-content"> 
           
                    <a  href="#">Contactanos</a> 
                    <a  href="#">Productos</a> 
                    <a  href="#">Donaciones</a>
             
                </div>
          </div>
                
        </nav>
    </div-->
</header>

    <body>
        <div id="contenedor">   
            <div id="contenedorcentrado" style = "margin-top: 10px;">
                <div id="login">
                    <form id="loginform">
                        <label for="cedula">C&eacutedula</label>
                        <input class = "cedula" id = "cedula" type="text" name = "cedula" placeholder = "VE-99999999">
                        
                        <label for = "password">Contraseña</label>
                        <input id = "password" type = "password" placeholder = "Contraseña"  class = "password" name = "password">
                        <svg id=clickme style = "width:18px; height: 14px; margin-top: -37px; margin-left: 230px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M569.354 231.631C512.97 135.949 407.81 72 288 72 168.14 72 63.004 135.994 6.646 231.631a47.999 47.999 0 0 0 0 48.739C63.031 376.051 168.19 440 288 440c119.86 0 224.996-63.994 281.354-159.631a47.997 47.997 0 0 0 0-48.738zM288 392c-102.556 0-192.091-54.701-240-136 44.157-74.933 123.677-127.27 216.162-135.007C273.958 131.078 280 144.83 280 160c0 30.928-25.072 56-56 56s-56-25.072-56-56l.001-.042C157.794 179.043 152 200.844 152 224c0 75.111 60.889 136 136 136s136-60.889 136-136c0-31.031-10.4-59.629-27.895-82.515C451.704 164.638 498.009 205.106 528 256c-47.908 81.299-137.444 136-240 136z"/></svg>
                    </form>
                     <button type = "submit" title = "Ingresar" id = "BtnLogin" name = "Ingresar">Ingresar</button>
                </div>
                <div id="derecho">
                    <div class="titulo">
                       Escuela T&eacutecnica Andy Aparicio
                    </div>
                    <hr>
                    <div id = "id" class="pie-form" >
                        <img  id = "sms" class = "img" src = "<?php echo APP;?>app/public/images/fondo_negro-removebg.png"/>                     
                        <hr>
                        <p id = "texto" style = "background: linear-gradient(white, red); -webkit-background-clip:text; color: transparent;"><strong>"SISTEMA DE CONTROL INASISTENCIAL Y PASE ESTUDIANTIL"</p></strong>
                    </div>
                </div>
            </div>
        </div>

<!--body class="bg-gradient-primary">
    <div class="container">
        <!- Outer Row ->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="cart">
                    <div class="card-body p-0">
                        <!- Nested Row within Card Body ->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-iage" >
                              <div class="img1">
                                 <img src = "app/public/images/CSSSHOES1 ORIGINAL.png"></img>
                             </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4>Registrate en CCSHOES1, lo mejor en calzado</h4>
                                    </div><br>
                                    <form id="loginUser" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                            id="cedula" name="usuario" aria-describedby="emailHelp"
                                            placeholder="Ingrese su E-mail">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder=" Ingrese su Contraseña"><br>
                                             </input>   
                                            
                                        
                                         <div class = " botones">
                                            <a type = "submit" href = "#"  class="btn btn-danger" id = "boton1" name = "boton1">
                                            Acceder</a>


                                           <a type = "submit"  href = "registro_user"  class="btn btn-primary" id = "boton2" name = "boton2">
                                            Registrate</a>
                                        </div>
                                    </form>
                                  
                                    <div class="text-center">
                                        <!-<a class="small" href="forgot-password.html">Recuperar Contraseña</a>->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div-->
    
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo APP;?>app/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo APP;?>app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--JQUERY-->
    <script src="<?php echo APP;?>app/plugins/jquery/jquery-3.5.1.js"></script>
    <!--  SweetAlert   -->
    <script src = "<?php echo APP;?>app/plugins/sweetalert2/sweetalert2.js"></script>
    <script src = "<?php echo APP;?>app/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!--MASCARAS JQUERY-->
    <script src = "<?php echo APP;?>app/plugins/devoops-master/plugins/maskedinput/src/jquery.maskedinput.js"></script>
    <!--JQuery-confirm JS-->
    <script src = "<?php echo APP;?>app/plugins/jquery-confirm-master/dist/jquery-confirm.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo APP;?>app/plugins/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo APP;?>app/plugins/js/sb-admin-2.min.js"></script>
<?php
    if (isset($this->js)){
        foreach ($this->js as $js){
          echo '<script type="text/javascript" src="'.APP.'app/views/'.$js.'"></script>'; 
        }
    }
?>
</body>    
</html>

