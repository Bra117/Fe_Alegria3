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
    $usuarioModel = new pedagogiaModel($value);
    $result = $usuarioModel->ShowAsecciones($value);
    $ConsultaAlumno = $usuarioModel->ConsultaAlumno($result['row']['cedula']);

    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Estaus</th>
            <th class='text-center' style='width: 6%;'>Fecha_nacimiento</th>
            <th class='text-center' style='width: 6%;'>Sexo</th>
            <th class='text-center' style='width: 6%;'>Nombre y Apellido</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula</th>
            <th class='text-center' style='width: 6%;'>Total Inasistencia</th>
            <th class='text-center' style='width: 6%;'>Total Consulta</th>
           </tr> 
        </thead>
        <tbody>"; 
    
     for ($i=0; $i < $ConsultaAlumno['numRows']; $i++) { 
         $row = pg_fetch_assoc($ConsultaAlumno['query'], $i);

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);

      if($agente['status'] != "Inactivo"){
        if($agente['alumno_inasistencia'] >= 3){
          $html.= '<tr class = text-center>
            <td style = "color: green;">'.$agente['status'].'</td>
            <td>'.$agente['fecha_nac'].'</td>
            <td>'.$agente['d_sexo'].'</td>
            <td>'.$agente['fullname'].'</td>
            <td>'.$agente['aseccion'].'</td>
            <td>'.$agente['cedula'].'</td>
            <td style = "color: red;">'.$agente['alumno_inasistencia'].'</td>
            <td>'.$row['consulta_alumno'].'</td>';
        }else{
          $html.= '<tr class = text-center>
            <td style = "color: green;">'.$agente['status'].'</td>
            <td>'.$agente['fecha_nac'].'</td>
            <td>'.$agente['d_sexo'].'</td>
            <td>'.$agente['fullname'].'</td>
            <td>'.$agente['aseccion'].'</td>
            <td>'.$agente['cedula'].'</td>
            <td>'.$agente['alumno_inasistencia'].'</td>
          </tr>';
        }
      }else{
        $html.= '<tr class = text-center>
          <td  style = "color: red;">'.$agente['status'].'</td>
          <td>'.$agente['fecha_nac'].'</td>
          <td>'.$agente['d_sexo'].'</td>
          <td>'.$agente['fullname'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['cedula'].'</td>
          <td>'.$agente['alumno_inasistencia'].'</td>  
        </tr>';
      }   
    }
  }
  //var_dump($row);
  $obj->addAssign('hola', 'innerHTML', $html);
  $obj->addScript("datatable('grid');");
  return $obj;
}

function SelectSeccion(){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new pedagogiaModel();
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
  $grafModel = new pedagogiaModel();
  $seccion = $grafModel->getSeccionById($value);
 // var_dump($seccion["row"]["desc_seccion"]);
  $arrContador = array();
  $data = $grafModel->gr_general($value);
  $arrContador = [
    "aseccion_consulta" =>$data['row']['aseccion_consulta'],
    "total_consulta" =>$data['row']['total_consulta'],
    "desc_seccion"=>$seccion["row"]["desc_seccion"],
  ];
    $json = json_encode($arrContador);

    //  $obj->addScript("contadoresPrincipales(".$json.")");
  $obj->addScript("grafica(".$json.")");
  //$obj->addScript("contadoresPrincipales(".$json.")");
  //var_dump($data);
  return $obj; 
} 

  $xajax->registerFunction("countDataAjax");
  $xajax->registerFunction("SearchCedula");
  $xajax->registerFunction("ShowAseccion");
  $xajax->registerFunction("SelectSeccion");
  $xajax->registerFunction("volver");


  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests(); 
?>