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

  function ShowProfesores(){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new profeModel();
    $result = $loginModel->ShowProfesores();
    $html = "";

    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style = 'background-color: black; color: white;'>
            <th class='text-center' style='width: 6%;'>Estaus</th>
            <th class='text-center' style='width: 6%;'>Rol</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula</th>
            <th class='text-center' style='width: 6%;'>Nombre</th>
            <th class='text-center' style='width: 6%;'>Apellido</th>
            <th class='text-center' style='width: 6%;'>Email</th>
            <th class='text-center' style='width: 6%;'>Editar Profesor</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
        
        if($agente['d_status'] != 'Activo'){
          $html.= 
          '<tr class = text-center>
            <td style = "color: red;">'.$agente['d_status'].'</td>
            <td>'.$agente['d_rol'].'</td>
            <td>'.$agente['cedula'].'</td>
            <td>'.$agente['nombre'].'</td>
            <td>'.$agente['apellido'].'</td>
            <td>'.$agente['email'].'</td>
            <td style="width: 10%;">
              <div class="btn-group">
                <button type="button" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarTeacher(\''.$agente['cedula'].'\')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Editar</i>
                </button>
              </div>
            </td>         
          </tr>';
        }else{
          $html.= 
          '<tr class = text-center>
            <td style = "color: green;">'.$agente['d_status'].'</td>
            <td>'.$agente['d_rol'].'</td>
            <td>'.$agente['cedula'].'</td>
            <td>'.$agente['nombre'].'</td>
            <td>'.$agente['apellido'].'</td>
            <td>'.$agente['email'].'</td>
            <td style="width: 10%;">
              <div class="btn-group">
                <button type="button" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarTeacher(\''.$agente['cedula'].'\')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Editar</i>
                </button>
              </div>
            </td>         
          </tr>';
        }
      }
   $obj->addAssign('teacher', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");
   return $obj;
  }

  
function ModificarTeacher($cedula){
 $obj = new xajaxResponse('UTF-8');
 $usuarioModel = new profeModel();
 $result = $usuarioModel->GetTeacherByCedula($cedula);
 $html = "";
for ($i=0; $i < $result['numRows']; $i++) { 
  $agente = pg_fetch_assoc($result['query'], $i);
   
  $id_profesor = $agente['id_profesor'];
  $obj->addAssign('id_profesor', 'value', $id_profesor);

  $html=
"<div class = 'form-group'>
    <label for = 'message-text' class = 'col-form-label'>Cedula</label>
    <input style = 'width: 320px;' type = 'text'  name = 'cedula' class = 'form-control' id = 'cedula' onBlur=validateField() value = '".$agente['cedula']."'></input>
    <p class= 'parrafo' id = 'parrafoCedula'></p>
  </div>
  <div class = 'form-group'>
    <label for = 'message-text' class = 'col-form-label'>Nombre</label>
    <input style = 'width: 320px;' type = 'text'  name = 'nombre' class = 'form-control' id = 'nombre' onBlur=validateField() value = '".$agente['nombre']."'></input>
 <p class= 'parrafo' id = 'parrafoNombre'></p>
  </div> 
  <div class = 'form-group'>
    <label for = 'message-text' class = 'col-form-label'>Apellido</label>
    <input style = 'width: 320px;' type = 'text'  name = 'apellido' class = 'form-control' id = 'apellido' onBlur=validateField() value = '".$agente['apellido']."'></input>
  <p class= 'parrafo' id = 'parrafoApellido'></p>
  </div>
  <div class = 'form-group'>
    <label for = 'message-text' class = 'col-form-label'>Correo</label>
    <input  style = 'width: 320px;' type = 'text'  name = 'correo' class = 'form-control' id = 'correo' onBlur=validateField() value = '".$agente['email']."'></input>
 <p class= 'parrafo' id = 'parrafocorreo'></p>

  </div><br>
  
   <div class = 'form-group'>
    <label style = 'margin-top: -30px; for = 'message-text' class = 'col-form-label'>Rol</label>
    <select style = 'width: 125px;' type = 'select'  class = 'form-select' name = 'rol' id = 'rol'>
    <option disabled hidden selected value = '".$agente['id_rol']."'>".$agente['d_rol']."</option>
    <option value = 1>Director@</option>
    <option value = 2>Profesor@</option>
    <option value = 3>Psicopedagoga</option>

    </select>
  </div><br>

  <div class = 'form-group'>
    <label  style = 'margin-top: -110px; margin-left: 200px;' for = 'message-text' class = 'col-form-label'>Status</label>
    <select style = 'width: 120px; margin-top: -65px; margin-left: 200px;' type = 'select' class = 'form-select' name = 'status' id = 'status'>
    <option disabled hidden selected value = '".$agente['id_status']."'>".$agente['d_status']."</option>
    <option value = 1>Activo</option>
    <option value = 2>Inactivo</option>
    </select>
  </div>";
}
  $obj->addScript("$(document).ready(function(){
    $.mask.definitions['~']='[VE]';
    $('#cedula').mask('~-9?9999999');
  });");
  $obj->addAssign('form', 'innerHTML', $html);
 return $obj;
}

function UpdateTeacherInfo($form){
  $obj = new xajaxResponse('UTF-8');
  $Model = new profeModel();
  $cedula = $Model->getTeachersByCedula1($form);
  $html='';
  //var_dump($form);
  if($cedula['numRows'] != 2){
    if($form['cedula']!='' && $form['nombre']!='' && $form['apellido']!='' && $form['correo']!=''){
      if(preg_match("/^[a-zA-ZñÑ\s]+$/", $form['nombre'])){
        if(preg_match("/^[a-zA-ZñÑ\s]+$/", $form['apellido'])){ 
          if(false !== filter_var($form['correo'], FILTER_VALIDATE_EMAIL)){
            if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{3,7}$/", $form['correo'])){
              if(strlen($form['nombre']) > 2){
                if(strlen($form['apellido']) > 2){
                  $result = $Model->updateTeacherInfo($form);
                  if($result){
                    $obj->addScript("Swal.fire({
                      title: '¡Se ha Actualizado!',
                      text: 'Los datos del Profesor se han Actualizado Correctamente.',
                      icon: 'success',
                      color: 'black'
                    });");
                    //REDIRECTION
                    $obj->addScript("setTimeout(function(){ window.location='user_1';},1555)");
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
                text: 'El dominio del correo no es valido.',
                icon: 'error',
                color: 'black'
              });");
            }
          }else{
            $obj->addScript("Swal.fire({
              title: '¡No se puede Actualizar!',
              text: 'El gmail no es valido.',
              icon: 'error',
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
 $usuarioModel = new profeModel();
 $result = $usuarioModel->getTeachersByCedula1($form);
 $html = '';
  //var_dump($result['numRows']);
  /*if ($form['nombre']=='') {    
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

  if($form['correo']=='') {
    $html = '<p style = "color: red;">No tiene datos</p>';
    $obj->addAssign('parrafocorreo', 'innerHTML', $html);     
  }else{
    $html = '<p style = "color: green;">Verificado</p>';
    $obj->addAssign('parrafocorreo', 'innerHTML', $html);
  }*/
 $html='';
 //var_dump($result['numRows']);
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

function countProfesores(){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new profeModel();
  $result = $usuarioModel->countProfesores();
  $html = '';

  for ($i=0; $i < $result['numRows']; $i++) { 
  $agente = pg_fetch_assoc($result['query'], $i);

  $html.= '
  <div class="card bg-success text-white mb-4">
    <div class="card-body" style = "font-size: 40px; margin-left: 100px;">'.$agente["profesores"].'</div>
      <div class="card-footer d-flex align-items-center justify-content-between">
        <a style = "margin-left: 75px">Profesores</a>
      <div class="small text-white"></div>
    </div>
  </div>';
  } 
  //var_dump($agente["profesores"]);
  $obj->addAssign('profesores', 'innerHTML', $html);
  return $obj;
}

function countDirectivo(){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new profeModel();
  $result = $usuarioModel->countDirectivo();
  $html = '';

  for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);

  $html.= '                     
  <div class="card bg-danger text-white mb-4">
    <div class="card-body" style = "font-size: 40px; margin-left: 100px;">'.$agente["directivo"].'</div>
      <div class="card-footer d-flex align-items-center justify-content-between">
        <a style = "margin-left: 80px">Directivo</a>
      <div class="small text-white"></div>
    </div>
  </div>';
} 
  //var_dump($result);
  $obj->addAssign('directivo', 'innerHTML', $html);
  return $obj;
 }

function countAlumnos(){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new register_alumnoModel();
  $result = $usuarioModel->countAlumno();
  $html = '';

  for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);

  $html.= '                     
  <div class="card bg-primary text-white mb-4">
    <div class="card-body" style = "font-size: 40px; margin-left: 100px;">'.$agente["alumnos"].'</div>
      <div class="card-footer d-flex align-items-center justify-content-between">
        <a style = "margin-left: 80px">Alumnos</a>
      <div class="small text-white"></div>
    </div>
  </div>';
} 
  //var_dump($result);
  $obj->addAssign('alumnos', 'innerHTML', $html);
  return $obj;
 }
 

 function countPersonal(){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new profeModel();
  $result = $usuarioModel->countPersonals();
  $html = '';

  for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);

  $html.= '                     
  <div class="card bg-info text-white mb-4">
    <div class="card-body" style = "font-size: 40px; margin-left: 100px;">'.$agente["personal"].'</div>
      <div class="card-footer d-flex align-items-center justify-content-between">
        <a style = "margin-left: 80px">Pedagog&iacutea</a>
      <div class="small text-white"></div>
    </div>
  </div>';
} 
  //var_dump($result);
  $obj->addAssign('personal', 'innerHTML', $html);
  return $obj;
 }
    $xajax->registerFunction("ZoneTimeDate");

  $xajax->registerFunction("volver");
  $xajax->registerFunction("mostrarAlumno");
  $xajax->registerFunction("ShowProfesores");
  $xajax->registerFunction("ModificarTeacher");
  $xajax->registerFunction("ShowSolicitud");
  $xajax->registerFunction("countProfesores");
  $xajax->registerFunction("countDirectivo");
  $xajax->registerFunction("countAlumnos");
  $xajax->registerFunction("countPersonal");
  $xajax->registerFunction("UpdateTeacherInfo");
  $xajax->registerFunction("ValidateFieldCedula");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();    
?>


