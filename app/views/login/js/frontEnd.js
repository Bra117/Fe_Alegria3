$(document).ready(function(){
//xajax_ShowAseccion1A();
//xajax_ShowAseccion2A();
});

$(document).ready(function(){
  $('#BtnLogin').on('click',function(){
    xajax_validateInfo(xajax.getFormValues('loginform'));
  });
});

$.mask.definitions['~']='[VE]';
 $('#cedula').mask('~-9?9999999');

$.mask.definitions['~']='[VE]';
 $('.cedula').mask('~-9?9999999');


/**************** JAVASCRIPT FORM LOGIN & REGISTER VALIDATION ONLY CSS *************************/
/*window.addEventListener('load', ()=> {
  const inputs       = document.querySelectorAll('#container__all input');
  const form         = document.querySelector('#container__all');
  const usuario      = document.getElementById('usuario');
  const apellido     = document.getElementById('apellido');
  const cedula       = document.getElementById('cedula');
  const cedula_login = document.getElementById('cedula_login');
  const pass_login   = document.getElementById('pass_login');
  const email        = document.getElementById('email');
  const pass         = document.getElementById('pass');


   /*form.addEventListener('submit', (e) => {
     e.preventDefault()
    validaCampos()     
   });*/

 //VALIDACAMPOS()
   /* const validaCampos = () => {
    //capturar los valores ingresados por el usuario
    const usuarioValor      = usuario.value.trim();
    const apellidoValor     = apellido.value.trim();
    const cedula_loginValor = cedula_login.value.trim();
    const cedulaValor       = cedula.value.trim();
    const emailValor        = email.value.trim();
    const passValor         = pass.value.trim();
    const pass_loginValor   = pass_login.value.trim();

    // VALIDACION USUARIO 
    const ar = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g
    if(!usuarioValor){
      validaFalla(usuario, 'Campo vacío');
    }else if(usuarioValor.length > 50){
      validaFalla(usuario, 'El nombre debe ser menor de 50 caracrteres')
    }else if (usuarioValor.length < 3) {
      validaFalla(usuario, 'El nombre debe tener al menos 3 caracteres')
    }else if (!usuarioValor.match(ar)) {
      validaFalla(usuario, 'Debe tener sòlo letras, sin espacio')
    }else{
      validaOk(usuario)
    }
         
    // VALIDACION APELLIDO
    const ur = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g
    /* \u00f1 y \u00d1 significa  "ñ" y "Ñ"*/
   /* if(!apellidoValor){
      validaFalla(apellido, 'Campo vacío')
    }else if(apellidoValor.length > 50){
      validaFalla(usuario, 'El apellido debe ser menor de 50 caracteres')
    }else if(apellidoValor.length < 3) {
      validaFalla(apellido, 'El apellido debe tener mas de 4 caracteres')
    }else if(!apellidoValor.match(ur)){
      validaFalla(apellido, 'Debe tener sòlo letras, sin espacios')
    }else{
      validaOk(apellido)
    }

    //VALIDACION CEDULA
    const ab = /^[VvEe]-[0-9]{1,8}$/i
    ^[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g
    if(!cedulaValor){
      validaFalla(cedula, 'Campo vacío')
    }else if(!cedulaValor.match(ab)) {
      validaFalla(cedula, 'Debe tener sòlo nùmeros y cumplir con el formato')
    }else if(cedulaValor.length > 10){
      validaFalla(cedula, 'No puede tener mas de 10 dìgitos')
    }else if(cedulaValor.length < 10){
      validaFalla(cedula, 'No puede tener menos de 10 dìgitos')
    }else{
      validaOk(cedula)
    }*/

      //VALIDACION CEDULA_LOGIN
    /*const re = /^[VvEe]-[0-9]{1,8}$/i
    if(!cedula_loginValor){
      validaFalla(cedula_login, 'Campo vacío')
    }else if(!cedula_loginValor.match(re)) {
      validaFalla(cedula_login, 'Debe tener sòlo nùmeros y cumplir con el formato')
    }else if(cedula_loginValor.length > 10){
      validaFalla(cedula_login, 'No puede tener mas de 10 dìgitos')
    }else if(cedula_loginValor.length < 10){
      validaFalla(cedula_login, 'No puede tener menos de 10 dìgitos')
    }else{
      validaOk(cedula_login)
    }

   //VALIDACION EMAIL
  const validaEmail = (email) => {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);        
  }
    if(!emailValor){
      validaFalla(email, 'Campo vacío')            
    }else if(!validaEmail(emailValor)) {
      validaFalla(email, 'El e-mail no es válido')
    }else{
      validaOk(email)
    }

    //VALIDACION PASSWORD
    const er = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,18}$/          
    if(!passValor) {
      validaFalla(pass, 'Campo vacío')
    }else if (passValor.length < 6){   
      validaFalla(pass, 'Debe tener 6 caracteres cómo mínimo.')
    /*}else if (!passValor.match(er)) {
      validaFalla(pass, 'Debe tener al menos una mayuscula, una minuscula,  y un número.')*/
    /*}else{
      validaOk(pass)
    }
    
    //VALIDACION PASSWORD_LOGIN
     /*const af = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,18}$/        
    if(!pass_loginValor) {
      validaFalla(pass_login, 'Campo vacío')
    }else if (pass_loginValor.length < 6) {   
      validaFalla(pass_login, 'Debe tener 6 caracteres cómo mínimo.')
    }else{
      validaOk(pass_login)
    }
  //////////////////////////////// FORM VALIDATION  /////////////////////////////////////////////////////////////
  function valida(usuarioValor){
    const hola = "^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$";
    if(usuarioValor.match(hola) !=  null){
      return true;
    }else{
      return false;
    }
  }
 /*$('#Btn_register').click(function (e) {
  e.preventDefault();
  validate();
});

function validate(){

  if(usuarioValor != ""){
    if(usuarioValor.length > 2){
      if(valida(usuarioValor)){
        if(apellidoValor != ""){
          if(valida(apellidoValor)){
            if(apellidoValor.length > 3){
              if(cedulaValor != ""){
                if(cedulaValor.length > 9){
                  if(emailValor != ""){
                    if(validaEmail(emailValor)){
                      if(passValor != ""){
                        if(passValor.length  > 5){
                          var  url = 'app/views/login/backEnd.php';
                          var eform = document.getElementById("form__register");            
                           var usuario =  document.getElementById("usuario").value;
                           var apellido = document.getElementById("apellido").value;
                           var cedula = document.getElementById("cedula").value;
                           var id_rol = document.getElementById("select").value;
                           var pass = document.getElementById("pass").value;
                           var select = document.getElementById("select").value;

                          const formData = new FormData();

                          formData.append('usuario', usuario);
                          formData.append('apellido', apellido);
                          formData.append('cedula', cedula);
                          formData.append('id_rol', id_rol);
                          formData.append('pass', pass);
                          formData.append('select', select);

                          $.ajax({
                            method: "POST", //send method
                            url: url, //URL 
                            data: formData, //data to be send
                            processData: false,
                            contentType: false,
                            success: function(){
                             Swal.fire({
                                title: "¡Registrado!",
                                text: "¡Ha sido registrado exitosamente!",
                                icon: "success"
                              });
                            },              
                            error: function () {
                             Swal.fire({
                                title: "¡Error!",
                                text: "¡No se ha registrado exitosamente!",
                                icon: "error"
                              });
                            }
                          })
                        }else{
                          Swal.fire({
                           title: "Error!",
                           text: "¡Su Password no cumple con el formato!",
                           icon: "warning"
                          })
                        }
                      }else{
                        Swal.fire({
                         title: "¡Revisar!",
                         text: "¡Su Password no puede estar vacío!",
                         icon: "error"
                        })
                      }
                    }else{
                      Swal.fire({
                        title: "¡Revisar!",
                        text: "¡Su Email es inválido!",
                        icon: "error"
                      })  
                    }
                  }else{
                    Swal.fire({
                      title: "¡Revisar!",
                      text: "¡Su Email esta vacío!",
                      icon: "error"
                    }) 
                  }
                }else{
                  Swal.fire({
                    title: "¡Revisar!",
                    text: "¡Su Cédula no puede tener menos de 10 carácteres!",
                    icon: "warning"
                  })
                }     
              }else{
                Swal.fire({
                  title: "¡Revisar!",
                  text: "¡Su Cédula esta vacío!",
                  icon: "warning"
                })  
              }
            }else{
              Swal.fire({
                title: "¡Revisar!",
                text: "¡Su Apellido no puede tener menos de 5 carácteres!",
                icon: "warning"
              })
            }
          }else{
            Swal.fire({
              title: "¡Error!",
              text: "¡Su Apellido no cumple con el formato!",
              icon: "error"
            })
          }
        }else{
          Swal.fire({
            title: "¡Revisar!",
            text: "¡Su Apellido no puede estar vacío!",
            icon: "warning"
          })
        }
      }else{
        Swal.fire({
          title: "¡Error!",
          text: "¡Su Nombre no cumple con el formato!",
          icon: "error"
        })
      }  
    }else{
      Swal.fire({
        title: "¡Error!",
        text: "¡Su Nombre no puede tener menos de 3 carácteres!",
        icon: "error"
      })
    }
  }else{
    Swal.fire({
      title: "¡Revisar!",
      text: "¡Su Nombre no puede estar vacío!",
      icon: "warning"
    });
  };
 };*/



//////////////////////////////// END FORM VALIDATION  /////////////////////////////////////////////////////////////


/*  inputs.forEach((input) => {
    //input.addEventListener('keyup', validaCampos);
    input.addEventListener('blur', validaCampos);
  });

 const validaFalla = (input, msje) => {
    const formControl = input.parentElement
    const aviso = formControl.querySelector('p')
    aviso.innerText = msje
    formControl.className = 'form-control falla'
  }

  const validaOk = (input, msje) => {
    const formControl = input.parentElement
    formControl.className = 'form-control ok'
  }

})*/

 ////////////////////////////////////////////////////// FUNCIONA /////////////////////////////////////////////////////



/*$(document).ready(function () {
    $('#Btn_register').click(function (e) {
        e.preventDefault();
  var Http = new XMLHttpRequest();
  var url  = 'app/views/login/backEnd.php';
  var data = $(".form__register").serialize();

  /*"&usuario=" + document.getElementById("usuario").value + 
               "&apellido=" + document.getElementById("apellido").value + 
               "&cedula=" + document.getElementById("cedula").value + 
               "&email=" + document.getElementById("email").value +
               "&pass=" + document.getElementById("pass").value;

  Http.open("POST", url);
  Http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  Http.onreadystatechange = function() {
      if(Http.readyState == 4 && Http.status == 200) {
          //aquí es donde se mostrarán los datos de respuesta
          console.log("hola")
      }
  }
  Http.send(data);
});

})*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Show/hide password onClick of button using Javascript only

// https://stackoverflow.com/questions/31224651/show-hide-password-onclick-of-button-using-javascript-only

// Show/hide password onClick of button using Javascript only

// https://stackoverflow.com/questions/31224651/show-hide-password-onclick-of-button-using-javascript-only


jQuery('#clickme').on('click', function() {
  jQuery('#password').attr('type', function(index, attr) {
    return attr == 'text' ? 'password' : 'text';
  })
})


// Get the input field
var input1 = document.getElementById("cedula");
var input2 = document.getElementById("password");

// Execute a function when the user presses a key on the keyboard
input1.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("BtnLogin").click();
  }
}); 

input2.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("BtnLogin").click();
  }
}); 

