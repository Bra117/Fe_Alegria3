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

function Register1($form){
  $obj = new xajaxResponse('UTF-8');
  $model = new profeModel();
  var_dump($form);
  // Verifica si el campo 'hora' está vacío
  if($form['hora'] != ""){
    // Aplica la expresión regular para validar el formato de hora
    if(preg_match("/^\s*(0[1-9]|1[0-2]):[0-5][0-9] (AM|PM)\s*$/", $form['hora'])){
      $insert = $model->registrarhr($form);
      if($insert){
        $obj->addScript("Swal.fire({
          title: '¡Registrado!',
          text: 'Se ha registrado Correctamente.',
          icon: 'success',
          color: 'black'
        });");
        //REDIRECTION
        $obj->addScript("setTimeout(function(){ window.location='registro_hora';},1000)");
      } else {
        $obj->addScript("Swal.fire({
          title: '¡Hubo un error!',
          text: 'Algun campo no cumple con los parámetros o esta vacío.',
          icon: 'error',
          color: 'black'
        });");
      }  
    } else {
      $obj->addScript("Swal.fire({
        title: '¡No se puede registrar!',
        text: ' El formato de hora esta erroneo.',
        icon: 'error',
        color: 'black'
      });"); 
    }
  } else {
    $obj->addScript("Swal.fire({
      title: '¡No se puede registrar!',
      text: 'Hay un campo vacío',
      icon: 'error',
      color: 'black'
    });");
  }
  return $obj;
}

function showHora(){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new profeModel();
    $result = $loginModel->hora1();
    $html = "";
    //var_dump($result);
    
    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Nro hora</th>
            <th class='text-center' style='width: 6%;'>Estatus Hora</th>
            <th class='text-center' style='width: 6%;'>hora</th>
            <th class='text-center' style='width: 6%;'>Editar hora</th>
        </thead>
        <tbody>";
    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
       //var_dump($agente);

      if ($agente['id_status'] != 1) {
            $html.= '<tr class = text-center>
                <td>'.$agente['id_hora'].'</td>
                <td style = "color: red;">'.$agente['d_status'].'</td>
                <td>'.$agente['hora'].'</td>
                <td style="width: 10%;">
                    <div class="btn-group">
                        <button type="button" style = "box-shadow: 0px 9px 3px rgba(0,0,0,.2); font-family: "Lato";" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarHora('.$agente['id_hora'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Editar</i>
                        </button>
                    </div>
                </td>         
            </tr>';
        }else{
             $html.= '<tr class = text-center>
                <td>'.$agente['id_hora'].'</td>
                <td style = "color: green;">'.$agente['d_status'].'</td>
                <td>'.$agente['hora'].'</td>
                <td style="width: 10%;">
                    <div class="btn-group">
                        <button type="button" style = "box-shadow: 0px 9px 3px rgba(0,0,0,.2); font-family: "Lato";" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarHora('.$agente['id_hora'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Editar</i>
                        </button>
                    </div>
                </td>         
            </tr>';}
    }
    $obj->addScript("$(document).ready(function(){
    $.mask.definitions['~']='[AP]';
    $('#hora').mask(' 99:99 ~M');
    });");

    //var_dump($html);
    $obj->addAssign('hola', 'innerHTML', $html);
    $obj->addScript("datatable('grid');");

   return $obj;
}

function ModificarHora($id_hora){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new profeModel();
    $result = $loginModel->SearchHoraById($id_hora);
    $html = "";
    //var_dump($id_hora);

    for ($i=0; $i < $result['numRows']; $i++) { 
        $agente = pg_fetch_assoc($result['query'], $i);
       
        $id_hora = $agente['id_hora'];
        $obj->addAssign('id_hora', 'value', $id_hora);

        $html=
        "<div class = 'form-group'>
            <label for = 'message-text' class = 'col-form-label'>Hora</label>
            <input style = 'width: 320px;' type = 'text'  name = 'hora' class = 'form-control' id = 'hora' onBlur=validateField() value = '".$agente['hora']."'></input>
            <p class= 'parrafo' id = 'parrafoNombre'></p>
        </div> 

        <div class = 'form-group'>
            <label  style = 'margin-top: -20px; margin-left: 120px;' for = 'message-text' class = 'col-form-label'>Status</label>
            <select style = 'width: 120px; margin-top: -5px; margin-left: 90px;' type = 'select' class = 'form-select' name = 'status' id = 'status'>
                <option disabled hidden selected value = '".$agente['id_status']."'>".$agente['d_status']."</option>
                <option value = 1>Activo</option>
                <option value = 2>Inactivo</option>
            </select>
        </div>";
    }
    $obj->addScript("$(document).ready(function(){
        $.mask.definitions['~']='[AP]';
        $('#hora').mask(' 99:99 ~M');
    });");
  $obj->addAssign('form', 'innerHTML', $html);
 return $obj;
}

function UpdateHoraInfo($form){
$obj = new xajaxResponse('UTF-8');
  $Model = new profeModel();
  $result = $Model->SearchHoraById1($form);
  $html='';
  //var_dump($form);
    if($form['hora'] != '' || $form['hora'] != 'M' || $form['hora'] != 'AM' || $form['hora'] != 'PM'){
        if(preg_match("/^\s*(0[1-9]|1[0-2]):[0-5][0-9] (AM|PM)\s*$/", $form['hora'])){
            $result = $Model->updateHorainfo($form);
            if($result){
                $obj->addScript("Swal.fire({
                    title: '¡Se ha Actualizado!',
                    text: 'Los datos de la hora se han Actualizado Correctamente.',
                    icon: 'success',
                    color: 'black'
                });");
                //REDIRECTION
                $obj->addScript("setTimeout(function(){ window.location='registro_hora';},1555)");
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
                title: '¡No se puede registrar!',
                text: ' El formato de hora esta erroneo.',
                icon: 'error',
                color: 'black'
            });");
        }
    }else{
        $obj->addScript("Swal.fire({
            title: '¡No se puede Actualizar!',
            text: 'El campo Esta vacio.',
            icon: 'error',
            color: 'black'
        });");
    }
  return $obj;
} 

/*function hora(){
    $obj = new xajaxResponse('UTF-8');
    $model = new profeModel();
    $result = $model->hora1();
        $html="
         <option disabled hidden selected>Hora</option>";

    for ($i=0; $i <$result['numRows']; $i++) { 
        $row = pg_fetch_assoc($result['query'], $i);

        $html.="
                <option value = ".$row["id_hora"].">".$row["hora"]."</option>"
                ;};

    $obj->addAssign('selecthora', 'innerHTML', $html);
    return $obj;
  }*/

  function ValidateFieldCedula($form){
 $obj = new xajaxResponse('UTF-8');
 $usuarioModel = new profeModel();
 $result = $usuarioModel->SearchHoraById1($form);
 $html='';
 //var_dump($form);
  if ($form['hora'] != 'M' || $form['hora'] != 'AM' || $form['hora'] != 'PM'){
    if($result['numRows'] != 2){
     $html = '<p style = "color: green;">Verificado</p>';
      $obj->addAssign('parrafoNombre', 'innerHTML', $html);
    }else{
      $html = '<p style = "color: red;">Ya esa cedula esta registrada</p>';
      $obj->addAssign('parrafoNombre', 'innerHTML', $html);
    }
  }else{
     $html = '<p style = "color: red;">No tiene datos</p>';
    $obj->addAssign('parrafoNombre', 'innerHTML', $html);
  }

  $obj->addAssign('parrafoNombre', 'innerHTML', $html);
  return $obj;
}

  //registramos la función creada anteriormente al objeto xajax
  //$xajax->registerFunction("hora");
  $xajax->registerFunction("volver");
  $xajax->registerFunction("Register1");
  $xajax->registerFunction("showHora");
  $xajax->registerFunction("ModificarHora");  
  $xajax->registerFunction("ValidateFieldCedula");
  $xajax->registerFunction("UpdateHoraInfo");

  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests(); 
?>