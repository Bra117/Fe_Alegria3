<?php
class register_alumnoModel extends Model{

  function __contruct(){
    parent::__construct();
  }

  function register_alumnoModel(){
    $this->db = DatabaseCon::getInstance();
  }

  function countAlumno(){
   try{
     $sql = "SELECT count (*) as alumnos from alumnos WHERE id_status = 1";
     //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
     return $result;
    }catch(Throwable $e){

    }
  }

  function registrar($form){
   
    try {
      $sql = "INSERT INTO alumnos
      (id_status, nombre, apellido , cedula, fecha_nac, id_aseccion, id_sexo) VALUES (1, '".strtoupper($form['nombre'])."', '".strtoupper($form['apellido'])."', '".$form['cedula']."', '".$form['fecha_nac']."', '".strtoupper($form['select'])."', '".strtoupper($form['select1'])."');";
    }catch (Throwable $e) {
      
    }  
    $result = $this->db->pgquery($sql);
    //var_dump($sql);
    return $result;
  }
 
  function getStudentByCedula($form){
      
    try {
      $sql = "SELECT alu.id_alumno, sta.d_status, CONCAT (ase.ano, ' ', ase.seccion) as d_aseccion, alu.cedula, alu.nombre, alu.apellido,  alu.fecha_nac, sex.d_sexo From alumnos  as alu
      Inner Join status sta On sta.id_status = alu.id_status
      Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
      Inner Join sexo sex On sex.id_sexo = alu.id_sexo WHERE alu.cedula = '".$form['cedula']."';";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);    
      return $result;

      }catch(Throwable $e) {
         
      }
    }

    function getStudentByCedulaQR($id_student){
      
    try {
      $sql = "SELECT alu.id_alumno, sta.d_status, CONCAT (ase.ano, ' ', ase.seccion) as d_aseccion, alu.cedula, alu.nombre, alu.apellido,  alu.fecha_nac, sex.d_sexo From alumnos  as alu
      Inner Join status sta On sta.id_status = alu.id_status
      Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
      Inner Join sexo sex On sex.id_sexo = alu.id_sexo WHERE alu.id_alumno = ".$id_student.";";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);    
      return $result;

      }catch(Throwable $e) {
         
      }
    }

    function getStudentByCedulaQR1($cod){
      
    try {
      $sql = "SELECT alu.id_alumno, sta.d_status, CONCAT (ase.ano, ' ', ase.seccion) as d_aseccion, alu.cedula, alu.nombre, alu.apellido,  alu.fecha_nac, sex.d_sexo From alumnos  as alu
      Inner Join status sta On sta.id_status = alu.id_status
      Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
      Inner Join sexo sex On sex.id_sexo = alu.id_sexo WHERE alu.id_alumno = ".$cod.";";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);    
      return $result;

      }catch(Throwable $e) {
         
      }
    }
    
  function getStudentByCedulaRol3($form){
      
    try {
      
       $sql = "SELECT alu.id_alumno, sta.d_status, CONCAT (ase.ano, ' ', ase.seccion) as d_aseccion, alu.cedula, alu.nombre, alu.apellido,  alu.fecha_nac, sex.d_sexo From alumnos  as alu
        Inner Join status sta On sta.id_status = alu.id_status
        Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
        Inner Join sexo sex On sex.id_sexo = alu.id_sexo WHERE alu.cedula = '".$form['cedula']."';";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      
      return $result;

    }catch(Throwable $e) {
         
    }
  }

  function getStudentById($id_student){    
    try {
     $sql = "SELECT alu.id_alumno, alu.id_status, sta.d_status, CONCAT (ase.ano, ' ', ase.seccion) as d_aseccion, alu.cedula, alu.nombre, alu.apellido,  alu.fecha_nac, sex.id_sexo, sex.d_sexo From alumnos  as alu
      Inner Join status sta On sta.id_status = alu.id_status
      Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
      Inner Join sexo sex On sex.id_sexo = alu.id_sexo WHERE alu.id_alumno = ".$id_student.";";
      //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
      return $result['row'];
    }catch(Throwable $e) {


    }
  }

  function getStudentByIdVal($value){    
    try {
     $sql = "SELECT alu.id_alumno, alu.id_status, sta.d_status, CONCAT (ase.ano, ' ', ase.seccion) as d_aseccion, alu.cedula, alu.nombre, alu.apellido,  alu.fecha_nac, sex.id_sexo, sex.d_sexo From alumnos  as alu
      Inner Join status sta On sta.id_status = alu.id_status
      Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
      Inner Join sexo sex On sex.id_sexo = alu.id_sexo WHERE alu.id_alumno = ".$value.";";
      //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
      return $result['row'];
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

  public function ShowStudent(){
    try{
      $sql = "SELECT alu.id_alumno, sta.d_status, sex.d_sexo, CONCAT (ase.ano, ' ', ase.seccion) as d_aseccion, alu.cedula, 
       alu.nombre, alu.apellido,  alu.edad From alumnos  as alu
        Inner Join status sta On sta.id_status = alu.id_status
        Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
        Inner Join sexo sex On sex.id_sexo = alu.id_sexo";
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e) {

   }
  }

  public function ShowAsecciones($value){
   try{
    $sql = "SELECT alu.fecha_nac, sex.d_sexo, alu.id_alumno, st.d_status as status, CONCAT(alu.nombre, ' ', alu.apellido) as fullname, alu.cedula,CONCAT (ase.ano, ' ', ase.seccion) as aseccion,
        (Select count(id_inasistencia) as alumno_inasistencia from inasistencias inas where inas.id_alumno = alu.id_alumno),
        (Select count(id_status_inasistencia) as vigentes from inasistencias inas where  inas.id_status_inasistencia = 1 AND alu.id_alumno = inas.id_alumno ),
        (Select count(id_status_inasistencia) as anuladas from inasistencias inas where  inas.id_status_inasistencia = 2 AND alu.id_alumno = inas.id_alumno ),
        ((Select count(id_inasistencia) from inasistencias inas where inas.id_alumno = alu.id_alumno)::int -
        (Select count(id_status_inasistencia) as anuladas from inasistencias inas where  inas.id_status_inasistencia = 2 AND alu.id_alumno = inas.id_alumno)::int) AS inasistencia_real
      From aseccion ase
        Inner Join alumnos alu On alu.id_aseccion = ase.id_aseccion
        Inner Join sexo sex On sex.id_sexo = alu.id_sexo 
        Inner Join status st On st.id_status = alu.id_status Where ase.id_aseccion = '".$value."'";
    $result = Model::getResult($sql,$this->db);
    //var_dump($sql);
    return $result;
   }catch(Throwable $e){

   }
  }

    public function ShowAseccionesEstadistic($value){
   try{
    $sql = "SELECT alu.fecha_nac, sex.d_sexo, alu.id_alumno, st.d_status as status, CONCAT(alu.nombre, ' ', alu.apellido) as fullname, alu.cedula,CONCAT (ase.ano, ' ', ase.seccion) as aseccion,
        (Select count(id_inasistencia) as alumno_inasistencia from inasistencias inas where inas.id_alumno = alu.id_alumno),
      (Select count(id_status_inasistencia) as vigentes from inasistencias inas where  inas.id_status_inasistencia = 1 AND alu.id_alumno = inas.id_alumno ),
      (Select count(id_status_inasistencia) as anuladas from inasistencias inas where  inas.id_status_inasistencia = 2 AND alu.id_alumno = inas.id_alumno ),
      ((Select count(id_inasistencia) from inasistencias inas where inas.id_alumno = alu.id_alumno)::int -
      (Select count(id_status_inasistencia) as anuladas from inasistencias inas where  inas.id_status_inasistencia = 2 AND alu.id_alumno = inas.id_alumno)::int) AS inasistencia_real
    From aseccion ase
      Inner Join alumnos alu On alu.id_aseccion = ase.id_aseccion
      Inner Join sexo sex On sex.id_sexo = alu.id_sexo 
      Inner Join status st On st.id_status = alu.id_status Where ase.id_aseccion = '".$value."'";
    $result = Model::getResult($sql,$this->db);
    //var_dump($sql);
    return $result;
   }catch(Throwable $e){

   }
  }

  public function ShowAseccionesRol3($value){
   try{
    $sql = "SELECT alu.fecha_nac, sex.d_sexo, alu.id_alumno, st.d_status as status, CONCAT(alu.nombre, ' ', alu.apellido) as fullname, alu.cedula,CONCAT (ase.ano, ' ', ase.seccion) as aseccion From aseccion ase
      Inner Join alumnos alu On alu.id_aseccion = ase.id_aseccion
      Inner Join sexo sex On sex.id_sexo = alu.id_sexo 
      Inner Join status st On st.id_status = alu.id_status Where ase.id_aseccion = '".$value."'";
    $result = Model::getResult($sql,$this->db);
    //var_dump($sql);
    return $result;
   }catch(Throwable $e){

   }
  }

  public function ShowAseccionesRol2($value){
   try{
    $sql = "SELECT alu.fecha_nac, sex.d_sexo, alu.id_alumno, st.d_status as status, CONCAT(alu.nombre, ' ', alu.apellido) as fullname, alu.cedula,CONCAT (ase.ano, ' ', ase.seccion) as aseccion From aseccion ase
      Inner Join alumnos alu On alu.id_aseccion = ase.id_aseccion
      Inner Join sexo sex On sex.id_sexo = alu.id_sexo 
      Inner Join status st On st.id_status = alu.id_status Where ase.id_aseccion = '".$value."'";
    $result = Model::getResult($sql,$this->db);
    //var_dump($sql);
    return $result;
   }catch(Throwable $e){

   }
  }
  
  public function SelectAseccion(){
    try{
      $sql = "SELECT ase.id_aseccion, CONCAT (ase.ano, ' ', ase.seccion) AS aseccion FROM aseccion ase";
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  public function SelectAseccion1(){
    try{
      $sql = "SELECT ase.id_aseccion, ase.id_status, CONCAT (ase.ano, ' ', ase.seccion) AS aseccion FROM aseccion ase";
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  
  function updateStudentInfo($form){
    $status   = $form['status'];
    $cedula   = $form['cedula'];
    $nombre   = $form['nombre'];
    $apellido = $form['apellido'];
    $fecha    = $form['fecha_nac'];
    $aseccion = $form['aseccion'];
    $sexo     = $form['sexo'];
  
    try{
      $sql="UPDATE alumnos SET id_status=".$status.", id_sexo= ".$sexo.", id_aseccion= ".$aseccion.", cedula='".$cedula."', nombre='".strtoupper($nombre)."', apellido='".strtoupper($apellido)."', fecha_nac='".$fecha."' WHERE id_alumno = ".$form['id_student'].";";
      $result = Model::getResult($sql,$this->db);
      //var_dump($id_profesor);
      return $result;
    }catch(Throwable $e){

    } 
  }

  public function SelectAseccionRol2(){
    try{
      $sql = "SELECT ase.id_aseccion, CONCAT (ase.ano, ' ', ase.seccion) AS aseccion FROM aseccion ase";
      
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  public function SelectAseccionRol3(){
    try{
      $sql = "SELECT ase.id_aseccion, CONCAT (ase.ano, ' ', ase.seccion) AS aseccion FROM aseccion ase";
      
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  public function getUpdate($form){
    try{
    $sql = "UPDATE alumnos
      SET  nombre = '".strtoupper($form['nombre'])."', apellido = '".strtoupper($form['apellido'])."' , fecha_nac = '".$form['fecha_nac']."', cedula = '".$form['cedula']."', id_status = ".$form['status'].",  id_sexo = ".$form['sexo']." , id_aseccion = ".$form['aseccion']."  WHERE id_alumno = ".$form['id_student'].";";
    
    $result = $this->db->pgquery($sql);
    //var_dump($sql);
    return $result;
    }catch(Throwable $e){

    }
  }

  public function gr_general($value){
    try {
      $sql = "SELECT  count(id_aseccion) as seccion,
      (SELECT  count(id_aseccion) FROM   alumnos) as total,
      (SELECT count (id_aseccion) FROM alumnos Where id_status = 2  and id_aseccion = ".$value.") as inactivo
      FROM   alumnos al 
      WHERE id_aseccion = ".$value.";";

      $result = Model::getResult($sql,$this->db);
      return $result;  
    }catch (Throwable $e) {
      
      
    }
  }
   
  public function gr_general2($value){
    try {
      $sql = " SELECT (SELECT  count(id_inasistencia) FROM  inasistencias WHERE id_status_inasistencia != 2) as total_inasistencias,
        ((Select count(id_inasistencia) from inasistencias inas where inas.id_alumno = alu.id_alumno)::int -
        (Select count(id_status_inasistencia) as anuladas from inasistencias inas where  inas.id_status_inasistencia = 2 AND alu.id_alumno = inas.id_alumno)::int) AS inasistencia_real,
        (Select count(id_status_inasistencia) as vigentes from inasistencias inas where  inas.id_status_inasistencia = 1 AND alu.id_alumno = inas.id_alumno),
        (Select count(id_status_inasistencia) as anuladas from inasistencias inas where  inas.id_status_inasistencia = 2 AND alu.id_alumno = inas.id_alumno )
          FROM   inasistencias inas
          Inner Join alumnos alu On alu.id_alumno = inas.id_alumno
        WHERE  id_aseccion = ".$value." GROUP BY alu.id_alumno;";
      $result = Model::getResult($sql,$this->db);
      return $result;  
    }catch (Throwable $e) {
      
      
    }
  }

  public function gr_general3(){
    try {
        $sql = "SELECT ase.id_aseccion, CONCAT(ase.ano, ' ', ase.seccion) as secciones, 
                  COUNT(DISTINCT alu.id_alumno) as total_alumnos,
                  COUNT(DISTINCT inas.id_inasistencia) as total_inasistencia from aseccion ase
                LEFT JOIN 
                alumnos alu ON ase.id_aseccion = alu.id_aseccion
                LEFT JOIN 
                inasistencias inas ON alu.id_alumno = inas.id_alumno
                GROUP BY ase.id_aseccion, secciones
                ORDER BY ase.id_aseccion";
      //var_dump($sql);      
      $result = Model::getResult($sql,$this->db);
      return $result;  
    }catch (Throwable $e) {
      
      
    }
  }

  public function getSeccionById($value){
    try {
      $sql = "SELECT CONCAT(ano ,' ', seccion) as desc_seccion FROM aseccion WHERE id_aseccion = ".$value.";";
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }
  
  public function getSeccionById2($value){
    try {
      $sql = "SELECT CONCAT(ano ,' ', seccion) as desc_seccion FROM aseccion WHERE id_aseccion = ".$value.";";
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  function getStudentByIdValue($value){    
    try {
     $sql = "SELECT alu.id_alumno, CONCAT(alu.nombre, ' ', alu.apellido) as fullname, alu.cedula as cedulaalu, pro.id_profesor, CONCAT(pro.nombre, ' ', pro.apellido) as fullnamepro, pro.cedula as cedulapro from solicitudes sol
      Inner Join alumnos alu On alu.id_alumno = sol.id_alumno
      Inner Join profesores pro On pro.id_profesor = sol.id_profesor where  alu.id_alumno = ".$value.";";
      //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e) {


    }
  }

  function InsertInasistencia($value){
      try {
     $sql = "INSERT Into inasistencias (id_profesor, id_alumno, fecha, id_status_inasistencia) Values (".$_SESSION['id_profesor'].", ".$value.", NOW(), 1)";
      //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e) {


    }
  }

  function InasistenciaAlumno($value){
      try {
     $sql = "SELECT * FROM inasistencias Where id_alumno = ".$value.";";
      //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e) {


    }
  }

  function ConInasisByIdAlumno($value){
    try{
      $sql = "SELECT * From inasistencias where id_alumno = ".$value.";";
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function GfByIdAlumno($value){
    try{
      $sql = "SELECT COUNT(id_inasistencia) as inasistencia_alumno,
            (SELECT  count(id_inasistencia) FROM   inasistencias) as total_inasistencia 
            from inasistencias Where id_alumno = ".$value.";";
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  function TableInas2($form){
      try{
      $sql = "SELECT ina.id_inasistencia, alu.id_alumno, sta.d_status, si.d_status_inasistencia, si.id_status_inasistencia, alu.nombre, alu.apellido, 
     alu.cedula, CONCAT(ase.ano, ' ', ase.seccion) as d_aseccion, ina.fecha, CONCAT(pro.nombre, ' ', pro.apellido) as fullname, ina.observacion_anulacion from inasistencias ina
     Inner Join alumnos alu on alu.id_alumno = ina.id_alumno   
     Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
     Inner Join profesores pro On pro.id_profesor = ina.id_profesor
     Inner Join status sta On sta.id_status = alu.id_status
   Inner Join status_inasistencia si On si.id_status_inasistencia = ina.id_status_inasistencia
    Where alu.cedula = '".$form['cedula']."';";
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  function TableInas($form){
      try{
      $sql = "SELECT alu.id_alumno, sta.d_status, si.d_status_inasistencia, si.id_status_inasistencia,alu.nombre, alu.apellido, 
     alu.cedula, CONCAT(ase.ano, ' ', ase.seccion) as d_aseccion, ina.fecha, CONCAT(pro.nombre, ' ', pro.apellido) as fullname  
   from inasistencias ina
     Inner Join alumnos alu on alu.id_alumno = ina.id_alumno   
     Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
     Inner Join profesores pro On pro.id_profesor = ina.id_profesor
     Inner Join status_inasistencia si On si.id_status_inasistencia = ina.id_status_inasistencia
     Inner Join status sta On sta.id_status = alu.id_status Where alu.cedula = '".$form['cedula']."' AND si.id_status_inasistencia = 1 ;";
     //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  function CountInasistencias($value, $month, $year){
      try{
      $sql = "SELECT count(*) AS total_inasistencias 
        FROM inasistencias inas 
      Inner Join alumnos alu On alu.id_alumno = inas.id_alumno WHERE inas.id_alumno = ".$value." AND alu.id_status != 2
      AND (fecha >= '".$year."-".$month."-01' AND fecha <= '".$year."-".$month."-30');";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  /*function CountInasistencias($value, $month, $year){
      try{
      $sql = "SELECT count(*) AS total_inasistencias 
        FROM inasistencias inas 
      Inner Join alumnos alu On alu.id_alumno = inas.id_alumno WHERE inas.id_alumno = ".$value." AND alu.id_status != 2
      AND (fecha >= '01-".$month."-".$year."' AND fecha <= '30-".$month."-".$year."');";
      var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }*/


  function getStudentByIdInas($id_student){    
    try {
     $sql = "SELECT alu.id_alumno, alu.id_status, sta.d_status, CONCAT (ase.ano, ' ', ase.seccion) as d_aseccion, alu.cedula, alu.nombre, alu.apellido,  alu.fecha_nac, sex.id_sexo, sex.d_sexo From alumnos  as alu
      Inner Join status sta On sta.id_status = alu.id_status
      Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
      Inner Join sexo sex On sex.id_sexo = alu.id_sexo WHERE alu.id_alumno = ".$id_student.";";
      //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e) {


    }
  }

  function showAllMotivo_consulta(){
    try {
      $sql = "SELECT id_motivo_consulta, d_motivo_consulta as motivo FROM motivo_consulta ";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    } catch (Exception $e) {
      
    }
  }

  function InsertMotivo($form, $id_student){
     try {
      $sql = "INSERT INTO consulta(id_alumno, id_directivo, id_motivo_consulta, fecha_consulta, id_status_consulta)
              VALUES (".$id_student.", ".$_SESSION['id_profesor'].", ".$form['botones'].", NOW(), 1);";
      //var_dump($sql);
      $result = $this->db->pgquery($sql);
      return $result;
    } catch (Exception $e) {
      
    } 
  }

  public function getSeccionByIdArray(){
    try {
      $sql = "SELECT array_agg(CONCAT(ano,' ', seccion)) as secciones FROM aseccion";

      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  public function Showselectaseccion(){
    try {
      $sql = "SELECT ase.id_aseccion ,CONCAT(ase.ano,' ', ase.seccion) as secciones FROM aseccion ase";

      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
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

  public function UpdateAseccion($form){
    try {
      $sql = "SELECT st.id_status, st.d_status as status FROM status st";

      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  public function UpdateAseccion1($form){
    try {
      $sql = "UPDATE aseccion SET id_status = ".$form['selecstatus']." WHERE id_aseccion = ".$form['selecAseccion'].";";

      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  public function StatusInasistencia(){
    try {
      $sql = "SELECT si.id_status_inasistencia, si.d_status_inasistencia From status_inasistencia si Where id_status_inasistencia = 2";
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  public function UpdateInasistencia($form){
    try {
      $sql = "UPDATE inasistencias SET id_status_inasistencia = ".$form['SelectStInas'].", observacion_anulacion = '".$form['message']."'  WHERE id_inasistencia = ".$form['id_inas'].";";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  public function StatusAseccion($form){
    try {
      $sql = "SELECT ase.id_status FROM aseccion ase Where ase.id_aseccion = ".$form['select'].";";
      var_dump($sql);
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  public function StatusAseccion1($form){
    try {
      $sql = "SELECT ase.id_status FROM aseccion ase Where ase.id_aseccion = ".$form['aseccion'].";";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }

  public function IdInasistencia($id_inas){
    try {
      $sql = "SELECT inas.id_inasistencia FROM inasistencias inas WHERE inas.id_inassitencia = ".$id_inas.";";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
    return $result;  
    }catch (Throwable $e) {
       
    }
  }
}
?>
