<?php
  class pdf  extends Controller{

  	public function __construct(){
  		parent:: __construct();
  		session_start();
  	}
  	
    function pdf(){

      //Incorpora el FrontEnd Controller
     	$this->view->render('user_1/pdf/reportePDFAll',1);
    }
  }
?>