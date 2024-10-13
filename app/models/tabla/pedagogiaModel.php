<?php
  	class pedagogiaModel extends Model{
  		function __contruct(){
    		parent::__construct();
  		}

  		function pedagogiaModel(){
    		$this->db = DatabaseCon::getInstance();
  		}

  		function ShowPersonalPedago(){
  			try{
              $sql = "SELECT pro.id_profesor, rol.d_rol, st.d_status, pro.cedula, CONCAT(pro.nombre, ' ', pro.apellido) as fullname From profesores pro
					Inner Join roles rol On rol.id_rol = pro.id_rol 
	   				Inner JOin status st On st.id_status = pro.id_status  Where pro.id_rol = 3";
      			$result = Model::getResult($sql,$this->db);
     			 return $result;
  			}catch(Throwable $e){

  			}
  		}

  		function ShowPconsulta(){
  			try{
              $sql = "SELECT con.id_consulta, stc.d_status_consulta, alu.cedula as cedulaalu, CONCAT(alu.nombre, ' ', alu.apellido) as fullalumno, dir.cedula as cedulapro, CONCAT(dir.nombre, ' ', dir.apellido) as fullprofesor, mot.d_motivo_consulta, con.fecha_consulta, con.fecha_atencion, con.id_status_consulta
	 				From consulta con
					Inner Join alumnos alu On alu.id_alumno = con.id_alumno
					Inner Join motivo_consulta mot on mot.id_motivo_consulta = con.id_motivo_consulta
					Inner Join directivo dir On dir.id_directivo = con.id_directivo
					Inner Join status_consulta stc On stc.id_status_consulta = con.id_status_consulta;";
      			$result = Model::getResult($sql,$this->db);
      			//var_dump($result);
     			 return $result;
  			}catch(Throwable $e){

  			}
  		}
      
      	function ShowPconsulta4(){
  			try{
              $sql = "SELECT con.id_consulta, stc.d_status_consulta, alu.cedula as cedulaalu, CONCAT(alu.nombre, ' ', alu.apellido) as fullalumno, dir.cedula as cedulapro, CONCAT(dir.nombre, ' ', dir.apellido) as fullprofesor, mot.d_motivo_consulta, con.fecha_consulta, con.fecha_atencion, con.id_status_consulta
	 				From consulta con
					Inner Join alumnos alu On alu.id_alumno = con.id_alumno
					Inner Join motivo_consulta mot on mot.id_motivo_consulta = con.id_motivo_consulta
					Inner Join directivo dir On dir.id_directivo = con.id_directivo
					Inner Join status_consulta stc On stc.id_status_consulta = con.id_status_consulta Where con.id_status_consulta = 1;";
				//var_dump($sql);
      			$result = Model::getResult($sql,$this->db);
     			 return $result;
  			}catch(Throwable $e){

  			}
  		}

  		function ShowPconsulta1(){
  			try{
              $sql = "SELECT con.id_consulta, stc.d_status_consulta, alu.cedula as cedulaalu, CONCAT(alu.nombre, ' ', alu.apellido) as fullalumno, dir.cedula as cedulapro, CONCAT(dir.nombre, ' ', dir.apellido) as fullprofesor, mot.d_motivo_consulta, con.fecha_consulta, con.fecha_atencion, con.id_status_consulta
	 				From consulta con
					Inner Join alumnos alu On alu.id_alumno = con.id_alumno
					Inner Join motivo_consulta mot on mot.id_motivo_consulta = con.id_motivo_consulta
					Inner Join directivo dir On dir.id_directivo = con.id_directivo
					Inner Join status_consulta stc On stc.id_status_consulta = con.id_status_consulta where con.id_status_consulta = 2;";
				//var_dump($sql);
      			$result = Model::getResult($sql,$this->db);
     			 return $result;
  			}catch(Throwable $e){

  			}
  		}

  		function ShowPconsulta2(){
  			try{
              $sql = "SELECT con.id_consulta, stc.d_status_consulta, alu.cedula as cedulaalu, CONCAT(alu.nombre, ' ', alu.apellido) as fullalumno, dir.cedula as cedulapro, CONCAT(dir.nombre, ' ', dir.apellido) as fullprofesor, mot.d_motivo_consulta, con.fecha_consulta, con.fecha_atencion, con.fecha_finalizacion, con.id_status_consulta
	 				From consulta con
					Inner Join alumnos alu On alu.id_alumno = con.id_alumno
					Inner Join motivo_consulta mot on mot.id_motivo_consulta = con.id_motivo_consulta
					Inner Join directivo dir On dir.id_directivo = con.id_directivo
					Inner Join status_consulta stc On stc.id_status_consulta = con.id_status_consulta where con.id_status_consulta = 3;";
				//var_dump($sql);
      			$result = Model::getResult($sql,$this->db);
     			 return $result;
  			}catch(Throwable $e){

  			}
  		}
        
        function SearchConsulById($id_consulta){
        	try{
        		$sql = "SELECT * FROM consulta Where id_consulta = ".$id_consulta.";";
      			$result = Model::getResult($sql,$this->db);
     			return $result;
  			}catch(Throwable $e){

  			}	
        }


  		function CambioStatusConsulta($id_consulta){
  			try{
              $sql = "UPDATE consulta SET FECHA_ATENCION = NOW(),  id_status_consulta = 2 WHERE id_consulta = ".$id_consulta.";";
      			$result = Model::getResult($sql,$this->db);
     			 return $result;
  			}catch(Throwable $e){

  			}	
  		}

  		function CambioStatusConsulta1($id_consulta){
  			try{
              $sql = "UPDATE consulta SET fecha_finalizacion = NOW(),  id_status_consulta = 3 WHERE id_consulta = ".$id_consulta.";";
      			$result = Model::getResult($sql,$this->db);
     			 return $result;
  			}catch(Throwable $e){

  			}	
  		}


  		function GetConsultaByIdConsulta(){
  			try{
              $sql = "SELECT * From consulta Where id_status_consulta = 2";
      			$result = Model::getResult($sql,$this->db);
     			 return $result;
  			}catch(Throwable $e){

  			}	
  		}

  		function ConsultaByCedula($form){
      	try{
      		$sql = "SELECT con.id_alumno, CONCAT(alu.nombre, ' ', alu.apellido) as fullname, alu.cedula, CONCAT(ase.ano, ' ', ase.seccion) as aseccion, mtv.d_motivo_consulta, stcon.id_status_consulta, stcon.d_status_consulta, con.fecha_consulta, con.fecha_finalizacion 
					From consulta con
					Inner Join motivo_consulta mtv On mtv.id_motivo_consulta = con.id_motivo_consulta
					Inner Join status_consulta stcon On stcon.id_status_consulta = con.id_status_consulta
					Inner Join alumnos alu On alu.id_alumno = con.id_alumno 
					Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion Where alu.cedula = '".$form['cedula']."';";
					//var_dump($sql);
      		$result = Model::getResult($sql,$this->db);
      		return $result;
    		}catch(Throwable $e){

    		} 
  		}

  		function ConsultaAlumno($id){
      	try{
      		$sql = "SELECT count(*)	as consulta_alumno From consulta con
					Inner Join motivo_consulta mtv On mtv.id_motivo_consulta = con.id_motivo_consulta
					Inner Join status_consulta stcon On stcon.id_status_consulta = con.id_status_consulta
					Inner Join alumnos alu On alu.id_alumno = con.id_alumno 
					Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion Where alu.cedula = '".$id."';";
      		$result = Model::getResult($sql,$this->db);
      		return $result;
    		}catch(Throwable $e){

    		}
    	}

    public function ShowAsecciones($value){
   		try{
    		$sql = "SELECT alu.fecha_nac, sex.d_sexo, alu.id_alumno, st.d_status as status, CONCAT(alu.nombre, ' ', alu.apellido) as fullname, alu.cedula,CONCAT (ase.ano, ' ', ase.seccion) as aseccion,
        (Select count(id_inasistencia) as alumno_inasistencia from inasistencias inas where inas.id_alumno = alu.id_alumno)
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

  	public function SelectAseccion(){
    	try{
      	$sql = "SELECT ase.id_aseccion, CONCAT (ase.ano, ' ', ase.seccion) AS aseccion FROM aseccion ase";
      	$result = Model::getResult($sql,$this->db);
      	return $result;
    	}catch(Throwable $e){

    	}
  	}

  	public function getSeccionById($value){
    	try {
      	$sql = "SELECT CONCAT(ano ,' ', seccion) as desc_seccion FROM aseccion WHERE id_aseccion = ".$value.";";
      	$result = Model::getResult($sql,$this->db);
    		return $result;  
    	}catch (Throwable $e){
       
    	}
  	}

  	public function gr_general($value){
    	try {
      	$sql = "SELECT  count(id_consulta) as aseccion_consulta, (SELECT  count(id_consulta) FROM consulta) as total_consulta
		  	from consulta con
		  	Inner Join alumnos alu On alu.id_alumno = con.id_alumno
		  	Inner Join aseccion ase On ase.id_aseccion = alu.id_aseccion
      	WHERE alu.id_aseccion = ".$value.";";
      	$result = Model::getResult($sql,$this->db);
      	return $result;  
    	}catch (Throwable $e){
      
      
    	}
  	}
  }  
?>