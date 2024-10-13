<?php
  class perfil  extends Controller{

  	public function __construct(){
  		parent:: __construct();
  		
  	}
  	
    function index(){

      Model::exists('tabla/funcionario');

      //Incorpora el FrontEnd Controller
      $this->view->js=array('admin/perfil/js/frontEnd.js');
     	$this->view->render('admin/perfil/index',1);
    }
  }
?>
