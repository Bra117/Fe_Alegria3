<?php
  class loginModel extends Model{

    public function __contruct(){
          parent::__construct();

    }

    public function loginModel(){

      $this->db = DatabaseCon::getInstance();

    }

   function getLogin($cedula,$password){
    try{

  
      $sql = "SELECT pro.id_profesor, pro.id_status, pro.nombre, pro.apellido, CONCAT (pro.nombre, ' ', pro.apellido) AS full_name, pro.id_rol, rol.d_rol,  pro.email, pro.pass, pro.cedula from profesores pro
        Inner Join roles rol  ON rol.id_rol = pro.id_rol
        Inner Join status sta ON sta.id_status = pro.id_status
        WHERE pro.cedula = '".$cedula."'
        AND pro.pass = '".$password."'
     UNION ALL
        SELECT dir.id_directivo, dir.id_status, dir.nombre, dir.apellido, CONCAT (dir.nombre, ' ', dir.apellido) AS full_name, dir.id_rol, rol.d_rol, dir.email, dir.passwd, dir.cedula from directivo dir
        Inner Join roles rol  ON rol.id_rol = dir.id_rol
        Inner Join status sta ON sta.id_status = dir.id_status
        WHERE dir.cedula = '".$cedula."'
        AND dir.passwd = '".$password."'; ";
      //var_dump($sql);
      /*UNION ALL
      SELECT CONCAT (seg.nombre, ' ', seg.apellido) AS full_name, seg.id_rol, rol.d_rol, seg.email, seg.passs, seg.cedula from seguridad seg
        Inner Join roles rol  ON rol.id_rol = seg.id_rol
        WHERE seg.cedula = '".$cedula."'
        AND seg.passs = '".$password."'; ";*/
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch (Throwable $e) {

    } 
  }

 
  function ShowSoli(){
    try{
    $sql = "SELECT sol.id_solicitud, sts.d_status_solicitud, sol.fecha_solicitud, CONCAT (dir.nombre, ' ', dir.apellido) as director
        , CONCAT (alu.nombre, ' ', alu.apellido) as alumno, CONCAT (pro.nombre, ' ', pro.apellido) as profesor, 
        sol.id_alumno, CONCAT(ase.ano, ' ', ase.seccion) as aseccion, mot.d_motivo, sol.anexo
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


  function ShowDirectivo(){  
   try {
     $sql = "SELECT dir.id_directivo, rol.d_rol, st.d_status, dir.cedula, dir.nombre, dir.apellido, dir.email 
       From directivo as dir
     Inner Join roles rol On rol.id_rol = dir.id_rol
     Inner Join status st On st.id_status = dir.id_status";
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){
 
    }
  }


  function getUpdateName($form){
    try{
     $sql = "UPDATE profesores
      SET  nombre = '".strtoupper($form['nombre'])."'  WHERE id_profesor = ".$form['id_profesor'].";";
     //var_dump($sql);
     $result = $this->db->pgquery($sql);
     return $result;
    }catch(Throwable $e){

    }
  }
  
  function getUpdateSurname($form){
    try{
     $sql = "UPDATE profesores
      SET  nombre = '".strtoupper($form['apellido'])."'  WHERE id_profesor = ".$form['id_profesor'].";";
     //var_dump($sql);
     $result = $this->db->pgquery($sql);
     return $result;
    }catch(Throwable $e){

    }
  }
  
  function getUpdateCedula($id_profesor){
    try{
     $sql = "UPDATE profesores
      SET  cedula = '".strtoupper($form['cedula'])."'  WHERE id_profesor = ".$id_profesor.";";
     //var_dump($sql);
     $result = $this->db->pgquery($sql);
     return $result;
    }catch(Throwable $e){

    }
  }


  
  function GetCedula($id_profesor){
    try{
      $sql = "SELECT cedula FROM profesores WHERE id_profesor = ".$id_profesor['id_profesor'].";";
      $result = Model::getResult($sql,$this->db);
      var_dump($sql);
    }catch(Throwable $e){

    }
  }

  function countAlumnoRol3(){
   try{
     $sql = "SELECT count (*) as alumnos from alumnos";
     //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
     return $result;
    }catch(Throwable $e){

    }
  }
  

  function showStudentsRol3(){
    try{
     $sql = "SELECT alu.id_alumno, CONCAT (ase.ano, ' ', ase.seccion) as secciones , st.d_status, alu.cedula, alu.nombre, alu.apellido
       From alumnos as alu
     Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion 
     Inner Join status st On st.id_status = alu.id_status";
     //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
     return $result;
    }catch(Throwable $e){

    }
  }
} //Fin Modelo
?>