<?php
require ('app/plugins/xajax/xajax.inc.php');
  //instanciamos el objeto de la clase xajax
  $xajax = new xajax();
  //Función()
  function volver(){
    $obj = new xajaxResponse('UTF-8');
     session_destroy();
    $obj->addRedirect("login");
    return $obj;
  }   

  function BuscarAlumno($form){
    $obj = new xajaxResponse('UTF-8');
    $usuarioModel = new pedagogiaModel();
    $result = $usuarioModel->ConsultaByCedula($form);
    $html = "";
      
      if ($form['cedula'] != ''){
   	    $html="<div class='table-responsive';>
          <table id='grid' class='table table-bordered' width='100%'>
            <thead>
              <tr style='background-color: black; color:white;'>
                <th class='text-center' style='width: 6%;'>Nro Estudiante</th>
                <th class='text-center' style='width: 6%;'>Nombre Estudiante</th>
                <th class='text-center' style='width: 6%;'>C&eacutedula</th>
                <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
                <th class='text-center' style='width: 6%;'>Motivo Consulta</th>
                <th class='text-center' style='width: 6%;'>Status Consulta</th>
                <th class='text-center' style='width: 6%;'>Fecha Consulta</th>
                <th class='text-center' style='width: 6%;'>Fecha Finalizaci&oacuten</th>
              </tr> 
            </thead>
        <tbody>"; 

    	 for ($i=0; $i < $result['numRows']; $i++) { 
      	 $agente = pg_fetch_assoc($result['query'], $i);
        
          if($agente['id_status_consulta'] == 3){
      	   $html.= '<tr class = text-center>
        	   <td>'.$agente['id_alumno'].'</td>
        	   <td>'.$agente['fullname'].'</td>
        	   <td>'.$agente['cedula'].'</td>
        	   <td>'.$agente['aseccion'].'</td>
             <td>'.$agente['d_motivo_consulta'].'</td>
             <td style = "color: #308446;">'.$agente['d_status_consulta'].'</td>
        	   <td>'.substr($agente['fecha_consulta'],0,11).'</td>
        	   <td>'.substr($agente['fecha_finalizacion'],0,11).'</td>
            </tr>';
          }else if($agente['id_status_consulta'] == 2){
            $html.= '<tr class = text-center>
              <td>'.$agente['id_alumno'].'</td>
              <td>'.$agente['fullname'].'</td>
              <td>'.$agente['cedula'].'</td>
              <td>'.$agente['aseccion'].'</td>
              <td>'.$agente['d_motivo_consulta'].'</td>
              <td style = "color: green;">'.$agente['d_status_consulta'].'</td>
              <td>'.substr($agente['fecha_consulta'],0,11).'</td>
              <td>'.substr($agente['fecha_finalizacion'],0,11).'</td>
            </tr>';
          }else if($agente['id_status_consulta'] == 1){
            $html.= '<tr class = text-center>
              <td>'.$agente['id_alumno'].'</td>
              <td>'.$agente['fullname'].'</td>
              <td>'.$agente['cedula'].'</td>
              <td>'.$agente['aseccion'].'</td>
              <td>'.$agente['d_motivo_consulta'].'</td>
              <td style = "color:#48CAE4;">'.$agente['d_status_consulta'].'</td>
              <td>'.substr($agente['fecha_consulta'],0,11).'</td>
              <td>'.substr($agente['fecha_finalizacion'],0,11).'</td>
            </tr>';
          }
        }
      }else{
        $obj->addScript("Swal.fire({
          title: '¡No se pude Buscar Cedula!',
          text: 'Campo vacio.',
          icon: 'error',
          color: 'black'
        });");
      }
      //var_dump('hola');
   $obj->addAssign('hola', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");
   return $obj;
  }



  $xajax->registerFunction("Agendar");
  $xajax->registerFunction("funcionAllPdf");
  $xajax->registerFunction("BuscarAlumno");
  $xajax->registerFunction("volver");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests()
?>