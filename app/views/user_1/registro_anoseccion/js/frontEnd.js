$(document).ready(function(){  
xajax_showAseccion();
})

$(document).ready(function(){
  $('#form_button3').on('click',function(){
    xajax_Register(xajax.getFormValues('form1'));
  });
});

// Initialize our function when the document is ready for events.
$(document).ready(function(){
    // Listen for the input event.
    $("#ano").on('input', function (evt) {
        // Allow only numbers.
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
});

$(document).ready(function(){
    // Listen for the input event.
    $("#seccion").on('input', function (evt) {
        // Allow only numbers.
        $(this).val($(this).val().replace(/[^A-Za-z]/, ''));
    });
});

function validateField(){
    var id_aseccion = $('#id_aseccion').val();
    xajax_ValidateFieldCedula(xajax.getFormValues('ModalForm'), id_aseccion);
}


$(document).ready(function(){
  $('#BtnActua').on('click',function(){
   var id_aseccion = $('#id_aseccion').val();
    xajax_UpdateAseccionInfo(xajax.getFormValues('ModalForm'), id_aseccion);
  });
});

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
            "emptyTable"    : "No hay Materia disponibles en la tabla",
            //"lengthMenu"    : "Mostrar _MENU_",
            "zeroRecords"   : "No se encontraron resultados para la búsqueda",
            "info"          : "Mostrando pagina _PAGE_ de _PAGES_ ( _TOTAL_ Materia(s) )",
            "infoEmpty"     : "No hay Materia disponibles",
            "infoFiltered"  : "(Filtrado de _MAX_ Materia disponibles)",
            "search"        : "Buscar:",
            "loadingRecords": "Buscando...",
            "processing"    : "Procesando...",
            "lengthMenu": 'Mostrar <select>'+
                '<option value="4">4</option>'+
                '<option value="3">3</option>'+
                '<option value="2">2</option>'+
                '<option value="10">10</option>'+
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




