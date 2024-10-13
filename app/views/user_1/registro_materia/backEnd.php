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

/*function Register1($form){
    $obj = new xajaxResponse('UTF-8');
    $model = new profeModel();
    //var_dump($form);
    
    if($form['hora'] != ""){
        $insert = $model->registrarhr($form);
                        
        if($insert){
            $obj->addScript("Swal.fire({
               title: '¡Registrado!',
               text: 'Se ha registrado Correctamente.',
               icon: 'success',
               color: 'black'
            });");
           //REDIRECTION
           $obj->addScript("setTimeout(function(){ window.location='registro_materia';},1000)");
           //
        }else{
            $obj->addScript("Swal.fire({
               title: '¡Hubo un error!',
               text: 'Algun campo no cumple con los parámetros o esta vacío.',
               icon: 'error',
               color: 'black'
            });");
        }                             
    }else{
        $obj->addScript("Swal.fire({
            title: '¡No se puede registrar!',
            text: 'Hay un campo vacío',
            icon: 'error',
            color: 'black'
        });");
    }
   return $obj;    
}*/

 function Register($form){
    $obj = new xajaxResponse('UTF-8');
    $model = new profeModel();
    //var_dump($form);
    
    if($form['Materia'] != ""){
        if(preg_match("/^[a-zA-ZñÑ\s]+$/", $form['Materia'])){
            $insert = $model->registrarMate($form);            
            if($insert){
                $obj->addScript("Swal.fire({
                    title: '¡Registrado!',
                    text: 'Se ha registrado Correctamente.',
                    icon: 'success',
                    color: 'black'
                });");
                //REDIRECTION
                $obj->addScript("setTimeout(function(){ window.location='registro_materia';},1000)");
                //
            }else{
                $obj->addScript("Swal.fire({
                    title: '¡Hubo un error!',
                    text: 'Algun campo no cumple con los parámetros o esta vacío.',
                    icon: 'error',
                    color: 'black'
                });");
            }
        }else{
            $obj->addScript("Swal.fire({
                title: '¡No se puede Registrar la Materia!',
                text: 'La materia No puede tener carácteres especiales.',
                icon: 'error',
                color: 'black'
            });"); 
        }                             
    }else{
        $obj->addScript("Swal.fire({
            title: '¡No se puede registrar!',
            text: 'Hay un campo vacío',
            icon: 'error',
            color: 'black'
        });");
    }
   return $obj;    
}

function showMateria(){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new profeModel();
    $result = $loginModel->TableMateria();
    $html = "";
    //var_dump($result);
    
    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Nro Materia</th>
            <th class='text-center' style='width: 6%;'>Estatus Materia</th>
            <th class='text-center' style='width: 6%;'>Materia</th>
            <th class='text-center' style='width: 6%;'>Editar Materia</th>
        </thead>
        <tbody>";
    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
       //var_dump($agente);

      if ($agente['id_status'] != 1) {
            $html.= '<tr class = text-center>
                <td>'.$agente['id_materia'].'</td>
                <td style = "color: red;">'.$agente['d_status'].'</td>
                <td>'.$agente['d_materia'].'</td>
                <td style="width: 10%;">
                    <div class="btn-group">
                        <button type="button" style = "box-shadow: 0px 9px 3px rgba(0,0,0,.2); font-family: "Lato";" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarMateria('.$agente['id_materia'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Editar</i>
                        </button>
                    </div>
                </td>         
            </tr>';
        }else{
             $html.= '<tr class = text-center>
                <td>'.$agente['id_materia'].'</td>
                <td style = "color: green;">'.$agente['d_status'].'</td>
                <td>'.$agente['d_materia'].'</td>
                <td style="width: 10%;">
                    <div class="btn-group">
                        <button type="button" style = "box-shadow: 0px 9px 3px rgba(0,0,0,.2); font-family: "Lato";" class = "btn btn-success btn-sm btnImp" onClick="xajax_ModificarMateria('.$agente['id_materia'].')"  data-target="#exampleModal"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Editar</i>
                        </button>
                    </div>
                </td>         
            </tr>';        }
    }
    //var_dump($html);
    $obj->addAssign('hola', 'innerHTML', $html);
    $obj->addScript("datatable('grid');");
   return $obj;
}

function ModificarMateria($id_materia){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new profeModel();
    $result = $loginModel->SearchMateriaById($id_materia);
    $html = "";
    //var_dump($result);

    for ($i=0; $i < $result['numRows']; $i++) { 
        $agente = pg_fetch_assoc($result['query'], $i);
       
        $id_materia = $agente['id_materia'];
        $obj->addAssign('id_materia', 'value', $id_materia);

        $html=
        "<div class = 'form-group'>
            <label for = 'message-text' class = 'col-form-label'>Nombre Materia</label>
            <input style = 'width: 320px;' type = 'text'  name = 'nombre' class = 'form-control' id = 'nombre' onBlur=validateField() value = '".$agente['d_materia']."'></input>
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
    $.mask.definitions['~']='[VE]';
    $('#cedula').mask('~-9?9999999');
  });");
  $obj->addAssign('form', 'innerHTML', $html);
 return $obj;
}

function UpdateMateriaInfo($form){
$obj = new xajaxResponse('UTF-8');
  $Model = new profeModel();
  $result = $Model->SearchMateriaById1($form);
  $html='';
  //var_dump($form);
    if($form['nombre'] != ''){
        $result = $Model->updateMateriaInfo($form);
        if($result){
            $obj->addScript("Swal.fire({
                title: '¡Se ha Actualizado!',
                text: 'Los datos de la Materia se han Actualizado Correctamente.',
                icon: 'success',
                color: 'black'
            });");
            //REDIRECTION
            $obj->addScript("setTimeout(function(){ window.location='registro_materia';},1555)");
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
 $result = $usuarioModel->SearchMateriaById1($form);
 $html='';
 //var_dump($result);
  if ($form['nombre'] != ''){
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
  $xajax->registerFunction("Register");
  $xajax->registerFunction("Register1");
  $xajax->registerFunction("showMateria");
  $xajax->registerFunction("ModificarMateria");  
  $xajax->registerFunction("ValidateFieldCedula");
  $xajax->registerFunction("UpdateMateriaInfo");

  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests(); 
?>