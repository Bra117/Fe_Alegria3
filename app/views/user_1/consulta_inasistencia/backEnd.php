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
    $usuarioModel = new register_alumnoModel();
    $result = $usuarioModel->TableInas($form);
    $consulta = $usuarioModel->showAllMotivo_consulta();
    $po = "";
    $hola = "";

    if ($form['cedula'] != ''){
    $html = "";
    $value = $result['row']['id_alumno'];
   if ($result['numRows'] >= 3 ){
     
     $po="<select class = 'form-select' aria-label = 'Default select example'>
      <option disabled hidden selected>Motivos</option>";

    for ($i=0; $i <$consulta['numRows']; $i++){ 
      $row2 = pg_fetch_assoc($consulta['query'], $i);

      $po.="<option value = ".$row2["id_motivo_consulta"].">".$row2["motivo"]."</option>";
    };

   	 $hola= 
     '<div class="btn-group">
        <button type="button" style = "margin-left: 400px; height:33px; margin-top: -50px; font-size: 14px;" class = "btn btn-danger btn-sm btnImp" onClick= "funcionAllPdf('.$value.');"<i class=""> Acta de Citación</i></button>
      </div>
      <td style="width: 10%;">
        <div class="btn-group">
          <button type="button" class = "btn btn-info"  style = "color: white; margin-left: 550px; height:33px; width: 120px; margin-top: -50px; font-size: 14px;" data-target="#exampleModal" onclick = Student('.$value.') data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Psicopedagoga</i>
          </button>
        </div>
      </td>';	 
   	  $html="<div class='table-responsive';>
        <table id='grid' class='table table-bordered' width='100%'>
          <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Nro Estudiante</th>
            <th class='text-center' style='width: 6%;'>Estatus</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula</th>
            <th class='text-center' style='width: 6%;'>Nombre</th>
            <th class='text-center' style='width: 6%;'>Apellido</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 13%;'>Fecha Inasistencia H-M-S</th>
            <th class='text-center' style='width: 6%;'>Profesor</th>
           </tr> 
        </thead>
        <tbody>"; 

    	for ($i=0; $i < $result['numRows']; $i++) { 
      		$agente = pg_fetch_assoc($result['query'], $i);
      
      		$html.= '<tr class = text-center>
          		<td style = "color: white; background-color: red;">'.$agente['id_alumno'].'</td>
          		<td>'.$agente['d_status'].'</td>
          		<td>'.$agente['cedula'].'</td>
          		<td>'.$agente['nombre'].'</td>
          		<td>'.$agente['apellido'].'</td>
          		<td>'.$agente['d_aseccion'].'</td>
          		<td>'.substr($agente['fecha'],0,19).'</td>
          		<td>'.$agente['fullname'].'</td>
        	</tr>';
     	 }
    }else{
    	$html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Nro Estudiante</th>
            <th class='text-center' style='width: 6%;'>Estaus</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula</th>
            <th class='text-center' style='width: 6%;'>Nombre</th>
            <th class='text-center' style='width: 6%;'>Apellido</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 10%;'>Fecha Inasistencia H-M-S</th>
            <th class='text-center' style='width: 6%;'>Profesor</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
      
      	$html.= 
       	'<tr class = text-center>
          <td>'.$agente['id_alumno'].'</td>
          <td>'.$agente['d_status'].'</td>
          <td>'.$agente['cedula'].'</td>
          <td>'.$agente['nombre'].'</td>
          <td>'.$agente['apellido'].'</td>
          <td>'.$agente['d_aseccion'].'</td>
          <td>'.substr($agente['fecha'],0,19).'</td>
          <td>'.$agente['fullname'].'</td>
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
   $obj->addAssign("botones","innerHTML",$po);
   $obj->addAssign("BotonCita","innerHTML",$hola);
   $obj->addAssign('hola', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");
   return $obj;
  }

  function funcionAllPdf($value){
  $obj = new xajaxResponse('UTF-8');
  $id_alumno = base64_encode(base64_encode($value));

  $obj->addScript("window.open('pdf/pdf/?cod=".$id_alumno."');");
  return $obj;
}

function Agendar($form, $id_student){
  $obj = new xajaxResponse('UTF-8');
  $usuarioModel = new register_alumnoModel();
  $consulta = $usuarioModel->showAllMotivo_consulta();
  //var_dump($id_student);
  if ($form['botones'] == "Motivos") {
    $obj->addScript("Swal.fire({
      title: '¡No Se puede Agendar!',
      text: 'Debe Seleccionar un motivo.',
      icon: 'error',
      color: 'black'
    });");
  }else{
    $InsertMotivo = $usuarioModel->InsertMotivo($form, $id_student);

    if ($InsertMotivo) {
      $obj->addScript("Swal.fire({
        title: '¡Agendado!',
        text: 'La Consulta ha sido Enviada a la/el Psicopedagog@.',
        icon: 'success',
        color: 'black'
      });");
      //REDIRECTION
      $obj->addScript("setTimeout(function(){ window.location='consulta_inasistencia';},2000)");
      //
    }else{
      $obj->addScript("Swal.fire({
        title: '¡No se pudo Agendar!',
        text: 'Hubo un error.',
        icon: 'error',
        color: 'black'
      });");
    }
  }  
 return $obj;
}

  $xajax->registerFunction("Agendar");
  $xajax->registerFunction("funcionAllPdf");
  $xajax->registerFunction("BuscarAlumno");
  $xajax->registerFunction("volver");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();
?>