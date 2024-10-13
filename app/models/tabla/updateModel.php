<?php
class updateModel extends Model{
  function __contruct(){
    parent::__construct();
  }

  function updateModel(){
    $this->db = DatabaseCon::getInstance();
  }

  function getTeachersByCedula($form){
      
    try {
     $sql = "SELECT * FROM profesores WHERE cedula = '".$_SESSION['cedula']."'
                UNION ALL
              SELECT * From directivo Where cedula = '".$_SESSION['cedula']."';";
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e){
 
    }
  }
  
   function updateProfile2($form){
    try {
      $sql = "UPDATE profesores SET nombre = '".strtoupper($form["usuario"])."', apellido = '".strtoupper($form['apellido'])."', email = '".strtoupper($form["email"])."' , pass = '".sha1(md5($form["pass"]))."' Where cedula = '".$_SESSION["cedula"]."';";
      $result = $this->db->pgquery($sql);
      //var_dump($sql);
      return $result;
    }catch (Throwable $e) {
      
    } 
  }

  function updateProfile($form){
    try {
      $sql = "UPDATE profesores SET nombre = '".strtoupper($form["usuario"])."', apellido = '".strtoupper($form['apellido'])."', email = '".strtoupper($form["email"])."' , pass = '".sha1(md5($form["pass"]))."' Where cedula = '".$_SESSION["cedula"]."';";
    }catch (Throwable $e) {
      
    }
    try{
      $sql.= "UPDATE directivo SET nombre = '".strtoupper($form["usuario"])."', apellido = '".strtoupper($form['apellido'])."', email = '".strtoupper($form["email"])."' , passwd = '".sha1(md5($form["pass"]))."' Where cedula = '".$_SESSION["cedula"]."';";
        //var_dump($sql);
      $result = $this->db->pgquery($sql);
      return $result;
    }catch (Throwable $e) {
      
    } 
  }

  function updateProfile1($form){
    try {
      $sql = "UPDATE profesores SET nombre = '".strtoupper($form["usuario"])."', apellido = '".strtoupper($form['apellido'])."', email = '".strtoupper($form["email"])."' , pass = '".sha1(md5($form["pass"]))."' Where cedula = '".$_SESSION["cedula"]."';";
    }catch (Throwable $e) {
      
    } 
    try {
       $sql.= "UPDATE directivo SET nombre = '".strtoupper($form["usuario"])."', apellido = '".strtoupper($form['apellido'])."', email = '".strtoupper($form["email"])."' , passwd = '".sha1(md5($form["pass"]))."' Where cedula = '".$_SESSION["cedula"]."';";
      //var_dump($sql);
      $result = $this->db->pgquery($sql);
      return $result;
    }catch (Throwable $e) {
      
    } 
  }

  function updateProfileWithoutCedula($form){
    try {
      $sql = "UPDATE profesores SET nombre = '".strtoupper($form["usuario"])."', apellido = '".strtoupper($form['apellido'])."', email = '".strtoupper($form["email"])."' Where cedula = '".$_SESSION["cedula"]."';";
    }catch (Throwable $e) {
      
    }
    try {
       $sql.= "UPDATE directivo SET nombre = '".strtoupper($form["usuario"])."', apellido = '".strtoupper($form['apellido'])."', email = '".strtoupper($form["email"])."' Where cedula = '".$_SESSION["cedula"]."';";
      //var_dump($sql);
      $result = $this->db->pgquery($sql);
      return $result;
    }catch (Throwable $e) {
      
    } 
  }

  function updateProfileWithoutCedula1($form){
    try {
      $sql = "UPDATE profesores SET nombre = '".strtoupper($form["usuario"])."', apellido = '".strtoupper($form['apellido'])."', email = '".strtoupper($form["email"])."' Where cedula = '".$_SESSION["cedula"]."';";
    }catch (Throwable $e) {
      
    }
    try{
       $sql.= "UPDATE directivo SET nombre = '".strtoupper($form["usuario"])."', apellido = '".strtoupper($form['apellido'])."', email = '".strtoupper($form["email"])."' Where cedula = '".$_SESSION["cedula"]."';";
      //var_dump($sql);
      $result = $this->db->pgquery($sql);
      return $result;
    }catch (Throwable $e) {
      
    } 
  }

  function updateProfileWithoutCedula2($form){
    try {
      $sql = "UPDATE profesores SET nombre = '".strtoupper($form["usuario"])."', apellido = '".strtoupper($form['apellido'])."', email = '".strtoupper($form["email"])."' Where cedula = '".$_SESSION["cedula"]."';";
    }catch (Throwable $e) {
      
    }
    try {
       $sql.= "UPDATE directivo SET nombre = '".strtoupper($form["usuario"])."', apellido = '".strtoupper($form['apellido'])."', email = '".strtoupper($form["email"])."' Where cedula = '".$_SESSION["cedula"]."';";
      //var_dump($sql);
      $result = $this->db->pgquery($sql);
      return $result;
    }catch (Throwable $e) {
      
    } 
  }
}
?>