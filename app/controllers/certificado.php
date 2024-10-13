<?php
  class certificado  extends Controller{

  	public function __construct(){
  		parent:: __construct();
  		session_start();
  	}
  	
    function pdf(){

      Model::exists('tabla/consultaSolicitud');
      Model::exists('tabla/persona');
      Model::exists('tabla/permiso_acceso');


      //Incorpora el FrontEnd Controller
     	$this->view->render('admin/mostrar_tabla/reportePDF',1);
    }

    function pdfall(){

      //session_start();

      Model::exists('tabla/consultaSolicitud');
      Model::exists('tabla/persona');
      Model::exists('tabla/mostrar_tabla');
      //Incorpora el FrontEnd Controller
      $this->view->render('admin/mostrar_tabla/reportePDFAll',1);
    }
  }
?>
