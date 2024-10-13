<?php

 class personaModel extends Model{

    public function __contruct(){
          parent::__construct();
        
    }

    public function personaModel(){

        $this->db = DatabaseCon::getInstance();

    }

    public function getPersonByCed($cedula){

    try {
 
    $sql = "SELECT * FROM personas WHERE cedula = '".strtoupper($cedula)."';";

    $result = Model::getResult($sql,$this->db);
      
      return $result;
    
    } catch (Throwable $e) {
    
    
    } 
 


    }

    public function getPersonByCed2($arrData){

      try {

     $sql = "SELECT * FROM personas WHERE cedula = '".strtoupper($arrData['d_cedula'])."' AND id_persona != ".$arrData['idPersona'].";";

      $result = Model::getResult($sql,$this->db);
      
      return $result;

      }catch(Throwable $e) {


      }

      

    }

    public function getPersonByID($idPersona){

      try {

     $sql = "SELECT * FROM personas WHERE id_persona = ".$idPersona.";";

      $result = Model::getResult($sql,$this->db);
      
      return $result;


      }catch(Throwable $e) {


      }

 
    }

    public function insertPersona($arrPerson){


      try {

     $sql = "INSERT INTO personas(nombre,apellido,cedula,status)VALUES('".strtoupper($arrPerson['d_nombre'])."','".strtoupper($arrPerson['d_apellido'])."','".strtoupper($arrPerson['d_cedula'])."',1);";

      $query = $this->db->pgquery($sql);

      return $query;

      }catch(Throwable $e) {


      }

    

    }

    public function getallPerson(){


      try {

      $sql = "SELECT * FROM personas p
              INNER JOIN status_dato sd ON p.status = sd.id_status
               WHERE status = 1 LIMIT 150;";

      $result = Model::getResult($sql,$this->db);
      
      return $result;


      }catch(Throwable $e) {


      }

    }

    public function getallPersonPDF(){


      try {

      $sql = "SELECT * FROM personas p
              INNER JOIN status_dato sd ON p.status = sd.id_status
               WHERE status = 1 LIMIT 100;";

      $result = Model::getResult($sql,$this->db);
      
      return $result;


      }catch(Throwable $e) {


      }

    }

    public function updatePersona($arrPerson){


      try {

     $sql = "UPDATE personas SET nombre = '".$arrPerson['d_nombre']."', apellido = '".$arrPerson['d_apellido']."', cedula = '".$arrPerson['d_cedula']."', status = 1 WHERE id_persona = ".$arrPerson['idPersona'].";";

      $query = $this->db->pgquery($sql);

      return $query;

      }catch(Throwable $e) {


      }

 
    }

    public function updateStatus($form,$idPersona,$status){

      try {
        

       $sql = "UPDATE personas SET nombre = '".$form['d_nombre']."',apellido = '".$form['d_apellido']."',cedula = '".$form['d_cedula']."', status = ".$status." WHERE id_persona = ".$idPersona.";";
       var_dump($sql);
      $query = $this->db->pgquery($sql);

      return $query;

      }catch(Throwable $e) {


      }

  

    }
     public function updateStatuspdf($idPersona,$status){

      try {
        

       $sql = "UPDATE personas SET status = ".$status." WHERE id_persona = ".$idPersona.";";
     
      $query = $this->db->pgquery($sql);

      return $query;

      }catch(Throwable $e) {


      }

  

    }

  }
?>
