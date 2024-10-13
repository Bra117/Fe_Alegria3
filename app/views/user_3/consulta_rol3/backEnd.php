<?php
require ('app/plugins/xajax/xajax.inc.php');
  //instanciamos el objeto de la clase xajax
  $xajax = new xajax();
  //Función()
  function volver(){
    $obj = new xajaxResponse('UTF-8');
    session_destroy();
    $obj->addRedirect("login");
    return $obj;
  }   

  function BuscarAlumno2($form){
    $obj = new xajaxResponse('UTF-8');
    $usuarioModel = new register_alumnoModel();
    $result = $usuarioModel->getStudentByCedulaRol3($form);

    //var_dump( $_SESSION["Nombre"]);
    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: #df4e4e;color:#fff;'>
            <th class='text-center' style='width: 6%;'>id</th>
            <th class='text-center' style='width: 6%;'>Estaus</th>
            <th class='text-center' style='width: 6%;'>Sexo</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 6%;'>Cedula</th>
            <th class='text-center' style='width: 6%;'>Nombre</th>
            <th class='text-center' style='width: 6%;'>Apellido</th>
            <th class='text-center' style='width: 6%;'>fecha_nacimiento</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
      
      $html.= 
      '<tr class = text-center>
        <td>'.$agente['id_alumno'].'</td>
        <td>'.$agente['d_status'].'</td>
        <td>'.$agente['d_sexo'].'</td>
        <td>'.$agente['d_aseccion'].'</td>
        <td>'.$agente['cedula'].'</td>
        <td>'.$agente['nombre'].'</td>
        <td>'.$agente['apellido'].'</td>
        <td>'.$agente['fecha_nac'].'</td>
      </tr>';
    }
  
   $obj->addAssign('hola2', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");
   return $obj;
  }

  $xajax->registerFunction("BuscarAlumno2");
  $xajax->registerFunction("volver");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();    
?>