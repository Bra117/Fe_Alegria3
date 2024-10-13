<?php
  class user_2  extends Controller{

    public function __construct(){
      parent:: __construct();   
      session_start();
      if (empty($_SESSION["id_profesor"]) || $_SESSION["id_rol"] != 2 ){
        $url = $this->getURL();
        //redirigimos
        session_destroy();
        header($url.'login');
        exit();
      }
    }
    
    function index(){
      Model::exists('tabla/solicitud');
      Model::exists('tabla/profe');

      
      //Incorpora el FrontEnd Controller
      $this->view->js=array('user_2/user/js/frontEnd.js');
      $this->view->render('user_2/user/index',1);
    }
  }
?>