<?php
class paseModel extends Model{
  function __contruct(){
    parent::__construct();
  }

  public function paseModel(){
    $this->db = DatabaseCon::getInstance();
  }

  function Registerpase($form){
    try {
      $sql = "INSERT INTO solicitudes (id_status_solicitud, fecha_solicitud, id_directivo, id_profesor, id_alumno, id_aseccion, id_motivo, anexo, id_materia_profesor)
       VALUES (1, NOW(), '".strtoupper($form['remitente'])."', '".strtoupper($form['destinatario'])."', '".$form['alumno']."', '".strtoupper($form['SelectSeccion'])."', '".strtoupper($form['motivos'])."', '".$form['message']."', ".$form['Materias'].");";
        //var_dump($form);      
        $result = $this->db->pgquery($sql);
      return $result;
    }catch (Throwable $e) {
      
    }
  }

  function showAll1(){
    try {
      $sql = "SELECT pro.id_profesor, CONCAT (pro.nombre, ' ', pro.apellido) As full_name FROM profesores pro Where id_rol = 2 AND pro.id_status = 1;";
      $result = Model::getResult($sql,$this->db);
      return $result;
    } catch (Exception $e) {
      
    }
  }

  function showAll($value){
    try {
      $sql = "SELECT matepro.id_materia_profesor, CONCAT(mate.d_materia, ' ', hrs.hora) as d_materia 
                FROM materia_profesor matepro
              Inner Join materias mate On mate.id_materia = matepro.id_materia
              Inner Join horas hrs On hrs.id_hora = matepro.id_hora where matepro.id_profesor = ".$value.";";
      $result = Model::getResult($sql,$this->db);
      return $result;
    } catch (Exception $e) {
      
    }
  }


  function showAlumnPaseAseccion($value){
    try {
    
    $sql = "SELECT alu.id_alumno, ase.id_aseccion, CONCAT (ans.ano, ' ', ase.seccion) as aseccions, CONCAT(alu.nombre, ' ', alu.apellido) as alumno, alu.cedula from aseccion ase
        Inner Join ano_sepa ans On ans.ano = ase.ano 
        Inner Join alumnos alu On alu.id_aseccion = ase.id_aseccion  where ase.id_aseccion = ".$value." ORDER BY ase.id_aseccion";
        //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch (Exception $e) {
    
    }
  }

    function showAlumnPaseAseccion1($form){
    try {
    $sql = "SELECT ase.id_aseccion, CONCAT (ans.ano, ' ', ase.seccion) as aseccions, CONCAT(alu.nombre, ' ', alu.apellido) as alumno, alu.cedula from aseccion ase
        Inner Join ano_sepa ans On ans.ano = ase.ano 
        Inner Join alumnos alu On alu.id_aseccion = ase.id_aseccion ORDER BY ase.id_aseccion";
        //var_dump($form);
      $result = Model::getResult($sql,$this->db);
      return $result;
    }catch (Exception $e) {
    
    }
  }


  function showAlumnPase($val){
    try {
      $sql = "SELECT asce.id_aseccion, CONCAT (asce.ano, ' ', asce.seccion) as secciones, alu.id_alumno,
  CONCAT (alu.nombre, ' ', alu.apellido) as fullname FROM aseccion asce 
  INNER JOIN  alumnos alu ON alu.id_aseccion = asce.id_aseccion 
  WHERE asce.id_aseccion = ".$val.";
;";
      $result = Model::getResult($sql,$this->db);
     /// var_dump($sql);
      return $result;
    }catch (Exception $e) {

    }
  }

  function showSeccions($value){
    try {
      $sql = "SELECT ase.id_aseccion, ase.id_status, ase.seccion from aseccion ase where ase.ano = ".$value." AND ase.id_status = 1;";
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch (Exception $e) {

    }
  }

  function CedulaAseccion($form){
  	try{
  		$sql = "SELECT cedula FROM alumnos  where id_aseccion = '".$form['secciones']."';";
  		$result = Model::getResult($sql,$this->db);
  		//var_dump($sql);
  		return $result;
  	}catch (Exception $e) {

    }
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

  function getStudentByCedulaPase($form){
      
    try {
      
      $sql = "SELECT alu.id_alumno, sta.d_status, CONCAT (ase.ano, ' ', ase.seccion) as d_aseccion, alu.cedula, alu.nombre, alu.apellido,  alu.fecha_nac, sex.d_sexo From alumnos  as alu
      Inner Join status sta On sta.id_status = alu.id_status
      Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
      Inner Join sexo sex On sex.id_sexo = alu.id_sexo WHERE alu.cedula = '".$form['alumno']."';";
      //var_dump($sql);
      $result = Model::getResult($sql,$this->db);
      
      return $result;

    }catch(Throwable $e) {
         
    }
  }

  function PaseTotal($form){

    try{
     $sql = "SELECT * From solicitudes soli 
            Inner Join contador cont On cont.id_alumno = soli.id_alumno Where cont.id_alumno = ".$form['alumno']." AND soli.id_status_solicitud = 1;";     
     $result = Model::getResult($sql,$this->db);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }
  
  function PaseTotal2($form){

    try{
     $sql = "SELECT count(*) AS total_solicitudes FROM solicitudes WHere id_alumno  = ".$form['alumno'].";";     
     $result = Model::getResult($sql,$this->db);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function ContadorTotal($form){
    try{
     $sql = "SELECT * From contador Where contador = 3 AND id_alumno = ".$form['alumno'].";";     
     $result = Model::getResult($sql,$this->db);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function ShowMotivos(){
    try{
     $sql = "SELECT id_motivo, d_motivo as motivo From motivos;";     
     $result = Model::getResult($sql,$this->db);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function ShowAno(){
    try{
     $sql = "SELECT id_ano, ano  From ano_sepa;";     
     $result = Model::getResult($sql,$this->db);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function CountDatePase($form){
     try{
     $sql = "SELECT cont.fecha_solicitud as fecha_solicitud_conta, cont.contador, sol.fecha_solicitud as fecha_solicitud_soli from contador cont
             Inner Join solicitudes sol On sol.id_solicitud = cont.id_contador where cont.id_alumno = ".$form['alumno'].";";   
             //var_dump($sql);
     $result = Model::getResult($sql,$this->db);
      return $result;
    }catch(Throwable $e){

    }
  }

  function TotalContador(){
     try{
     $sql = "SELECT  count (*) as contador FROM contador cont Where id_alumno = ".$value.";";     
     $result = Model::getResult($sql,$this->db);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function SelectContador($form){
     try{
     $sql = "SELECT * FROM contador Where id_alumno = ".$form['alumno'].";";     
     $result = Model::getResult($sql,$this->db);
     //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function InsertContador($form){
     try{
     $sql = "INSERT INTO contador(id_alumno, fecha_solicitud, contador) VALUES (".$form['alumno'].",  NOW(), 1);";   
          //var_dump($sql);
     $result = $this->db->pgquery($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function UpdateContador($form){
    try{
      $sql = "  UPDATE contador cont set contador= contador+1 where cont.id_alumno = ".$form['alumno'].";";   
      $result = $this->db->pgquery($sql);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function UpdateContador1($form){
    try{
      $sql = "UPDATE contador SET contador = 3 Where contador = 2 AND id_alumno = ".$form['alumno'].";";   
      $result = $this->db->pgquery($sql);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function UpdateContador2($value){
    try{
      $sql = "UPDATE contador SET Contador = 0 Where id_alumno = ".$value.";";   
      $result = $this->db->pgquery($sql);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function CountPaseAlumno($value, $month, $year){
    try{
      $sql = "SELECT count(*) AS total_solicitudes 
      FROM solicitudes WHERE id_alumno = ".$value." AND id_status_solicitud != 2
      AND (fecha_solicitud >= '".$year."-".$month."-01' AND fecha_solicitud <= '".$year."-".$month."-30');";  
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql); 
      return $result;
    }catch(Throwable $e){

    }
  }

  function InactiveAlumno($value){
    try{
      $sql = "SELECT id_status as status from alumnos where id_alumno = ".$value.";";   
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function InactiveAlumnoConForm($form){
    try{
      $sql = "SELECT id_status as status from alumnos where id_alumno = ".$form['alumno'].";";   
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function Inactiveseccion($value){
    try{
      $sql = "SELECT id_status, id_aseccion from aseccion where id_aseccion = ".$value.";";   
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function SearchCedulaProfesor($value){
    try{
      $sql = "SELECT pro.cedula FROM profesores pro where id_profesor = ".$value.";";   
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }

  function SearchCedulaAlu($value){
    try{
      $sql = "SELECT alu.cedula FROM alumnos alu  where alu.id_alumno = ".$value.";";   
      $result = Model::getResult($sql,$this->db);
      //var_dump($sql);
      return $result;
    }catch(Throwable $e){

    }
  }
}
?>