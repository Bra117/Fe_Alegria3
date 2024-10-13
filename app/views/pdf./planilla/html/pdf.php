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
<body>
  <div >
    <table border = '1' style = "font-size: 9px;" width='50%' >
      <thead>
        <h1 style = "margin-left: 69px;" class = "text-center">Estudiante</h1>
        <tr>
          <th class='text-center'>Nro Estudiante</th>
          <td><?php echo $result['row']['id_alumno'];?></td>
        </tr>
        <tr>
          <th class='text-center'>Estaus</th>
          <td><?php echo $result['row']['d_status'];?></td>
        </tr>
        <tr>
          <th class='text-center'>Sexo</th>
          <td style="font-size: 8px;"><?php echo $result['row']['d_sexo'];?></td>
        </tr>
        <tr>
          <th class='text-center'>Año, Seccion</th>
          <td><?php echo $result['row']['d_aseccion'];?></td>
        </tr>
        <tr>
          <th class='text-center'>Cedula</th>
          <td style="font-size: 7px;"><?php echo $result['row']['cedula'];?></td>
        </tr>
        <tr>
          <th class='text-center'>Nombre</th>
          <td style="font-size: 8px;"><?php echo $result['row']['nombre'];?></td>
        </tr>
        <tr>
          <th class='text-center'>Apellido</th>
          <td style="font-size: 8px;"><?php echo $result['row']['apellido'];?></td>
        </tr>
        <tr>
          <th width= '10%'>fecha nacimiento</th>
          <td style="font-size: 7px;"><?php echo $result['row']['fecha_nac'];?></td> 
        </tr> 
      </thead>
    </table>
  </div>
</body>
</html>


