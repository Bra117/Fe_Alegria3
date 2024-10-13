<?php

/*

NOMBRE DEL MODELO: model_fecha.php

DESCRIPCION: Busca y edita el campo de la fecha del registro original 

*/

  class model_fecha extends Model{

    public function __contruct(){
          parent::__construct();

    }


   //Ejecuta las variables 

   public function model_fecha(){

      $this->db  = Database::getInstance();
      //Variables para actualizar 
        $this->idSol = "";
        $this->fSol  = "";
        $this->fStat = "";
     } 

   //Busca los datos del Registro 

    public function getFecha($val){ //Hacemos la busqueda completa

      $sql  = "SELECT * 
                 FROM solicitud 
                WHERE d_numero_sanitario ='".$val."'
                  AND id_tipo_solicitud = 1 
                  AND id_categoria_solicitud IN (1,2,3,4);";

     $arr = $this->getResult($sql,$this->db);

     if($arr['numRows'] > 0){
       return $arr;
     }else{
       return 0; 
     }
   } //Fin del Metodo 

   public function setFecha(){

       $sql  = "UPDATE solicitud
                   SET f_status ='".$this->fStat."',
                       f_solicitud ='".$this->fSol."'
                 WHERE id_solicitud =".$this->idSol.";";

     $arr = $this->getResult($sql,$this->db);

     if($arr['query']){
       return 1;
     }else{
       return 0; 
     } 
   }

  } //Fin Modelo

?>