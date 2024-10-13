<?php
 class listar_estudiantes3 extends Controller{

  	public function __construct(){
  		parent:: __construct();
  		session_start();
      if (empty($_SESSION["id_profesor"]) || $_SESSION["id_rol"] != 3 ){
        $url = $this->getURL();
        //redirigimos
        session_destroy();
        header($url.'login');
        exit();
      }
  	}
  	
    function index(){
      Model::exists('tabla/register_alumno');

      //Incorpora el FrontEnd Controller
      $this->view->js=array('user_3/listar_estudiantes3/js/frontEnd.js');
     $this->view->render('user_3/listar_estudiantes3/index',1);
    }
  }
?>