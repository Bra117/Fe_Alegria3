<?php
require ('app/plugins/xajax/xajax.inc.php');
require ('app/plugins/phpqrcode/qrlib.php');
require ('app/plugins/dompdf/autoload.inc.php');
  //instanciamos el objeto de la clase xajax
  $xajax = new xajax();
  //Función()
  function BuscarAlumno3(){
    $obj = new xajaxResponse('UTF-8');
    $usuarioModel = new register_alumnoModel();
    $result = $usuarioModel->getStudentByCedulaQR();

    $html.="<div class='table-responsive';>
      <table id='grid' class='table table-bordered' width='100%'>
        <thead>
          <tr style='background-color: #df4e4e;color:#fff;'>
            <th class='text-center' style='width: 6%;'>id</th>
            <th class='text-center' style='width: 6%;'>Sexo</th>
            <th class='text-center' style='width: 6%;'>Año, Secci&oacuten</th>
            <th class='text-center' style='width: 6%;'>Cedula</th>
            <th class='text-center' style='width: 6%;'>Nombre</th>
            <th class='text-center' style='width: 6%;'>Apellido</th>
            <th class='text-center' style='width: 6%;'>fecha_nacimiento</th>
          </tr> 
        </thead>
        <tbody>"; 
      	 $html.= 
       	  '<tr class = text-center>
            <td>'.$result['row']['d_status'].'</td>
            <td>'.$result['row']['d_sexo'].'</td>
            <td>'.$result['row']['d_aseccion'].'</td>
            <td>'.$result['row']['cedula'].'</td>
            <td>'.$result['row']['nombre'].'</td>
            <td>'.$result['row']['apellido'].'</td>
            <td>'.$result['row']['fecha_nac'].'</td>
          </tr>
        </tbody>
      </table>
      <button type= "button" class = "btn btn-success btn-sm btnImp" onClick= "funcionAllPdf();"><i>Imprimir Varios</i></button> 
    </div' 
     ;   
   $obj->addAssign('formAlumno', 'innerHTML', $html);
   $obj->addScript("datatable('grid');");
   return $obj;
  }

   function ImprimirCarnet(){
}
 
  $xajax->registerFunction("BuscarAlumno3");
  $xajax->registerFunction("ImprimirCarnet");

  //$xajax->registerFunction("login");
  //El objeto xajax tiene que procesar cualquier petición
  $xajax->processRequests();
?>
