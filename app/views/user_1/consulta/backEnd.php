<?php
require ('app/plugins/xajax/xajax.inc.php');
require ('app/plugins/phpqrcode/qrlib.php');
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
    $result = $usuarioModel->getStudentByCedula($form);
    
    if ($form['cedula'] != ''){

    //var_dump( $_SESSION["Nombre"]);
    //#df4e4e
    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>Nro Estudiante</th>
            <th class='text-center' style='width: 6%;'>Estaus</th>
            <th class='text-center' style='width: 6%;'>Sexo</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 6%;'>C&eacutedula</th>
            <th class='text-center' style='width: 6%;'>Nombre</th>
            <th class='text-center' style='width: 6%;'>Apellido</th>
            <th class='text-center' style='width: 6%;'>fecha nacimiento</th>
            <th class='text-center' style='width: 6%;'>Imprimir</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
      
      if ($agente['d_status'] == 'Activo'){

      	$html.= 
       	'<tr class = text-center>
          <td>'.$agente['id_alumno'].'</td>
          <td style = "background-color: green; color: white;">'.$agente['d_status'].'</td>
          <td>'.$agente['d_sexo'].'</td>
          <td>'.$agente['d_aseccion'].'</td>
          <td>'.$agente['cedula'].'</td>
          <td>'.$agente['nombre'].'</td>
          <td>'.$agente['apellido'].'</td>
          <td>'.$agente['fecha_nac'].'</td>
          </td> <td style="width: 10%;">
            <div class="btn-group">
               <button type="button" class = "btn btn-success btn-sm btnImp" onClick="funcionAllPdf('.$agente['id_alumno'].')"  data-target="#exampleModa"  data-whatever="@mdo" data-toggle="modal" "data-dismiss="modal"><i class="">Carnet</i>
              </button>
            </div>
          </td>   
        </tr>';
      }else{
        $html.= 
       	'<tr class = text-center>
          <td>'.$agente['id_alumno'].'</td>
          <td style = "background-color: red; color: white;">'.$agente['d_status'].'</td>
          <td>'.$agente['d_sexo'].'</td>
          <td>'.$agente['d_aseccion'].'</td>
          <td>'.$agente['cedula'].'</td>
          <td>'.$agente['nombre'].'</td>
          <td>'.$agente['apellido'].'</td>
          <td>'.$agente['fecha_nac'].'</td>
        </tr>';
      }
    }
    }else{
      $obj->addScript("Swal.fire({
        title: '¡No se pude Buscar Cedula!',
        text: 'Campo vacio.',
        icon: 'error',
        color:'black'
      });");
    }
   $obj->addAssign('hola', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");
   return $obj;
  }

  function GeneraQR($id_student){
    $obj = new xajaxResponse('UTF-8');
    $obj = new xajaxResponse('UTF-8');
    $usuarioModel = new register_alumnoModel();
    $result = $usuarioModel->getStudentByCedulaQR($id_student);
    //var_dump($id_student);

    $dir = 'app/lib/';

    if(!file_exists($dir))
    mkdir($dir);

    $filename = $dir.'QR.png';

    $tamano    = 3;
    $level     = 'M';
    $framesize = 3;
    $contenido = 
    'Estudiante:
      Nombre:    ' . $result['row']['nombre'] .'
      Apellido:  ' . $result['row']['apellido'] .'
      Cedula:    ' . $result['row']['cedula'] .'
      Año y Sección: ' . $result['row']['d_aseccion'] .'
      Sexo:   ' . $result['row']['d_sexo'] .'
      Fecha_nacimiento:  '. $result['row']['fecha_nac'] .'
    ';
   QRcode::png($contenido, $filename, $level, $tamano, $framesize);
   $obj->addScript("setTimeout(function(){ window.location='estudiante_qr';},1000)");

    //var_dump($result);
    //return $html;
   return $obj;
 }

   function funcionAllPdf($value){
  $obj = new xajaxResponse('UTF-8');
  $id_alumno = base64_encode(base64_encode($value));

  $obj->addScript("window.open('pdf1/pdf1/?cod=".$id_alumno."');");
  return $obj;
}

  $xajax->registerFunction("BuscarAlumno");
  $xajax->registerFunction("GeneraQR");
  $xajax->registerFunction("volver");
  $xajax->registerFunction("funcionAllPdf");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();    
?>

