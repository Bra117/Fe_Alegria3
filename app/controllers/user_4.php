<?php
class user_4 extends Controller{

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
      Model::exists('tabla/pedagogia');  

      //Incorpora el FrontEnd Controller
      $this->view->js=array('user_4/user/js/frontEnd.js');
      $this->view->render('user_4/user/index',1);
    }
  }
?>