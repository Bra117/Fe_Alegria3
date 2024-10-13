$(document).ready(function(){
xajax_showHora();
});


$(document).ready(function(){
$.mask.definitions['~']='[AP]';
$('#hora').mask(' 99:99 ~M');
});

$(document).ready(function(){
  $('#form_button1').on('click',function(){
    xajax_Register1(xajax.getFormValues('form1'));
  });
});

$(document).ready(function(){
  $('#BtnActua').on('click',function(){
   var id_hora = $('#id_hora').val();
    xajax_UpdateHoraInfo(xajax.getFormValues('ModalForm'), id_hora);
  });
});

function validateField(){
    var id_hora = $('#id_hora').val();
    xajax_ValidateFieldCedula(xajax.getFormValues('ModalForm'), id_hora);
}


function datatable(table){
$('#'+table).DataTable({
        "pagingType": "simple_numbers",
        "language": {
            "emptyTable"    : "No hay horas disponibles en la tabla",
            //"lengthMenu"    : "Mostrar _MENU_",
            "zeroRecords"   : "No se encontraron resultados para la búsqueda",
            "info"          : "Mostrando pagina _PAGE_ de _PAGES_ ( _TOTAL_ hora(s) )",
            "infoEmpty"     : "No hay horas disponibles",
            "infoFiltered"  : "(Filtrado de _MAX_ Materia horas)",
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

