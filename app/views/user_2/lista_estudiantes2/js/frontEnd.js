$(document).ready(function(){
//xajax_ShowAseccion1A();
//xajax_ShowAseccion2A();
xajax_SelectSeccion2();
});

$(document).ready(function(){
    $( '#botton_inasistencia' ).on( 'click', function(){
        if($('input[type=checkbox]#id_alumno_inasistente').is(':checked')){
            $('input[type=checkbox]#id_alumno_inasistente:checked').each(function (){
                let value = $(this).val();
                xajax_ValidationCkeckbox(value);
                xajax_ResetInasistencia(value);

            });
        }else{
            Swal.fire({
                title: '¡Aviso!',
                text: 'Debe Seleccionar al menos 1 Alumno si desea poner inasistente.',
                icon: 'warning',
                color: 'black'
            });
        }
    });
});

/*$(document).ready(function(){
    $('#botton_inasistencia').on('click',function(){
        if( $('input[type=checkbox]#id_alumno_inasistente').is('uncheck')) {
            $('input[type=checkbox]#id_alumno_inasistente:uncheck').each(function () {
                let value = $(this).val();
                xajax_ValidationCkeckbox(value);
            });
        }else{
            Swal.fire({
                title: '¡Aviso!',
                text: 'Debe Seleccionar al menos 1 Alumno si desea enviar.',
                icon: 'warning',
                color: 'black'
            });
            let value = $(this).val();
            console.log(value); 
        }
    });
});*/


function funcSelect9(value) {
    xajax_ShowAseccion2(value);   
    //xajax_countDataAjax(value);
};

function funcionAllPdf(value) {
  xajax_funcionAllPdf(value);
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

function datatable(table){
    $('#'+table).DataTable({
        "pagingType": "simple_numbers",
        "language": 
        {
            "emptyTable"    : "No hay estudiantes disponibles en la tabla",
            //"lengthMenu"    : "Mostrar _MENU_",
            "zeroRecords"   : "No se encontraron resultados para la búsqueda",
            "info"          : "Mostrando pagina _PAGE_ de _PAGES_ ( _TOTAL_ Estudiantes(s) )",
            "infoEmpty"     : "No hay Estudiantes disponibles",
            "infoFiltered"  : "(Filtrado de _MAX_ Estudiantes totales)",
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

/*function grafica(jsonText){

  //const labels   = jsonText.desc_seccion;
  //const total    = jsonText.total;
  const inasistencia_alumno  = jsonText.inasistencia_alumno;
  const total = jsonText.total_inasistencia;

  const graph = document.querySelector("#grafica");

  const data = {
    labels: [
     'total de Inasistencias',
     'Inasistencias Alumno',
    ],
    datasets: [{
      labels: 'dataSet',
      data: [inasistencia_alumno,total],
      backgroundColor: [
        '#e06060',
        'rgb(54, 162, 235)',
        '#000'
      ],
      hoverOffset: 4
    }]
  };
console.log(inasistencia_alumno);
  const config = {
    type: 'polarArea',
    data: data,
  };



  new Chart(graph, config);
}*/
