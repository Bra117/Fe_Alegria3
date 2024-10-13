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

  function ShowSolicitud(){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new solicitudModel();
    $result = $loginModel->ShowSoli();
    $html = "";
    //var_dump($result);
       if ($result['numRows'] > 0 ) {
     	    $obj->addScript("Swal.fire({
          title: 'Bandeja',
          text: 'Tienes ".$result['numRows']." Pases.',
          icon: 'warning',
          color: 'black'
        });");

    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black;color:white;'>
            <th class='text-center' style='width: 6%;'>Nro Pase</th>
            <th class='text-center' style='width: 6%;'>Status Pase</th>
            <th class='text-center' style='width: 15%;'>Fecha y hora Pase</th>
            <th class='text-center' style='width: 6%;'>Directivo</th>
            <th class='text-center' style='width: 6%;'>Alumno</th>
            <th class='text-center' style='width: 6%;'>Aseccion</th>
            <th class='text-center' style='width: 6%;'>Motivo</th>
            <th class='text-center' style='width: 6%;'>Anexo</th>
            <th class='text-center' style='width: 6%;'>Accion</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
      
        $html.= 
        '<tr class = text-center>
          <td>'.$agente['id_solicitud'].'</td>
          <td style = "background-color: #1384ed; color: white;">'.$agente['d_status_solicitud'].'</td>
          <td>'.substr($agente['fecha_solicitud'],0,16).'</td>
          <td>'.$agente['director'].'</td>
          <td>'.$agente['alumno'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['d_motivo'].'</td>
          <td>'.$agente['anexo'].'</td>
          <td style="width: 10%;">
            <div class="btn-group">
              <button type="button" class = "btn btn-success btn-sm btnImp" onClick="xajax_UpdateModal('.$agente['id_solicitud'].')"   data-target="#exampleMdal" data-whatever="@mdo" data-toggle="moda" "data-dismiss="moda"><i class="">Aceptar</i>
              </button>
              <button type="button" class = "btn btn-danger btn-sm btnImp" onClick="xajax_CancelModal('.$agente['id_solicitud'].')"   data-target="#exampleModal" data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Cancelar</i>
              </button>
            </td>
        </tr>';
      }
      
    }else if ($agente['d_status_solicitud'] != "Aceptado") {
      $obj->addScript("Swal.fire({
          title: 'Bandeja',
          text: 'No tienes Pases pendiente.',
          icon: 'warning',
          color: 'black'
        });");
    }else{
       $obj->addScript("Swal.fire({
          title: 'Bandeja',
          text: 'No ha aceptado el Pase.',
          icon: 'warning',
          color: 'black'
        });");
   }
  $obj->addAssign('solicitud', 'innerHTML', $html);
  $obj->addScript("datatable('grid');");
  return $obj;
}

function CancelModal($form){
  $obj = new xajaxResponse('UTF-8');
  $loginModel = new solicitudModel();
  $result = $loginModel->getSoliById($form);
  $html = "";

  $id_profesor = $form;
  $obj->addAssign('id_profesor', 'value', $id_profesor);

  $html = "<div class = 'form-group'>
    <textarea type = 'text'  name = 'textarea' class = 'form-control' id = 'textarea' value = ></textarea>
    <p class= 'parrafo' id = 'textarea'></p>
  </div>";
  $obj->addAssign('form', 'innerHTML', $html);
  return $obj;  
}

function UpdateModal1($form){
  $obj = new xajaxResponse('UTF-8');
  $loginModel = new solicitudModel();

  if ($form['textarea'] != '') {
    $result = $loginModel->UpdateSoliCancel($form);
    if($result){
      $obj->addScript("Swal.fire({
        title: '¡Cancelada!',
        text: 'El pase ha sido cancelado.',
        icon: 'success',
        color: 'black'

      });");
      //REDIRECTION
      $obj->addScript("setTimeout(function(){ window.location='user_2';},1000)");
      //
    }else{
      $obj->addScript("Swal.fire({
        title: 'No se pudo Cancelar!',
        text: 'El pase no se pudo cancelar.',
        icon: 'error',
        color: 'black'
      });");
    }
  }else{
    $obj->addScript("Swal.fire({
      title: '¡Aviso!',
      text: 'El campo esta vacio.',
      icon: 'error',
      color: 'black'
    });");
  }
  return $obj;
}

function UpdateModal($form){
  $obj = new xajaxResponse('UTF-8');
  $loginModel = new solicitudModel();
  $result = $loginModel->ShowSoli2();
  if ($form != ""){
    $Update = $loginModel->UpdateSoli($form);
    if($Update){
      $obj->addScript("Swal.fire({
        title: '¡Aceptada!',
        text: 'El pase ha sido aceptado.',
        icon: 'success',
        color: 'black'
      });");
      //REDIRECTION
      $obj->addScript("setTimeout(function(){ window.location='user_2';},1000)");
      //
    }else{
      $obj->addScript("Swal.fire({
        title: '¡Hubo un error!',
        text: 'No se ha podido aceptar el pase.',
        icon: 'error',
        color: 'black'
      });");
    }
  }else{
  	$obj->addScript("Swal.fire({
      title: 'Bandeja',
      text: 'No hay Pase.',
      icon: 'error',
      color: 'black'
    });");
  }
   $obj->addAssign('solicitud1', 'innerHTML', $html);
   $obj->addScript("datatable('grid1');");
  	return $obj;
  }
  
  function ShowSolicitud1(){
  $obj = new xajaxResponse('UTF-8');
  $loginModel = new solicitudModel();
  $result = $loginModel->ShowSoli2();
  $html = "";
  //var_dump($result);

    $html="<div class='table-responsive';>
      <table id='grid1' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black;color:white;'>
            <th class='text-center' style='width: 6%;'>Nro Pase</th>
            <th class='text-center' style='width: 6%;'>Status Pase</th>
            <th class='text-center' style='width: 10%;'>Fecha y hora Pase</th>
            <th class='text-center' style='width: 6%;'>Directivo</th>
            <th class='text-center' style='width: 6%;'>Alumno</th>
            <th class='text-center' style='width: 6%;'>Aseccion</th>
            <th class='text-center' style='width: 6%;'>Motivo</th>
            <th class='text-center' style='width: 6%;'>Anexo</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
      

        $html.= 
        '<tr class = text-center>
          <td>'.$agente['id_solicitud'].'</td>
          <td style = "background-color: green; color: white;">'.$agente['d_status_solicitud'].'</td>
          <td>'.substr($agente['fecha_solicitud'],0,16).'</td>
          <td>'.$agente['director'].'</td>
          <td>'.$agente['alumno'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['d_motivo'].'</td>
          <td>'.$agente['anexo'].'</td>
        </tr>';
      }
  $obj->addAssign('solicitud1', 'innerHTML', $html);
  $obj->addScript("datatable('grid1');");
  return $obj;
}

 function ShowSolicitud2(){
  $obj = new xajaxResponse('UTF-8');
  $loginModel = new solicitudModel();
  $result = $loginModel->ShowSoli3();
  $html = "";
  //var_dump($result);
    $html="<div class='table-responsive';>
      <table id='grid2' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black;color:white;'>
            <th class='text-center' style='width: 6%;'>Nro Pase</th>
            <th class='text-center' style='width: 6%;'>Status Pase</th>
            <th class='text-center' style='width: 10%;'>Fecha y hora Pase</th>
            <th class='text-center' style='width: 6%;'>Directivo</th>
            <th class='text-center' style='width: 6%;'>Alumno</th>
            <th class='text-center' style='width: 6%;'>Aseccion</th>
            <th class='text-center' style='width: 6%;'>Motivo</th>
            <th class='text-center' style='width: 6%;'>Anexo</th>
            <th class='text-center' style='width: 6%;'>Motivo de Cancelacion</th>

           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
      
        $html.= 
        '<tr class = text-center>
          <td>'.$agente['id_solicitud'].'</td>
          <td style = "background-color: red; color: white;">'.$agente['d_status_solicitud'].'</td>
          <td>'.substr($agente['fecha_solicitud'],0,16).'</td>
          <td>'.$agente['director'].'</td>
          <td>'.$agente['alumno'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['d_motivo'].'</td>
          <td>'.$agente['anexo'].'</td>
          <td>'.$agente['text_cancelacion'].'</td>
        </tr>';
      }
   //var_dump($agente);
  $obj->addAssign('solicitud2', 'innerHTML', $html);
  $obj->addScript("datatable('grid2');");
  return $obj;
}
  
  $xajax->registerFunction("ShowSolicitud");
  $xajax->registerFunction("ShowSolicitud1");
  $xajax->registerFunction("UpdateModal");
  $xajax->registerFunction("CancelModal");
  $xajax->registerFunction("ShowSolicitud2");
  $xajax->registerFunction("volver");
  $xajax->registerFunction("UpdateModal1");

  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();    
?>