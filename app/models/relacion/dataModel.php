<?php

  class dataModel extends Model{

    public function __contruct(){
          parent::__construct();

    }

    public function dataModel(){

      $this->nroRgistro  = '';
      $this->idSolicitud = '';
        
      //Conexion a la BD
        $this->db = Database::getInstance(); 

    }

    //Metodo para Buscar el Numero de Registro 

      public function getDataReg(){
          
          $sql = "SELECT * 
                    FROM solicitud 
                   WHERE d_numero_sanitario='".$this->nroRgistro."'
                     AND id_tipo_solicitud = 1
                     AND id_categoria_solicitud IN(1,2,3,4)
                     LIMIT 1;";
         
          $array = $this->getResult($sql,$this->db);

          return $array;
      }//Fin Function

      public function getDataNum(){
          
          $sql = "SELECT * 
                    FROM solicitud 
                   WHERE id_solicitud='".$this->idSolicitud."'
                     AND id_tipo_solicitud = 1
                     AND id_categoria_solicitud IN(1,2,3,4);";
         
          $array = $this->getResult($sql,$this->db);

          return $array;
      }//Fin Function



  } //Fin Modelo

?>