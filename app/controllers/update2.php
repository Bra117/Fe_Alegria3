<?php
 class update2 extends Controller{

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
      Model::exists('tabla/update');  

       
      //Incorpora el FrontEnd Controller
      $this->view->js=array('user_2/update2/js/frontEnd.js');
      $this->view->render('user_2/update2/index',1);
    }
  }
?>