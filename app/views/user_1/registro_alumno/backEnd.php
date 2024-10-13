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

function SearchCedula($form){
    $obj     = new xajaxResponse('UTF-8');
    if($form['cedula'] != ''){  
        $model   = new register_alumnoModel('UFT-8');
        $result  = $model->getStudentByCedula($form);
        $html = "";

        if ($result['numRows'] == 1){
            $html = '<p style = "color: red; margin-left: 170px;">La cédula ya se encuentra registrada</p>';
        }else{
            $html = '<p style = "color: green;">Verificado</p>';
        }
    }else{
        $html = '<p style = "color: red;">No tiene datos</p>';
    }
  //var_dump($result['numRows']);
  $obj->addAssign('parrafo', 'innerHTML', $html);
  return $obj;
}
 function Register($form){
    $obj = new xajaxResponse('UTF-8');
    $model = new register_alumnoModel();
    $result = $model->getStudentByCedula($form);
    $StatusAseccion = $model->StatusAseccion($form);
    $fecha_actual = date("Y-m-d");
    //var_dump($StatusAseccion);
    // Convertir la fecha de nacimiento a timestamp
    $fecha_nac_timestamp = strtotime($form['fecha_nac']);

    // Calcular la diferencia en segundos entre las fechas
    $diferencia_segundos = time() - $fecha_nac_timestamp;

    // Convertir la diferencia a años (aproximado)
    $edad = floor($diferencia_segundos / (60 * 60 * 24 * 365.25));

    $numero  = '^[0-9]^';
    if($form['nombre'] != "" && $form['apellido'] != "" && $form['cedula'] && $form['fecha_nac'] != "" && $form['select'] != "" && $form['select1'] != ""){
       if(preg_match("/^[a-zA-ZñÑ\s]+$/", $form['nombre'])){
            if(preg_match("/^[a-zA-ZñÑ\s]+$/", $form['apellido'])){            
                if (strlen($form['nombre']) > 2){
                    if(strlen($form['apellido']) > 2){
                        if(strlen($form['cedula'])  == 10){
                            //var_dump($result['numRows']);
                            if($result['numRows'] == 0){
                                /*if($form['fecha_nac'])){*/
                                    if($edad >= 9 && $edad <= 17){
                                        if ($StatusAseccion['row']['id_status'] == 1) {
                                            /*if(preg_match($numero, $form['edad'])){*/
                                            $insert = $model->registrar($form);
                                            if($insert){
                                                $obj->addScript("Swal.fire({
                                                    title: '¡Registrado!',
                                                    text: 'Se ha registrado en la base de datos.',
                                                    icon: 'success',
                                                    color: 'black'
                                                });");
                                                //REDIRECTION
                                                $obj->addScript("setTimeout(function(){ window.location='registro_alumno';},1000)");
                                                //
                                            }else{
                                                $obj->addScript("Swal.fire({
                                                    title: '¡Hubo un error!',
                                                    text: 'Algún campo no cumple con los parámetros o esta vacío.',
                                                    icon: 'error',
                                                    color: 'black'
                                                });");
                                            }
                                            /*}else{
                                                $obj->addScript("Swal.fire({
                                                    title: '¡No se puede registrar!',
                                                    text: 'La edad no puede contener letras.',
                                                    icon: 'error'
                                                });"); 
                                            }*/
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
                                            title: '¡No se puede registrar!',
                                            text: 'La Fecha de nacimiento del Alumno debe ser mayor o igual a 2010 o menor o igual a 2006.',
                                            icon: 'error',
                                            color: 'black'
                                        });");
                                    }
                                /*}else{
                                    $obj->addScript("Swal.fire({
                                      title: '¡No se puede registrar!',
                                      text: 'La Fecha no cumple con el formato.',
                                      icon: 'error',
                                      color: 'black'
                                    });");
                                }*/
                            }else{
                                $obj->addScript("Swal.fire({
                                    title: '¡No se puede registrar!',
                                    text: 'Esta cédula ya existe.',
                                    icon: 'warning',
                                    color: 'black'
                                });");
                            }    
                        }else{
                            $obj->addScript("Swal.fire({
                             title: '¡No se puede registrar!',
                             text: 'La cédula no tener menos de 10 dígitos.',
                             icon: 'error',
                             color: 'black'
                            });");
                        }
                    }else{
                        $obj->addScript("Swal.fire({
                            title: '¡No se puede registrar!',
                            text: 'El apellido no puede tener menos de 3 letras.',
                            icon: 'error',
                            color: 'black'
                        });");
                    } 
                }else{
                    $obj->addScript("Swal.fire({
                        title: '¡No se puede registrar!',
                        text: ' El nombre no puede tener menos de 3 letras.',
                        icon: 'error',
                        color: 'black'
                    });");
                }
            }else{
                $obj->addScript("Swal.fire({
                    title: '¡No se puede registrar!',
                    text: 'El apellido no puede tener números ni carácteres especiales.',
                    icon: 'error',
                    color: 'black' 
                });");
            }
        }else{
           $obj->addScript("Swal.fire({
                title: '¡No se puede registrar!',
                text: 'El nombre no puede tener números ni carácteres especiales.',
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
 

function SelectSeccion(){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new register_alumnoModel();
  $result = $usuarioModel->SelectAseccion1();
  $html="<option hidden disable></option>";

    for ($i=0; $i <$result['numRows']; $i++) { 
        $row = pg_fetch_assoc($result['query'], $i);

        $html.="<option value = ".$row["id_aseccion"].">".$row["aseccion"]."</option>";
    }


    $obj->addAssign("select","innerHTML",$html);
    return $obj;
}

/*function AlertaAseccion($value){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new register_alumnoModel();
  $result = $usuarioModel->StatusAseccion($value);
  
  if ($result['row']['id_status'] == 1){
    }else{
        $obj->addScript("Swal.fire({
            title: '¡Sección Inactiva!',
            text: 'La sección seleccionada está inactiva.',
            icon: 'warning',
            color: 'black'
        });");
    }
  return $obj;
}*/
  //registramos la función creada anteriormente al objeto xajax
  //$xajax->registerFunction("AlertaAseccion");
  $xajax->registerFunction("volver");
  $xajax->registerFunction("Register");
  $xajax->registerFunction("SearchCedula");
  $xajax->registerFunction("SelectSeccion");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests(); 
?>