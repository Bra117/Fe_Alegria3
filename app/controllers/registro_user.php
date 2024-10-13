<?php
  class registro_user  extends Controller{

    public function __construct(){
      parent:: __construct();
    }
    
    function index(){
    
      Model::exists('tabla/registro_user');

       
      //Incorpora el FrontEnd Controller
      $this->view->js=array('registro_user/js/frontEnd.js');
      $this->view->render('registro_user/index',1);

    }

  }
?>
