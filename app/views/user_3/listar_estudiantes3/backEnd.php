<?php
require('app/plugins/xajax/xajax.inc.php');
//instanciamos el objeto de la clase xajax
$xajax = new xajax();

function volver(){
  $obj = new xajaxResponse('UTF-8');
  session_destroy();
  $obj->addRedirect("login");
  return $obj;
}   

function ShowAseccion1($value){
    $obj = new xajaxResponse('UTF-8');
    $usuarioModel = new register_alumnoModel($value);
    $result = $usuarioModel->ShowAseccionesRol3($value);
    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: #df4e4e;color:#fff;'>
            <th class='text-center' style='width: 6%;'>Estaus</th>
            <th class='text-center' style='width: 6%;'>Fecha_nacimiento</th>
            <th class='text-center' style='width: 6%;'>Sexo</th>
            <th class='text-center' style='width: 6%;'>Nombre y Apellido</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 6%;'>Cedula</th>
            <th class='text-center' style='width: 6%;'>Accion</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
      
        $html.= 
        '<tr class = text-center>
          <td>'.$agente['status'].'</td>
          <td>'.$agente['fecha_nac'].'</td>
          <td>'.$agente['d_sexo'].'</td>
          <td>'.$agente['fullname'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['cedula'].'</td> <td style="width: 10%;">
            <div class="btn-group">
               <input type = "checkbox"></input>
              </button>
            </div>
          </td>         
        </tr>';
    }
   $obj->addAssign('hola1', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");
   return $obj;
  }

  function SelectSeccion1(){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new register_alumnoModel();
  $result = $usuarioModel->SelectAseccionRol3();
         $html="
         <option>Secciones</option>";

    for ($i=0; $i <$result['numRows']; $i++) { 
        $row = pg_fetch_assoc($result['query'], $i);

        $html.="
        <option value = ".$row["id_aseccion"].">".$row["aseccion"]."</option>";};

        $obj->addAssign("SelectSeccion1","innerHTML",$html);
    return $obj;
  }

  $xajax->registerFunction("volver");
  $xajax->registerFunction("ShowAseccion1");
  $xajax->registerFunction("SelectSeccion1");


  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();
?>