<?php
 require('app/plugins/xajax/xajax.inc.php');
 //instanciamos el objeto de la clase xajax
 $xajax = new xajax();
function volver(){
   	$obj = new xajaxResponse('UTF-8');
   	session_destroy();
   	$obj->addRedirect("user_1");
  	return $obj;
}

function ShowAseccion($value){
    $obj = new xajaxResponse('UTF-8');
    $usuarioModel = new register_alumnoModel($value);
    $result = $usuarioModel->ShowAseccionesEstadistic($value);
    //var_dump($result['row']['status']);

    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Estatus</th>
            <th class='text-center' style='width: 6%;'>Fecha nacimiento</th>
            <th class='text-center' style='width: 6%;'>Sexo</th>
            <th class='text-center' style='width: 6%;'>Nombre y Apellido</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula</th>
            <th class='text-center' style='width: 6%;'>Total Inasistencia</th>
            <th class='text-center' style='width: 6%;'>Vigente</th>
            <th class='text-center' style='width: 6%;'>Anulado</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
      
      if ($agente['status'] == 'Activo'){
        if($agente['inasistencia_real'] >= 3){
          $html.='<tr class = text-center>
            <td style = "color:green;">'.$agente['status'].'</td>
            <td>'.$agente['fecha_nac'].'</td>
            <td>'.$agente['d_sexo'].'</td>
            <td>'.$agente['fullname'].'</td>
            <td>'.$agente['aseccion'].'</td>
            <td>'.$agente['cedula'].'</td>
            <td  style = "color: red;">'.$agente['inasistencia_real'].'</td> 
            <td>'.$agente['vigentes'].'</td> 
            <td>'.$agente['anuladas'].'</td> ';
        }else{
          $html.='<tr class = text-center>
            <td style = "color:green;">'.$agente['status'].'</td>
            <td>'.$agente['fecha_nac'].'</td>
            <td>'.$agente['d_sexo'].'</td>
            <td>'.$agente['fullname'].'</td>
            <td>'.$agente['aseccion'].'</td>
            <td>'.$agente['cedula'].'</td>
            <td>'.$agente['inasistencia_real'].'</td> 
            <td>'.$agente['vigentes'].'</td> 
            <td>'.$agente['anuladas'].'</td> ';
          '</td>';
        }
      }else{
        $html.='<tr class = text-center>
          <td style = "color: red;";>'.$agente['status'].'</td>
          <td>'.$agente['fecha_nac'].'</td>
          <td>'.$agente['d_sexo'].'</td>
          <td>'.$agente['fullname'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['cedula'].'</td>
          <td>'.$agente['inasistencia_real'].'</td>             
          <td>'.$agente['vigentes'].'</td> 
          <td>'.$agente['anuladas'].'</td>';
      }
    }
   $obj->addAssign('hola', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");
   return $obj;
  }
  

function SelectSeccion(){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new register_alumnoModel();
  $result = $usuarioModel->SelectAseccion();
  $html="<option>Secciones</option>";

  for ($i=0; $i <$result['numRows']; $i++) { 
    $row = pg_fetch_assoc($result['query'], $i);

    $html.= "<option value = ".$row["id_aseccion"].">".$row["aseccion"]."</option>";
  };

  $obj->addAssign("SelectSeccion","innerHTML",$html);
  return $obj;
}

function countDataAjax($value){

  $obj = new xajaxResponse('UTF-8');
  $grafModel = new register_alumnoModel();
  $seccion = $grafModel->getSeccionById2($value);
 // var_dump($seccion["row"]["desc_seccion"]);
  $arrContador = array();
  $data = $grafModel->gr_general2($value);
  $arrContador = [
    "inasistencia_real" =>$data['row']['inasistencia_real'],
    "total_inasistencias" =>$data['row']['total_inasistencias'],
    "inasistencia_vigentes" =>$data['row']['vigentes'],
    "inasistencias_anuladas" =>$data['row']['anuladas']
  ];
    $json = json_encode($arrContador);
 
    //  $obj->addScript("contadoresPrincipales(".$json.")");
  $obj->addScript(" grafica(".$json.")");
  //$obj->addScript("contadoresPrincipales(".$json.")");
  //var_dump($data);
  return $obj; 
} 

function countDataAjax2(){

  $obj = new xajaxResponse('UTF-8');
  $grafModel = new register_alumnoModel();
  $seccion = $grafModel->getSeccionByIdArray();
  // var_dump($seccion["row"]["desc_seccion"]);
  $arrContador = array();
  //var_dump($arrContador);

  $data = $grafModel->gr_general3();
  $arrContador = [
    "secciones" => $seccion['row']['secciones'],
    "total_inasistencias" =>$data['row']['total_inasistencia'],
  ];
    $json = json_encode($arrContador);
 
    //  $obj->addScript("contadoresPrincipales(".$json.")");
  $obj->addScript(" grafica2(".$json.")");
  //var_dump($arrContador);  
  //$obj->addScript("contadoresPrincipales(".$json.")");
  return $obj; 
} 

  $xajax->registerFunction("countDataAjax2");
  $xajax->registerFunction("countDataAjax");
  $xajax->registerFunction("ShowAseccion");
  $xajax->registerFunction("SelectSeccion");
  $xajax->registerFunction("volver");


  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();
?>