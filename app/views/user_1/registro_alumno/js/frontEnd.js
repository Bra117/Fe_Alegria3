$(document).ready(function(){
xajax_SelectSeccion();
});

function myFunction(){
  $('#cedula').on('blur', function(){
        xajax_SearchCedula(xajax.getFormValues('form'));
    })   
}

$("#nombre").keyup(function(){
    let string = $("#nombre").val();
    $("#nombre").val(string.replace(/ /g, ""))
})

$("#apellido").keyup(function(){
    let string = $("#apellido").val();
    $("#apellido").val(string.replace(/ /g, ""))
})

$(document).ready(function(){
  $('#form_button').on('click',function(){
    xajax_Register(xajax.getFormValues('form'));
  });
});

$(document).ready(function(){
  $('#back').on('click',function(){
    xajax_back(xajax.getFormValues('form'));
  });
});



/*$(document).ready(function(){
  $('#QR').on('click',function(){
    xajax_QR(xajax.getFormValues('form'));
  });
});*/

/*const form = document.querySelector(".form"),
qrInput = form.querySelector(".form input"),
generateBtn = document.getElementById("QR"),
qrImg = form.querySelector(".qr-code img");
let preValue;

generateBtn.addEventListener("click", () => {
    let qrValue = qrInput.value.trim();
    if(!qrValue || preValue === qrValue) return;
    preValue = qrValue;
    generateBtn.innerText = "Creating QR Code...";
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=${qrValue}`;
    qrImg.addEventListener("load", () => {
        form.classList.add("active");
        generateBtn.innerText = "Create QR Code";
    });
});

qrInput.addEventListener("keyup", () => {
    if(!qrInput.value.trim()) {
        form.classList.remove("active");
        preValue = "";
    }
});*/


 $.mask.definitions['~']='[VE]';
  $('#cedula').mask('~-9?9999999');




  form.addEventListener('submit', (e) => {
    e.preventDefault()            
  });

(function() {
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

/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

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

