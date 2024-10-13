$(document).ready(function(){  
xajax_showAllAno();
xajax_ShowAllMotivos();
xajax_ShowAllProfesor();
xajax_ShowCedulaPro(value);
})



function funcSelect(value) {
    xajax_showAllSeccions(value);
}

function funcSelect4(value) {
    xajax_ShowAllMaterias(value);
    xajax_ShowCedulaPro(value)
}

function funcSelect1(value) {
    xajax_showAllAlumnos(value);
    xajax_showstatusaseccion(value);
}

function funcSelect2(value) {
    xajax_showCampoTexto(value);
}

function funcionAllPdf(value) {
  xajax_funcionAllPdf(value);
}

function RestartContador(value){
  xajax_RestartContador(value);
  xajax_ResetPase(value);
}

function funcSelect3(value) {
  xajax_ResetPase(value);
  xajax_SearchCedulaAlumno(value);
}

$(document).ready(function(){
  $('#form_button').on('click',function(){
    xajax_Registerpase(xajax.getFormValues('form'));
   /*xajax_ResetPase(xajax.getFormValues('form'));*/
  });
});

$(document).ready(function(){
  $('#form_button').on('click',function(){
    xajax_ShowAllProfesor(xajax.getFormValues('form'));
  });
});


$.mask.definitions['~']='[VE]';
 $('#alumno_select').mask('~-9?9999999');

 window.onload = function(){
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
  document.getElementById('fechaActual').value=ano+"-"+mes+"-"+dia;
}



/* window.onload = function(){
  const event = new Date();
  const options = {
  //weekday: 'long',
  year: 'numeric',
  day: 'numeric',
  month: 'numeric'
}


const fecha  = event.toLocaleString('en-us', options);
const year  = event.getFullYear();
const day   = event.getDate();
const month = event.getMonth();
document.getElementById('fechaActual').value=fecha+options;




console.log(event);

}*/

/*var texto = '2017-01-10';
var salida = formato(texto);
console.log(salida);*

/**
 * Convierte un texto de la forma 2017-01-10 a la forma
 * 10/01/2017
 *
 * @param {string} texto Texto de la forma 2017-01-10
 * @return {string} texto de la forma 10/01/2017
 *
 */

$(function() {
    "use strict";

    $(".preloader").fadeOut();
    // this is for close icon when navigation open in mobile view
    $(".nav-toggler").on('click', function() {
        $("#main-wrapper").toggleClass("show-sidebar");
        $(".nav-toggler i").toggleClass("ti-menu");
    });
    $(".search-box a, .search-box .app-search .srh-btn").on('click', function() {
        $(".app-search").toggle(200);
        $(".app-search input").focus();
    });

    // ============================================================== 
    // Resize all elements
    // ============================================================== 
    $("body, .page-wrapper").trigger("resize");
    $(".page-wrapper").delay(20).show();
    
    //****************************
    /* This is for the mini-sidebar if width is less then 1170*/
    //**************************** 
    var setsidebartype = function() {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        if (width < 1170) {
            $("#main-wrapper").attr("data-sidebartype", "mini-sidebar");
        } else {
            $("#main-wrapper").attr("data-sidebartype", "full");
        }
    };
    $(window).ready(setsidebartype);
    $(window).on("resize", setsidebartype);
});


