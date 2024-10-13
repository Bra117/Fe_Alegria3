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

function ShowAseccion2($value){
    $obj = new xajaxResponse('UTF-8');
    $usuarioModel = new register_alumnoModel($value);
    $result = $usuarioModel->ShowAseccionesRol2($value);

    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Estaus</th>
            <th class='text-center' style='width: 6%;'>Fecha_nacimiento</th>
            <th class='text-center' style='width: 6%;'>Sexo</th>
            <th class='text-center' style='width: 6%;'>Nombre y Apellido</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 6%;'>Cedula</th>
            <th class='text-center' style='width: 6%;'>Inasistente</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
        
      if($agente['status'] != "Inactivo"){
        $html.= 
        '<tr class = text-center>
          <td>'.$agente['status'].'</td>
          <td>'.$agente['fecha_nac'].'</td>
          <td>'.$agente['d_sexo'].'</td>
          <td>'.$agente['fullname'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['cedula'].'</td> <td style="width: 10%;">
            <div class="btn-group">
               <input name = "id_alumno_inasistente" id = "id_alumno_inasistente" type = "checkbox" value='.$agente['id_alumno'].'></input>
            </div>
          </td>         
        </tr>';
      }else{
        $html.= 
        '<tr class = text-center>
          <td style = "color: red;" >'.$agente['status'].'</td>
          <td>'.$agente['fecha_nac'].'</td>
          <td>'.$agente['d_sexo'].'</td>
          <td>'.$agente['fullname'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['cedula'].'</td> <td style="width: 10%;">
            <div class="btn-group">
               <input name = "id_alumno_inasistente" id = "id_alumno_inasistente" type = "checkbox" value='.$agente['id_alumno'].'></input>
            </div>
          </td>         
        </tr>';
      }
    }
    //var_dump($agente);
   $obj->addAssign('hola2', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");
   return $obj;
}

function SelectSeccion2(){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new register_alumnoModel();
  $result = $usuarioModel->SelectAseccionRol2();
  $html="<option>Secciones</option>";

  for ($i=0; $i <$result['numRows']; $i++) { 
    $row = pg_fetch_assoc($result['query'], $i);

    $html.="<option value = ".$row["id_aseccion"].">".$row["aseccion"]."</option>";};

    $obj->addAssign("SelectSeccion2","innerHTML",$html);
  return $obj;
}

function ValidationCkeckbox($value){
  $obj   = new xajaxResponse('UTF-8');
  $model = new register_alumnoModel();
  $result = $model->getStudentByIdValue($value);
  $Inasis = $model->InasistenciaAlumno($value);
  $Alu = $model->getStudentByIdVal($value);
  $html = "";
 //var_dump($Alu);
  if ($result > 1){
    if($Alu['id_status'] == 2){
      $obj->addScript("Swal.fire({
        title: '¡No se puede colocar Inasistente!',
        text: ' El alumno ".$Alu["nombre"]." ".$Alu["apellido"]."  Con cedula: ".$Alu["cedula"]." esta inactivo.',
        icon: 'warning',
        color: 'black'
      });");
    }else{ 
      $insert = $model->InsertInasistencia($value);
      if($insert){
        $obj->addScript("Swal.fire({
          title: '¡Enviado!',
          text: 'El Alumno se marco como Inasistente.',
          icon: 'success',
          color: 'black'
        });");
      }else{
        $obj->addScript("Swal.fire({
          title: '¡No se Pudo Enviar!',
          text: 'Hubo un Error.',
          icon: 'error',
          color: 'black'
        });");
      }
    }
  }else{
    $obj->addScript("Swal.fire({
      title: '¡No se Pudo Enviar!',
      text: 'No hay Datos.',
      icon: 'error',
      color: 'black'
    });");
  }
  $obj->addAssign("BotonCita","innerHTML",$html);
  //var_dump($Inasis);
  return $obj;
}

function funcionAllPdf($value){
  $obj = new xajaxResponse('UTF-8');
  $id_alumno = base64_encode(base64_encode($value));

  $obj->addScript("window.open('pdf/pdf/?cod=".$id_alumno."');");
  return $obj;
}

function ResetInasistencia($value){
  date_default_timezone_set('UTC');
  $obj = new xajaxResponse('UTF-8');
  $month  = date('m');
  $year = date('Y');
  $model = new register_alumnoModel;
  $result = $model->CountInasistencias($value, $month, $year);
  $Alu = $model->getStudentByIdVal($value);
  //var_dump($result);

  $html = "";
  if($Alu['id_status'] == 2){
    $obj->addScript("Swal.fire({
      title: '¡No se puede colocar Inasistente!',
      text: ' El alumno ".$Alu["nombre"]." ".$Alu["apellido"]."  Con cedula: ".$Alu["cedula"]." esta inactivo.',
      icon: 'warning',
      color: 'black'
    });"); 
  }else{

    for ($i=0; $i <$result['numRows']; $i++) { 
      $row = pg_fetch_assoc($result['query'], $i);

      if ($row['total_inasistencias'] == 3) {
        $obj->addScript("Swal.fire({
          title: '¡No se Pudo Enviar!',
          text: ' El alumno ".$Alu["nombre"]." ".$Alu["apellido"]." Con cedula: ".$Alu["cedula"]." Ya Cuenta con 3 Inasistencia.',
          icon: 'error',
          color: 'black'
        });");
      }else{
            
      }
    }
  }
  $obj->addAssign("BotonCita","innerHTML",$html);
  return $obj;
}



  $xajax->registerFunction("ResetInasistencia");
  $xajax->registerFunction("funcionAllPdf");
  $xajax->registerFunction("volver");
  $xajax->registerFunction("ShowAseccion2");
  $xajax->registerFunction("SelectSeccion2");
  $xajax->registerFunction("ValidationCkeckbox");




  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();
?>

