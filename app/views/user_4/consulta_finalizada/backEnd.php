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

  function showconsulta2(){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new pedagogiaModel();
    $result = $loginModel->ShowPconsulta2();
    $html = "";
    
    $html="<div class='table-responsive';>
      <table id='grid3' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Nro Consulta</th>
            <th class='text-center' style='width: 6%;'>Estatus Consulta</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula Alumno</th>
            <th class='text-center' style='width: 6%;'>Nombre Alumno</th>
            <th class='text-center' style='width: 6%;'>Nombre Profesor</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula Profesor</th>
            <th class='text-center' style='width: 6%;'>Motivo Consulta</th>
            <th class='text-center' style='width: 6%;'>Fecha Consulta</th>
            <th class='text-center' style='width: 15%;'>Fecha Atencion</th>
            <th class='text-center' style='width: 15%;'>Fecha Finalizacion</th>
           </tr> 
        </thead>
        <tbody>";
    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
       
      $id_alumno = $agente['id_solicitud'];
      $obj->addAssign('id_student', 'value', $id_alumno); 

      $html.= 
      '<tr class = text-center>
        <td>'.$agente['id_consulta'].'</td>
        <td style = "background-color: #ec5252; color:white;">'.$agente['d_status_consulta'].'</td>
        <td>'.$agente['cedulaalu'].'</td>
        <td>'.$agente['fullalumno'].'</td>
        <td>'.$agente['fullprofesor'].'</td>
        <td>'.$agente['cedulapro'].'</td>
        <td>'.$agente['d_motivo_consulta'].'</td>
        <td>'.substr($agente['fecha_consulta'],0,16).'</td>
        <td>'.substr($agente['fecha_atencion'],0,16).'</td>
        <td>'.substr($agente['fecha_finalizacion'],0,16).'</td>        
      </tr>';
    }
    //var_dump($id_alumno);
    $obj->addAssign('consulta2', 'innerHTML', $html);
    $obj->addScript("datatable('grid3');");
   return $obj;
  }

  $xajax->registerFunction("volver");
  $xajax->registerFunction("showconsulta2");

  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();
?>