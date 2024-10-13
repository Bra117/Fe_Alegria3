<?php
class mostrar_tabla  extends Controller{

public function __construct(){
  	   parent:: __construct();
       	
  	}
  	
function index(){

Model::exists('tabla/mostrar_tabla');


$this->view->js = array('admin/mostrar_tabla/js/frontEnd.js');
$this->view->render('admin/mostrar_tabla/index',1);

}

  }

?>
