$(document).ready(function(){
//xajax_ShowAseccion1A();
//xajax_ShowAseccion2A();
xajax_SelectSeccion1();
});



function funcSelect1(value) {
    xajax_ShowAseccion1(value);   
};

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
        "language": 
        {
            "emptyTable"    : "No hay estudiantes disponibles en la tabla",
            "lengthMenu"    : "Mostrar _MENU_",
            "zeroRecords"   : "No se encontraron resultados para la búsqueda",
            "info"          : "Mostrando pagina _PAGE_ de _PAGES_ ( _TOTAL_ Estudiantes(s) )",
            "infoEmpty"     : "No hay Estudiantes disponibles",
            "infoFiltered"  : "(Filtrado de _MAX_ Estudiantes totales)",
            "search"        : "Buscar:",
            "loadingRecords": "Buscando...",
            "processing"    : "Procesando...",
            "paginate": {
            "first"   : "Primero",
            "last"    : "Ultimo",
            "next"    : "Siguiente",
            "previous": "Anterior"
            }                                                      
        }
    });
}

$(document).ready(function(){
  $('#BtnActua').on('click',function(){
    var id_student1 = $('#id_student1').val();
    xajax_ModificarStudent(xajax.getFormValues('form1'),id_student1);
  });
});

$.mask.definitions['~']='[VE]';
 $('#cedula').mask('~-9?9999999');


function Student1(estudiante1){

        $('#id_student1').val(estudiante1);
    }