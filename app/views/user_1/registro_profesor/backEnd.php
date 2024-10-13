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

    $model   = new profeModel('UFT-8');
    $result  = $model->getTeachersByCedula1($form);
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
    $model = new profeModel();
    if($form['nombre'] != "" && $form['apellido'] != "" && $form['cedula'] != "" && $form['email'] != "" && $form['pass'] != "" && $form['select'] != ""){
      $result = $model->getTeachersByCedula1($form);

      if(preg_match("/^[a-zA-ZñÑ\s]+$/", $form['nombre'])){
        if(preg_match("/^[a-zA-ZñÑ\s]+$/", $form['apellido'])){            
          if (strlen($form['nombre']) > 2){
            if(strlen($form['apellido']) > 2){
              if(strlen($form['cedula'])  == 10){
                //var_dump($result['numRows']);
                if($result['numRows'] == 0){
                  if(false !== filter_var($form['email'], FILTER_VALIDATE_EMAIL)){
                    if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{3,7}$/", $form['email'])){
                      if($form['pass'] > 10){
                        $insert = $model->getRegister($form);
                        if($insert){
                          $obj->addScript("Swal.fire({
                            title: '¡Registrado!',
                            text: 'Se ha registrado en la base de datos.',
                            icon: 'success',
                            color: 'black'
                          });");
                          //REDIRECTION
                          $obj->addScript("setTimeout(function(){ window.location='registro_profesor';},1000)");
                          //
                        }else{
                          $obj->addScript("Swal.fire({
                            title: '¡Hubo un error!',
                            text: 'Algún campo no cumple con los parámetros o esta vacío.',
                            icon: 'error',
                            color: 'black'
                          });");
                        }
                      }else{
                        $obj->addScript("Swal.fire({
                          title: '¡No se puede registrar!',
                          text: 'La Contraseña no puede tener menos de 10 dígitos.',
                          icon: 'error',
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
                      title: '¡No se puede registrar!',
                      text: 'El email no es válido.',
                      icon: 'error',
                      color: 'black'
                    });");
                  }
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
        text: 'Hay un campo vacío.',
        icon: 'error',
        color: 'black'
      });");
    }
   return $obj;    
  }

  //registramos la función creada anteriormente al objeto xajax
  $xajax->registerFunction("volver");
  $xajax->registerFunction("Register");
  $xajax->registerFunction("SearchCedula");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();
?>