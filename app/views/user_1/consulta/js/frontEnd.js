$(document).ready(function(){
  $('#button').on('click',function(){
    xajax_BuscarAlumno(xajax.getFormValues('formulario3'));
  });
 });

/*$(document).ready(function(){
  $('#BtnQr').on('click',function(){
    xajax_GeneraQR(xajax.getFormValues('formulario3'));
  });
 });*/

function funcionAllPdf(value) {
  xajax_funcionAllPdf(value);
}

$.mask.definitions['~']='[VE]';
 $('#cedula').mask('~-9?9999999');

  function datatable(table){
$('#'+table).DataTable({
        "pagingType": "simple_numbers",
        "language": {
            "emptyTable"    : "No hay resultado disponibles en la tabla",
            //"lengthMenu"    : "Mostrar _MENU_",
            "zeroRecords"   : "No se encontraron resultados para la búsqueda",
            "info"          : "Mostrando pagina _PAGE_ de _PAGES_ ( _TOTAL_ Alumno(s) )",
            "infoEmpty"     : "No hay reportes disponibles",
            "infoFiltered"  : "(Filtrado de _MAX_ Alumnos totales)",
            "search"        : "Buscar:",
            "loadingRecords": "Buscando...",
            "processing"    : "Procesando...",
            "lengthMenu": 'Mostrar <select>'+
                '<option value="5">5</option>'+
                '<option value="10">10</option>'+
                '<option value="25">30</option>'+
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

function img(){
imagen = '<img src="app/lib/QR.png" alt="cargando..." />'
alumno = '<?php echo $_SESSION["usuario"]?>'
                         

document.write(imagen);
document.write(alumno);
}

function pedirVoto(){ 
    if (confirm("Esta página está genial (ya la puedes ver). Me das tu voto?")){ 
        window.open('<img src= "app/lib/QR.png""/>') 
    } 
} 

/*const wrapper = document.querySelector(".wrapper"),
qrInput = wrapper.querySelector(".form input"),
generateBtn = wrapper.querySelector(".form button"),
qrImg = wrapper.querySelector(".qr-code img");
let preValue;

generateBtn.addEventListener("click", () => {
    let qrValue = qrInput.value.trim();
    if(!qrValue || preValue === qrValue) return;
    preValue = qrValue;
    generateBtn.innerText = "Creating QR Code...";
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
    qrImg.addEventListener("load", () => {
        wrapper.classList.add("active");
        generateBtn.innerText = "Create QR Code";
    });
});

qrInput.addEventListener("keyup", () => {
    if(!qrInput.value.trim()) {
        wrapper.classList.remove("active");
        preValue = "";
    }
});*/

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


