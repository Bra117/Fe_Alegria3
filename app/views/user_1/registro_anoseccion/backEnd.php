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

 function Register($form){
    $obj = new xajaxResponse('UTF-8');
    $model = new profeModel();
    //var_dump($form);
    
    if($form['ano'] != "" && $form['seccion'] != ""){
        $insert = $model->registrarAsecc($form);
                        
        if($insert){
            $obj->addScript("Swal.fire({
               title: '¡Registrado!',
               text: 'Se ha registrado en la base de datos.',
               icon: 'success',
               color: 'black'
            });");
           //REDIRECTION
           $obj->addScript("setTimeout(function(){ window.location='registro_anoseccion';},1000)");
           //
        }else{
            $obj->addScript("Swal.fire({
               title: '¡Hubo un error!',
               text: 'Algun campo no cumple con los parametros o esta vacio.',
               icon: 'error',
               color: 'black'
            });");
        }                             
    }else{
        $obj->addScript("Swal.fire({
            title: '¡No se puede registrar!',
            text: 'Hay un campo vacio',
            icon: 'error',
            color: 'black'
        });");
    }
   return $obj;    
}
 
function showAseccion(){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new profeModel();
    $result = $loginModel->TablaAse();
    $html = "";
    //var_dump($result);
    
    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Nro Secciones</th>
            <th class='text-center' style='width: 6%;'>Estatus Secciones</th>
            <th class='text-center' style='width: 6%;'>Seccion</th>
            <th class='text-center' style='width: 6%;'>Editar Seccion</th>
        </thead>
        <tbody>";
    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
       //var_dump($agente);

      if ($agente['id_status'] != 1) {
            $html.= '<tr class = text-center>
                <td>'.$agente['id_aseccion'].'</td>
                <td style = "color: red;">'.$agente['d_status'].'</td>
                <td>'.$agente['d_aseccion'].'</td>
                <td style="width: 10%;">
                    <div class="btn-group">
                        <button type="button" style = "box-shadow: 0px 9px 3px rgba(0,0,0,.2); font-family: "Lato";" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarSeccion('.$agente['id_aseccion'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Editar</i>
                        </button>
                    </div>
                </td>         
            </tr>';
        }else{
            $html.= '<tr class = text-center>
             <td>'.$agente['id_aseccion'].'</td>
             <td style = "color: green;">'.$agente['d_status'].'</td>
             <td>'.$agente['d_aseccion'].'</td>
               <td style="width: 10%;">
                    <div class="btn-group">
                        <button type="button" style = "box-shadow: 0px 9px 3px rgba(0,0,0,.2); font-family: "Lato";" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarSeccion('.$agente['id_aseccion'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Editar</i>
                        </button>
                    </div>
                </td>         
            </tr>';
        }
    }
    //var_dump($html);
    $obj->addAssign('hola', 'innerHTML', $html);
    $obj->addScript("datatable('grid');");
   return $obj;
}

function ModificarSeccion($id_aseccion){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new profeModel();
    $result = $loginModel->SearchAseccionById($id_aseccion);
    $html = "";
    //var_dump($id_hora);
    for ($i=0; $i < $result['numRows']; $i++) { 
        $agente = pg_fetch_assoc($result['query'], $i);
       
        $id_aseccion = $agente['id_aseccion'];
        $obj->addAssign('id_aseccion', 'value', $id_aseccion);

        $html=
        "<div class = 'form-group'>
            <label for = 'message-text' class = 'col-form-label'>Ano</label>
            <input style = 'width: 320px;' type = 'text'  name = 'ano' class = 'form-control' id = 'ano' onBlur=validateField() value = '".$agente['ano']."'></input>
            <p class= 'parrafo' id = 'parrafoNombre'></p>
        </div>

        <div class = 'form-group'>
            <label for = 'message-text' class = 'col-form-label'>seccion</label>
            <input style = 'width: 320px;' type = 'text'  name = 'seccion' class = 'form-control' id = 'seccion' onBlur=validateField() value = '".$agente['seccion']."'></input>
            <p class= 'parrafo' id = 'parrafoApellido'></p>
        </div> 

        <div class = 'form-group'>
            <label  style = 'margin-top: -10px; margin-left: 120px;' for = 'message-text' class = 'col-form-label'>Status</label>
            <select style = 'width: 120px; margin-top: -5px; margin-left: 90px;' type = 'select' class = 'form-select' name = 'status' id = 'status'>
                <option disabled hidden selected value = '".$agente['id_status']."'>".$agente['d_status']."</option>
                <option value = 1>Activo</option>
                <option value = 2>Inactivo</option>
            </select>
        </div>";
    }
    $obj->addScript("$(document).ready(function(){
      $('#ano').on('input', function (evt) {
          $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });");

    $obj->addScript("$(document).ready(function(){
        $('#seccion').on('input', function (evt) {
            $(this).val($(this).val().replace(/[^A-Za-z]/, ''));
        });
    });");

  $obj->addAssign('form', 'innerHTML', $html);
 return $obj;
}

function ValidateFieldCedula($form){
 $obj = new xajaxResponse('UTF-8');
 $usuarioModel = new profeModel();
 $result = $usuarioModel->SearchAseccionById1($form);
 $html='';
 //var_dump($form);
  if ($form['ano'] != ''){
     $html = '<p style = "color: green;">Verificado</p>';
      $obj->addAssign('parrafoNombre', 'innerHTML', $html);
    }else{
        $html = '<p style = "color: red;">No tiene datos</p>';
        $obj->addAssign('parrafoNombre', 'innerHTML', $html);
    }

    if ($form['seccion'] != ''){
     $html = '<p style = "color: green;">Verificado</p>';
      $obj->addAssign('parrafoApellido', 'innerHTML', $html);
    }else{
        $html = '<p style = "color: red;">No tiene datos</p>';
        $obj->addAssign('parrafoApellido', 'innerHTML', $html);
    }
  return $obj;
}

function UpdateAseccionInfo($form){
 $obj = new xajaxResponse('UTF-8');
 $usuarioModel = new profeModel();
 $result = $usuarioModel->SearchAseccionById1($form);
 $html='';
 //var_dump($form);

  if($form['ano'] != '' && $form['seccion'] != ''){
        $result = $usuarioModel->updateAseccionInfo($form);
        if($result){
            $obj->addScript("Swal.fire({
                title: '¡Se ha Actualizado!',
                text: 'Los datos de la Seccion se han Actualizado Correctamente.',
                icon: 'success',
                color: 'black'
            });");
            //REDIRECTION
            $obj->addScript("setTimeout(function(){ window.location='registro_anoseccion';},1555)");
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
            text: 'El campo Esta vacio.',
            icon: 'error',
            color: 'black'
        });");
    }
 return $obj;
}
//registramos la función creada anteriormente al objeto xajax
$xajax->registerFunction("UpdateAseccionInfo");
$xajax->registerFunction("ValidateFieldCedula");
$xajax->registerFunction("showAseccion");
$xajax->registerFunction("volver");
$xajax->registerFunction("Register");
$xajax->registerFunction("ModificarSeccion");
//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequests();
?>

