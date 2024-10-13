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

  function Update2($form){
    $obj = new xajaxResponse('UTF-8');
    $model = new updateModel();
    $result = $model->getTeachersByCedula($form);
    //  var_dump($form);
     $usuario = '^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]^';
    if($form['usuario'] != "" && $form['email'] != ""){
      if(preg_match($usuario, $form['usuario'])){
        if (strlen($form['usuario']) > 2){
          if(preg_match($usuario, $form['apellido'])){
            if(strlen($form['apellido'])  > 2){
                if(false !== filter_var($form['email'], FILTER_VALIDATE_EMAIL)){
                  if($form['pass'] != ""){
                    $insert = $model->updateProfile2($form);
                    //var_dump($result);
                    if($insert){
                      $_SESSION["usuario"]      = $form['usuario'];
                      $_SESSION["email"]        = $form['email'];
                      //$_SESSION["apellido"]     = $form['apellido'];
                      $obj->addScript("Swal.fire({
                        title: 'Actualizado!',
                        text: 'Se ha Actualizado Correctamente.',
                        icon: 'success',
                        color: 'black'
                      });");
                      //REDIRECTION
                      session_destroy();
                      $obj->addScript("setTimeout(function(){window.location='login';},1000)");
                      //
                    }else{
                      $obj->addScript("Swal.fire({
                        title: '¡Hubo un error!',
                        text: 'No se ha podido Actualizar.',
                        icon: 'error',
                        color: 'black'
                      });");
                    }
                  }else{
                    $insertW = $model->updateProfileWithoutCedula2($form);
                    if($insertW){
                      $obj->addScript("Swal.fire({
                        title: 'Actualizado!',
                        text: 'Se ha Actualizado Correctamente.',
                        icon: 'success',
                        color: 'black'
                      });");
                      //REDIRECTION
                      session_destroy();
                      $obj->addScript("setTimeout(function(){window.location='login';},1000)");
                      //
                    }else{
                      $obj->addScript("Swal.fire({
                        title: '¡Hubo un error!',
                        text: 'No se ha podido Actualizar.',
                        icon: 'error',
                        color: 'black'
                      });");
                    }
                  }
              }else{
                $obj->addScript("Swal.fire({
                  title: '¡No se puede Actaulizar!',
                  text: 'El correo no cumple con los parametros.',
                  icon: 'error'
                });");
              }                  
            }else{
              $obj->addScript("Swal.fire({
                title: '¡No se puede registrar!',
                text: 'El apellido no puede tener menos de 3 caracteres.',
                icon: 'error',
                color: 'black'
              });");
            }
          }else{
            $obj->addScript("Swal.fire({
                title: '¡Verifique!',
                text: 'El Apellido  no puede tener caracteres especiales ni numeros.',
                icon: 'warning',
                color: 'black'
            });");
          } 
        }else{
          $obj->addScript("Swal.fire({
              title: '¡No se puede Actaulizar!',
              text: 'El nombre no puede tener menos de 3 caracteres',
              icon: 'warning',
              color: 'black'
          });");
        }      
      }else{
        $obj->addScript("Swal.fire({
          title: '¡No se puede Actaulizar!',
          text: 'El nombre no puede tener caracteres especiales ni numeros.',
          icon: 'warning',
          color: 'black'
        });");
      }
    }else{
      $obj->addScript("Swal.fire({
        title: '¡No se puede Actaulizar!',
        text: 'Hay un campo vacio.',
        icon: 'error',
        color: 'black'
      });");
    }
    return $obj; 
  }
  
  $xajax->registerFunction("Update2");
  $xajax->registerFunction("volver");
  //$xajax->registerFunction("login");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests(); 
?>