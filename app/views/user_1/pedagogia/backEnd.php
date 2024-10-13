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
  
 function showPedagogiaPersonal(){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new pedagogiaModel();
    $result = $loginModel->ShowPersonalPedago();
    $html = "";
    
    $html="<div class='table-responsive';>
      <table id='grid1' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Status</th>
            <th class='text-center' style='width: 6%;'>Rol</th>
            <th class='text-center' style='width: 6%;'>Nombre</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula</th>
           </tr> 
        </thead>
        <tbody>";
    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);

      $html.= 
      '<tr class = text-center>
        <td>'.$agente['d_status'].'</td>
        <td>'.$agente['d_rol'].'</td>
        <td>'.$agente['fullname'].'</td>
        <td>'.$agente['cedula'].'</td>
      </tr>';
    }
    //var_dump($id_alumno);
    $obj->addAssign('personal', 'innerHTML', $html);
    $obj->addScript("datatable('grid1');");
   return $obj;
  }

  function showconsulta(){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new pedagogiaModel();
    $result = $loginModel->ShowPconsulta();
    $html = "";
    //var_dump($result);
    
    $html="<div class='table-responsive';>
      <table id='grid2' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Nro Consulta</th>
            <th class='text-center' style='width: 6%;'>Estatus Consulta</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula Alumno</th>
            <th class='text-center' style='width: 6%;'>Nombre Alumno</th>
            <th class='text-center' style='width: 6%;'>Nombre Profesor</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula Profesor</th>
            <th class='text-center' style='width: 6%;'>Motivo Consulta</th>
            <th class='text-center' style='width: 15%;'>Fecha Consulta H-M</th>
           </tr> 
        </thead>
        <tbody>";
    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
       //var_dump($agente);
        $html.= '<tr class = text-center>
          <td>'.$agente['id_consulta'].'</td>
          <td>'.$agente['d_status_consulta'].'</td>
          <td>'.$agente['cedulaalu'].'</td>
          <td>'.$agente['fullalumno'].'</td>
          <td>'.$agente['fullprofesor'].'</td>
          <td>'.$agente['cedulapro'].'</td>
          <td>'.$agente['d_motivo_consulta'].'</td>
          <td>'.substr($agente['fecha_consulta'],0,16).'</td>
        </tr>';
    }
    //var_dump($html);
    $obj->addAssign('consulta', 'innerHTML', $html);
    $obj->addScript("datatable('grid2');");
   return $obj;
  }

  $xajax->registerFunction("volver");
  $xajax->registerFunction("showPedagogiaPersonal");
  $xajax->registerFunction("showconsulta");

  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();
?>