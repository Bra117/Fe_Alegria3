<?php
  class estudiante_qr extends Controller{

  	public function __construct(){
  		parent:: __construct();
  		
  	}
  	
    function index(){
    session_start();
      Model::exists('tabla/register_alumno');  

      //Incorpora el FrontEnd Controller
      $this->view->js=array('user_1/estudiante_qr/js/frontEnd.js');
     	$this->view->render('user_1/estudiante_qr/index',1);
    }
  }
?>