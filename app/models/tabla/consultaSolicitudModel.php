<?php
  class ConsultaSolicitudModel extends Model{

    public function __contruct(){
          parent::__construct();

    }

    public function ConsultaSolicitudModel(){

      $this->db = Database::getInstance();
      $this->db2 = DatabaseCon::getInstance();
      $this->db3 = DatabasePer::getInstance();
      
    

    }
     public function setValidar($cedula){
      
      $sql = "SELECT status FROM personas WHERE cedula = '".$cedula."';";


     
      $arrData   = Model::getResult($sql,$this->db3);

      return $arrData;  
    } 


    public function setCertificado($cedula,$apellido,$nombre){
      
      $sql = "INSERT INTO personas(nombre,apellido,cedula)VALUES('".$nombre."','".$apellido."','".strtoupper($cedula)."');";

      $query = $this->db3->pgquery($sql);
      
      return $query;
    } 
     public function setUpdateInsert($cedula){
      
      $sql = "UPDATE personas SET status = 1 WHERE cedula = '".$cedula."';";

      $query = $this->db3->pgquery($sql);
      
      return $query;
    } 


    


    public function getSolicitud($nroSol){

      $sql = "SELECT sol.id_solicitud,sol.d_numero_sanitario,sol.f_solicitud,sol.f_status,
              sol.id_tipo_solicitud,ts.d_tipo_solicitud,ss.d_status_solicitud,cs.d_categoria_solicitud,sol.id_status_solicitud 
              FROM solicitud sol
              INNER JOIN tipo_solicitud ts ON sol.id_tipo_solicitud = ts.id_tipo_solicitud
              INNER JOIN status_solicitud ss ON sol.id_status_solicitud = ss.id_status_solicitud
              INNER JOIN categoria_solicitud cs ON sol.id_categoria_solicitud = cs.id_categoria_solicitud
              WHERE sol.id_solicitud = $nroSol;";

      $arrData   = $this->getResult($sql,$this->db);

    return $arrData;                          

    }

    public function getNuevoRegistro($nroRegistro){

      $sql = "SELECT id_solicitud FROM solicitud WHERE id_tipo_solicitud = 1 AND d_numero_sanitario = '".$nroRegistro."';";

      $arrData   = $this->getResult($sql,$this->db);

      $idSol = $arrData['row']['id_solicitud'];

    return $idSol;                          

    }

    public function getProducto($idSol){

      $sql = "SELECT p.d_marca,p.d_denomina,op.d_origen,p.id_forma_elaboracion FROM producto p
              INNER JOIN origen_producto op ON p.id_origen_prod = op.id_origen_prod
              WHERE p.id_solicitud = ".$idSol.";";

      $arrData   = $this->getResult($sql,$this->db);

    return $arrData;                          

    }

    public function getFuncConsulta($idFunc){

      $sql = "SELECT CONCAT(d_nombre,' ',d_apellido) as funcionario FROM funcionario WHERE id_funcionario = ".$idFunc.";";

      $arrData   = $this->getResult($sql,$this->db2);

      $funcionario = $arrData['row']['funcionario'];

    return $funcionario;                          

    }

    public function insertTraza($id_func,$idSol){

      $sql = "INSERT INTO traza(id_funcionario,fecha_consulta,id_solicitud)VALUES(".$id_func.",'".date('Y-m-d H:i:s')."',".$idSol.");";

      $query = $this->db2->pgquery($sql);

    return $query;                          

    }

    public function getSolEmpresa($nroSol,$id_actividad){

      $sql = "SELECT * FROM solicitud_empresa 
                      WHERE id_solicitud = ".$nroSol." AND id_actividad IN(".$id_actividad.") ORDER BY id_actividad ASC;";

      $arrData   = $this->getResult($sql,$this->db);

    return $arrData;                          

    }

    public function dataEmpresa($tipoEmpresa, $id_empresa,$id_actividad){

      $arrEmpresa = [];

      if ($tipoEmpresa == 1) {//empresa nacional
          
        $empresa = $this->empresaNacional($id_empresa);

      }else{//empresa extranjera

        $empresa = $this->empresaExtranjera($id_empresa);

      }

      //agregamos el nombre de empresa al arreglo
      $arrEmpresa['razon_social'] = $empresa;
      //agregamos la descripcion de la actividad
      $arrEmpresa['d_actividad'] = $this->d_actividad($id_actividad);

    return $arrEmpresa;                          

    }

    public function empresaNacional($id_empresa){

      $sql = "SELECT d_nombre FROM empresa_nacional 
                      WHERE id_empresa = ".$id_empresa.";";

      $arrData   = $this->getResult($sql,$this->db);

      if ($arrData['numRows'] > 0) {
        $empresa = $arrData['row']['d_nombre'];
      }else{
        $empresa = 'N/A';
      }

    return $empresa;                          

    }

    public function empresaExtranjera($id_empresa){

      $sql = "SELECT d_nombre FROM empresa_extranjera 
                      WHERE id_empresa_extranjera = ".$id_empresa.";";

      $arrData   = $this->getResult($sql,$this->db);

      if ($arrData['numRows'] > 0) {
        $empresa = $arrData['row']['d_nombre'];
      }else{
        $empresa = 'N/A';
      }

    return $empresa;                          

    }

    public function d_actividad($id_actividad){

      $sql = "SELECT d_actividad FROM actividad_empresa 
                      WHERE id_actividad = ".$id_actividad.";";

      $arrData   = $this->getResult($sql,$this->db);

      if ($arrData['numRows'] > 0) {
        $actividad = $arrData['row']['d_actividad'];
      }else{
        $actividad = 'N/A';
      }

    return $actividad;                          

    }

  public function ubicByFabr($nroSol){
    
    $ubic ='';
    
    $actividad = 2;
    //solo buscamos fabricantes
    $arrEmpresa = $this->getSolEmpresa($nroSol,$actividad);

    for ($i=0; $i < $arrEmpresa['numRows']; $i++){ 
      $row = pg_fetch_array($arrEmpresa['query'], $i);

      if ($i > 0) {
        $ubic.=',';
      }

      //empresa nacional
      if($row["id_tipo_empresa"] == 1){

        if ($row["n_planta"] == 1){
        
          //Si tiene Planta Busca la Ubicacion
          $ubic.= $this->getUbicaPlanta($row["id_empresa"],$nroSol);

        }else{
          $ubic.='NULL';
        }

      }else{//empresa extranjera
      
        $ubic.= $this->getUbicaExtranjera($row["id_empresa"]); 

      }   
       
    }//endFor

    return $ubic;

  }

  public function getUbicaPlanta($empresa,$nroSol){

    $sql = "SELECT pf.d_ciudad,pf.id_estado 
             FROM planta_fabricante pf, solicitud_planta sp
            WHERE pf.id_empresa= ".$empresa."
              AND pf.id_planta_fabricante = sp.id_planta_fabricante
              AND sp.id_solicitud = ".$nroSol.";";

    $arrData   = $this->getResult($sql,$this->db);

    if ($arrData['numRows'] > 0) {

      for($i = 0;$i < $arrData['numRows'];$i++){

        $row = pg_fetch_array($arrData['query'] ,$i);

        if($row["id_estado"] !== 1){

        $ubicacion =$row["d_ciudad"].', EDO. '.$this->findEstado($row["id_estado"]); 
        }else{

        $ubicacion =$row["d_ciudad"].', '.$this->findEstado($row["id_estado"]); 

        }

      }//endFor


    }else{
      $ubicacion = 'vacia';
    }

  return $ubicacion;       
  }

  //Busca nombre del estado
  public function findEstado($id_estado){

       $sql = "SELECT d_estado
                 FROM estado
                WHERE id_estado =".$id_estado.";";

      $arrData   = $this->getResult($sql,$this->db);

      if ($arrData['numRows'] > 0) {
        $d_estado = $arrData['row']['d_estado'];
      }else{
        $d_estado = 'N/A';
      }

      return $d_estado;

  }

  public function getUbicaExtranjera($id_empresa){

    $sql = "SELECT p.d_pais, ee.d_ciudad FROM empresa_extranjera ee
        INNER JOIN pais p ON ee.id_pais = p.id_pais
              WHERE ee.id_empresa_extranjera =".$id_empresa.";";

    $arrData   = $this->getResult($sql,$this->db);

    if ($arrData['numRows'] > 0) {

      $ubicacion = $arrData['row']['d_ciudad'].', '.$arrData['row']['d_pais'];

    }else{
      $ubicacion = 'vacia';
    }

  return $ubicacion;       
  }

  public function getFecha($nPermiso){

    if ($nPermiso != 'N') {
      
      $renovacion = $this->getLastRenovacion($nPermiso);

      if ($renovacion['numRows'] > 0) {
        $fecha = $renovacion['row']['f_status'];
      }else{
        $nRegistro = $this->getFirstRegistro($nPermiso);

        $fecha = $nRegistro['row']['f_status'];
      }

    }else{
      $fecha = null;
    }

  return $fecha;       
  }

  public function getLastRenovacion($nPermiso){


    $sql = "SELECT f_status FROM solicitud 
             WHERE d_numero_sanitario = '".$nPermiso."' 
             AND id_tipo_solicitud = 3 
             AND id_status_solicitud IN(18,20,22) 
             ORDER BY id_solicitud DESC LIMIT 1;";

    $arrData   = $this->getResult($sql,$this->db);

  return $arrData;       
  }

  public function getFirstRegistro($nPermiso){

    $sql = "SELECT f_status FROM solicitud 
             WHERE d_numero_sanitario = '".$nPermiso."' 
             AND id_tipo_solicitud = 1 
             AND id_status_solicitud IN(18,20,22) 
             ORDER BY id_solicitud ASC LIMIT 1;";

    $arrData   = $this->getResult($sql,$this->db);

  return $arrData;       
  }


} //Fin Modelo

?>