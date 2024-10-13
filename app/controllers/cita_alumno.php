<?php
class cita_alumno extends Controller{

  	public function __construct(){
  		parent:: __construct();
  		session_start();
      if (empty($_SESSION["id_profesor"]) || $_SESSION["id_rol"] != 1 ){
        $url = $this->getURL();
        //redirigimos
        session_destroy();
        header($url.'login');
        exit();
      }
  	}
  	
    function index(){
      Model::exists('tabla/pedagogia');  

      //Incorpora el FrontEnd Controller
      $this->view->js=array('user_1/cita_alumno/js/frontEnd.js');
      $this->view->render('user_1/cita_alumno/index',1);
    }
  }
?>