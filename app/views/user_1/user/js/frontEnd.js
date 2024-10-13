$(document).ready(function(){
xajax_ShowProfesores();
//xajax_ShowDirectivo();
//ajax_ShowDirectivo();
xajax_countProfesores();
xajax_countPersonal();
xajax_countDirectivo();
xajax_countAlumnos();
$.mask.definitions['~']='[VE]';
$('#cedula').mask('~-9?9999999');
});

$(document).ready(function(){
  $('#BtnActua').on('click',function(){
   var id_profesor = $('#id_profesor').val();
    xajax_UpdateTeacherInfo(xajax.getFormValues('ModalForm'), id_profesor);
  });
});

function teacher(id_profesor){
    $('#id_profesor').val(id_profesor);
}


function validateField(){
        console.log(cedula);
        xajax_ValidateFieldCedula(xajax.getFormValues('ModalForm'));
}

function myFunction(){
  $('#cedula').on('blur', function(){
        xajax_SearchCedula(xajax.getFormValues('form'));
    })   
}



/*$(document).ready(function(){
  $('#BtnActual').on('click',function(){
    var id_directivo = $('#id_directivo').val();
    xajax_ModificarDirectivo(xajax.getFormValues('form2'),id_directivo);
  });
});*/



/*$.mask.definitions['~']='[VE]';
  $('#cedula1').mask('~-9?9999999');*/


/*function directivo(id_directivo){

    $('#id_directivo').val(id_directivo);
}*/


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

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});



function datatable(table){
$('#'+table).DataTable({
        "pagingType": "simple_numbers",
        "language": {
            "emptyTable"    : "No hay Profesores disponibles en la tabla",
            //"lengthMenu"    : "Mostrar _MENU_",
            "zeroRecords"   : "No se encontraron resultados para la búsqueda",
            "info"          : "Mostrando pagina _PAGE_ de _PAGES_ ( _TOTAL_ Profesores(s) )",
            "infoEmpty"     : "No hay Profesores disponibles",
            "infoFiltered"  : "(Filtrado de _MAX_ Profesores disponibles)",
            "search"        : "Buscar:",
            "loadingRecords": "Buscando...",
            "processing"    : "Procesando...",
            "lengthMenu": 'Mostrar <select>'+
                '<option value="5">5</option>'+
                '<option value="10">10</option>'+
                '<option value="25">25</option>'+
                '<option value="50">50</option>'+
                '<option value="-1">Todos</option>'+
            '</select>',
            "paginate": {
            "first"   : "Primero",
            "last"    : "Ultimo",
            "next"    : "Siguiente",
            "previous": "Anterior"
            }                                                      
        }
    });
}

