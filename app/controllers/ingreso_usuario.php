<?php
  class ingreso_usuario  extends Controller{

  	public function __construct(){
  		parent:: __construct();
  		
  	}
  	
    function index(){
     
      //Model::exists('tabla/login');  

      //Incorpora el FrontEnd Controller
    	
      $this->view->js=array('user/home_user/js/frontEnd.js');
     	$this->view->render('user/home_user/index',1);
    }
  }
?>
