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
        <title>QR Estudiante</title>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/css/QR_Alumnos.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/fontawesome.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/fontawesome.min.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/fontawesome-free/css/solid.css"/>
        <link rel = "stylesheet" href = "<?php echo APP;?>app/plugins/datatables/DataTables-1.12.1/css/dataTables.dataTables.min.css"/>
    </head>
    <body>
    	<div id = "tablaAlumnos" class = 'table-responsive'>
    		<table id = "formAlumno" class='table-bordered' ></table><br>
           <img src = "app/lib/QR.png"></img>

    	</div>
        <button id = "carnet" class = "carnet">Imprimir Carnet</button>  
    </body>
    <script src = "<?php echo APP;?>app/plugins/jquery/jquery.min.js"></script>
    <script src = "<?php echo APP;?>app/plugins/ -free/js/solid.js"></script>
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
</html>