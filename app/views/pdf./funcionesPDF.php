<?php
require ('app/plugins/xajax/xajax.inc.php');
//DECLARAR FUNCIONES A USAR EN L PLANILLA
require ('app/plugins/dompdf/autoload.inc.php');

 $xajax = new xajax();

function headerpdf(){
	//var_dump("llega");
	//INCLUIMOS VARIABLE HTML
 	ob_start();
    	include 'app/views/pdf./planilla/html/header.php';
    	$html = ob_get_contents();
    ob_end_clean();

	return $html;	

}

function datos_profesor($encryption){
    $obj = new xajaxResponse('UTF-8');
	$model = new register_alumnoModel();
	$encryption = trim($_REQUEST['cod']);
    $encryption = base64_decode(base64_decode($encryption));
	$result = $model->getStudentByCedulaQR1($encryption);
    $html = "";

 //var_dump($encryption);
    $html="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: black; color:white;'>
            <th class='text-center' style='width: 6%;'>id</th>
            <th class='text-center' style='width: 6%;'>Estaus</th>
            <th class='text-center' style='width: 6%;'>Sexo</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 6%;'>Cedula</th>
            <th class='text-center' style='width: 6%;'>Nombre</th>
            <th class='text-center' style='width: 6%;'>Apellido</th>
            <th class='text-center' style='width: 6%;'>fecha_nacimiento</th>
           </tr> 
        </thead>
        <tbody>"; 

    for ($i=0; $i < $result['numRows']; $i++) { 
      $agente = pg_fetch_assoc($result['query'], $i);
      
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
        </tr>';
         //var_dump($html);
    
    }
   $obj->addAssign('hola', 'innerHTML',$html);
   $obj->addScript("datatable('grid');");  
	//INCLUIMOS VARIABLE HTML
 	ob_start();
    	include 'planilla/html/pdf.php';
    	$html = ob_get_contents();
    ob_end_clean();
	return $html;
}


/*function pdfAll($id_func){

	$model = new usuarioModel($id_func);
	$result = $model->getAllUsuario();
	$row = $result['row'];

	$html = "";
	for ($i=0; $i < $result['numRows'] ; $i++) { 
        $row = pg_fetch_assoc($result['query'], $i);
		$model->updateStatus($row['id_usuario']);
	    $id = $row['id_usuario'];
	    $mes = $model->getMes(date('m',strtotime($row['fecha_curso'])));
	    
		$traza = $model->impreso($id,$id_func);
		//INCLUIMOS VARIABLE HTML
	 	ob_start();
	    	include 'html/pdfAll.php';
	    	$html .= ob_get_contents();
	    ob_end_clean();

}
	return $html;

}*/
