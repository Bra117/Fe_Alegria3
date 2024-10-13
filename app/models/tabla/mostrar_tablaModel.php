<?php
  class permiso_accesoModel extends Model{
    
    public function __contruct(){
          parent::__construct();

    }

    public function permiso_accesoModel(){

      $this->db = DatabaseCon::getInstance();

    }

    public function getPerson(){
     
      $sql = "SELECT * FROM personas WHERE status =1  ORDER BY cedula ASC;";

      

      $query = Model::getResult($sql,$this->db);
 
      return $query;
    } 

     public function getIdPersona($persona){
     
      $sql = "SELECT * FROM personas WHERE id_persona= $persona;";

     

      $query = Model::getResult($sql,$this->db);
 
      return $query;
    } 

     public function getStatus($id_persona){
     
      $sql = "UPDATE personas SET status = 2 WHERE id_persona = $id_persona;";
     
      

      $query = Model::getResult($sql,$this->db);
    
      return $query;
    } 
      public function getStatusInsert($id_persona){
     
      $sql = "UPDATE personas SET status = 2 WHERE id_persona = $id_persona;";
     
      

      $query = Model::getResult($sql,$this->db);
   
      return $query;
    }


    public function dataCertificado($id_persona,$id_fecha){
    
      $sql="INSERT INTO certificados (id_persona,id_fecha)VALUES('".$id_persona."','".$id_fecha."');";
      
      $query = $this->db->pgquery($sql);
     
      
      return $query;
    }

    public function getLastDate(){

      $sql = "SELECT fecha_certificado::date FROM fecha ORDER BY id_fecha DESC LIMIT 1;";

      $query = Model::getResult($sql,$this->db);

      $fecha = $query['row']['fecha_certificado'];

      return $fecha;

    }

    public function insertDate($fecha){

      $validar = "SELECT fecha_certificado::date FROM fecha WHERE fecha_certificado::date = '".$fecha."';";
      $query = $this->db->pgquery($validar);
      $numRows = pg_num_rows($query);

  
      if ($numRows>0) {
        
              $sqlSelect = "SELECT id_fecha FROM fecha WHERE fecha_certificado::date = '".$fecha."';";

              $querySelect = $this->db->pgquery($sqlSelect);


      }else{
          

         $sql = "INSERT INTO fecha(fecha_certificado)VALUES('".$fecha."');";

         $query = $this->db->pgquery($sql);

          $sqlSelect = "SELECT id_fecha FROM fecha WHERE fecha_certificado = '".$fecha."';";

          $querySelect = $this->db->pgquery($sqlSelect);
      }
     
      return $querySelect;

    }

    public function fechaCertificado($id_fecha){

      $sql ="SELECT fecha_certificado::date FROM fecha WHERE id_fecha = ".$id_fecha.";";

      $query = Model::getResult($sql,$this->db);

      $fecha = strtotime($query['row']['fecha_certificado']);

      return $fecha;

    }

    public function setDate(){
     
    

      $sql = "SELECT fecha_certificado::date FROM fecha WHERE fecha_certificado::date = '".$date."';";
      $query = $this->db->pgquery($sql);
      $numRows = pg_num_rows($query);

      if ($numRows > 0) {
        // existe la fecha
        $row = pg_fetch_assoc($query);
        $fecha = $row['fecha_certificado'];
      }else{
        //si la fecha no existe la guardamos
        if ($this->insertDate()) {
          //si el insert es correcto tomamos los datos
          $fecha = $this->getLastDate();
        }else{
          //intentamos de nuevo el insert en fecha
          $this->insertDate();
          $fecha = $this->getLastDate();
        }

      }

      return $fecha;
    } 





 /*   public function buscarPersonas(){
     
      $sql = "SELECT * FROM personas ORDER BY cedula ASC;";

      $query = $this->db->pgquery($sql);
      
      return $query;
    } 

    public function getPersonas(){
     
      $sql = "SELECT * FROM personas ORDER BY cedula ASC;";

      var_dump($sql);

   //   $query = Model::getResult($this->db,$sql) ;
      
     // return $query;
    } 


    public function buscarCedula($cedula){

     
      $sql = "SELECT * FROM personas LIMIT 1;";

      $query = $this->db->pgquery($sql);
      
      return $query;
    } 



  public function insert($array){

    try { 

      $sql ="INSERT INTO public.funcionario( d_nombre, d_apellido, cedula_pasaporte, telefono, d_correo, d_password, id_status)
              VALUES ('".strtoupper($array[1])."', '".strtoupper($array[2])."','".$array[0]."','".$array[3]."','".strtoupper($array[4])."','".sha1(md5($array[5]))."',".$array[7].");";

      $sql.="INSERT INTO public.funcionario_rol( id_funcionario, id_rol_funcional, fecha_creacion, id_status)
              VALUES ((SELECT MAX(id_funcionario) FROM funcionario),".$array[6].",'".date('Y-m-d H:i:s')."', ".$array[7].");";  

      $query = $this->db->pgquery($sql);
        
      return $query;   

    }catch(IOException $e) {

      return false;

    } 

  }//endFunction


  public function verificar($array){

    try { 

      $sql = " SELECT * FROM  funcionario  WHERE cedula_pasaporte='".$array[0]."';";

      $query   = $this->getResult($sql,$this->db);

      return $query;   

    } catch (IOException $e) {

      return false;
    } 

  }//endFunction

  public function getFuncionarios(){

    try { 

      $sql = "SELECT * FROM funcionario fun
              INNER JOIN funcionario_rol frol ON fun.id_funcionario = frol.id_funcionario
              INNER JOIN rol_funcional rolfun ON rolfun.id_rol_funcional = frol.id_rol_funcional
              INNER JOIN status_dato sd ON fun.id_status = sd.id_status
              ORDER BY fun.id_funcionario ASC;";

      $arrData   = $this->getResult($sql,$this->db);

      return $arrData;   

    } catch (IOException $e) {

      return false;
    } 

  }//endFunction

  public function getFuncionarios2(){

    try { 

      $sql = "SELECT * FROM funcionario fun
              INNER JOIN funcionario_rol frol ON fun.id_funcionario = frol.id_funcionario
              INNER JOIN rol_funcional rolfun ON rolfun.id_rol_funcional = frol.id_rol_funcional
              INNER JOIN status_dato sd ON fun.id_status = sd.id_status
              WHERE fun.id_funcionario NOT IN(1)
              ORDER BY fun.id_funcionario ASC;";

      $arrData   = $this->getResult($sql,$this->db);

      return $arrData;   

    } catch (IOException $e) {

      return false;
    } 

  }//endFunction

  public function getFuncByID($idFunc){

    try { 

      $sql = "SELECT * FROM funcionario fun
              INNER JOIN funcionario_rol frol ON fun.id_funcionario = frol.id_funcionario
              INNER JOIN rol_funcional rolfun ON rolfun.id_rol_funcional = frol.id_rol_funcional
              WHERE fun.id_funcionario =".$idFunc;";";

      $arrData   = $this->getResult($sql,$this->db);

      return $arrData;   

    } catch (IOException $e) {

      return false;
    } 

  }//endFunction  

   public function update($array){

    try { 
      
$sql =" UPDATE public.funcionario
           SET d_nombre='".strtoupper($array[1])."', 
             d_apellido='".strtoupper($array[2])."', 
       cedula_pasaporte='".$array[0]."', 
               telefono='".$array[3]."',
               d_correo='".strtoupper($array[4])."', 
             d_password='".sha1(md5($array[5]))."', 
              id_status=".$array[7]."
        WHERE id_funcionario =".$array[8].";";

$sql.="UPDATE public.funcionario_rol
           SET id_rol_funcional=".$array[6].", 
                  fecha_creacion='".date('Y-m-d H:i:s')."', 
                      id_status=".$array[7]."
           WHERE id_funcionario =".$array[8].";";

$query = $this->db->pgquery($sql);

      return $query;   

    } catch (IOException $e) {

      return false;
    } 

  }//endFunction  update */


    public function trazaCertificado($id_funcionario){

      $sql = "INSERT INTO traza_certificado(id_funcionario,id_certificado,fecha_impresion)VALUES(".$id_funcionario.",(SELECT MAX(id_certificado) FROM certificados),'".date('Y-m-d h:i:s')."');";

      $query = $this->db->pgquery($sql);

      return $query;

    }


} //Fin Modelo 

?>