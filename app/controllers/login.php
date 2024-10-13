<?php
  class login  extends Controller{

  	public function __construct(){
  		parent:: __construct();
  		
  	}
  	
    function index(){
    session_start();
      Model::exists('tabla/login');  

      //Incorpora el FrontEnd Controller
      $this->view->js=array('login/js/frontEnd.js');
     	$this->view->render('login/index',1);
    }
  }
?>
