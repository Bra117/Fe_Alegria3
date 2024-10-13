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
    
    if($form['selectmateria'] != "Seleccione" && $form['selectprofesor'] != "Seleccione" && $form['selecthoras'] != "Seleccione"){
        $insert = $model->UpdateMateria($form);
                        
        if($insert){
            $obj->addScript("Swal.fire({
               title: '¡Asigando!',
               text: 'Se le ha asignado la materia al profesor.',
               icon: 'success',
               color: 'black'
            });");
           //REDIRECTION
           $obj->addScript("setTimeout(function(){ window.location='asignacion_materia';},3000)");
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

function horas(){
    $obj = new xajaxResponse('UTF-8');
    $model = new profeModel();
    $result = $model->hora();

     if ($result['numRows'] == 0) {
        $html="
        <option disabled hidden selected>No hay Horas Disponible</option>";
    }else{
        $html="
        <option disabled hidden selected>Seleccione</option>";

        for ($i=0; $i <$result['numRows']; $i++) { 
            $row = pg_fetch_assoc($result['query'], $i);

            $html.="
            <option value = ".$row["id_hora"].">".$row["hora"]."</option>"
        ;};
    }
    $obj->addAssign('selecthoras', 'innerHTML', $html);
    return $obj;
  }

function materia(){
    $obj = new xajaxResponse('UTF-8');
    $model = new profeModel();
    $result = $model->materia();

    if ($result['numRows'] == 0) {
        $html="
        <option disabled hidden selected>No hay Materias Disponible</option>";
    }else{
        $html="
        <option disabled hidden selected>Seleccione</option>";

        for ($i=0; $i <$result['numRows']; $i++) { 
            $row = pg_fetch_assoc($result['query'], $i);

            $html.="
                <option value = ".$row["id_materia"].">".$row["d_materia"]."</option>"
        ;};
    }
    $obj->addAssign('selectmateria', 'innerHTML', $html);
    return $obj;
  }

  function profesor(){
    $obj = new xajaxResponse('UTF-8');
    $model = new profeModel();
    $result = $model->profesorselect();

    if ($result['numRows'] == 0) {
        $html="
        <option disabled hidden selected>No hay Profesor Disponible</option>";
    }else{
        $html="
        <option disabled hidden selected>Seleccione</option>";

        for ($i=0; $i <$result['numRows']; $i++) { 
            $row = pg_fetch_assoc($result['query'], $i);

            $html.="<option value = ".$row["id_profesor"].">".$row["full_name"]."</option>"
        ;};
    }
    $obj->addAssign('selectprofesor', 'innerHTML', $html);
    return $obj;
  }

  //registramos la función creada anteriormente al objeto xajax
  $xajax->registerFunction("profesor");
  $xajax->registerFunction("materia");
  $xajax->registerFunction("volver");
  $xajax->registerFunction("Register");
  $xajax->registerFunction("horas");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests(); 
?>