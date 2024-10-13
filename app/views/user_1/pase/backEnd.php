<?php
require('app/plugins/xajax/xajax.inc.php');
//instanciamos el objeto de la clase xajax
$xajax = new xajax();
//Función()

function volver(){
    $obj = new xajaxResponse('UTF-8');
    session_destroy();
    $obj->addRedirect("user_1");
    return $obj;
}   

function Registerpase($form){
    $obj = new xajaxResponse('UTF-8');
    $model = new paseModel();
    $usuario = '^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]^';   
    $result = $model->getStudentByCedulaPase($form);
    date_default_timezone_set('UTC');
    $inactive = $model->InactiveAlumnoConForm($form);
    $html = "";
    //var_dump($form);
    if($form['remitente'] != "Seleccione" && $form['destinatario'] != "Seleccione" && $form['Materias'] != "Seleccione" && $form['motivos'] != "Seleccione" && $form['alumno'] != "" && $form['SelectAno'] != "Seleccione" && $form['SelectSeccion'] != ''){
        $cedulaAlu = $model->showAlumnPaseAseccion1($form);
            if(strlen($form['motivos']) < 50){
                $ContadorTotal = $model->PaseTotal2($form);
                /*for ($i=0; $i <$ContadorTotal['numRows']; $i++) { 
                    $row = pg_fetch_assoc($ContadorTotal['query'], $i);
                }*/
               //var_dump($row);
                 //if ($row['total_solicitudes'] != 3) {
                 for ($i=0; $i <$inactive['numRows']; $i++) { 
                    $row = pg_fetch_assoc($inactive['query'], $i);
                }
                if($row['status'] != 2){
                  $SelectContador = $model->SelectContador($form);
                    if ($SelectContador['numRows'] == 0){
                        $InsertContador = $model->InsertContador($form);
                        $insert = $model->Registerpase($form);
                        if ($insert){
                            $obj->addScript("Swal.fire({
                                title: '¡Enviado!',
                                text: 'Se ha enviado al Profesor.',
                                icon: 'success',
                                color: 'black'
                            });");
                            //REDIRECTION
                            $obj->addScript("setTimeout(function(){ window.location='pase';},1000)");
                            //
                        }else{
                            $obj->addScript("Swal.fire({
                                title: '¡No se puede enviar!',
                                text: 'Revise la Solicitud y verifique si el alumno se encuentra registrado con esa seccion.',
                                icon: 'error',
                                color: 'black'
                            });");
                        }
                    }else{
                        $insert = $model->Registerpase($form);
                        $obj->addScript("Swal.fire({
                                title: '¡Enviado!',
                                text: 'Se ha enviado al Profesor.',
                                icon: 'success',
                                color: 'black'
                            });");
                        //REDIRECTION
                            $obj->addScript("setTimeout(function(){ window.location='pase';},1000)");
                            //
                        $UpdateContador = $model->UpdateContador($form);
                    }
              /* }else{                
                    $obj->addScript("Swal.fire({
                        title: '¡No se puede enviar!',
                        text: 'El Alumno tiene mas de tres pases.',
                        icon: 'error'
                    });"); 
                    $html="<div class='btn-group'>
                        <button type='button' class = 'btn btn-danger' onClick= 'funcionAllPdf(".$form['alumno'].");' data-dismiss='modal'><i class=''> Acta de Citación</i></button>
                    </div>";

                     $html.="<div class='btn-group'>
                        <button style = 'color: white; margin-left: 5px;' type='button' class = 'btn btn-info' onClick= 'RestartContador(".$form['alumno'].");' data-dismiss='modal'><i class=''>Permitir Pases</i></button>
                    </div>";
                }*/
            /*}else{
                 $obj->addScript("Swal.fire({
                        title: '¡No se puede enviar!',
                        text: 'El Alumno tiene mas de tres pases.',
                        icon: 'error',
                        color: 'black'
                    });"); 
                    $html="<div class='btn-group'>
                        <button type='button' style = 'margin-left: 50px;' class = 'btn btn-danger' onClick= 'funcionAllPdf(".$form['alumno'].");' data-dismiss='modal'><i class=''> Acta de Citación</i></button>
                    </div>";
            }*/
            }else{
                $obj->addScript("Swal.fire({
                title: '¡No se puede enviar!',
                text: 'El Alumno está Inactivo.',
                icon: 'warning',
                color: 'black'
            });");  
}
            }else{
                $obj->addScript("Swal.fire({
                    title: '¡No se puede enviar!',
                    text: 'El motivo no puede exceder el límite de 50 carácteres.',
                    icon: 'error',
                    color: 'black'
                });");
            }
    }else{
     $obj->addScript("Swal.fire({
          title: '¡No se puede enviar!',
          text: 'No puede haber campos vacios.',
          icon: 'error',
          color: 'black'
        });");
    }
    $obj->addAssign("BotonCita","innerHTML",$html);
    return $obj;
}

function funcionAllPdf($value){
  $obj = new xajaxResponse('UTF-8');
  $id_alumno = base64_encode(base64_encode($value));

  $obj->addScript("window.open('pdf/pdf/?cod=".$id_alumno."');");
  return $obj;
}

   function ShowAllMaterias($value){
    $obj = new xajaxResponse('UTF-8');
    $model = new paseModel();
    $result = $model->showAll($value);
    //var_dump($result);
   
      $html="<option disabled hidden selected>Seleccione</option>";

        for ($i=0; $i <$result['numRows']; $i++) { 
            $row = pg_fetch_assoc($result['query'], $i);

            $html.="
            <option value = ".$row["id_materia_profesor"].">".$row["d_materia"]."</option>"
        ;};
    
    //var_dump($result);
    $obj->addAssign('SelectMaterias', 'innerHTML', $html);
    return $obj;
  }

  function ShowAllProfesor(){
    $obj = new xajaxResponse('UTF-8');
    $model = new paseModel();
    $result = $model->showAll1();

    if ($result['numRows'] == 0) {
        $html="
        <option disabled hidden selected>No hay profesor Disponible</option>";
    }else{
      $html="<option disabled hidden selected>Seleccione</option>";

        for ($i=0; $i <$result['numRows']; $i++) { 
            $row = pg_fetch_assoc($result['query'], $i);

            $html.="
            <option value = ".$row["id_profesor"].">".$row["full_name"]."</option>"
            ;};
        }
    $obj->addAssign('SelectProfesores', 'innerHTML', $html);
    return $obj;
  }

  function showAllSeccions($value){
    $obj = new xajaxResponse('UTF-8');
    $model = new paseModel();
    $result = $model->showSeccions($value);
    //var_dump($result);

        $html="
         <option disabled hidden selected>Seleccione</option>";

    for ($i=0; $i <$result['numRows']; $i++) { 
        $row = pg_fetch_assoc($result['query'], $i);

        $html.="
                <option value = ".$row["id_aseccion"].">".$row["seccion"]."</option>"
                ;};
    $obj->addAssign('SelectSeccion', 'innerHTML', $html);
    return $obj;
  }

  function showAllAno(){
    $obj = new xajaxResponse('UTF-8');
    $model = new paseModel();
    $result = $model->ShowAno();
        $html="
         <option disabled hidden selected>Seleccione</option>";

    for ($i=0; $i <$result['numRows']; $i++) { 
        $row = pg_fetch_assoc($result['query'], $i);

        $html.="
                <option value = ".$row["id_ano"].">".$row["ano"]."</option>"
                ;};
    $obj->addAssign('SelectAno', 'innerHTML', $html);
    return $obj;
  }

  function showstatusaseccion($value){
    $obj = new xajaxResponse('UTF-8');
    $model = new paseModel();
    $result = $model->Inactiveseccion($value);
      
    if($result['row']['id_status'] == 2) {
         $obj->addScript("Swal.fire({
            title: '¡No se puede procesar!',
            text: 'Esta sección Está Inactiva.',
            icon: 'error',
            color: 'black'
        });");
    }
        return $obj;

  }
  
  function ShowAllMotivos(){
    $obj = new xajaxResponse('UTF-8');
    $model = new paseModel();
    $result = $model->ShowMotivos();
    $html="<option disabled hidden selected>Seleccione</option>";

    for ($i=0; $i <$result['numRows']; $i++) { 
        $row = pg_fetch_assoc($result['query'], $i);

        $html.="
                <option value = ".$row["id_motivo"].">".$row["motivo"]."</option>"
                ;};
    //var_dump($row);
    $obj->addAssign('motivos', 'innerHTML', $html);
    return $obj;
  }

  function showAllAlumnos($value){
    $obj = new xajaxResponse('UTF-8');
    $model = new paseModel();
    $result = $model->showAlumnPaseAseccion($value);
    $html="<option disabled hidden selected>Seleccione</option>";

    for ($i=0; $i <$result['numRows']; $i++) { 
        $row = pg_fetch_assoc($result['query'], $i);

        $html.="
                <option value = ".$row["id_alumno"].">".$row["alumno"]."</option>"
                ;};
    $obj->addAssign('alumno', 'innerHTML', $html);
    return $obj;
  }
  
  function showCampoTexto($value){
  $obj = new xajaxResponse('UTF-8');
  $html = "";
 if($value == 5) {
     $html = "<div class = 'message'>
      <label for = 'message'></label>
      <textarea name = 'message' placeholder = 'Anexo' id = 'message_input' cols = '30' rows = '5'></textarea>
    </div";
 }else{

 }
  $obj->addAssign('message', 'innerHTML', $html);
  return $obj;
  }


function RestartContador($value){
    $obj = new xajaxResponse('UTF-8');
    $model = new paseModel();
    $result = $model->UpdateContador2($value);
    $id_alumno = base64_encode(base64_encode($value));
    
    if($result){
        $obj->addScript("Swal.fire({
            title: '¡Se a Reiniciado!',
            text: 'El Alumno puede volver a tener tres pases.',
            icon: 'success',
            color: 'black'
        });");
        $obj->addScript("setTimeout(function(){ window.location='pase';},1000)");
    }else{
        $obj->addScript("Swal.fire({
            title: '¡No se a Reiniciado!',
            text: 'NO se puede reinicair.',
            icon: 'error',
            color: 'black'
        });");
    }
 return $obj;
}

function ResetPase($value){
    date_default_timezone_set('UTC');
    $obj = new xajaxResponse('UTF-8');
    $month  = date('m');
    $year = date('Y');
    $model = new paseModel;
    $result = $model->CountPaseAlumno($value, $month, $year);
    $inactive = $model->InactiveAlumno($value);
    $html = "";
    //var_dump($result);
   for ($i=0; $i <$inactive['numRows']; $i++) { 
        $row = pg_fetch_assoc($inactive['query'], $i);
    }

    if ($row['status'] == 1){ 
        for ($i=0; $i <$result['numRows']; $i++) { 
            $row = pg_fetch_assoc($result['query'], $i);
            if ($row['total_solicitudes'] >= 3) {
                $obj->addScript("Swal.fire({
                    title: '¡No se puede enviar!',
                    text: 'El Alumno tiene mas de tres pases.',
                    icon: 'error',
                    color: 'black'
                });"); 
                $html="<div class='btn-group'>
                    <button style = 'margin-left: 50px;' type='button' class = 'btn btn-danger' onClick= 'funcionAllPdf(".$value.");' data-dismiss='modal'><i class=''> Acta de Citación</i></button>
                </div>";
            }else{
            
            }
        }
    }else{
        $obj->addScript("Swal.fire({
            title: '¡Atento!',
            text: 'El Alumno esta Inactivo.',
            icon: 'warning',
            color: 'black'
        });");  
    }
    $obj->addAssign("BotonCita","innerHTML",$html);
    return $obj;
}

function ShowCedulaPro($value){
    $obj = new xajaxResponse('UTF-8');
    $model = new paseModel();
    $result = $model->SearchCedulaProfesor($value);

    $cedula_profesor = $result['row']['cedula'];
    //var_dump($cedula_profesor);
    $obj->addAssign('ceduProfe', 'value', $cedula_profesor);
    return $obj;  
}

function SearchCedulaAlumno($value){
    $obj = new xajaxResponse('UTF-8');
    $model = new paseModel();
    $result = $model->SearchCedulaAlu($value);

    $cedula_alumno = $result['row']['cedula'];
    $obj->addAssign('cedualumno', 'value', $cedula_alumno);
    return $obj;  
}

  $xajax->registerFunction("SearchCedulaAlumno"); 
  $xajax->registerFunction("showstatusaseccion"); 
  $xajax->registerFunction("ResetPase"); 
  $xajax->registerFunction("funcionAllPdf"); 
  $xajax->registerFunction("showCampoTexto"); 
  $xajax->registerFunction("showAllAno");
  $xajax->registerFunction("showAllSeccions");
  $xajax->registerFunction("ShowAllMaterias");
  $xajax->registerFunction("ShowAllMotivos");
  $xajax->registerFunction("Registerpase");
  $xajax->registerFunction("ShowAllProfesor");
  $xajax->registerFunction("showAllAlumnos");
  $xajax->registerFunction("RestartContador");
  $xajax->registerFunction("volver");
  $xajax->registerFunction("ShowCedulaPro"); 

  $xajax->processRequests(); 
?>