$(document).ready(function(){
//xajax_ShowAseccion1A();
//xajax_ShowAseccion2A();
xajax_BuscarAlumno3();
});

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

$(document).ready(function(){
  $('#carnet').on('click',function(){
    xajax_ImprimirCarnet(xajax.getFormValues('formAlumno'));
  });
 });