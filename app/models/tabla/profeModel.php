<?php
class profeModel extends Model{
  function __contruct(){
    parent::__construct();
  }

  function profeModel(){
    $this->db = DatabaseCon::getInstance();
  }
  
   public function getRegister($form){

    if ($form['select'] == 1) {

      try{
        $sql.= "INSERT INTO directivo (id_rol, id_status, cedula, nombre, apellido, email, passwd) VALUES (".$form['select'].", 1 , '".$form['cedula']."', '".strtoupper($form['nombre'])."', '".strtoupper($form['apellido'])."',  '".$form['email']."', '".sha1(md5($form['pass']))."')";
      }catch(Throwable $e){
       
       }
    }else{
      try{
        $sql= "INSERT INTO profesores (id_rol, id_status, cedula, nombre, apellido, email, pass) VALUES (".$form['select'].", 1, '".$form['cedula']."', '".strtoupper($form['nombre'])."', '".strtoupper($form['apellido'])."',  '".$form['email']."', '".sha1(md5($form['pass']))."')";
      }catch(Throwable $e){
   
        }
    }
    //var_dump($sql);
    $result = $this->db->pgquery($sql);
    return $result;
  }

  function countPersonals(){

   try{
     $sql = "SELECT count (*) as personal from profesores where id_rol = 3 AND id_status = 1";
     //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
     return $result;
    }catch(Throwable $e){

    }
  }

  function getTeachersByCedula1($form){
    
    try {
      $sql = "SELECT * FROM profesores WHERE cedula = '".$form['cedula']."'
                UNION ALL
              SELECT * From directivo Where cedula = '".$form['cedula']."';";
             // var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){
 
    }
  }

  function countDirectivo(){

    try{
     $sql = "SELECT count (*) as directivo from directivo WHERE id_status = 1
";
     //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
     return $result;
    }catch(Throwable $e){

    }
  }

  function countProfesores(){

    try{
     $sql = "SELECT count (*) as profesores from profesores where id_rol = 2 AND id_status = 1";
     //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
     return $result;
    }catch(Throwable $e){

    }
  }
  
  function GetTeacherById($id_profesor){
    try{
      $sql = "SELECT pro.id_profesor, rol.d_rol, rol.id_rol, st.d_status, st.id_status, pro.cedula, pro.nombre, pro.apellido, pro.email 
       From Profesores as pro
     Inner Join roles rol On rol.id_rol = pro.id_rol
     Inner Join status st On st.id_status = pro.id_status WHERE pro.id_profesor = ".$id_profesor."
     UNION ALL
     SELECT dir.id_directivo, rol.d_rol, rol.id_rol, st.d_status, st.id_status, dir.cedula, dir.nombre, dir.apellido, dir.email 
       From directivo as dir
     Inner Join roles rol On rol.id_rol = dir.id_rol
     Inner Join status st On st.id_status = dir.id_status WHERE dir.id_directivo = ".$id_profesor.";";
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  function GetTeacherByCedula($cedula){
    try{
      $sql = "SELECT pro.id_profesor, rol.d_rol, rol.id_rol, st.d_status, st.id_status, pro.cedula, pro.nombre, pro.apellido, pro.email 
       From Profesores as pro
     Inner Join roles rol On rol.id_rol = pro.id_rol
     Inner Join status st On st.id_status = pro.id_status WHERE pro.cedula = '".$cedula."'
     UNION ALL
     SELECT dir.id_directivo, rol.d_rol, rol.id_rol, st.d_status, st.id_status, dir.cedula, dir.nombre, dir.apellido, dir.email 
       From directivo as dir
     Inner Join roles rol On rol.id_rol = dir.id_rol
     Inner Join status st On st.id_status = dir.id_status WHERE dir.cedula = '".$cedula."';";
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

function updateTeacherInfo($form){

  $rol      = $form['rol'];
  $status   = $form['status'];
  $cedula   = $form['cedula'];
  $nombre   = $form['nombre'];
  $apellido = $form['apellido'];
  $email    = $form['correo'];
  
  try{
    $sql="UPDATE public.profesores SET id_rol=".$rol.", id_status=".$status.", cedula='".$cedula."', nombre='".strtoupper($nombre)."', apellido='".strtoupper($apellido)."', email='".strtoupper($email)."' WHERE cedula = '".$form['cedula']."';";
  }catch(Throwable $e){

  }
  try{
   $sql.="UPDATE public.directivo SET id_rol=".$rol.", id_status=".$status.", cedula='".$cedula."', nombre='".strtoupper($nombre)."', apellido='".strtoupper($apellido)."', email='".strtoupper($email)."' WHERE cedula = '".$form['cedula']."';";
       //var_dump($sql);
     $result = $this->db->pgquery($sql);
    return $result;
  }catch(Throwable $e){

  }
}

  function ShowProfesores(){  

   try {
     $sql = "SELECT pro.id_profesor, rol.d_rol, st.d_status, pro.cedula, pro.nombre, pro.apellido, pro.email 
       From Profesores as pro
     Inner Join roles rol On rol.id_rol = pro.id_rol
     Inner Join status st On st.id_status = pro.id_status
      Union All 
      SELECT dir.id_directivo, rol.d_rol, st.d_status, dir.cedula, dir.nombre, dir.apellido,dir.email 
       From directivo as dir
      Inner Join roles rol On rol.id_rol = dir.id_rol
      Inner Join status st On st.id_status = dir.id_status";
    //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){
 
    }
  }

  /*public function ShowSoli(){

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
      Inner Join motivos mot    ON   mot.id_motivo = sol.id_motivo Where sol.id_profesor = ".$_SESSION['id_profesor']." AND sol.id_status_solicitud = 1;";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e) {

   }
  }*/

  function getUpdate($id_profesor){
    try{
     $sql = "UPDATE profesores
      SET  nombre = '".strtoupper($form['nombre'])."', apellido = '".strtoupper($form['apellido'])."' , email = '".strtoupper($form['email'])."', cedula = '".$form['cedula']."', id_status = ".$form['status'].",  id_rol = ".$form['rol']."  WHERE id_profesor = ".$id_profesor.";";
     //var_dump($sql);
     $result = $this->db->pgquery($sql);
     return $result;
    }catch(Throwable $e){

    }
  }

  function hora1(){
    try{
     $sql = "SELECT hr.id_hora, hr.id_status, st.d_status, hr.hora From horas hr
      Inner Join status st On st.id_status = hr.id_status where hr.id_status = 1;";     
     $result = Model::getResult($sql,$this->db);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function materia(){
    try{
     $sql = " SELECT mate.id_materia, mate.d_materia From materias mate WHERE mate.id_status = 1";     
     $result = Model::getResult($sql,$this->db);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }
  
  function hora(){
    try{
     $sql = " SELECT hr.id_hora, hr.hora From horas hr where hr.id_status = 1";     
     $result = Model::getResult($sql,$this->db);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function getMateriaById($form){
    try{
     $sql = "SELECT * From materias Where id_materia = ".$form['id_materia'].";";     
     $result = Model::getResult($sql,$this->db);
     var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function registrarMate($form){
    try{
     $sql = "INSERT INTO materias (id_status, d_materia) VALUES (1,'".strtoupper($form['Materia'])."')";     
     $result = $this->db->pgquery($sql);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }
  
  function registrarAsecc($form){
    try{
     $sql = "INSERT INTO ano_sepa (ano) VALUES (".$form['ano'].");
            INSERT INTO aseccion (id_status, ano, seccion) VALUES (1, ".$form['ano'].", '".strtoupper($form['seccion'])."')";     
     $result = $this->db->pgquery($sql);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function registrarhr($form){
    try{
     $sql = "INSERT INTO horas (id_status, hora) VALUES (1,'".strtoupper($form['hora'])."')";     
     $result = $this->db->pgquery($sql);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function profesorselect(){
    try {
      $sql = "SELECT pro.id_profesor, CONCAT (pro.nombre, ' ', pro.apellido) As full_name FROM profesores pro Where id_rol = 2;";
      $result = Model::getResult($sql,$this->db);
      return $result;
    } catch (Exception $e) {
      
    }
  }

  function UpdateMateria($form){
    try {
      $sql = "INSERT INTO materia_profesor (id_profesor, id_materia, id_hora) VALUES  (".$form['selectprofesor'].", ".$form['selectmateria'].", ".$form['selecthoras'].");";
      $result = $this->db->pgquery($sql);
      //var_dump($sql);
      return $result;
    } catch (Exception $e) {
      
    }
  }

  function SelecHora(){
    try {
      $sql = "SELECT hr.id_hora, hr.hora, hr.id_status FROM horas hr;";
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    } catch (Exception $e) {
      
    }
  }

  public function Showstatus(){
    try {
      $sql = "SELECT st.id_status, st.d_status as status FROM status st";
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  public function UpdateHora($form){
    try {
      $sql = "UPDATE horas SET id_status = ".$form['selecstatus']." WHERE id_hora = ".$form['selechora'].";";
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  public function TableMateria(){
    try {
      $sql = "SELECT mat.id_materia, mat.id_status,st.d_status, mat.d_materia From materias mat
        Inner Join status st On st.id_status = mat.id_status";
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  public function SearchMateriaById($id_materia){
    try {
      $sql = "SELECT mat.id_materia, mat.id_status,st.d_status, mat.d_materia From materias mat
        Inner Join status st On st.id_status = mat.id_status WHERE mat.id_materia = ".$id_materia.";";
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  public function SearchMateriaById1($form){
    try {
      $sql = "SELECT mat.id_materia, mat.id_status,st.d_status, mat.d_materia From materias mat
        Inner Join status st On st.id_status = mat.id_status WHERE mat.id_materia = ".$form['id_materia'].";";
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  function updateMateriaInfo($form){
    try{
      $sql="UPDATE public.materias SET id_status=".$form['status'].", d_materia='".strtoupper($form['nombre'])."' WHERE id_materia = ".$form['id_materia'].";";
      //var_dump($sql);
      $result = $this->db->pgquery($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function SearchHoraById($id_hora){
    try{
      $sql="SELECT hr.id_hora, hr.id_status, st.d_status, hr.hora From horas hr Inner Join status st On st.id_status = hr.id_status where hr.id_hora = ".$id_hora.";";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  function SearchHoraById1($form){
    try{
      $sql="SELECT hr.id_hora, hr.id_status, st.d_status, hr.hora From horas hr Inner Join status st On st.id_status = hr.id_status where hr.id_hora = ".$form['id_hora'].";";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  function updateHorainfo($form){
    try{
      $sql="UPDATE public.horas SET id_status=".$form['status'].", hora='".strtoupper($form['hora'])."' WHERE id_hora = ".$form['id_hora'].";";
      //var_dump($sql);
      $result = $this->db->pgquery($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function TablaAse(){
    try{
      $sql="SELECT ase.id_aseccion, ase.id_status, st.d_status, CONCAT(ase.ano, ' ', ase.seccion) as d_aseccion 
              From aseccion ase
            Inner Join status st On st.id_status = ase.id_status";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  function SearchAseccionById($id_aseccion){
    try{
      $sql="SELECT ase.id_aseccion, ase.id_status, st.d_status, ase.ano, ase.seccion
              From aseccion ase
            Inner Join status st On st.id_status = ase.id_status WHERE ase.id_aseccion = ".$id_aseccion.";";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  function SearchAseccionById1($form){
    try{
      $sql="SELECT ase.id_aseccion, ase.id_status, st.d_status, ase.ano, ase.seccion
              From aseccion ase
            Inner Join status st On st.id_status = ase.id_status WHERE ase.id_aseccion = ".$form['id_aseccion'].";";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  function updateAseccionInfo($form){
    try{
      $sql="UPDATE public.aseccion SET id_status=".$form['status'].", seccion='".strtoupper($form['seccion'])."', ano=".$form['ano']." WHERE id_aseccion = ".$form['id_aseccion'].";";
      //var_dump($sql);
      $result = $this->db->pgquery($sql);
      return $result;
    }catch(Throwable $e){

    }
  }
}
?>