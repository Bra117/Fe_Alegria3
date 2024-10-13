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
    $result = $loginModel->ShowSoliUser1();
    $html = "";
    
    $html="<div class='table-responsive';>
      <table id='grid1' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Nro Pase</th>
            <th class='text-center' style='width: 6%;'>Status Pase</th>
            <th class='text-center' style='width: 15%;'>Fecha Pase H-M</th>
            <th class='text-center' style='width: 6%;'>Directivo</th>
            <th class='text-center' style='width: 6%;'>Profesor</th>
            <th class='text-center' style='width: 6%;'>Alumno</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 6%;'>Motivo</th>
            <th class='text-center' style='width: 6%;'>Anexo</th>
            <th class='text-center' style='width: 6%;'>Motivo de Cancelaci&oacuten</th>
           </tr> 
        </thead>
        <tbody>";
    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
       
      $id_alumno = $agente['id_solicitud'];
      $obj->addAssign('id_student', 'value', $id_alumno); 
      
      if($agente['d_status_solicitud'] == 'Cancelado'){
        $html.= 
        '<tr class = text-center>
          <td>'.$agente['id_solicitud'].'</td>
          <td style = "color:red;">'.$agente['d_status_solicitud'].'</td>
          <td>'.substr($agente['fecha_solicitud'],0,16).'</td>
          <td>'.$agente['director'].'</td>
          <td>'.$agente['profesor'].'</td>
          <td>'.$agente['alumno'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['d_motivo'].'</td>
          <td>'.$agente['anexo'].'</td>
          <td>'.$agente['text_cancelacion'].'</td>
        </tr>';
      }else if($agente['d_status_solicitud'] == 'Enviado'){
        $html.= 
        '<tr class = text-center>
          <td>'.$agente['id_solicitud'].'</td>
          <td style = "color:#0d8aff;">'.$agente['d_status_solicitud'].'</td>
          <td>'.substr($agente['fecha_solicitud'],0,16).'</td>
          <td>'.$agente['director'].'</td>
          <td>'.$agente['profesor'].'</td>
          <td>'.$agente['alumno'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['d_motivo'].'</td>
          <td>'.$agente['anexo'].'</td>
          <td>'.$agente['text_cancelacion'].'</td>
        </tr>';
      }else if($agente['d_status_solicitud'] == 'Aceptado'){
        $html.= 
        '<tr class = text-center>
          <td>'.$agente['id_solicitud'].'</td>
          <td style = "color:#34c916;">'.$agente['d_status_solicitud'].'</td>
          <td>'.substr($agente['fecha_solicitud'],0,16).'</td>
          <td>'.$agente['director'].'</td>
          <td>'.$agente['profesor'].'</td>
          <td>'.$agente['alumno'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['d_motivo'].'</td>
          <td>'.$agente['anexo'].'</td>
          <td>'.$agente['text_cancelacion'].'</td>
        </tr>';
      }
    }
    //var_dump($id_alumno);
    $obj->addAssign('solicitud', 'innerHTML', $html);
    $obj->addScript("datatable('grid1');");
   return $obj;
  }

  function countDataAjax(){

    $obj = new xajaxResponse('UTF-8');
    $grafModel = new solicitudModel();
    $soli = $grafModel->getSoliById();

    $arrContador = array();
    $data = $grafModel->gr_general();
    $arrContador = [
      "enviado" =>$data['row']['enviado'],
      "aceptado" =>$data['row']['aceptado'],
      "cancelado"=>$data["row"]["cancelado"]
    ];
    $json = json_encode($arrContador);

    //  $obj->addScript("contadoresPrincipales(".$json.")");
    $obj->addScript(" grafica(".$json.")");
    //$obj->addScript("contadoresPrincipales(".$json.")");*/
    return $obj; 
  }
  $xajax->registerFunction("volver");
  $xajax->registerFunction("countDataAjax");
  $xajax->registerFunction("ShowSolicitud");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();
?>