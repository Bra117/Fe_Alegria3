<?php
 require ('app/plugins/xajax/xajax.inc.php');
  //instanciamos el objeto de la clase xajax
  $xajax = new xajax();
  //Función()
  function register($form){
    $obj = new xajaxResponse('UTF-8');
    $model = new loginModel();
    $result = $model->getTeachersByCedula($form);
    
    /* ESTA LINEA DE CODIGO ME PERMITE QUITAR LAS LETRA EN LA CEDULA*/
    $cedula =  preg_replace('/[a-zA-Z]+/', '',$form['cedula']);
    /**/ 

    $usuario = '^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]^';
    if($form['usuario'] != "" && $form['apellido'] &&  $form['cedula'] != ""  && $form['email'] != "" && $form['pass'] != "" && $form['select'] != ""){
     
      if(preg_match($usuario, $form['usuario'])){
     
        if(preg_match($usuario, $form['apellido'])){

          if (strlen($form['usuario']) > 2){

            if(strlen($form['apellido']) > 2){

              if($result['numRows'] == 0){

                if(strlen($form['cedula'])  >= 10){

                    if(false !== filter_var($form['email'], FILTER_VALIDATE_EMAIL)){
               
                      if(strlen($form['pass'])  > 5){
                        $insert = $model->getRegister($form);
                        
                          if($insert){
                            $obj->addScript("Swal.fire({
                              title: '¡Registrado!',
                              text: 'Se ha registrado en la base de datos.',
                              icon: 'success',
                              color: 'black'
                            });");
                            //REDIRECTION
                            $obj->addScript("setTimeout(function(){ window.location='login';},1000)");
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
                          title: '¡No se puede registar!',
                          text: 'La contraseña debe tener al menos 10 digitos.',
                          icon: 'error',
                          color: 'black'
                        });");
                      }
                    }else{
                      $obj->addScript("Swal.fire({
                        title: '¡No se puede registar!',
                        text: 'El correo no cumple con los parametros.',
                        icon: 'error',
                        color: 'black'
                      });");
                    }                  
                }else{
                  $obj->addScript("Swal.fire({
                    title: '¡No se puede registrar!',
                    text: 'La cedula no puede tener menos de 10.',
                    icon: 'error',
                    color: 'black'
                  });"); 
                }
              }else{     
                $obj->addScript("Swal.fire({
                  title: '¡Verifique!',
                  text: 'La cédula ya está registrada.',
                  icon: 'warning',
                  color: 'black'
                });");
              } 
            }else{
              $obj->addScript("Swal.fire({
                title: '¡Verifique!',
                text: 'El apellido no puede tener menos de 3 caracteres',
                icon: 'warning',
                color: 'black'
              });");
            }
          }else{
           $obj->addScript("Swal.fire({
              title: '¡Verifique!',
              text: 'El nombre no puede tener menos de 3 caracteres',
              icon: 'warning',
              color: 'black'
            });");
          }
        }else{
          $obj->addScript("Swal.fire({
            title: '¡Verifique!',
            text: 'El apellido no puede tener caracteres especiales ni numeros',
            icon: 'warning',
            color: 'black'
          });");
        }
      }else{
        $obj->addScript("Swal.fire({
          title: '¡Verifique!',
          text: 'El nombre no puede tener caracteres especiales ni numeros',
          icon: 'warning',
          color: 'black'
        });");
      } 
    }else{
      $obj->addScript("Swal.fire({
        title: '¡No se puede registrar!',
        text: 'Hay un campo vacio o la edad contiene letras',
        icon: 'error',
        color: 'black'
      });");
    }
    return $obj;       
  }

function validateInfo($form){
    $obj = new xajaxResponse('UTF-8');
    $cedula = trim(strtoupper($form['cedula']));
    $pass  = trim($form['password']);
    //var_dump($form);

    if ($cedula != "") {
      if ($pass != "") {
        $obj->addScript("xajax_login('".$cedula."','".$pass."');");
      }else{
         $obj->addScript("Swal.fire({
        title: '¡No se puede ingresar!',
        text: 'El campo contraseña esta vacío.',
        icon: 'error',
        color: 'black'
      });");
        /*$obj->addAlert('Debe ingresar la contraseña');
        $obj->addScript("$('#password').focus();");*/
      }
    }else{
      $obj->addScript("Swal.fire({
      title: '¡No se puede ingresar!',
      text: 'El campo cédula esta vacío.',
      icon: 'error',
      color: 'black'
    });");
      /*$obj->addAlert('Debe ingresar su cédula');
      $obj->addScript("$('#email').focus();");*/
      //var_dump($form);
    }
  return $obj;
}


  function login($cedula,$pass){
    $obj = new xajaxResponse('UTF-8');
    $loginModel = new loginModel();
    $password = sha1(md5($pass));
    $login = $loginModel->getLogin($cedula,$password);
    if ($login['numRows'] > 0 ) {

    $func = $login['row'];
    /*$pa = $pass;*/ // CONTRASENA DESENCRIPTADA//
    $_SESSION["id_status"]    = $func['id_status'];
    $_SESSION["id_profesor"]  = $func['id_profesor'];
    $_SESSION["usuario"]      = $func['full_name'];
    $_SESSION["nombre"]       = $func['nombre'];
    $_SESSION["apellido"]     = $func['apellido'];
    $_SESSION["email"]        = $func['email'];
    $_SESSION["id_rol"]       = $func['id_rol'];
    $_SESSION["d_rol"]        = $func['d_rol'];
    $_SESSION["cedula"]       = $func['cedula'];
    /*$_SESSION["pa"]           = $pa;*/
    $_SESSION["menu"]         = 1;
      //var_dump($func);

     if($_SESSION["id_status"] == 1){

      //var_dump($func);
      //$obj->addRedirect('home_all');
      switch ($func['id_rol']) {
        /* DIRECTIVO */
        case 1:
          $obj->addRedirect('user_1');
        break;
      
        /* PROFESOR */
        case 2:
          $obj->addRedirect('user_2');
        break;
        
        /* PSICOPEDAGOGIA*/
        case 3;
          $obj->addRedirect('user_4');
        break;
      }
    }else{
      $obj->addScript("Swal.fire({
      title: '¡No se puede ingresar!',
      text: 'El personal esta Inactivo.',
      icon: 'error',
      color: 'black'
    });");
    }
  }else{
     $obj->addScript("Swal.fire({
      title: '¡No se puede ingresar!',
      text: 'cédula o contraseña incorrecta.',
      icon: 'error',
      color: 'black'
    });");
  }
  return $obj;
}


  //registramos la función creada anteriormente al objeto xajax
  $xajax->registerFunction("cedula");
  $xajax->registerFunction("register");
  $xajax->registerFunction("validateInfo");
  $xajax->registerFunction("login");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests(); 
?>