<?php
  class pdf1 extends Controller{

  	public function __construct(){
  		parent:: __construct();
  		session_start();
  	}
  	
    function pdf1(){
      Model::exists('tabla/register_alumno');
      //Incorpora el FrontEnd Controller
     	$this->view->render('pdf./reportePDFAll',1);
    }
  }
?>