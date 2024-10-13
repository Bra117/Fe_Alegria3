<?php
/*
  Clase     : GeneraOficio.php
  Proposito : Modelo de Datos para mostrar los oficios 
              que se van a Generar 
*/

class GeneraOficio extends Model{
	  
      public $ofSolicitud;
      public $ofStatus;
      public $ofArea;
      public $ofcoord;
      public $regDato;
      private $db;
      private $result;


  public function __construct(){

  	 parent:: __construct();

  	 //Instancia la Clase Database
  	   $this->db = Database::getInstance();

  	//Inicializo las variables 
  	  $this->ofSolicitud  = '';
  	  $this->ofStatus     = '';
  	  $this->ofArea       = '';
  	  $this->ofcoord      = '';  
      $this->regDato	    = '';
  }

  //Buscar los datos de las solicitudes 

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


}//EndClass

?>