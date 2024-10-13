<?php
  class solCorrijeModel extends Model{
    public static $solicitud      = "solicitud";

    public function __contruct(){
          parent::__construct();
    }

    public function solCorrijeModel(){

      //Defino Atributos
      $this->id_solicitud = "";
      $this->f_status     = "";
      $this->nroReg       = "";
      $this->created_at   = "NOW()";

     //Conecta a la Base de Datos
       $this->db = Database::getInstance();  
    }

    //CONSULTAS////////////////////////////////////////////////////////

    //Metodo que devuelve el Numero de Solicitud 
    public function getFixIdSol(){
        
        $sql ="SELECT *
                 FROM solicitud
                WHERE d_numero_sanitario ='".$this->nroReg."'
                  AND id_tipo_solicitud = 1
                  AND id_status_solicitud IN(11,17,18,22);";

        $array =$this->getResult($sql,$this->db);  

      return $array; 
    }

    //Metodo que actualiza la Fecha de Registro
    public function fixDate(){

        $sql = "UPDATE solicitud 
                   SET f_status = '".$this->f_status."'
                 WHERE id_solicitud =".$this->id_solicitud.";";

        $array = $this->getResult($sql,$this->db);

     return $array;   
    }


} //Fin Modelo

?>