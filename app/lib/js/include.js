 /*Redirecciona a una nueva pagina
	variables:
		pag=Ruta de la pagina y si envian variables se indica de una vez
*/		
function PagNuv(pag){
	document.forms[0].action=pag;
	document.forms[0].submit();
}

	//CREA UNA NUEVA PAGINA
	//pagina=Ruta y cdoc= una variable enviar  
	function Pagina_nueva_direc(pagina,cdoc){
		window.open(pagina+cdoc,"Codigo","toolbar = 0,scrollbars =0, status =0, resizable=0, width =300,height =200, left=300, top=300, directories=0, location=0");
	}

//PERMISOS INICIO
var nav4 = window.Event ? true : false;
/*---------Bloqueos de Teclas---------*/

//Solo Numeros
function acceptNum(evt){
   // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57	
   var key = nav4 ? evt.which : evt.keyCode;	
   return (key < 13 || (key >= 48 && key <= 57));
}

//Solo Numeros y Letras
function acceptAlphaNum(evt){
   // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57	
   var key = nav4 ? evt.which : evt.keyCode;	
   return (key < 13 || (key >= 48 && key <= 57)) || (key < 13 || key==32 || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || key==209 || key==241);
}

//Solo Letras
function acceptLetras(evt){	
	// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57	
	var key = nav4 ? evt.which : evt.keyCode;	
	return (key < 13 || key==32 || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || key==209 || key==241);
}
//Solo letras y numeros - ' .
function aceptLetNumS(evt){
  // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57	
	var key = nav4 ? evt.which : evt.keyCode;	
	  return (key < 13 || (key >= 38 && key <= 39)) || (key >= 97 && key <= 122) || (key >= 48 && key <= 57) || (key >= 40 && key <= 41) || (key >= 44 && key <= 45) || (key == 32) || (key == 34) || (key >= 65 && key <= 90) || (key == 130) || (key >= 160 && key <= 167) || (key == 209) || (key == 241) ;
	
}
//Solo Correos electronicos
function acceptCorreos(evt){	
	// NOTE: Letras, Numeros, '.', '-', '_'	
	var key = nav4 ? evt.which : evt.keyCode;	
	return (key < 13 || (key >= 45 && key <= 46) || (key >= 48 && key <= 57) || (key >= 64 && key <= 90) || key==95 || (key >= 97 && key <= 122));
}

//Solo numeros, comas y puntos
function acceptNumComa(evt){
   // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 La coma=44 El punto = 46	
   var key = nav4 ? evt.which : evt.keyCode;	
   return (key <= 13 || (key >= 48 && key <= 57) || key==46);
}
//Solo Letras y Comas
function acceptLetrasComa(evt){	
	// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57	
	var key = nav4 ? evt.which : evt.keyCode;	
	return (key <= 13 || key==32 || key==44 || (key >= 65 && key <= 90) || (key >= 97 && key <= 122));
}

//Bloquear una tecla
function BloqTeclas(evt,tecla1,tecla2){
	//'-'=45; Enter = 13
   var key = nav4 ? evt.which : evt.keyCode;	
   return (key != tecla1 && key != tecla2);
}

//Bloquea en Enter
function BloqEnter(evt){							
   // NOTE: Enter = 13
   var key = nav4 ? evt.which : evt.keyCode;	
   return (key < 13 || (key >= 14 && key <= 33) || (key >= 35 && key <= 38) || key >= 40);
}

//PERMITE EL USO DE NUMERO Y COMA
function variasSolicitudes(evt){	
   // NOTE: Backspace = 8, Enter = 13, ','= 44, '0' = 48, '9' = 57	
   var key = nav4 ? evt.which : evt.keyCode;	
   return (key < 13 || (key >= 48 && key <= 57) || key == 44);
}

function ValidaObservaciones(evt){							
   // NOTE: Todas las teclas menos las (') y ("); tambien elimino el Ctrl	
   var key = nav4 ? evt.which : evt.keyCode;	
   return (key <= 13 || (key >= 18 && key <= 33) || (key >= 35 && key <= 38) || key >= 40);
}

//Esta funcion Bloquea el Boton Derecho del Mouse
function BloquearBotonMouse()	{
	return false;
}


//Limpia los espacios en blanco al Inicio y al Final del String
function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}

//Validad Formato de Correo
function ValidaCorreo(correo)
{
  //var filter=/^[A-Za-z][A-Za-z0-9_.-]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
	var filter=/^[a-z0-9_+.-]+\@([a-z0-9-]+\.)+[a-z0-9]{2,4}$/;
	if (filter.test(correo))	
		return true;
	else
	 return false;
}

//****Fin**********
//Muestra o Oculta una parte del Formulario
var obj=null;
function viewHide(id)
{
	var targetId, srcElement, targetElement;
	var targetElement = document.getElementById(id);
	var valorNfab = document.getElementById("var_fabrica").value;
	var newFabric = document.getElementById("fab_nuevo");
	var newtabla1 = document.getElementById("tabla1");
	if (obj!=null) 
	  obj.style.display='none';
	  obj=targetElement;
	  targetElement.style.display = "";
	//Limpia si es extranjera  
	if(targetElement.id == 'tabla2'){
		//Tabla destino
	   newtabla1.style.display='none';
	   newFabric.style.display = 'none'; 
	   if(valorNfab == 1){
		   xajax_restarFab(valorNfab);
	   }
	}
 }

//Elimina una opcion de un select
//id: Id del Select y option: Opcion a eliminar
function delete_option(id,option){
	document.getElementById(id).options[option] = null;
}
//Valida tama�o de textarea
	
	function ismaxlength(obj,id){
	var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : "";
	if (obj.getAttribute && obj.value.length>mlength){
		obj.value=obj.value.substring(0,mlength);
	alert("La cantidad máxima de caracteres en la observación es de 255\n Por Favor Verifique");
			document.getElementById(id).focus();					
		}
}
//--- VALIDACION DE ESPACIOS VACIOS ---//

function check(k){	
	if( k.value == null || k.value.length == 0){
	  alert("El campo ("+k.id+") no puede estar vacío o su Formato es Incorrecto");
	  k.focus();
	  return false;
	}else{
		return true;
	}
}

/*
************************************************* ESTA FUNCION FUE ALTERADA VERSION ORIGINAL ******************************
function check(k){	
	if( k.value == null || k.value.length == 0 || /^\s+$/.test(k.value) ){
	  alert("El campo ("+k.id+") no puede estar vacío o su Formato es Incorrecto");
	  k.focus();
	  return false;
	}else{
		return true;
	}
}
*/
//--- VALIDACION DE RADIO BUTTON ---//

function validarBotonRadio2() {
var s = "no";
with (document.forms[0]){
for ( var i = 0; i < orp.length; i++ ) {
if ( orp[i].checked ) {
s= "si";
return true;
break;
}
}
if ( s == "no" ){
window.alert("Debe seleccionar el Origen del Producto" ) ;
sol_num.focus();
 return false;
}
}
} 


   //--- VALIDACION ENTRE DOS FECHAS DADAS ---//
   
function validarFecha()
{
with (document.formulario){
var Finicial=new Date(anioExp.value,mesExp.value,diaExp.value);var Ffinal=new Date(anioVenc.value,mesVenc.value,diaVenc.value);
var k=anioExp;
    if(Finicial > Ffinal)
    {
      alert("El campo Fecha de Expedicion no puede no puede ser mayor a la Fecha Vencimiento");
	  k.focus();
      return false;
     }
    else{
      return true;
	  }}}
	  
	  
	//Seleccion con valor por defecto //
	function marcar(valor,elem){
		obj=document.getElementById(elem);
		for(ii=0;ii<obj.options.length;ii++){
			if(obj.options[ii].value==valor){
				obj.options[ii].selected=1;
			}else{
				obj.options[ii].selected=0;
			}
		}
	} 	  
	
	function ventanaSecundaria(URL){ 
	   ancho=screen.availWidth;
       alto=screen.availHeight;
	   window.open(URL,"ventana1","width="+ancho+", height="+alto+", menubar=no, scrollbars=yes, statusbar=0,fullscreen=yes, toolbar=no, location=no, directories=no, resizable=no,top=0,left=0"); 
		
	}
var ventana;	
    ventana = "ventana1"; 
function ventanaSecond(URL){
		window.open(URL,ventana,"width=1014, height=720, menubar=no, scrollbars=yes, statusbar=0, toolbar=no, location=no, directories=no, resizable=no,top=100,left=100"); 
	}	

function limpiarCampo(id_campo){
	setTimeout("document.getElementById('"+id_campo+"').value=''");
}

function disabled(id_campo){
	setTimeout("document.getElementById('"+id_campo+"').disabled=true");
}

//VALIDA EL CAMPO SOLICITUD DE LOS BUSCADORES//
function checkSolicitudes(pagina){
	var digito;
	digito=document.forms[0].solicitudes.value;
	dig=digito.replace(/,,/gi,",");
	document.forms[0].solicitudes.value=dig;
	f=dig.substring(0,1);
	e=dig.substring(dig.length-1,dig.length);

	if (document.forms[0].solicitudes.value ==""){				 
		PagNuv(pagina);
	}else if(f==',' || e==','){
	   alert("Verifique la data introducida, no debe comenzar ni terminar por coma (,)");
	   document.forms[0].solicitudes.focus();
	}else{
		document.forms[0].submit();
	}
}

	/* Esta funci�n valida que si se deschequea un check box y estaba seleccionado
	el checkbox de todos los documentos, entonces lo deschequea, para mantener
	consistente las acciones del usuario sobre el modulo.*/
	
	function ValideSelect(form){
		if (form.checked==false){
			if (document.forms[0].chk_all.checked) 
			document.forms[0].chk_all.checked=false;				
		}
	}

	//FUNCION QUE PERMITE SELECCIONAR Y DESELECCIONAR TODOS LOS CHECKBOX
	function SelectAll(form){
		for (var j=0; j < form.length; j++){
			if (form.chk_all.checked){
				if ((form.elements[j].type=="checkbox") && (form.elements[j].disabled==false)){
					if (!form.elements[j].checked){ 
						form.elements[j].checked=true;
					}
				}
			}
			else{
				if ((form.elements[j].type=="checkbox") && (form.elements[j].disabled==false)){
					if (form.elements[j].checked){ 
						form.elements[j].checked=false;
					}
				}
			}
		}
	}

	function EstatusSeleccionado(estatus){
			if(document.forms[0].c_status_sig.length==null){
				document.forms[0].c_status_sig.value=estatus; 	
			}else{													
				for(var i=0; i<document.forms[0].c_status_sig.length;i++){
					document.forms[0].c_status_sig[i].value=estatus; 																
				}
			}			
	}
	
/************************************
       CODIGO NUEVO DESARROLLO  
************************************/
function clear_campos(){
	var form = window.document.forms[0];
	for(i=0; i<form.elements.length; i++){
	     if(form.elements[i].type == "text"){
		form.elements[i].value = "";
	     }
	}
} //Fin 
function clear_ext(){
	var form = window.document.forms[1];
	for(i=0; i<form.elements.length; i++){
	     if(form.elements[i].type == "text"){
		form.elements[i].value = "";
	     }
	}
} //Fin 


	