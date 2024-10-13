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

  function BuscarAlumnoInas($form){
    $obj = new xajaxResponse('UTF-8');
    $usuarioModel = new register_alumnoModel();
    $result = $usuarioModel->TableInas2($form);
  
    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color: white;'>
            <th class='text-center' style='width: 6%;'>Nro Estudiante</th>
            <th class='text-center' style='width: 6%;'>Estatus Estudiante</th>
            <th class='text-center' style='width: 6%;'>Estatus Inasistencia</th>
            <th class='text-center' style='width: 6%;'>Cedula</th>
            <th class='text-center' style='width: 6%;'>Nombre</th>
            <th class='text-center' style='width: 6%;'>Apellido</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 15%;'>Fecha Inasistencia H-M</th>
            <th class='text-center' style='width: 6%;'>Profesor</th>
            <th class='text-center' style='width: 6%;'>Observacion De anulacion</th>
            <th class='text-center' style='width: 6%;'>Status Inasistencia</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
       //var_dump($agente);

      if ($result['numRows'] >= 3){
      if($agente['d_status_inasistencia'] != 'Vigente'){
        $html.= '<tr class = text-center>
          <td style = "background-color: red; color: white;">'.$agente['id_alumno'].'</td>
          <td>'.$agente['d_status'].'</td>
          <td style = "color: red;">'.$agente['d_status_inasistencia'].'</td>
          <td>'.$agente['cedula'].'</td>
          <td>'.$agente['nombre'].'</td>
          <td>'.$agente['apellido'].'</td>
          <td>'.$agente['d_aseccion'].'</td>
          <td>'.substr($agente['fecha'],0,16).'</td>
          <td>'.$agente['fullname'].'</td>
          <td>'.$agente['observacion_anulacion'].'</td>
            <td style="width: 10%;">
              <div class="btn-group">
                <button type="button" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarInasis('.$agente['id_alumno'].', '.$agente['id_inasistencia'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Cambiar Status</i>
                </button>
              </div>
            </td>
        </tr>';
        }else{
          $html.= '<tr class = text-center>
          <td style = "background-color: red; color: white;">'.$agente['id_alumno'].'</td>
          <td>'.$agente['d_status'].'</td>
          <td  style = "color: green;">'.$agente['d_status_inasistencia'].'</td>
          <td>'.$agente['cedula'].'</td>
          <td>'.$agente['nombre'].'</td>
          <td>'.$agente['apellido'].'</td>
          <td>'.$agente['d_aseccion'].'</td>
          <td>'.substr($agente['fecha'],0,16).'</td>
          <td>'.$agente['fullname'].'</td>
          <td>'.$agente['observacion_anulacion'].'</td>
            <td style="width: 10%;">
              <div class="btn-group">
                <button type="button" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarInasis('.$agente['id_alumno'].' , '.$agente['id_inasistencia'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Cambiar Status</i>
                </button>
              </div>
            </td>
        </tr>';
        }
      }else{
        $html.= '<tr class = text-center>
          <td>'.$agente['id_alumno'].'</td>
          <td>'.$agente['d_status'].'</td>
          <td>'.$agente['d_status_inasistencia'].'</td>
          <td>'.$agente['cedula'].'</td>
          <td>'.$agente['nombre'].'</td>
          <td>'.$agente['apellido'].'</td>
          <td>'.$agente['d_aseccion'].'</td>
          <td>'.substr($agente['fecha'],0,16).'</td>
          <td>'.$agente['fullname'].'</td>
          <td>'.$agente['observacion_anulacion'].'</td>
            <td style="width: 10%;">
              <div class="btn-group">
                <button type="button" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarInasis('.$agente['id_alumno'].', '.$agente['id_inasistencia'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Cambiar Status</i>
                </button>
              </div>
            </td>
        </tr>';
      }
   }
    //var_dump($timestamp);
   $obj->addAssign('hola2', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");	
   return $obj;
  }

 
  function ModificarInasis($id_student, $id_inas){
    $obj = new xajaxResponse('UTF-8');
    $usuarioModel = new register_alumnoModel();
    $result = $usuarioModel->StatusInasistencia($id_student);
    $result1 = $usuarioModel->IdInasistencia($id_inas);

    $html = "";

    $id_alumno = $id_student;
    $obj->addAssign('id_student', 'value', $id_alumno);

    $id_inas = $id_inas;
    $obj->addAssign('id_inas', 'value', $id_inas);

  
    $html="<option disabled hidden selected>Seleccione</option>";

    for ($i=0; $i <$result['numRows']; $i++) { 
        $row = pg_fetch_assoc($result['query'], $i);

        $html.="<option value = ".$row["id_status_inasistencia"].">".$row["d_status_inasistencia"]."</option>"
                ;};
    //svar_dump($result);
    $obj->addAssign('SelectStInas', 'innerHTML', $html);
    return $obj;
  }

  function showCampoTexto($value){
    $obj = new xajaxResponse('UTF-8');
    $html = "";

    if($value == 2) {
      $html = 
      "<label for = 'message'></label>        
        <textarea name = 'message' placeholder = 'Motivo De Anulacion' id = 'message_input' cols = '30' rows = '5'></textarea>";
     //var_dump($value);
    }else{

    }
    $obj->addAssign('Message', 'innerHTML', $html);
    return $obj;
  }

  function UpdateInas($form){
    $obj = new xajaxResponse('UTF-8');
    $usuarioModel = new register_alumnoModel();
    //var_dump($form);

    if ($form['SelectStInas'] != "" || $form['SelectStInas'] != "Seleccione" && $form['message'] != "") {
      $Update = $usuarioModel->UpdateInasistencia($form);
      if($Update){
        $obj->addScript("Swal.fire({
          title: '¡Éxito!',
          text: '¡Se ha Actualizado Correctamente!.',
          icon: 'success',
          color: 'black'
        });");
        //REDIRECTION
        $obj->addScript("setTimeout(function(){window.location='consulta_inasistencia2';},1000)");
        //
      }else{
        $obj->addScript("Swal.fire({
          title: '¡Error!',
          text: '¡No se pudo actualizar!.',
          icon: 'error',
          color: 'black'
        });");
      }
    }else{
      $obj->addScript("Swal.fire({
        title: 'Revise!',
        text: '¡No puede Haber Campo vacío!.',
        icon: 'warning',
        color: 'black'
      });");
    }
    //var_dump($form);
    return $obj;
  }

  $xajax->registerFunction("UpdateInas");  
  $xajax->registerFunction("showCampoTexto");  
  $xajax->registerFunction("ModificarInasis");
  $xajax->registerFunction("BuscarAlumnoInas");
  $xajax->registerFunction("volver");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();  
?>