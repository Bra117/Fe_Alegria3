$(document).ready(function(){
//xajax_ShowAseccion1A();
//xajax_ShowAseccion2A();
xajax_SelectSeccion();
xajax_countDataAjax2();
});

function funcSelect(value) {
  xajax_ShowAseccion(value);
  xajax_countDataAjax(value);   
};

$(document).ready(function(){
  $('#BtnActua').on('click',function(){
    xajax_UpdateStudentInfo(xajax.getFormValues('ModalForm'));
  });
});

function validateField(){
  xajax_ValidateFieldCedula(xajax.getFormValues('ModalForm'));
}

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

function Student(estudiante){

    $('#id_student').val(estudiante);
}

function myFunction(){
  $('#cedula').on('blur', function(){
        xajax_SearchCedula(xajax.getFormValues('form'));
    })   
}




function grafica(jsonText){

    document.getElementById("grafica").remove();
    var canvas = document.createElement("canvas");
    canvas.id = "grafica"; 
    document.getElementById("contenedor").appendChild(canvas);

  const inasistencia_real    = jsonText.inasistencia_real;
  const total_inasistencias  = jsonText.total_inasistencias;
  const inasistencia_vigentes    = jsonText.inasistencia_vigentes;
  const inasistencias_anuladas  = jsonText.inasistencias_anuladas;

  const graph = document.querySelector("#grafica");
  
  const data = {
    labels: [
     'total de Inasistencias',
     'Insistencia Seccion',
     'Inasistencias Vigentes',
     'Inasistencias Anuladas'
    ],
    datasets: [{
      labels: 'dataSet',
      data: [total_inasistencias, inasistencia_real, inasistencia_vigentes, inasistencias_anuladas],
      backgroundColor: [
        '#dffc03',
        '#030bfc',
        '#13fc03',
        '#fc0303'
      ],
      hoverOffset: 4
    }]
  };

  const config = {
    type: 'polarArea',
    data: data,
  };



  new Chart(graph, config);
}

/*function grafica2(jsonText){

  const secciones       = jsonText.secciones;
  console.log(secciones);

  //const total_inasistencias  = jsonText.total_inasistencias;

  var data = {
            labels: [secciones],
            datasets: [{
                label: "Ventas",
                data: [12.50, 19.00, 3.50, 5, 2, 10, 20,50,32,34],
                backgroundColor: 'rgb(4, 24, 124)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Opciones del gráfico de barras
        var options = {
            showAllTooltips: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    offset: 4,
                    color: 'red',
                    font: {
                        weight: 'bold',
                        size: 12
                    }
                }
            }
        };

        // Crear el gráfico de barras
        var ctx = document.getElementById('grafica2').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
}

 /*var data = {
            labels: ["17/09", "18/09", "19/09", "20/09", "21/09", "22/09", "23/09"],
            datasets: [{
                label: "Ventas",
                data: [12.50, 19.00, 3.50, 5, 2, 10, 20],
                backgroundColor: 'rgb(4, 24, 124)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Opciones del gráfico de barras
        var options = {
            showAllTooltips: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    offset: 4,
                    color: 'red',
                    font: {
                        weight: 'bold',
                        size: 12
                    }
                }
            }
        };

        // Crear el gráfico de barras
        /*var ctx = document.getElementById('grafica2').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        }); var data = {
            labels: ["17/09", "18/09", "19/09", "20/09", "21/09", "22/09", "23/09"],
            datasets: [{
                label: "Ventas",
                data: [12.50, 19.00, 3.50, 5, 2, 10, 20],
                backgroundColor: 'rgb(4, 24, 124)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Opciones del gráfico de barras
        var options = {
            showAllTooltips: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    offset: 4,
                    color: 'red',
                    font: {
                        weight: 'bold',
                        size: 12
                    }
                }
            }
        };

        // Crear el gráfico de barras
        var ctx = document.getElementById('grafica2').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });*/                                               