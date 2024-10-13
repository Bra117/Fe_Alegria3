<?php
  class solicitudModel extends Model{
  
  function __contruct(){
    parent::__construct();
  }

  function solicitudModel(){
    $this->db = DatabaseCon::getInstance();
  }

   
  function ShowSoli(){
    try{
    $sql = "SELECT sol.id_solicitud, sts.d_status_solicitud, sol.fecha_solicitud, CONCAT (dir.nombre, ' ', dir.apellido) as director
        , CONCAT (alu.nombre, ' ', alu.apellido) as alumno, CONCAT (pro.nombre, ' ', pro.apellido) as profesor, 
        sol.id_alumno, CONCAT(ase.ano, ' ', ase.seccion) as aseccion, mot.d_motivo, sol.anexo, sol.text_cancelacion
        from solicitudes sol 
        Inner Join status_solicitud sts On sts.id_status_solicitud = sol.id_status_solicitud
        Inner Join profesores pro On pro.id_profesor = sol.id_profesor
        Inner Join alumnos alu On alu.id_alumno = sol.id_alumno
        Inner Join aseccion ase On ase.id_aseccion = sol.id_aseccion
        Inner Join directivo dir On  dir.id_directivo = sol.id_directivo
      Inner Join motivos mot  On mot.id_motivo = sol.id_motivo where sol.id_status_solicitud = 1";
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e) {

   }
  }

  function ShowSoliUser1(){
    try{
    $sql = "SELECT sol.id_solicitud, sts.d_status_solicitud, sol.fecha_solicitud, CONCAT (dir.nombre, ' ', dir.apellido) as director
        , CONCAT (alu.nombre, ' ', alu.apellido) as alumno, CONCAT (pro.nombre, ' ', pro.apellido) as profesor, 
        sol.id_alumno, CONCAT(ase.ano, ' ', ase.seccion) as aseccion, mot.d_motivo, sol.anexo, sol.text_cancelacion
        from solicitudes sol 
        Inner Join status_solicitud sts On sts.id_status_solicitud = sol.id_status_solicitud
        Inner Join profesores pro On pro.id_profesor = sol.id_profesor
        Inner Join alumnos alu On alu.id_alumno = sol.id_alumno
        Inner Join aseccion ase On ase.id_aseccion = sol.id_aseccion
        Inner Join directivo dir On  dir.id_directivo = sol.id_directivo
      Inner Join motivos mot  On mot.id_motivo = sol.id_motivo";
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e) {

   }
  }
  
  public function ShowSoli2(){
    try{
    $sql = "SELECT sol.id_solicitud, sts.d_status_solicitud, sol.fecha_solicitud, CONCAT (dir.nombre, ' ', dir.apellido) as director
        , CONCAT(alu.nombre, ' ', alu.apellido) as alumno, 
        sol.id_alumno, CONCAT(ase.ano, ' ', ase.seccion) as aseccion, mot.d_motivo, sol.anexo
        from solicitudes sol 
        Inner Join status_solicitud sts On sts.id_status_solicitud = sol.id_status_solicitud
        Inner Join profesores pro On pro.id_profesor = sol.id_profesor
        Inner Join alumnos alu On alu.id_alumno = sol.id_alumno
        Inner Join aseccion ase On ase.id_aseccion = sol.id_aseccion
        Inner Join directivo dir On  dir.id_directivo = sol.id_directivo 
        Inner Join motivos mot ON mot.id_motivo = sol.id_motivo Where sol.id_profesor = ".$_SESSION['id_profesor']." AND sol.id_status_solicitud = 3;";
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e) {

   }
  }

  public function ShowSoli3(){
    try{
    $sql = "SELECT sol.id_solicitud, sts.d_status_solicitud, sol.fecha_solicitud, CONCAT (dir.nombre, ' ', dir.apellido) as director
        , CONCAT(alu.nombre, ' ', alu.apellido) as alumno, 
        sol.id_alumno, CONCAT(ase.ano, ' ', ase.seccion) as aseccion, mot.d_motivo, sol.anexo, sol.text_cancelacion
        from solicitudes sol 
        Inner Join status_solicitud sts On sts.id_status_solicitud = sol.id_status_solicitud
        Inner Join profesores pro On pro.id_profesor = sol.id_profesor
        Inner Join alumnos alu On alu.id_alumno = sol.id_alumno
        Inner Join aseccion ase On ase.id_aseccion = sol.id_aseccion
        Inner Join directivo dir On  dir.id_directivo = sol.id_directivo 
        Inner Join motivos mot ON mot.id_motivo = sol.id_motivo Where sol.id_profesor = ".$_SESSION['id_profesor']." AND sol.id_status_solicitud = 2";
        //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      
      return $result;
    }catch(Throwable $e) {

   }
  }

  public function UpdateSoli($form){
    try{
    $sql = "UPDATE solicitudes SET id_status_solicitud = 3 WHERE id_solicitud = ".$form.";";
    $result = $this->db->pgquery($sql);
    //var_dump($sql);
    return $result; 
    }catch(Throwable $e){

    }
  }

  function UpdateSoliCancel($form){
    try{
    $sql = "UPDATE solicitudes SET text_cancelacion = '".$form['textarea']."', id_status_solicitud = 2 WHERE id_solicitud = ".$form['id_profesor'].";";
    $result = $this->db->pgquery($sql);
   // var_dump($form);
    return $result; 
    }catch(Throwable $e){

    }
  }
  
  function getSoliById(){
    try{
    $sql = "SELECT * From solicitudes";
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e) {

   }
  }

  public function gr_general(){

    try {
      $sql = "SELECT  count(id_solicitud) as Enviado,
              (SELECT  count(id_solicitud) FROM  solicitudes where id_status_solicitud = 3) as Aceptado , 
              (SELECT  count(id_solicitud) FROM  solicitudes where id_status_solicitud = 2) as Cancelado,
              (SELECT  count(id_solicitud) FROM  solicitudes) as todo
          FROM   solicitudes sol 
          WHERE  id_status_solicitud = 1";
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
      
      
    }
  }
} //Fin Modelo

?>
