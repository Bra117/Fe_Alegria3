<?php
  class QR  extends Controller{

  	public function __construct(){
  		parent:: __construct();
  		
  	}
  	
    function index(){
    session_start();
      //Model::exists('tabla/funcionario');

      //Incorpora el FrontEnd Controller
      $this->view->js=array('QR/js/frontEnd.js');
     	$this->view->render('QR/index',1);
    }
  }
?>