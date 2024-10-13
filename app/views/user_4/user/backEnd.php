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
  
  function showconsulta(){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new pedagogiaModel();
    $result = $loginModel->ShowPconsulta();
    $html = "";
    
    $html="<div class='table-responsive';>
      <table id='grid1' class='table table-bordered' width='100%'>
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
            <th class='text-center' style='width: 15%;'>Accion</th>
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
        <td style = "background-color: #48CAE4; color:white;">'.$agente['d_status_consulta'].'</td>
        <td>'.$agente['cedulaalu'].'</td>
        <td>'.$agente['fullalumno'].'</td>
        <td>'.$agente['fullprofesor'].'</td>
        <td>'.$agente['cedulapro'].'</td>
        <td>'.$agente['d_motivo_consulta'].'</td>
        <td>'.substr($agente['fecha_consulta'],0,16).'</td>
        </td> <td style="width: 10%;">
            <div class="btn-group">
               <button type="button" class = "btn btn-success btn-sm btnImp" onClick="xajax_AceptarConsulta('.$agente['id_consulta'].')"  data-target="#exampleModa"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Aceptar</i>
              </button>
            </div>
          </td>         
        </tr>';
    }
    //var_dump($id_alumno);
    $obj->addAssign('consulta', 'innerHTML', $html);
    $obj->addScript("datatable('grid1');");
   return $obj;
  }
  
  function showconsulta1(){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new pedagogiaModel();
    $result = $loginModel->ShowPconsulta1();
    $html = "";
    
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
            <th class='text-center' style='width: 6%;'>Fecha Consulta</th>
            <th class='text-center' style='width: 15%;'>Fecha Atencion</th>
            <th class='text-center' style='width: 15%;'>Accion</th>
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
        <td style = "background-color: #308446; color:white;">'.$agente['d_status_consulta'].'</td>
        <td>'.$agente['cedulaalu'].'</td>
        <td>'.$agente['fullalumno'].'</td>
        <td>'.$agente['fullprofesor'].'</td>
        <td>'.$agente['cedulapro'].'</td>
        <td>'.$agente['d_motivo_consulta'].'</td>
        <td>'.substr($agente['fecha_consulta'],0,16).'</td>
        <td>'.substr($agente['fecha_atencion'],0,16).'</td>
        </td> <td style="width: 10%;">
            <div class="btn-group">
               <button type="button" class = "btn btn-success btn-sm btnImp" onClick="xajax_FinalizarConsulta('.$agente['id_consulta'].')"  data-target="#exampleModa"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Finalizar</i>
              </button>
            </div>
          </td>         
        </tr>';
    }
    //var_dump($id_alumno);
    $obj->addAssign('consulta1', 'innerHTML', $html);
    $obj->addScript("datatable('grid2');");
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

  function AceptarConsulta($id_consulta){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new pedagogiaModel();
    $result = $loginModel->SearchConsulById($id_consulta);
    $consu = $loginModel->GetConsultaByIdConsulta();
    //var_dump($consu);
    if ($id_consulta != ""){
      if($consu['numRows'] != 1){
        $Update = $loginModel->CambioStatusConsulta($id_consulta);
        if($Update){
          $obj->addScript("Swal.fire({
            title: '¡Aceptada!',
            text: 'La consulta ha sido aceptada.',
            icon: 'success',
            color: 'black'
          });");
          //REDIRECTION
          $obj->addScript("setTimeout(function(){ window.location='user_4';},1000)");
          //
        }else{
          $obj->addScript("Swal.fire({
            title: '¡Hubo un error!',
            text: 'No se ha podido aceptar la consulta.',
            icon: 'error',
            color: 'black'
          });");
        }
      }else{
       $obj->addScript("Swal.fire({
          title: 'Bandeja',
          text: 'Tienes Una Consulta en Proceso; Finalice la para poder Aceptar otra.',
          icon: 'warning',
          color: 'black'
        });"); 
      }
    }else{
      $obj->addScript("Swal.fire({
        title: 'Bandeja',
        text: 'No hay Consulta.',
        icon: 'error',
        color: 'black'
      });");
    } 
    return $obj;
  }
  
  function FinalizarConsulta($id_consulta){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new pedagogiaModel();
    $result = $loginModel->SearchConsulById($id_consulta);
    //var_dump($consu);
    if ($id_consulta != ""){
      $Update = $loginModel->CambioStatusConsulta1($id_consulta);
      if($Update){
        $obj->addScript("Swal.fire({
          title: 'Finalizado!',
          text: 'La consulta ha sido Finalizada.',
          icon: 'success',
          color: 'black'
        });");
        //REDIRECTION
        $obj->addScript("setTimeout(function(){ window.location='user_4';},1000)");
        //
      }else{
        $obj->addScript("Swal.fire({
          title: '¡Hubo un error!',
          text: 'No se ha podido finalizar la consulta.',
          icon: 'error',
          color: 'black'
        });");
      }
    }else{
      $obj->addScript("Swal.fire({
        title: 'Bandeja',
        text: 'No hay Consulta.',
        icon: 'error',
        color: 'black'
      });");
    } 
    return $obj;
  }

  $xajax->registerFunction("AceptarConsulta");
  $xajax->registerFunction("FinalizarConsulta");
  $xajax->registerFunction("volver");
  $xajax->registerFunction("showPedagogiaPersonal");
  $xajax->registerFunction("showconsulta");
  $xajax->registerFunction("showconsulta1");
  $xajax->registerFunction("showconsulta2");

  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();
?>