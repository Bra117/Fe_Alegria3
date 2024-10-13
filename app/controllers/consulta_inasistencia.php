<?php
class consulta_inasistencia extends Controller{

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
      Model::exists('tabla/register_alumno');  
            Model::exists('tabla/pase');  


      //Incorpora el FrontEnd Controller
      $this->view->js=array('user_1/consulta_inasistencia/js/frontEnd.js');
      $this->view->render('user_1/consulta_inasistencia/index',1);
    }
  }
?>