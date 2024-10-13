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
  
 function ShowAlumnos(){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new loginModel();
    $result = $loginModel->showStudentsRol3();
    $html = "";

    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: #df4e4e;color:#fff;'>
            <th class='text-center' style='width: 6%;'>Estaus</th>
            <th class='text-center' style='width: 6%;'>Nro Alumno</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 6%;'>Cedula</th>
            <th class='text-center' style='width: 6%;'>Nombre</th>
            <th class='text-center' style='width: 6%;'>Apellido</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
      
        $html.= 
        '<tr class = text-center>
          <td>'.$agente['d_status'].'</td>
          <td>'.$agente['id_alumno'].'</td>
          <td>'.$agente['secciones'].'</td>
          <td>'.$agente['cedula'].'</td>
          <td>'.$agente['nombre'].'</td>
          <td>'.$agente['apellido'].'</td>';
    }
   $obj->addAssign('alumnos', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");
   return $obj;
 }

 function countAlumnos1(){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new loginModel();
  $result = $usuarioModel->countAlumnoRol3();
  $html = '';

  for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);

  $html.= '                     
  <div style = "margin-left: 300px;" class="card bg-primary text-white mb-4">
    <div class="card-body" style = "font-size: 40px; margin-left: 100px;">'.$agente["alumnos"].'</div>
      <div class="card-footer d-flex align-items-center justify-content-between">
        <a style = "margin-left: 12px">Alumnos</a>
      <div class="small text-white"></div>
    </div>
  </div>';
} 
  //var_dump($result);
  $obj->addAssign('alumnos1', 'innerHTML', $html);
  return $obj;
 }

  $xajax->registerFunction("ShowAlumnos");
  $xajax->registerFunction("countAlumnos1");
  $xajax->registerFunction("volver");
  //$xajax->registerFunction("login");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();    
?>