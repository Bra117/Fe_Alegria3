<?php

  //Clase para Actualizar Datos de Acuerdo a las Modificaciones

  class SetDatos extends Model{

  	     private $db;

        public function __contruct(){

             parent::__construct();

             //Instancio la Variable $db
               $this->db = Database::getInstance();
            
        }

        public function ajustarFecha($f_solicitud,$f_status){
     
           $sql = "UPDATE ";   

        } 


  }
?>