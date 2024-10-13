$(document).ready(function(){
//xajax_ShowAseccion1A();
//xajax_ShowAseccion2A();
xajax_SelectSeccion();
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

  const labels   = jsonText.desc_seccion;
  const total    = jsonText.total;
  const seccion  = jsonText.seccion;
  const inactivo = jsonText.inactivo;

  const graph = document.querySelector("#grafica");

  const data = {
    labels: [
     'total de alumnos',
     ' '+labels+' ',
     'Inactivo'
    ],
    datasets: [{
      labels: 'dataSet',
      data: [total,seccion,inactivo],
      backgroundColor: [
        '#e06060',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)',
        '#000'
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

  /*var total = jsonText.total;
  var desc_seccion   = jsonText.desc_seccion;
  var seccion = jsonText.seccion;*/

/*console.log (desc_seccion);
console.log (seccion);
console.log (total);
  //cargamos los contadores principales
  //cargamos la grafica
  /*if (seccion == "") {

    var donutData = [
      {
        label: 'Sin Data',
        data : 1 ,
        color:  '#28a745'
      }
    ]

  }else{
    var donutData = [
      {
        label: 'desc_seccion',
        data : seccion,
        color: '#6c757d'
      },
      {
        label: 'desc_seccion',
        data : seccion,
        color: '#17a2b8'
      },
      {
        label: 'desc_seccion',
        data : seccion,
        color: '#ffc107'
      }
    ]
  }
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false,

      }
    })

  function labelFormatter(label, series) {
    return '<div style=\"font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;\">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }

}*/
