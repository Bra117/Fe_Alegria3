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
    $usuarioModel = new register_alumnoModel();
    $result = $usuarioModel->ShowAsecciones($value);

    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Estatus</th>
            <th class='text-center' style='width: 6%;'>Fecha_nacimiento</th>
            <th class='text-center' style='width: 6%;'>Sexo</th>
            <th class='text-center' style='width: 6%;'>Nombre y Apellido</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula</th>
            <th class='text-center' style='width: 6%;'>Total Inasistencia</th>
            <th class='text-center' style='width: 6%;'>Inasistencia Vigentes</th>
            <th class='text-center' style='width: 6%;'>Inasistencia Anuladas</th>
            <th class='text-center' style='width: 6%;'>Editar Estudiante</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);

      if($agente['status'] != "Inactivo"){
        if($agente['inasistencia_real'] >= 3){
          $html.= '<tr class = text-center>
            <td style = "color: green;">'.$agente['status'].'</td>
            <td>'.$agente['fecha_nac'].'</td>
            <td>'.$agente['d_sexo'].'</td>
            <td>'.$agente['fullname'].'</td>
            <td>'.$agente['aseccion'].'</td>
            <td>'.$agente['cedula'].'</td>
            <td style = "color: red;">'.$agente['inasistencia_real'].'</td>
            <td>'.$agente['vigentes'].'</td>
            <td>'.$agente['anuladas'].'</td>
            <td style="width: 10%;">
              <div class="btn-group">
                <button type="button" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarStudent('.$agente['id_alumno'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Editar</i>
                </button>
              </div>
            </td>         
          </tr>';
        }else{
          $html.= '<tr class = text-center>
            <td style = "color: green;">'.$agente['status'].'</td>
            <td>'.$agente['fecha_nac'].'</td>
            <td>'.$agente['d_sexo'].'</td>
            <td>'.$agente['fullname'].'</td>
            <td>'.$agente['aseccion'].'</td>
            <td>'.$agente['cedula'].'</td>
            <td>'.$agente['inasistencia_real'].'</td>
            <td>'.$agente['vigentes'].'</td>
            <td>'.$agente['anuladas'].'</td>
            <td style="width: 10%;">
              <div class="btn-group">
                <button type="button" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarStudent('.$agente['id_alumno'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Editar</i>
                </button>
              </div>
            </td>         
          </tr>';
        }
      }else{
        $html.= '<tr class = text-center>
          <td style = "color: red;">'.$agente['status'].'</td>
          <td>'.$agente['fecha_nac'].'</td>
          <td>'.$agente['d_sexo'].'</td>
          <td>'.$agente['fullname'].'</td>
          <td>'.$agente['aseccion'].'</td>
          <td>'.$agente['cedula'].'</td>
          <td>'.$agente['inasistencia_real'].'</td>
          <td>'.$agente['vigentes'].'</td>
          <td>'.$agente['anuladas'].'</td>
          <td style="width: 10%;">
            <div class="btn-group">
              <button type="button" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarStudent('.$agente['id_alumno'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Editar</i>
              </button>
            </div>
          </td>         
        </tr>';
      }   
    }
    
   $obj->addAssign('hola', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");
   return $obj;
  }
  
function ModificarStudent($id_student){
 $obj = new xajaxResponse('UTF-8');
 $usuarioModel = new register_alumnoModel();
 $agente = $usuarioModel->getStudentById($id_student);
 $aseccion = $usuarioModel->SelectAseccion();
 $html = "";  
 //var_dump($form);
  $id_alumno = $agente['id_alumno'];
  $obj->addAssign('id_student', 'value', $id_alumno);
  //var_dump($agente);
  $html=
  "<div class = 'form-group'>
    <label for = 'message-text' class = 'col-form-label'>Cedula</label>
    <input   style = 'width: 320px;' type = 'text'  name = 'cedula' class = 'form-control' id = 'cedula' onBlur=validateField() value = '".$agente['cedula']."'></input>
    <p class= 'parrafo' id = 'parrafoCedula'></p>
  </div>
  <div class = 'form-group'>
    <label for = 'message-text' class = 'col-form-label'>Nombre</label>
    <input  style = 'width: 320px;' type = 'text'  name = 'nombre' class = 'form-control' id = 'nombre' onBlur=validateField() value = '".$agente['nombre']."'></input>
 <p class= 'parrafo' id = 'parrafoNombre'></p>
  </div> 
  <div class = 'form-group'>
    <label for = 'message-text' class = 'col-form-label'>Apellido</label>
    <input  style = 'width: 320px;' type = 'text'  name = 'apellido' class = 'form-control' id = 'apellido' onBlur=validateField() value = '".$agente['apellido']."'></input>
  <p class= 'parrafo' id = 'parrafoApellido'></p>
  </div>
  <div class = 'form-group'>
    <label for = 'message-text' class = 'col-form-label'>Fecha de Nacimiento</label>
    <input  style = 'width: 320px;' type = 'date'  name = 'fecha_nac' class = 'form-control' id = 'fecha_nac' onBlur=validateField() value = '".$agente['fecha_nac']."';
></input>
 <p class= 'parrafo' id = 'parrafocorreo'></p>
 <div name = 'SelectAseccion'></div>";

  $html.="<label style = 'margin-top: -10px;class = 'col-form-label'>Secciones</label>
  <select margin-top: 10px class='form-select' aria-label='Default select example' style = 'width: 80px;'  id = 'aseccion' name = 'aseccion' value = '".$agente['d_aseccion']."'>";
  for ($i=0; $i <$aseccion['numRows'];$i++) {
  $row = pg_fetch_assoc($aseccion['query'], $i);
    $html.="<option value='".$row['id_aseccion']."'>".$row['aseccion']."</option>";
  }

  $html.="</select><br>";
   
   $html.= "<p style = 'color: red; margin-top: -20px;'>Revise la Seccion</p>
   <div class = 'form-group'>
    <label style = 'margin-top: -115px; margin-left: 200px;' for = 'message-text' class = 'col-form-label'>Status</label>
    <select style = 'width: 120px; margin-top: -80px; margin-left: 200px;' class='form-select' type = 'select'  name = 'status' id = 'status'>
    <option disabled hidden selected value = '".$agente['id_status']."'>".$agente['d_status']."</option>
    <option value = 1>Activo</option>
    <option value = 2>Inactivo</option>
    </select>
  </div><br>

  <div class = 'form-group'>
    <label style = 'margin-top: -40px; for = 'message-text' class = 'col-form-label'>Sexo</label>
    <select style = 'width: 120px;' class='form-select' type = 'select'  name = 'sexo' id = 'sexo'>
    <option disabled hidden selected value = '".$agente['id_sexo']."'>".$agente['d_sexo']."</option>
    <option value = 1>Masculino</option>
    <option value = 2>Femenino</option>
    </select>
  </div>";

  $obj->addScript("$(document).ready(function(){
    $.mask.definitions['~']='[VE]';
    $('#cedula').mask('~-9?9999999');
  });");

  $obj->addScript("$(document).ready(function(){
  $('#fecha_nac' ).datepicker();
  $('#fecha_nac' ).datepicker('option', 'dateFormat', 'yyyy-mm-dd');
  })");

  
  $obj->addAssign('to', 'innerHTML', $html);
  $obj->addAssign('form', 'innerHTML', $html);
 return $obj;
}

function UpdateStudentInfo($form){
  $obj = new xajaxResponse('UTF-8');
  $html='';
  $Model = new register_alumnoModel();
  $cedula = $Model->getStudentByCedula($form);
  $StatusAseccion = $Model->StatusAseccion1($form);
  //var_dump($form);
  //$usuario  = '^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]^';
   $fecha_actual = date("Y-m-d");
    //var_dump($StatusAseccion);
    // Convertir la fecha de nacimiento a timestamp
    $fecha_nac_timestamp = strtotime($form['fecha_nac']);

    // Calcular la diferencia en segundos entre las fechas
    $diferencia_segundos = time() - $fecha_nac_timestamp;

    // Convertir la diferencia a años (aproximado)
    $edad = floor($diferencia_segundos / (60 * 60 * 24 * 365.25));

  if($cedula['numRows'] != 2){
    if($form['cedula']!='' && $form['nombre']!='' && $form['apellido']!='' && $form['fecha_nac']!=''){
      if(strlen($form['cedula'])  == 10){
        if(preg_match("/^[a-zA-ZñÑ\s]+$/", $form['nombre'])){
          if(preg_match("/^[a-zA-ZñÑ\s]+$/", $form['apellido'])){
            if(strlen($form['nombre']) > 2){
              if(strlen($form['apellido']) > 2){
                if($edad >= 9 && $edad <= 17){
                  if ($StatusAseccion['row']['id_status'] == 1) {
                    $result = $Model->updateStudentInfo($form);
                    if($result){
                      $obj->addScript("Swal.fire({
                        title: '¡Se ha Actualizado!',
                        text: 'Los datos del Alumno se han Actualizado Correctamente.',
                        icon: 'success',
                        color: 'black'
                      });");
                      //REDIRECTION
                      $obj->addScript("setTimeout(function(){ window.location='lista_estudiantes';},1555)");
                      //
                    }else{
                      $obj->addScript("Swal.fire({
                        title: '¡No se puede Actualizar!',
                        text: 'No se puede Actualizar, ha ocurrido un error.',
                        icon: 'warning',
                        color: 'black'
                      });");
                    }
                  }else{
                    $obj->addScript("Swal.fire({
                      title: '¡Sección Inactiva!',
                      text: 'La sección seleccionada está inactiva.',
                      icon: 'warning',
                      color: 'black'
                    });");        
                  }
                }else{
                  $obj->addScript("Swal.fire({
                    title: '¡No se puede Actualizar!',
                    text: 'La Fecha de nacimiento del Alumno debe ser mayor o igual a 2010 o menor o igual a 2006.',
                    icon: 'error',
                    color: 'black'
                  });");
                }
              }else{
                $obj->addScript("Swal.fire({
                  title: '¡No se puede Actualizar!',
                  text: 'El el apellido no puede tener menos de 2 letras.',
                  icon: 'warning',
                  color: 'black'
                });");
              }
            }else{
              $obj->addScript("Swal.fire({
                title: '¡No se puede Actualizar!',
                text: 'El nombre no puede tener menos de 2 letras.',
                icon: 'warning',
                color: 'black'
              });");
            } 
          }else{
            $obj->addScript("Swal.fire({
              title: '¡No se puede Actualizar!',
              text: 'El apellido No se puede haber caracteres especiales.',
              icon: 'error',
              color: 'black'
            });");    
          }
        }else{
          $obj->addScript("Swal.fire({
            title: '¡No se puede Actualizar!',
            text: 'El nombre No puede haber caracteres especiales en el nombre.',
            icon: 'error',
            color: 'black'
          });");  
        }
      }else{
        $obj->addScript("Swal.fire({
          title: '¡No se puede Actualizar!',
          text: 'La cédula no tener menos de 10 dígitos.',
          icon: 'error',
          color: 'black'
        });");
      }
    }else{
      $obj->addScript("Swal.fire({
        title: '¡No se puede Actualizar!',
        text: 'Hay campos vacios',
        icon: 'warning',
        color: 'black'
      });");  
    }
  }else{
    $obj->addScript("Swal.fire({
      title: '¡No se puede Actualizar!',
      text: 'Ya existe esa cedula.',
      icon: 'error',
      color: 'black'
    });");  
  }
  return $obj;
}

function ValidateFieldCedula($form){
 $obj = new xajaxResponse('UTF-8');
 $usuarioModel = new register_alumnoModel();
 $result = $usuarioModel->getStudentByCedula($form);

 if ($form['nombre']=='') {    
    $html = '<p style = "color: red;">No tiene datos</p>';
    $obj->addAssign('parrafoNombre', 'innerHTML', $html);   
  }else{
    $html = '<p style = "color: green;">Verificado</p>';
    $obj->addAssign('parrafoNombre', 'innerHTML', $html);
  }

  if($form['apellido']=='') {
    $html = '<p style = "color: red;">No tiene datos</p>';
    $obj->addAssign('parrafoApellido', 'innerHTML', $html);     
  }else{
    $html = '<p style = "color: green;">Verificado</p>';
    $obj->addAssign('parrafoApellido', 'innerHTML', $html);
  }

  if($form['fecha_nac']=='') {
    $html = '<p style = "color: red;">No tiene datos</p>';
    $obj->addAssign('parrafocorreo', 'innerHTML', $html);     
  }else{
    $html = '<p style = "color: green;">Verificado</p>';
    $obj->addAssign('parrafocorreo', 'innerHTML', $html);
  }
 $html='';
  if ($form['cedula'] != ''){
    if($result['numRows'] != 2){
     $html = '<p style = "color: green;">Verificado</p>';
      $obj->addAssign('parrafoCedula', 'innerHTML', $html);
    }else{
      $html = '<p style = "color: red;">Ya esa cedula esta registrada</p>';
      $obj->addAssign('parrafoCedula', 'innerHTML', $html);
    }
  }else{
     $html = '<p style = "color: red;">No tiene datos</p>';
    $obj->addAssign('parrafoCedula', 'innerHTML', $html);
  }

  $obj->addAssign('parrafoCedula', 'innerHTML', $html);
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

  $obj->addAssign("SelectSeccion1","innerHTML",$html);
  return $obj;
}

function countDataAjax($value){

  $obj = new xajaxResponse('UTF-8');
  $grafModel = new register_alumnoModel();
  $seccion = $grafModel->getSeccionById($value);
 // var_dump($seccion["row"]["desc_seccion"]);
  $arrContador = array();
  $data = $grafModel->gr_general($value);
  $arrContador = [
    "seccion" =>$data['row']['seccion'],
    "total" =>$data['row']['total'],
    "desc_seccion"=>$seccion["row"]["desc_seccion"],
    "inactivo"=>$data["row"]["inactivo"]
  ];
    $json = json_encode($arrContador);

    //  $obj->addScript("contadoresPrincipales(".$json.")");
  $obj->addScript("grafica(".$json.")");
  //$obj->addScript("contadoresPrincipales(".$json.")");
  //var_dump($data);
  return $obj; 
} 

  $xajax->registerFunction("countDataAjax");
  $xajax->registerFunction("ValidateFieldCedula");
  $xajax->registerFunction("UpdateStudentInfo");
  $xajax->registerFunction("SearchCedula");
  $xajax->registerFunction("ShowAseccion");
  $xajax->registerFunction("SelectSeccion");
  $xajax->registerFunction("ModificarStudent");
  $xajax->registerFunction("volver");


  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests(); 
?>