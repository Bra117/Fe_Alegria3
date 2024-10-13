<?php
class registro_userModel extends Model{

  function __contruct(){
    parent::__construct();
  }

  function registro_userModel(){
    $this->db = DatabaseCon::getInstance();
  }

  function registrar($form){

    try {

      $sql = "INSERT INTO personas (cedula, nombre, apellido, edad, email, contrasena, id_nacionalidad, id_genero, id_rol) VALUES ('".$form['cedula']."', '" .$form['usuario']."' , '" .$form['apellido']. "', '" .$form['edad']. "','" .$form['email']. "','" .sha1(md5($form['pass'])). "', 1 , ".$form['radio'].", 1);";
      $result = $this->db->pgquery($sql);
      return $result;
    }catch (Throwable $e) {
      
    } 
  }
 
  function getPersonByCedula($form){
      
    try {
      
      $sql = "SELECT cedula FROM personas WHERE cedula = '".$form['cedula']."';";

      $result = Model::getResult($sql,$this->db);
      
      return $result;
    }catch(Throwable $e) {
         
    }
  }

  public function getPersonByAge($form){
      
    try {
      
     $sql = "SELECT edad FROM personas WHERE edad = '".$form['edad']."';";

      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e) {


    }
  }

  public function getPersonByName($form){

    try {
      $sql = "SELECT usuario FROM personas WHERE usuario = ".$usuario.";";

      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e) {

   }
  }
} 
?>