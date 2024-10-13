<?php
//DECLARAR FUNCIONES A USAR EN L PLANILLA
require ('app/plugins/dompdf/autoload.inc.php');

function headerpdf(){
	//var_dump("llega");
	//INCLUIMOS VARIABLE HTML
 	ob_start();
    	include 'app/views/user_1/pdf/planilla/html/header.php';
    	$html = ob_get_contents();
    ob_end_clean();

	return $html;	

}

//
/*function datos_profesor($id,$id_func){

	$model = new usuarioModel();
	$result = $model->getUserCert($id);

	$row = $result['row'];
	$mes = $model->getMes(date('m',strtotime($row['fecha_curso'])));

	$html = "";
	$id_func = $_SESSION['id_ciudadano'];
	$traza = $model->impreso($id,$id_func);
	//INCLUIMOS VARIABLE HTML
 	ob_start();
    	include 'html/pdf.php';
    	$html = ob_get_contents();
    ob_end_clean();
    $model->updateStatus($id);
	return $html;

}*/


function pdfAll($id_func){

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

}
