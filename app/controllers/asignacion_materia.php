<?php
   class asignacion_materia extends Controller{
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
      Model::exists('tabla/profe');

      //Incorpora el FrontEnd Controller
      $this->view->js=array('user_1/asignacion_materia/js/frontEnd.js');
     	$this->view->render('user_1/asignacion_materia/index',1);
    }
  }
?>