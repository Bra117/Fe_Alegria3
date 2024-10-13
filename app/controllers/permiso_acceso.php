<?php
class permiso_acceso  extends Controller{

public function __construct(){
  	   parent:: __construct();
       	
  	}
  	
function index(){

Model::exists('tabla/permiso_acceso');


$this->view->js = array('admin/permiso_acceso/js/frontEnd.js');
$this->view->render('admin/permiso_acceso/index',1);

}

  }

?>
