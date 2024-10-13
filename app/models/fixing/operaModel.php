<?php
/*
  Clase     : operaModel.php
  Proposito : Modelo de Datos para seguimiento 
              
*/

class operaModel extends Model{
	  
      public $nSolX;
      public $fStatusX;
      public $statusX;
      public $funcIniX;
      public $funcFinX;
      public $result;
      


  public function __construct(){

  	 parent:: __construct();

  	 //Instancia la Clase Database
  	   $this->db = Database::getInstance();

  	//Inicializo las variables 
  	  $this->nSolX        = '';
  	  $this->fStatusX     = '';
  	  $this->statusX      = '';
  	  $this->funcIniX     = '';  
      $this->funcFinX	    = '';
      $this->result       = '';
  }

  //Buscar los datos de las solicitudes 

  public function getSolX(){

    $sql = "SELECT s.id_solicitud,s.d_numero_sanitario,s.f_solicitud,s.f_status,s.id_categoria_solicitud,
            c.d_categoria_solicitud,s.id_tipo_solicitud,
            s.id_status_solicitud,s.id_usuario
            FROM solicitud s
            INNER JOIN categoria_solicitud c 
            ON s.id_categoria_solicitud = c. id_categoria_solicitud
            WHERE s.id_solicitud = ".$this->nSolX.";";

            //return($sql);
    
   
    //Ejecuta el Query
      try{

          //Ejecuta el query       
            $this->result = $this->getResult($sql,$this->db);

            return $this->result;
          } catch(Exception $e){
            
             return false;
          }

  } //End Method


    public function getSolAll(){

    	$sql = "SELECT s.*,c.d_categoria_solicitud 
    	          FROM solicitud s 
    	          INNER JOIN categoria_solicitud c
    	          ON s.id_categoria_solicitud = c.id_categoria_solicitud
    	          WHERE id_solicitud IN(".$this->ofSolicitud.")
    	          AND id_status_solicitud IN(".$this->ofStatus.");";

    	 //Busca los Datos  
             
           
          $this->result = $this->getResult($sql,$this->db);   
          
         if($this->result["numRows"] > 0){
         	return $this->result;
         }else{
         	return false;
         }
    }

    //Busca  todos los oficios de un Registro
      public function getAllReg(){

      $sql = "SELECT s.*,c.d_categoria_solicitud 
                FROM solicitud s 
                INNER JOIN categoria_solicitud c
                ON s.id_categoria_solicitud = c.id_categoria_solicitud
                WHERE d_numero_sanitario IN('".$this->regDato."')
                AND id_status_solicitud IN(".$this->ofStatus.");";


       //Busca los Datos  
           
          $this->result = $this->getResult($sql,$this->db);   
          
         if($this->result["numRows"] > 0){
          return $this->result;
         }else{
          return false;
         }
    }


    //Metodo que busca funcionarios por rol 
      public function getFuncRol($val){

        //Define Valores 
          $arrValues = array(1=>2,2=>4,3=>3,4=>4,5=>5,6=>6);

        //Realiza la Busqueda de Funcionarios
          $sql = "SELECT f.id_funcionario,f.d_nombre,f.d_apellido
            FROM funcionario f
            INNER JOIN funcionario_rol r
            ON f.id_funcionario = r.id_funcionario
            WHERE r.id_rol_funcional=".$arrValues[$val]."
            AND f.id_status = 1
            AND f.id_coordinacion = 1;";

          try{

             //Ejecuta el query       
               $this->result = $this->getResult($sql,$this->db);   
               return $this->result;
          } catch(Exception $e){
            
             return false;
          }
         
      } //EndMethod


    //Datos del funcionario 
      public function getFuncId($id){

        $sql = "select id_funcionario,cedula_pasaporte 
            from funcionario
            where id_funcionario = ".$id.";";


      try{
          //Ejecuta el query       
            $this->result = $this->getResult($sql,$this->db);   
               return $this->result;
          } catch(Exception $e){
            
             return false;
          }
      }//End Method


   //Obtiene las trazas 
   public function getTrazasX($func,$status){

    $sql = "select * 
            from transaccion_solicitud
            where id_funcionario_ini = ".$func."
            AND id_status_solicitud =".$status."
            order by id_transaccion_sol desc
            limit 400;";


     try{
          //Ejecuta el query       
            $this->result = $this->getResult($sql,$this->db);   
               return $this->result;
          } catch(Exception $e){
            
             return false;
          }
      }//End Function

   //Actualizacion de las trazas 
     public function setUpdate($status,$f_status,$func='',$id_solicitud,$val){

         if($val == 2){

          $sql = "update solicitud 
                 set id_status_solicitud =".$status.",f_status ='".$f_status."',id_funcionario =".$func." 
                 where id_solicitud=".$id_solicitud.";";
         }else{
          
          $sql = "update solicitud 
                 set id_status_solicitud =".$status.",f_status ='".$f_status."' 
                 where id_solicitud=".$id_solicitud.";";

         }
         
        
     try{
          //Ejecuta el query       
            $this->result = $this->getResult($sql,$this->db);   
               return $this->result;
          } catch(Exception $e){
            
             return false;
          }

     }   

     public function setInsert($arr){

         //Arma el query de la traza 
           
           $sql = "INSERT INTO transaccion_solicitud(id_solicitud,id_status_solicitud,id_funcionario_ini,id_funcionario_fin,id_usuario,f_transaccion)
             values(".$arr['id_solicitud'].",".$arr['id_status_solicitud'].",".$arr['id_funcionario_ini']."
             ,".$arr['id_funcionario_fin'].",
             ".$arr['id_usuario'].",'".$arr['f_transaccion']."');";

            try{
          //Ejecuta el query  
            $query = $this->db->pgquery($sql);

            return $query;
          } catch(Exception $e){
            
             return false;
          }  
     }

     public function getPasswd($id){

      $sql = "SELECT SUBSTRING(d_password,1,32)
                  AS clave,cedula_pasaporte  
                FROM funcionario
               WHERE id_funcionario ='".$id."';";

     try{
          //Ejecuta el query       
            $this->result = $this->getResult($sql,$this->db);   
               return $this->result;
          } catch(Exception $e){
            
             return false;
          }


     }//End Method

     //Inserta Sign 

     public function setIsertSign($id_solicitud,$fecha,$func,$firmaGen,$clave_publica){

        $sql= "INSERT INTO firma(
                      id_solicitud, f_firma, user_firma, firma_gen, clave_publica)
                VALUES(".$id_solicitud.",'".$fecha."','".$func."','".$firmaGen."','".$clave_publica."');";

        
        try{
          //Ejecuta el query       
            $this->result = $this->db->pgquery($sql);   
               return true;
          } catch(Exception $e){
            
             return false;
          }


     }//End Method

     public function setNumberReg($type,$num){

      $arrTable = array(1=>"permiso_alimento",
                        2=>"permiso_alimento",
                        3=>"permiso_licor",
                        4=>"permiso_licor");

         $table = $arrTable[$type];

             $sql ="INSERT INTO ".$table."(n_permiso,f_generado)
                         VALUES (".$num.",'".getTime()."');";
         try {

            $query = $this->db->pgquery($sql);
            return true;

          } catch (Exception $e) {

            return false;
            
          } 

     }//End Method


     public function finalSet($nro,$registro){

          $sql = "update solicitud set   d_numero_sanitario ='".$registro."',id_status_web = 1 
            WHERE id_solicitud ='".$nro."';";

     try{
          //Ejecuta el query       
            $this->db->pgquery($sql);
            return true;

          } catch(Exception $e){

             return false;
          }
      }//End Method

      public function setHideSol($sol,$num){

         $sql = "update solicitud set   id_status_solicitud ='".$num."' 
            WHERE id_solicitud =".$sol.";";

     try{
          //Ejecuta el query       
            $this->db->pgquery($sql);
            return true;

          } catch(Exception $e){

             return false;
          }


      }

}//EndClass

?>