$(document).ready(function(){
  $('#button2').on('click',function(){
    xajax_BuscarAlumno2(xajax.getFormValues('formulario4'));
  });
 });

$(document).ready(function(){
  $('#BtnQr').on('click',function(){
    xajax_GeneraQR(xajax.getFormValues('form3'));
  });
 });

$.mask.definitions['~']='[VE]';
 $('#cedula').mask('~-9?9999999');

  function datatable(table){
$('#'+table).DataTable({
        "pagingType": "simple_numbers",
        "language": {
            "emptyTable"    : "No hay resultado disponibles en la tabla",
            "lengthMenu"    : "Mostrar _MENU_",
            "zeroRecords"   : "No se encontraron resultados para la búsqueda",
            "info"          : "Mostrando pagina _PAGE_ de _PAGES_ ( _TOTAL_ Alumno(s) )",
            "infoEmpty"     : "No hay reportes disponibles",
            "infoFiltered"  : "(Filtrado de _MAX_ Alumnos totales)",
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