<?php

class dataProductModel extends Model{

  /************************************************************************
  *
  *
  *   DATOS DEL PRODUCTO
  *
  *
  *************************************************************************/

  public static $table  = "solicitud";
  public $numReg;
  public $categ;
  public $solRefer;

  public function __contruct(){
          parent::__construct();
  }

  public function dataProductModel(){
      $this->numReg   = "";
      $this->categ    = "";
      $this->solRefer = "";
      $this->statReg  = "";
      $this->created_at   = "NOW()";
      $this->db       = Database::getInstance();
  }

  public function solRef(){
       $db  = Database::getInstance();
     //Busco  el Numero de Referencia
       $sql ="SELECT * 
                FROM ".self::$table." 
               WHERE d_numero_sanitario='".$this->numReg."'
                 AND id_categoria_solicitud =".$this->categ." ;";
       
       $query = @pg_query($sql);
       $numR  = @pg_num_rows($query);

      if($numR > 0){
      	 $row = @pg_fetch_array($query);

         $arrSol = array("id_solicitud"           => $row["id_solicitud"],
                         "id_tipo_solicitud"      => $row["id_tipo_solicitud"],
                         "id_usuario"             => $row["id_usuario"],
                         "id_status_solicitud"    => $row["id_status_solicitud"],
                         "f_solicitud"            => $row["f_solicitud"],
                         "f_registro"             => $row["f_status"],
                         "f_vigencia"             =>$this->fVigencia($row["f_status"]),
                         "id_categoria_solicitud" =>$row["id_categoria_solicitud"],
                         "area"                   =>$row["id_area"]);
      }

  	 return  $arrSol;
  }

  //Metodo para Buscar datos del Historico 
    public function refRegistro(){
       $db  = Database::getInstance();
     //Busco  el Numero de Referencia
       $sql ="SELECT * 
                FROM ".self::$table." 
               WHERE d_numero_sanitario='".$this->numReg."'
                 AND id_status_solicitud =".$this->statReg." ;";
       
       $query = @pg_query($sql);
       $numR  = @pg_num_rows($query);

      if($numR > 0){
         $row = @pg_fetch_array($query);

         $arrSol = array("id_solicitud"           => $row["id_solicitud"],
                         "id_tipo_solicitud"      => $row["id_tipo_solicitud"],
                         "id_usuario"             => $row["id_usuario"],
                         "id_status_solicitud"    => $row["id_status_solicitud"],
                         "f_solicitud"            => $row["f_solicitud"],
                         "f_registro"             => $row["f_status"],
                         "f_vigencia"             =>$this->fVigencia($row["f_status"]),
                         "id_categoria_solicitud" =>$row["id_categoria_solicitud"],
                         "area"                   =>$row["id_area"]);
      }

     return  $arrSol;
  } 

/*******************************
  EN ESTA SECCION SE BUSCA LOS 
  DATOS DEL REGISTRO HISTORICO 
  PARTIENDO DEL NRO. REGISTRO 
********************************/
public function getDataReg($registro){

     //Solicita datos del Registro 
       $arrSolOrig = $this->getRegOrigen($registro);
     
     //Solicita Datos del producto 
       $arrProdOrig = $this->getProdOrigen($arrSolOrig['id_solicitud']); 
     
     //Datos totales 
       $arrData = array_merge($arrSolOrig,$arrProdOrig);

   return $arrData;      
    
}

//Metodo para buscar datos del Registro Original 
  private function getRegOrigen($registro){

    //Busca Datos Registro Original
    //Crea String SQL 
    $sql = "SELECT *
              FROM solicitud 
            WHERE d_numero_sanitario ='".$registro."'
              AND id_tipo_solicitud = 1
              AND id_categoria_solicitud IN (1,2,3,4)
              ORDER BY id_solicitud ASC LIMIT 1;";
     
    //Ejecuta el query 
      $query   = $this->db->pgquery($sql);
      $numRows = $this->db->pgNumrows($query);
      
      if($numRows > 0){
         $row = $this->db->pgfetch($query); 

         //Arma el Arreglo
           $dataOrigen = array("id_solicitud" => $row['id_solicitud'],
             "id_categoria_solicitud" => $row['id_categoria_solicitud'],
             "f_status" =>$row['f_status'],
             "f_vigencia" =>$this->fVigencia($row['f_status']));

          //Retorna datos     
            return  $dataOrigen;
      }
  } //End Method 
  
//Datos del producto 
  public function getProdOrigen($solicitud){
      
       //Crea String SQL 
    $sql = "SELECT *
              FROM producto 
            WHERE id_solicitud =".$solicitud."
             ORDER BY id_solicitud ASC LIMIT 1;";
     
    //Ejecuta el query 
      $query   = $this->db->pgquery($sql);
      $numRows = $this->db->pgNumrows($query);

      if($numRows > 0){
         $row = $this->db->pgfetch($query); 
         //Verifica la forma de Elaboracion 
           if($row["id_forma_elaboracion"] == null){
             $forma = 1;

           }else{
            $forma = $row['id_forma_elaboracion'];
           }
         //Arma el Arreglo
           $datProdOrig = array("d_denomina" => $row['d_denomina'],
             "d_marca" => $row['d_marca'],
             "tipo_producto" => $row['id_tipo_prod'],"id_forma_elaboracion"=>$forma);
        //Retorna datos     
          return  $datProdOrig;
      }
  } //End Method 

//**********FIN APARTADO*********

  public function solRefEE(){ //OBTENER DATOS NUMERO REFERENCIA ENVASE EMPAQUE
       $db  = Database::getInstance();
     //Busco  el Numero de Referencia
       $sql ="SELECT * 
                FROM ".self::$table." 
               WHERE d_numero_sanitario='".$this->numReg."'
                 AND id_categoria_solicitud ".$this->categ." ;";

       $query = @pg_query($sql);
       $numR  = @pg_num_rows($query);

      if($numR > 0){
         $row = @pg_fetch_array($query);

         $arrSol = array("id_solicitud"           => $row["id_solicitud"],
                         "id_tipo_solicitud"      => $row["id_tipo_solicitud"],
                         "id_usuario"             => $row["id_usuario"],
                         "id_status_solicitud"    => $row["id_status_solicitud"],
                         "f_solicitud"            => $row["f_solicitud"],
                         "f_registro"             => $row["f_status"],
                         "f_vigencia"             =>$this->fVigencia($row["f_status"]),
                         "id_categoria_solicitud" =>$row["id_categoria_solicitud"],
                         "area"                   =>$row["id_area"]);
      }

     return  $arrSol;
  }

  public function detSol($nroSol){
       $db  = Database::getInstance();
     //Busco  el Numero de Referencia
       $sql ="SELECT *
                FROM ".self::$table."
                WHERE id_solicitud =".$nroSol.";";
       
       $query = $db->pgquery($sql);
       $numR  = $db->pgNumrows($query);

      if($numR > 0){

         $row = $db->pgfetch($query);

         $arrSol = array("nroReg"                 => $row["d_numero_sanitario"],
                         "nroSol"                 => $this->formatoSol($nroSol),
                         "id_tipo_solicitud"      => $row["id_tipo_solicitud"],
                         "d_tipo_solicitud"       => $this->getTipoSol($row["id_tipo_solicitud"]),
                         "id_usuario"             => $row["id_usuario"],
                         "id_status_solicitud"    => $row["id_status_solicitud"],
                         "id_funcionario"         => $row["id_funcionario"],
                         "f_solicitud"            => $this->fSalida($row["f_solicitud"]),
                         "f_registro"             => $row["f_status"],
                         "f_vigencia"             => $this->fVigencia($row["f_status"]),
                         "id_categoria_solicitud" => $row["id_categoria_solicitud"],
                         "d_categoria_solicitud"  => $this->getCategoria($row["id_categoria_solicitud"]),
                         "area"                   => $row["id_area"],
                         "d_obser_usuario"        => $row["d_obser_usuario"],
                         "id_coordinacion"        => $row["id_coordinacion"]);
      }
     return  $arrSol;
  }
  //codigo original de detsol
  /*
    public function detSol($nroSol){
       $db  = Database::getInstance();
     //Busco  el Numero de Referencia
       $sql ="SELECT *
                FROM ".self::$table."
                WHERE id_solicitud =".$nroSol.";";

       $query = $db->pgquery($sql);
       $numR  = $db->pgNumrows($query);

      if($numR > 0){

         $row = $db->pgfetch($query);

         $arrSol = array("nroReg"                 => $row["d_numero_sanitario"],
                         "nroSol"                 => $this->formatoSol($nroSol),
                         "id_tipo_solicitud"      => $row["id_tipo_solicitud"],
                         "d_tipo_solicitud"       => $this->getTipoSol($row["id_tipo_solicitud"]),
                         "id_usuario"             => $row["id_usuario"],
                         "id_status_solicitud"    => $row["id_status_solicitud"],
                         "id_funcionario"         => $row["id_funcionario"],
                         "f_solicitud"            => $this->fSalida($row["f_solicitud"]),
                         "f_registro"             => $row["f_status"],
                         "f_vigencia"             => $this->fVigencia($row["f_status"]),
                         "id_categoria_solicitud" => $row["id_categoria_solicitud"],
                         "d_categoria_solicitud"  => $this->getCategoria($row["id_categoria_solicitud"]),
                         "area"                   => $row["id_area"],
                         "d_obser_usuario"        => $row["d_obser_usuario"]);
      }
     return  $arrSol;
  }
  */

  public function getCategoria($id){

        $db     = Database::getInstance();

        $sql = "SELECT d_categoria_solicitud 
                  FROM categoria_solicitud
                 WHERE id_categoria_solicitud =".$id.";";
     
       $query   = $db->pgquery($sql);
       $numRows = $db->pgNumRows($query);

       if($numRows > 0){
          
         $row = $db->pgfetch($query);
         $cat = $row["d_categoria_solicitud"];  
        
       }

      return $cat;   
  }


public function getTipoSol($id){

        $db     = Database::getInstance();

        $sql = "SELECT d_tipo_solicitud 
                  FROM tipo_solicitud
                 WHERE id_tipo_solicitud =".$id.";";
     
       $query   = $db->pgquery($sql);
       $numRows = $db->pgNumRows($query);

       if($numRows > 0){
          
         $row = $db->pgfetch($query);
         $cat = $row["d_tipo_solicitud"];  
        
       }

      return $cat;   
  }

  private function formatoSol($c_solicitud)
{     

    $longitud_numero=@strlen($c_solicitud);
    
    switch($longitud_numero){   
    case '1':
    $numero_solicitud='00000000'.$c_solicitud;
    break;
    case '2':
    $numero_solicitud='0000000'.$c_solicitud;
    break;
    case '3':
    $numero_solicitud='000000'.$c_solicitud;
    break;
    case '4':
    $numero_solicitud='00000'.$c_solicitud;
    break;
    case '5':
    $numero_solicitud='0000'.$c_solicitud;
    break;
    case '6':
    $numero_solicitud='000'.$c_solicitud;
    break;
    case '7':
    $numero_solicitud='00'.$c_solicitud;
    break;
    case '8':
    $numero_solicitud='0'.$c_solicitud;
    break;
    case '9':
    $numero_solicitud=$c_solicitud;
    break;
    }
    
    return $numero_solicitud;

}



/*fecha siacs2 en plubli*/
  public function getFechaReno($val){

       $db2  = DatabaseSiacs2::getInstance();

       $sql = " SELECT f_statud 
                  FROM public.solicitud 
                 WHERE c_tipo_solicitud IN(2,101,102,103,104) 
                   AND d_numero_sanitario = '".$val."' 
              ORDER BY c_solicitud DESC LIMIT 1 ";
  
       $query   = $db2->pgquery($sql);
       $numRows = $db2->pgNumRows($query);

       if($numRows > 0){
         $row = $db2->pgfetch($query);
         $fecha = $row["f_statud"];
       }

      return $fecha;   
  }

   /*buscar fecha solicitud en historico del siacs2*/
  public function getFechaHistorico($val){

       $db2  = DatabaseSiacs2::getInstance();

       $sql = " SELECT f_statud 
                 FROM historico.solicitud
                WHERE d_numero_sanitario = '".$val."' 
             ORDER BY c_solicitud DESC LIMIT 1 ";
  
       $query   = $db2->pgquery($sql);
       $numRows = $db2->pgNumRows($query);

       if($numRows > 0){
         $row = $db2->pgfetch($query);
         $fecha = $row["f_statud"];
       }

      return $fecha;   
  }

  //Nuevo Miguel
  public function getFechaStatus($val){

        $db     = Database::getInstance();

        $sql = "SELECT f_status 
                  FROM tbl_historico
                 WHERE d_numero_sanitario ='".$val."' ORDER BY id_registro DESC LIMIT 1";
     
       $query   = $db->pgquery($sql);
       $numRows = $db->pgNumRows($query);

       if($numRows > 0){
          
         $row = $db->pgfetch($query);
         $fecha = $row["f_status"];
        
       }

      return $fecha;   
  }

private function fSalida($fehca){
        if ($fehca==""){
            return $fehca;
        }
        $year=substr($fehca, 0, 4);
        $mes=substr($fehca, 5, 2);
        $dia=substr($fehca, 8, 2);
        $fechan = ($dia."/".$mes."/".$year);
        return $fechan;
 }


  public function getReferencia($sol,$cat){

        $db     = Database::getInstance();
        $table  = $this->getTable($cat);
        
        if($cat >= 32 && $cat <=35){
          $string = "id_solicitud_ref";
        }else{
          $string = "n_solicitud_ref";
        }

        $sql = "SELECT ".$string." 
                  FROM ".$table."
                 WHERE id_solicitud =".$sol.";";
        
        $query   = $db->pgquery($sql);
        $numRows = $db->pgNumRows($query);

        if($numRows > 0){

           $row  = $db->pgfetch($query);
           $nRef = $row[$string]; 

          return $nRef;   
        }

  }

  //Metodo para Busca la Referencia 

  public function getReferencia2($nroReg){

        $db     = Database::getInstance();
        
        $sql = "SELECT id_solicitud 
                  FROM solicitud
                 WHERE d_numero_sanitario ='".$nroReg."'
                   AND id_tipo_solicitud = 1
                 ORDER BY id_solicitud ASC
                 LIMIT 1;";
        
        $query   = $db->pgquery($sql);
        $numRows = $db->pgNumRows($query);

        if($numRows > 0){

           $row  = $db->pgfetch($query);
           $nRef = $row['id_solicitud']; 

          return $nRef;   
        }

  }


  private function getTable($num){

         $arrTables = array(5=>"ajuste_grado",             6=>"cambio_denominacion",
                            7=>"cambio_formula",           8=>"cambio_fabricante",
                            9=>"cambio_marca",            10=>"cambio_cont_neto",
                            11=>"cambio_rotulo",          12=>"cambio_razon_importador",
                            13=>"cambio_razon_fab",       14=>"cambio_razon_tit",
                            15=>"cambio_titular",         17=>"cambio_lug_fab",
                            18=>"inclu_distribuidor",     19=>"inclu_importador",
                            20=>"inclu_planta_fabricante",21=>"inclu_planta_env",
                            22=>"inclu_cont_neto",        23=>"inclu_material",
                            24=>"inclu_export",           25=>"inclu_promocional",
                            26=>"exclu_distribuidor",     27=>"exclu_importador",
                            28=>"exclu_planta_fabricante",29=>"exclu_planta_env",
                            30=>"exclu_cont_neto",        31=>"exclu_material",
                            32=>"renovacion_registro",    33=>"renovacion_registro",
                            34=>"renovacion_registro",    35=>"renovacion_registro",
                            40=>"inclu_pres_zonacomer");

     return $arrTables[$num];
  }

  public function detProducto(){

      $db  = Database::getInstance();
  	 //Hago La Consulta SQL
      $sql = "SELECT *
                FROM producto
               WHERE id_solicitud =".$this->solRefer.";";

      $query = $db->pgquery($sql);
      $numR  = $db->pgNumrows($query);

      if($numR > 0){
      	 $row = $db->pgfetch($query);
       //Capturo los datos
         $arrProduct = array("id_producto"          =>$row["id_producto"],
         	                   "id_tipo_prod"         =>$row["id_tipo_prod"],
         	                   "d_tipo_prod"          =>$this->dProducto($row["id_tipo_prod"]),
         	                   "id_clase_prod"        =>$row["id_clase_prod"],
         	                   "d_clase_prod"         =>$this->dClaseProd($row["id_clase_prod"]),
         	                   "id_subclase_prod"     =>$row["id_subclase_prod"],
         	                   "d_subclase_prod"      =>$this->subclaseProd($row["id_subclase_prod"]),
         	                   "d_denomina"           =>$row["d_denomina"],
         	                   "d_marca"              =>$row["d_marca"],
         	                   "d_fantasia"           =>$row["d_fantasia"],
                             "n_contenido_neto"     =>$this->contNeto($this->solRefer),
                             "producto_envase"      =>$this->prodEnvase($this->solRefer),
                             "n_grado_alcohol"      =>$this->gradoAlcohol($this->solRefer,$row["id_tipo_prod"]),
                             "id_origen_prod"       =>$row["id_origen_prod"]);

        if (isset($row["id_forma_elaboracion"])) {
          $arrProduct2 = array("id_forma_elaboracion"=>$row["id_forma_elaboracion"],
                                "d_forma_elaboracion"=>$this->formaElaboracion($row["id_forma_elaboracion"]));
          
        }else{
          $arrProduct2 = array("id_forma_elaboracion"=>1,
                                "d_forma_elaboracion"=>$this->formaElaboracion(1));
        }

        $arrProduct = array_merge($arrProduct,$arrProduct2);
         //Envio la Respuesta
           return $arrProduct;
      }
  }

  public function dProducto($id_tipo_prod){

  	   $sql = "SELECT d_tipo_prod
                 FROM tipo_producto
                WHERE id_tipo_prod =".$id_tipo_prod.";";

      $query = pg_query($sql);
      $numR  = pg_num_rows($query);
      if($numR > 0){
      	 $row = pg_fetch_array($query);
      	 $d_tipo_prod  = $row["d_tipo_prod"];
      }

       return $d_tipo_prod;
  }

  public function dClaseProd($id_clase_prod){

  	   $sql = "SELECT d_clase_prod
                 FROM clase_producto
                WHERE id_clase_prod =".$id_clase_prod.";";

      $query = pg_query($sql);
      $numR  = pg_num_rows($query);
      if($numR > 0){
      	 $row = pg_fetch_array($query);
      	 $d_clase_prod  = $row["d_clase_prod"];
      }

       return $d_clase_prod;
  }

  public function getformaElab($datSol){
    $sql = "SELECT id_forma_elaboracion
              FROM producto
             WHERE id_solicitud =".$datSol.";";
     
      $query = $this->db->pgquery($sql);
      $numR  = $this->db->pgNumrows($query);
      if($numR > 0){
         $row = $this->db->pgfetch($query);
         $id_forma_elaboracion  = $row["id_forma_elaboracion"];
      }

       return $id_forma_elaboracion;

  } 

  public function subclaseProd($id_subclase_prod){

  	   $sql = "SELECT d_subclase_prod
                 FROM subclase_producto
                WHERE id_subclase_prod =".$id_subclase_prod.";";

      $query = pg_query($sql);
      $numR  = pg_num_rows($query);
      if($numR > 0){
      	 $row = pg_fetch_array($query);
      	 $d_subclase_prod  = $row["d_subclase_prod"];
      }

       return $d_subclase_prod;
  }

  public function formaElaboracion($id_forma_elaboracion){

  	   $sql = "SELECT d_forma_elaboracion
                 FROM forma_elaboracion
                WHERE id_forma_elaboracion =".$id_forma_elaboracion.";";

      $query = pg_query($sql);
      $numR  = pg_num_rows($query);
      if($numR > 0){
      	 $row = pg_fetch_array($query);
      	 $d_forma_elaboracion  = $row["d_forma_elaboracion"];
      }

       return $d_forma_elaboracion;
  }

  public function fVigencia($fecha){
    //Transformo la Fecha a Tiempo
      $fechaDate = strtotime ( '+5 year' , strtotime ( $fecha ) ) ;
      $fechaDate = date ( 'Y-m-j' , $fechaDate );

     return $fechaDate;

  }

  /* Metodo para capturar los datos de los contenidos netos por envase
   * 
   * 
   */

   public function contEnvase($envase){

    $sql = "SELECT *
             FROM presentacion_envase
             WHERE id_solicitud =".$this->solRefer."
              AND id_prod_envase = ".$envase." ;";

      $query      = pg_query($sql);
      $numR       = pg_num_rows($query);
      $conts = array();
      if($numR > 0){
         for($i = 0; $i < $numR;$i++){

             $row = pg_fetch_array($query,$i);
             $conts[$i] = array(
                                   "id_pres_envase"       => $row["id_pres_envase"],
                                   "id_prod_presentacion" => $row["id_prod_presentacion"]
                                );
         }
      }

       return $conts;

  }


  /* Metodo para capturar los datos de los contenidos netos aprobados
   * registrados en la BD. Recibe el numero de solicitud y devuelve un
   * Arreglo con todos los datos de la tabla producto_presemtacion.
   */

  public function contNeto($nroSol){

    $sql = "SELECT *
              FROM producto_presentacion
             WHERE id_solicitud =".$nroSol.";";

    $query = pg_query($sql);
    $numR  = pg_num_rows($query);
    $contNeto = array();
      if($numR > 0){
         for($i = 0; $i < $numR;$i++){
             $row = pg_fetch_array($query,$i);
             $contNeto[$i] = array(
                               "id_producto"      => $row["id_producto"],
                               "contenido_neto"   => $row["contenido_neto"],
                               "id_unidad_medida" => $row["id_unidad_medida"],
                               "d_unidad_medida"  => $this->unMedida($row["id_unidad_medida"])
                             );
         }
      }

      return $contNeto;

  }

  /* Metodo para capturar los datos de los Envases y Empaques
   * registrados en la BD. Recibe el numero de solicitud y devuelve un
   * Arreglo con todos los datos de la tabla producto_envase.
   */


  public function prodEnvase($nroSol){

    $sql = "SELECT *
              FROM producto_envase
             WHERE id_solicitud =".$nroSol.";";

      $query      = pg_query($sql);
      $numR       = pg_num_rows($query);
      $prodEnvase = array();
      if($numR > 0){
         for($i = 0; $i < $numR;$i++){

             $row = pg_fetch_array($query,$i);
             $prodEnvase[$i] = array(
                                   "id_prod_envase"         => $row["id_prod_envase"],
                                   "id_autorizacion_envase" => $row["id_autorizacion_envase"],
                                   "f_autorizacion"         => $this->fSalida($row["f_autorizacion"]),
                                   "d_desc_envase"          => $row["d_desc_envase"],
                                   "d_uso_envase"           => $row["d_uso_envase"]);
         }
      }

       return $prodEnvase;

  }

  private function envaseProd($id_prod){

    $db = Database::getInstance();

    $sql = "SELECT *
              FROM producto_envase
             WHERE id_prod_envase =".$id_prod.";";

      $query      = $this->db->pgquery($sql);
      $numR       = $this->db->pgNumrows($query);
      $prodEnvase = array();
      if($numR > 0){
         for($i = 0; $i < $numR;$i++){

             $row = @pg_fetch_array($query,$i);
             $prodEnvase[$i] = array(
                                   "id_prod_envase"         => $row["id_prod_envase"],
                                   "id_autorizacion_envase" => $row["id_autorizacion_envase"],
                                   "f_autorizacion"         => $this->fSalida($row["f_autorizacion"]),
                                   "d_desc_envase"          => $row["d_desc_envase"],
                                   "d_uso_envase"           => $row["d_uso_envase"]);
         }
      }

       return $prodEnvase;

  }

  public function netoEnvaseOfic($nroSol,$mswitch){

        $db = Database::getInstance();

        $sql="SELECT pe.*,pd.d_desc_envase,pd.id_autorizacion_envase,pd.d_uso_envase,
                 (SELECT contenido_neto 
                    FROM producto_presentacion ep 
                   WHERE pe.id_prod_presentacion = ep.id_prod_presentacion),
                 (SELECT id_unidad_medida 
                    FROM producto_presentacion ep  
                   WHERE pe.id_prod_presentacion = ep.id_prod_presentacion)  
              FROM presentacion_envase pe,producto_envase pd 
              WHERE pe.id_solicitud =".$nroSol." 
                AND pe.id_prod_envase = pd.id_prod_envase;";

          $query = $db->pgquery($sql);
          $numR  = $db->pgNumrows($query);
     
         //Algoritmo

           if($numR > 0){
              for($i = 0; $i <$numR;$i++){

                  $row = @pg_fetch_array($query,$i);

                  $arrData[$i] =array('id_prod_envase'         =>$row['id_prod_envase'],
                                      'id_autorizacion_envase' =>$row['id_autorizacion_envase'], 
                                      'id_prod_presentacion'   =>$row['id_prod_presentacion'],
                                      'd_desc_envase'          =>$row['d_desc_envase'],
                                      'contenido_neto'         =>$row['contenido_neto'].$this->unMedida($row['id_unidad_medida']),
                                      'cont_neto_only'         =>$row['contenido_neto'],
                                      'unidad_medida'          =>$this->unMedida($row['id_unidad_medida'])); 
              } 
           }
           //Buscar los envases no repetidos 
             $arrEnvase = array();
             $arrAux    = array();
             $p = 0;
           if($mswitch == 0){
             foreach($arrData AS $item1){
                 foreach($item1 as $key => $value){
                  if($key =='d_desc_envase'){
                     if(!in_array($value, $arrAux)){
                         $arrAux[$p] = $value;
                         $arrEnvase[$p]=array($key=>$value); 
                      $p++;   
                     }
                  }
   
                }
            }
           }else{
               
              if($mswitch == 1){
                 $w = 0;
                 foreach($arrData AS $item1){
                  foreach($item1 as $key => $value){
                    if($key =='contenido_neto'){
                     
                     if(!in_array($value, $arrEnvase)){
                         //array_push($arrEnvase,$value);
                        $arrEnvase[$w]=array($key=>$value);

                      $w++;   
                     }
                  }
               }
            }
           }
           if($mswitch == 3){

             $arrEnvase = $arrData;
           }
         }
             
      return $arrEnvase;   

  }

  public function getComposicion($nroSol){

        $db = Database::getInstance();
       
        $arrComp = array();

        $sql = "SELECT c.d_ingrediente,c.id_tipo_composicion,
                (SELECT tc.d_tipo_composicion
                   FROM tipo_composicion tc  
                  WHERE c.id_tipo_composicion = tc.id_tipo_composicion),
                        d_funcion,cant_ingrediente,id_unidad_medida,
                  (SELECT a.d_aditivo
                  FROM aditivo a
                  WHERE c.id_aditivo = a.id_aditivo)
                   FROM composicion c
                  WHERE c.id_solicitud =".$nroSol."
               ORDER BY c.cant_ingrediente::numeric DESC;";
                 // ORDER BY c.cant_ingrediente  DESC;";
        $query   = $db->pgquery($sql);
        $numRows = $db->pgNumrows($query);

        if($numRows > 0){

           for($i = 0;$i < $numRows;$i++){

               $row = @pg_fetch_array($query,$i);

               $arrComp[$i] = array('d_ingrediente'       => $row['d_ingrediente'],
                                    'id_tipo_composicion' => $row['id_tipo_composicion'],
                                    'd_tipo_composicion'  => $row['d_tipo_composicion'],
                                    'd_funcion'           => $row['d_funcion'],
                                    'cant_ingrediente'    => $row['cant_ingrediente'],
                                    'd_aditivo'           => $row['d_aditivo'],
                                    'simbolo'             => $this->unMedida($row['id_unidad_medida'])  
                                   );
           }
         return $arrComp;    
        }else{

/////CORRE SQL
     $sql = "SELECT c.d_ingrediente,c.id_tipo_composicion,
                (SELECT tc.d_tipo_composicion
                   FROM tipo_composicion tc  
                  WHERE c.id_tipo_composicion = tc.id_tipo_composicion),
                        d_funcion,cant_ingrediente,id_unidad_medida,
                  (SELECT a.d_aditivo
                  FROM aditivo a
                  WHERE c.id_aditivo = a.id_aditivo)
                   FROM composicion c
                  WHERE c.id_solicitud =".$nroSol."
                 ORDER BY c.cant_ingrediente  DESC;";

         $query   = $db->pgquery($sql);
         $numRows = $db->pgNumrows($query);

  if($numRows > 0){

    for($i = 0;$i < $numRows;$i++){

     $row = @pg_fetch_array($query,$i);

      $arrComp0[$i] = array('d_ingrediente'       => $row['d_ingrediente'],
                           'id_tipo_composicion' => $row['id_tipo_composicion'],
                           'd_tipo_composicion'  => $row['d_tipo_composicion'],
                           'd_funcion'           => $row['d_funcion'],
                           'cant_ingrediente'    => $row['cant_ingrediente'],
                           'd_aditivo'           => $row['d_aditivo'],
                           'simbolo'             => $this->unMedida($row['id_unidad_medida'])  
              );
           }
         return $arrComp0;    
          }

        }           
   } //FIN FUNTION

    public function getDuracion($nroSol){

        $db = Database::getInstance();
       
        $arrComp   = array();
        $arrTiempo = array(1=>'dia(s)',2=>'mes(es)',3=>'año(s)');

        $sql = "SELECT *
                   FROM conservacion_producto
                  WHERE id_solicitud=".$nroSol.";";

        $query   = $db->pgquery($sql);
        $numRows = $db->pgNumrows($query);

        if($numRows > 0){

           for($i = 0;$i < $numRows;$i++){

               $row = @pg_fetch_array($query,$i);

               $arrComp[$i] = array('d_modo_conservacion' => $row['d_modo_conservacion'],
                                    'n_cant_conservacion' => $row['n_cant_conservacion'],
                                    'd_tiempo'            => $arrTiempo[$row['d_tiempo']],
                                    'd_codigo_lote'       => $row['d_codigo_lote'],
                                    'd_descripcion_lote'  => $row['d_descripcion_lote'],   

                                   );
           }
         return $arrComp;    
        }           
   }


  private function arrToText($arr,$esp){
    $a = "";  
    for ($i=0; $i < count($arr); $i++) { 
      if ($i == 0) {
        $a.= $arr[$i][$esp];    
      }else{
        if ($i == count($arr)-1) {
          $a.= " y ".$arr[$i][$esp];
        }else{
          $a.= ", ".$arr[$i][$esp]; 
        }
      }
    }

    return $a;
  }


  public function unMedida($id_unidad_medida){

      $db = Database::getInstance();

       $sql = "SELECT simbolo
                 FROM unidad_medida
                WHERE id_unidad_medida =".$id_unidad_medida.";";

      $query = $db->pgquery($sql);
      $numR  = $db->pgNumrows($query);

      if($numR > 0){
         $row      = $db->pgfetch($query);
         $uMedida  = $row["simbolo"];
      }

      return $uMedida;

  }

  //Busca nombre del estado
  public function findEstado($id_estado){

       $sql = "SELECT d_estado
                 FROM estado
                WHERE id_estado =".$id_estado.";";

      $query = pg_query($sql);
      $numR  = pg_num_rows($query);
      if($numR > 0){
         $row      = pg_fetch_array($query);
         $d_estado  = $row["d_estado"];
      }

      return $d_estado;

  }

  //Busca el Nombre del Municipio

  public function findMunicipio($id_municipio){

       $sql = "SELECT d_municipio
                 FROM municipio
                WHERE id_municipio =".$id_municipio.";";

      $query = pg_query($sql);
      $numR  = pg_num_rows($query);
      if($numR > 0){
         $row      = pg_fetch_array($query);
         $d_municipio  = $row["d_municipio"];
      }

      return $d_municipio;

  }

//Busca el Nombre de la Parroquia

  public function findParroquia($id_parroquia){

       $sql = "SELECT d_parroquia
                 FROM parroquia
                WHERE id_parroquia =".$id_parroquia.";";

      $query = pg_query($sql);
      $numR  = pg_num_rows($query);
      if($numR > 0){
         $row      = pg_fetch_array($query);
         $d_parroquia  = $row["d_parroquia"];
      }

      return $d_parroquia;

  }

  //Busca el Grado Alcoholico
    public function gradoAlcohol($nroSol,$tipoProd){

      //Verifico que no sea Alimento
        if($tipoProd == 1){
           $gradoAlcohol = 'No Aplica';
        }else{

          //Busco la informacion
            $sql = "SELECT n_grado_alcohol
                      FROM componentes_adicionales
                     WHERE id_solicitud =".$nroSol.";";

            $query = pg_query($sql);
            $numR  = pg_num_rows($query);
            if($numR > 0){
               $row           = pg_fetch_array($query);
               $gradoAlcohol  = $row["n_grado_alcohol"];
             }else
              $gradoAlcohol ='No Hay Datos Registrados';
          }

      return $gradoAlcohol;
    }

    public function empresas(){

         $db = Database::getInstance();
        //Inicializo la Variable
          $arrEmpresa = array();
        //Busco la informacion
          $sql = "SELECT id_solicitud_empresa,id_empresa,id_actividad,
                         id_tipo_empresa,n_planta
                    FROM solicitud_empresa
                   WHERE id_solicitud =".$this->solRefer.";";
            
            $query = $db->pgquery($sql);
            $numR  = $db->pgNumrows($query);

            if($numR > 0){
               for($i = 0; $i < $numR;$i++){

                   $row = @pg_fetch_array($query,$i);

                   $arrEmpresa[$i] = array(
                                      "id_empresa"       => $row["id_empresa"],
                                      "id_tipo_empresa"  => $row["id_tipo_empresa"],
                                      "d_empresa"        => $this->findRazonEmp($row["id_empresa"],$row["id_tipo_empresa"]),
                                      "d_tipo_empresa"   => $this->findTipoEmp($row["id_tipo_empresa"]),
                                      "id_actividad"     => $row["id_actividad"],
                                      "d_actividad"      => $this->findActividad($row["id_actividad"]),
                                      "n_planta"         => $row["n_planta"],
                                      "numRows"          => $i
                   );
             }

           }

         return $arrEmpresa; 
      }

      public function getSpecific($act){
            $arryEmpresa = array();
            $arrDatos    = array();
            $p           = 0;
            $arryEmpresa = $this->empresas();
            
            foreach($arryEmpresa as $item){
                foreach($item as $key => $value){
                   if($key == 'id_actividad' && $value == $act){
                        $arrDatos[$p] = array(
                                               'id_empresa'      => $item['id_empresa'],
                                               'id_tipo_empresa' => $item['id_tipo_empresa'],
                                               'd_empresa'       => $item['d_empresa']['d_nombre'],
                                               'd_tipo_empresa'  => $item['d_tipo_empresa'],
                                               'd_actividad'     => $item['d_actividad'],
                                               'n_planta'        => $item['n_planta']

                        );
                  $p++;
                }
              }

            }
          //return $arrDatos[0]['d_empresa'].' '.$arrDatos[1]['d_empresa'].' '.$arrDatos[2]['d_empresa'];
        return $arrDatos;  
      }

      public function findRazonEmp($id_empresa,$id_tipo_empresa){

          //Inicializo el arreglo que guarda los datos de la Empresa
            switch ($id_tipo_empresa){
                    case 1:

                       $razonEmp = $this->findNacional($id_empresa);
                       
                    break;
                    case 2:
                       $razonEmp = $this->findExtranjera($id_empresa);
                    break;
            }
            return $razonEmp;
      }


      public function findNacional($id_empresa){
              
             //Inicializo el Arreglo para que guarde
               $db = Database::getInstance();
               
             //Busqueda SQL
             $sql = "SELECT *
                       FROM empresa_nacional
                      WHERE id_empresa =".$id_empresa.";";

             $query = $db->pgquery($sql);
             $numR  = $db->pgNumrows($query);

            if($numR > 0){

               $row           = $db->pgfetch($query);
               
               $arrDatosEmp   = array("d_nombre"              => $row["d_nombre"],
                                      "id_estado"             => $row["id_estado"],
                                      "d_estado"              => $this->findEstado($row["id_estado"]),
                                      "id_municipio"          => $row["id_municipio"],
                                      "id_parroquia"          => $row["id_parroquia"],
                                      "d_ciudad"              => $row["d_ciudad"],
                                      "d_direccion"           => $row["d_direccion"],
                                      "n_telefono_local"      => $row["n_telefono_local"],
                                      "n_telefono_movil"      => $row["n_telefono_movil"],
                                      "d_correo"              => $row["d_correo"],
                                      "nro_permiso_sanitario" => $row["nro_permiso_sanitario"],
                                      "rif"                   => $row["rif"],
                                      "d_referencia"          => $row["d_referencia"]

                );
                
             }
             return  $arrDatosEmp;
      }

      public function findExtranjera($id_empresa){

             //Inicializo el Arreglo para que guarde
             //Busqueda SQL
             $sql = "SELECT *
                       FROM empresa_extranjera
                      WHERE id_empresa_extranjera =".$id_empresa.";";

             $query = pg_query($sql);
             $numR  = pg_num_rows($query);

            if($numR > 0){
               $row           = pg_fetch_array($query);
               $arrDatosEmp   = array("d_nombre"              => $row["d_nombre"],
                                      "id_pais"               => $row["id_pais"],
                                      "d_ciudad"              => $row["d_ciudad"],
                                      "d_pais"                => $this->findPais($row["id_pais"]),  
                                      "d_direccion"           => $row["d_direccion"],
                                      "d_correo"              => $row["d_correo"],
                                      "telefono"              => $row["telefono"],
                                      "rif"                   => $row["id_empresa_extranjera"] 
                                 );
             }
         return $arrDatosEmp;
      }

      public function findActividad($id_actividad){

             $sql = "SELECT d_actividad
                       FROM actividad_empresa
                      WHERE id_actividad =".$id_actividad.";";

             $query = pg_query($sql);
             $numR  = pg_num_rows($query);

            if($numR > 0){

               $row           = pg_fetch_array($query);
               $actividad   = $row["d_actividad"];
             }

        return $actividad;
      }

      public function findZona($id_zona_comer){

           if(isset($id_zona_comer)){

               $sql = "SELECT d_zona_comer
                      FROM zona_comercializacion
                     WHERE id_zona_comer =".$id_zona_comer.";";

             $query = pg_query($sql);
             $numR  = pg_num_rows($query);

            if($numR > 0){

               $row    = pg_fetch_array($query);
               $d_zona = $row["d_zona_comer"];
             }

           }else{
              $d_zona = 'No Aplica';
           }

        return $d_zona;
      }

      public function findTipoEmp($id_tipo_empresa){

           $sql = "SELECT  d_tipo_empresa
                     FROM  tipo_empresa
                     WHERE id_tipo_empresa =".$id_tipo_empresa.";";

             $query = pg_query($sql);
             $numR  = pg_num_rows($query);

            if($numR > 0){

               $row            = pg_fetch_array($query);
               $d_tipo_empresa = $row["d_tipo_empresa"];
             }

        return $d_tipo_empresa;
      }


      /*Metodo que sirve para buscar los datos de las plantas fabricantes
       * Es un Metodo Publico que puede llamarse despues de instancias la
       * clase.
       */
 
    public function findPlantas($activ){

          $arrPlantas = array();

          //Hago el Llamado de las Empresas

            $arrPlantas = $this->getSpecific($activ);
            $p = 0;

            foreach($arrPlantas as $item){

                  foreach($item as $key => $value){

                      if($key == 'n_planta' && $value == 1){

                       //Hago EL Busqueda de Informacion
                       $sql = "SELECT sp.id_solicitud_planta, pf.*
                               FROM solicitud_planta sp, planta_fabricante pf
                               WHERE sp.id_solicitud =".$this->solRefer."
                               AND sp.id_empresa = ".$item['id_empresa']."  
                               AND sp.id_planta_fabricante = pf.id_planta_fabricante;";

                         $query = pg_query($sql);
                         $numR  = pg_num_rows($query);
                 if($numR > 0){

                    for($t=0; $t < $numR;$t++){

                        $row   = pg_fetch_array($query,$t); 

                      //Lleno el Arreglo devuelto
                      $arrDatos[$p] = array(
                                            'id_planta_fabricante'  => $row['id_planta_fabricante'],
                                            'id_empresa'            => $row['id_empresa'],
                                            'd_empresa'             => $item['d_empresa'],
                                            'id_estado'             => $row['id_estado'],
                                            'd_estado'              => $this->findEstado($row['id_estado']),
                                            'id_municipio'          => $row['id_municipio'],
                                            'd_municipio'           => $this->findMunicipio($row['id_municipio']),
                                            'id_parroquia'          => $row['id_parroquia'],
                                            'd_parroquia'           => $this->findParroquia($row['id_parroquia']),
                                            'd_ciudad'              => $row['d_ciudad'],
                                            'telefono_primario'     => $row['telefono_primario'],
                                            'd_correo'              => $row['d_correo'],
                                            'd_direccion'           => $row['d_direccion'],
                                            'nro_permiso_sanitario' =>$row['nro_permiso_sanitario']
                                            );
                     $p++;
                    } 

                  }
                }

             }

          }
          return  $arrDatos;
      } //Fin findPlantas


      public function getPlantsSpecific($id){

             //Inicializo el Arreglo para que guarde
             //Busqueda SQL
             $sql = "SELECT *
                       FROM planta_fabricante
                      WHERE id_planta_fabricante =".$id.";";
             
             $query = pg_query($sql);
             $numR  = pg_num_rows($query);

            if($numR > 0){
               $row       = pg_fetch_array($query);
                
               $arrDatos  = array("id_planta_fabricante"    => $row["id_planta_fabricante"],
                                  "id_empresa"              => $row["id_empresa"],
                                  "d_direccion"             => $row["d_direccion"],                                    
                                  "nro_permiso_sanitario"   => $row["nro_permiso_sanitario"]
                                 );
             }
         return $arrDatos;
      }

   public function getFirma($nroSol){

          $sql = "SELECT * 
                   FROM firma 
                   WHERE id_solicitud = ".$nroSol.";"; 
          
          $query = pg_query($sql);
          $numR  = pg_num_rows($query);

          if($numR > 0){

             $row = @pg_fetch_array($query);

             $firma = $row["firma_gen"];
          
          }
                 
     return $firma;
   }


   public function findPais($id){
             //Inicializo el Arreglo para que guarde
             //Busqueda SQL
             $sql = "SELECT *
                       FROM pais
                      WHERE id_pais =".$id.";";

             $query = pg_query($sql);
             $numR  = pg_num_rows($query);

            if($numR > 0){
               $row    = @pg_fetch_array($query);
               $pais   = $row["d_pais"];
             }
         return $pais;
    }

    public function getUbicaPlanta($empresa){
            
          //Inicializo el Arreglo para que guarde
               $db = Database::getInstance();

               $sql = " SELECT pf.d_ciudad,pf.id_estado 
                        FROM planta_fabricante pf, solicitud_planta sp
                        WHERE pf.id_empresa= ".$empresa."
                        AND pf.id_planta_fabricante = sp.id_planta_fabricante
                        AND sp.id_solicitud = ".$this->solRefer.";";
               
               $query   = $db->pgquery($sql);
               $numRows = $db->pgNumrows($query);
               //echo $sql;
               if($numRows > 0){

                  for($i = 0;$i < $numRows;$i++){

                      $row = @pg_fetch_array($query,$i);

                       if($row["id_estado"] !== 1){

                           $arr[$i] =$row["d_ciudad"].', EDO. '.$this->findEstado($row["id_estado"]); 
                       }else{
                        
                           $arr[$i] =$row["d_ciudad"].', '.$this->findEstado($row["id_estado"]); 

                       }
                                      
                  } 
               }           
         
     return $arr;       
    }

    public function getUsuario($numSol){
   
         $db = Database::getInstance();

         $sql = "SELECT s.id_usuario,u.* 
                   FROM solicitud s,usuario u
                  WHERE s.id_usuario = u.id_usuario
                    AND s.id_solicitud =".$numSol.";";

         $query   = $db->pgquery($sql);
         $numRows = $db->pgNumrows($query);

         if($numRows > 0){

             $row = $db->pgfetch($query);

             $arrUser = array('cedula'     => $row['cedula_pasaporte'],
                              'd_nombre'   => $row['d_nombre'],
                              'd_apellido' => $row['d_apellido'],
                              'telefono'   => $row['n_telef_primario'],
                              'email'      => $row['d_correo']);
          return $arrUser;    
         }            

    }

    public function ultRenov(){
       $db  = Database::getInstance();
     //Busco  el Numero de Referencia
       $sql ="SELECT * 
                FROM ".self::$table." 
               WHERE d_numero_sanitario='".$this->numReg."'
                 AND id_categoria_solicitud IN(32,33,34,35) 
                  AND id_status_solicitud >=11
                    ORDER BY id_solicitud DESC LIMIT 1;";

       $query = @pg_query($sql);
       $numR  = @pg_num_rows($query);

      if($numR > 0){
         $row = @pg_fetch_array($query);

         $arrSol = array("id_solicitud"=>$row["id_solicitud"],
                         "id_tipo_solicitud"=>$row["id_tipo_solicitud"],
                         "id_usuario"=>$row["id_usuario"],
                         "id_status_solicitud"=>$row["id_status_solicitud"],
                         "f_solicitud"=>$row["f_solicitud"],
                         "f_registro"=>$row["f_status"],
                         "f_vigencia"=>$this->fVigencia($row["f_status"]),
                         "id_categoria_solicitud"=>$row["id_categoria_solicitud"],
                         "area"=>$row["id_area"]);
      }else{
        $arrSol = array();
      }
     return  array($numR,$arrSol);
    }


  /************************************************************************
  *
  *
  *   NOTIFICACIONES
  *
  *
  *************************************************************************/
//Aplica el Cambio de Notificacion 
        public function showNotifica($nro,$type,$tipo){

          $this->nroSolAux  = $nro;
          $this->tipoSolAux = $type;
          
          //Instancia la Base de Datos
          $this->dbAux      = Database::getInstance(); 

 //Busca la Funcion que corresponde
         $arrCambio = $this->getCambio($type);

         $table     = $arrCambio["table"]; 
         
       //Ejecuta la Funcion que ejecuta el query
         switch($type){
          case 2:
          case 4:

             if ($type == 2) {
                 $sql = "SELECT c.id_empresa, c.id_tipo_empresa 
                           FROM ".$table." c
                          WHERE id_solicitud=".$this->nroSolAux."
                            AND id_actividad = 5
                          ORDER BY c.id_solicitud_empresa ASC LIMIT 1;";
                          $sw = 0;
                     
                  }else{
                    $sql = "SELECT c.id_empresa, c.id_tipo_empresa, 
                                (SELECT z.d_zona_comer FROM zona_comercializacion z WHERE z.id_zona_comer = em.id_zona_comer)        
                          FROM ".$table." c, empresa_zona em
                          WHERE c.id_solicitud = em.id_solicitud
                          AND c.id_solicitud=".$this->nroSolAux."
                          AND c.id_actividad = 5;";
                          $sw = 1;
                  }
                break;
                case 3:
                case 34:

                  $sql = "SELECT DISTINCT ON (id_zona_comer)c.id_zona_comer, (SELECT z.d_zona_comer FROM zona_comercializacion z 
                          WHERE z.id_zona_comer = c.id_zona_comer) AS d_zona        
                          FROM ".$table." c
                          WHERE c.id_solicitud=".$this->nroSolAux."
                          ORDER BY id_zona_comer,d_zona ASC;";
                  $sw = 1;
                break;
                case 7:
                  $sql = "SELECT c.d_ingrediente,c.n_cantidad,
                          c.id_tipo_composicion,
                       (SELECT tc.d_tipo_composicion 
                          FROM tipo_composicion tc  
                         WHERE c.id_tipo_composicion = tc.id_tipo_composicion),
                        (SELECT um.simbolo 
                          FROM unidad_medida um  
                         WHERE c.id_unidad_medida = um.id_unidad_medida),
                         (SELECT a.d_aditivo 
                          FROM aditivo a  
                         WHERE c.id_aditivo = a.id_aditivo),
                               c.d_funcion,c.d_ingrediente,c.id_unidad_medida
                          FROM ".$table." c
                         WHERE id_solicitud=".$this->nroSolAux.";";
                  $sw = 1;
                break;
                case 10:
                  $sql = "SELECT c.n_contenido_anterior,c.n_contenido_actual,
                              (SELECT um.simbolo 
                                 FROM unidad_medida um  
                                WHERE c.id_unidad_anterior = um.id_unidad_medida) AS simbolo_anterior,
                              (SELECT um.simbolo 
                                 FROM unidad_medida um  
                                WHERE c.id_unidad_actual = um.id_unidad_medida) AS simbolo_Actual
                          FROM ".$table." c
                         WHERE id_solicitud=".$this->nroSolAux.";";
                  $sw = 0;
                break;
                case 19:
                    switch ($tipo) {
                      case 1:
                        //SQL por Defecto
                        $sql = "SELECT c.id_empresa, c.id_tipo_empresa, c.id_zona_comer
                          FROM ".$table." c WHERE c.id_solicitud=".$this->nroSolAux.";"; 
                      break;
                      case 2:
                        //SQL por Defecto
                        $sql = "SELECT c.id_empresa, c.id_tipo_empresa,c.id_zona_comer,
                            (SELECT z.d_zona_comer FROM zona_comercializacion z 
                                WHERE c.id_zona_comer = z.id_zona_comer) 
                          FROM ".$table." c WHERE c.id_solicitud=".$this->nroSolAux.";"; 
                      break;
                    }

                  $sw = 1;
                break;
                case 20:
                //SQL por Defecto
                 $sql = "SELECT *  
                         FROM ".$table." c 
                         WHERE c.id_solicitud=".$this->nroSolAux.";"; 
                  $sw = 0;
                break;
                case 21:
                   switch($tipo){
                      case 1:

                        //SQL por Defecto
                          $sql = "SELECT *
                          FROM ".$table." c 
                          WHERE c.id_solicitud=".$this->nroSolAux.";"; 
                          
                      break; 
                      case 2:
                        //SQL por Defecto

                        $sql = "SELECT c.id_empresa, c.id_tipo_empresa,c.id_zona_comer,
                            (SELECT z.d_zona_comer FROM zona_comercializacion z 
                                WHERE c.id_zona_comer = z.id_zona_comer) 
                          FROM ".$table." c WHERE c.id_solicitud=".$this->nroSolAux.";"; 
                          
                      break;
                    }
                    
                  $sw = 0;
                break;
                case 22:
                  $sql = "SELECT c.n_contenido_neto,c.id_prod_envase,
                                (SELECT pe.d_desc_envase 
                                   FROM producto_envase pe  
                                  WHERE c.id_prod_envase = pe.id_prod_envase),
                                (SELECT um.simbolo 
                                   FROM unidad_medida um  
                                   WHERE c.id_unidad_medida = um.id_unidad_medida)
                           FROM ".$table." c
                          WHERE c.id_solicitud=".$this->nroSolAux.";";
                  $sw = 1;
                break;
                case 24:
                  $sql = "SELECT c.d_nombre_prod,c.n_contenido_neto,
                                (SELECT um.simbolo 
                                   FROM unidad_medida um  
                                   WHERE c.id_unidad_medida = um.id_unidad_medida),(SELECT p.d_pais 
                                   FROM pais p  
                                   WHERE c.id_pais = p.id_pais)
                           FROM ".$table." c
                          WHERE c.id_solicitud=".$this->nroSolAux.";";
                  $sw = 1;
                break;
                case 25:
                  $sql = "SELECT c.d_nombre_promo,c.n_contenito_neto,c.f_promo_desde,c.f_promo_hasta,
                                (SELECT um.simbolo 
                                   FROM unidad_medida um  
                                   WHERE c.id_unidad_medida = um.id_unidad_medida),(SELECT z.d_zona_comer 
                                   FROM zona_comercializacion z  
                                   WHERE c.id_zona_comer = z.id_zona_comer)
                           FROM ".$table." c
                          WHERE c.id_solicitud=".$this->nroSolAux.";";
                  $sw = 1;
                break;
                default:
                  //SQL por Defecto
                  $sql = "SELECT * 
                          FROM ".$table."
                         WHERE id_solicitud=".$this->nroSolAux.";"; 
                  $sw = 0;
               break;
         } //Fin Switch $type

         //Busca la Informacion de la Notificacion
           
          $row = $this->getRecNotifica($table,$sql,$sw);
         
          //var_dump($row);

          switch($type){
            case 2:
                  $id_empresa = $row["id_empresa"];

                  $nTipo      = $row["id_tipo_empresa"];
                  
                  //Busca la Razon Social
                    $razImp = $this->findRazonEmp($id_empresa,$nTipo);

                  //Reacomoda el Arreglo
                    $rowAux = array('rif'              => $razImp['rif'],
                                    'razon_importa'    => $razImp['d_nombre'],
                                    'zonas'            => "NO APLICA"); 
                    $row = $rowAux;
                break;
              case 3:
              case 34:

                    $zona = "";
                    for ($i=0; $i < count($row); $i++) { 
                      if ($i==0) {
                        $zona.="".$row[$i]["d_zona"];

                      }else{
                        $zona.=", ".$row[$i]["d_zona"];
                      }
                    }                  
                  //Reacomoda el Arreglo
                    $rowAux = array('zonas' => $zona);  
                    $row = $rowAux;
                break;
                case 4:
                    $zona = "";
                    for ($i=0; $i < count($row); $i++) { 
                      if ($i==0) {
                        $zona.="".$row[$i]["d_zona_comer"];
                      }else{
                        $zona.=", ".$row[$i]["d_zona_comer"];
                      }
                    }
                  $id_empresa = $row[0]["id_empresa"];
                  $nTipo      = $row[0]["id_tipo_empresa"];
                  
                  //Busca la Razon Social
                    $razImp = $this->findRazonEmp($id_empresa,$nTipo);
                  //Reacomoda el Arreglo
                    $rowAux = array('rif'              => $razImp['rif'],
                                    'razon_importa'    => $razImp['d_nombre'],
                                    'zonas'            => $zona);  
                    $row = $rowAux;
                break;
                case 8:
                case 15:
                  $id_anterior = $row["id_empresa_anterior"];
                  
                  $id_actual   = $row["id_empresa_actual"];
                  if($type == 8){
                    $nTipo = $row["n_tipo_empresa"];
                  }
                  if($type == 15){
                    $nTipo = $row["id_tipo_empresa"];
                  }


                  //Busca la Razon Social
                    $razAnt = $this->findRazonEmp($id_anterior,$nTipo);
                    $razAct = $this->findRazonEmp($id_actual,$nTipo);
                    
                  //Reacomoda el Arreglo
                    if ($nTipo == 1){
                      $rowAux = array('id_empresa_anterior'=> $razAnt['rif'],
                                      'razon_anterior'     => $razAnt['d_nombre'],
                                      'id_empresa_actual'  => $razAct['rif'],
                                      'razon_actual'       => $razAct['d_nombre'],
                                      'tipo_empresa'       => $nTipo); 
                    }else{
                      $rowAux = array('id_empresa_anterior'=> $id_anterior,
                                      'razon_anterior'       => $razAnt['d_nombre'],
                                      'id_empresa_actual'    => $id_actual,
                                      'razon_actual'         => $razAct['d_nombre'],
                                      'tipo_empresa'         => $nTipo); 
                    }
                    
                    $row = $rowAux;                 
                break;
                case 12: 
                case 13:
                case 14: 
                  $id_empresa  = $row["id_empresa"];
                  $nTipo       = $row["id_tipo_empresa"];
                  //Busca la Razon Social
                    $datEmpre = $this->findRazonEmp($id_empresa,$nTipo);
                  //Reacomoda el Arreglo
                   if ($nTipo == 1) { 
                    $rowAux = array('id_empresa'    => $datEmpre['rif'],
                                    'razon_anterior'    => $row['d_empresa_anterior'],
                                    'razon_actual'      => $row['d_empresa_actual'],
                                    'tipo_empresa'      => $nTipo); 
                   }else{
                    $rowAux = array('id_empresa'    => $id_empresa,
                                    'razon_anterior'    => $row['d_empresa_anterior'],
                                    'razon_actual'      => $row['d_empresa_actual'],
                                    'tipo_empresa'      => $nTipo); 
                   }
                    $row = $rowAux;                 
                break;
                case 17:
                    $id      = $row["id_empresa"];
                    $idPlan  = (int)$row["id_planta_fabricante_ant"];
                    $idPlac  = (int)$row["id_planta_fabricante_act"];
                    $nTipo   = 1;
                    //Busca la Razon Social
                    $rasEmp = $this->findRazonEmp($id,$nTipo);
                    $pltAnt = $this->getPlantsSpecific($idPlan);
                    $pltAct = $this->getPlantsSpecific($idPlac);
                    //Reacomoda el Arreglo
                    $rowAux = array('id_empresa'=> $rasEmp['rif'],
                                    'nro_permiso_ant' => $row["nro_permiso_ant"],
                                    'nro_permiso_act' => $row["nro_permiso_act"],
                                    'lugar_ant' => $pltAnt["d_direccion"],
                                    'lugar_act' => $pltAct["d_direccion"]); 
                    $row = $rowAux;
                break;
                case 19:
                  $zona = "";
                  for ($i=0; $i < count($row); $i++) { 
                      if ($row[$i]["id_zona_comer"]<>0) {
                        if ($i==0) {
                          $zona.="".$row[$i]["d_zona_comer"];
                        }else{
                          $zona.=", ".$row[$i]["d_zona_comer"];
                        }
                      }else{
                        $zona.= 'NO APLICA';
                      }
                      $id_empresa = $row[$i]["id_empresa"];
                      $nTipo      = $row[$i]["id_tipo_empresa"];                 
                      //Busca la Razon Social
                      $razImp = $this->findRazonEmp($id_empresa,$nTipo);
                  }

                  $rowAux = array('rif'              => $razImp['rif'],
                                    'razon_importa'    => $razImp['d_nombre'],
                                    'zonas'            => $zona); 
                  $row = $rowAux;
                  
                  
                break;
                case 20:

                  $id_empresa = $row["id_empresa_matriz"];
                  $nTipo      = $row["id_tipo_empresa"];
                  $planta     = $row["id_planta_fabricante"];                     
                  //Busca la Razon Social
                    $razFab = $this->findRazonEmp($id_empresa,$nTipo);
                    switch ($nTipo){
                      case 1:
                          $Plants = $this->getPlantsSpecific($planta);
                          $rowAux = array('rif'              => $razFab['rif'],
                                          'razon_fabrica'    => $razFab['d_nombre'],
                                          'd_direccion'      => $Plants['d_direccion'],
                                          'nro_permiso_sanitario'     => $Plants['nro_permiso_sanitario'],
                                          'tipo'             => $nTipo); 
                      break;
                      case 2:
                          $rowAux = array('id'         => $id_empresa,
                                          'razon_fabrica'    => $razFab['d_nombre'],
                                          'd_ciudad'         => $razFab['d_ciudad'],
                                          'd_pais'           => $razFab['d_pais'],
                                          'tipo'             => $nTipo); 
                      break;
                    }
                    
                  //Reacomoda el Arreglo
                    $row = $rowAux;
                break;
                case 21:
                  $id_empresa = $row["id_empresa_matriz"];
                  $n_ref      = $row["n_solicitud_ref"];

                  $nTipo      = (int)$this->getTipoEmp($id_empresa,$n_ref);
                   
                  $planta     = $row["id_planta_env"];

                  //Busca la Razon Social

                    $razFab = $this->findRazonEmp($id_empresa,$nTipo);
                       
                    switch ($nTipo){
                      case 1:
                          $Plants = $this->getPlantsSpecific($planta);
                          $rowAux = array('rif'                   => $razFab['rif'],
                                          'razon_fabrica'         => $razFab['d_nombre'],
                                          'd_direccion'           => $Plants['d_direccion'],
                                          'nro_permiso_sanitario' => $Plants['nro_permiso_sanitario'],
                                          'tipo'                  => $nTipo);

                      break;
                      case 2:
                          $rowAux = array('id'         => $id_empresa,
                                          'razon_fabrica'    => $razFab['d_nombre'],
                                          'd_ciudad'         => $razFab['d_ciudad'],
                                          'd_pais'           => $razFab['d_pais'],
                                          'tipo'             => $nTipo); 
                      break;
                    }
                    $row = $rowAux;
                break;

                case 40:
                     $id_empresa = $row["id_empresa_matriz"];
                     $n_ref      = $row["n_solicitud_ref"];
                     $nTipo      = $this->getTipoEmp($id_empresa,$n_ref);
                     $planta     = $row["id_planta_env"];

                  //Busca la Zona de Comercializacion
                    $razFab = $this->findZonaComerc($this->nroSolAux);
                  //Convertir a String el Arreglo
                    $arrToString = $this->getStringArr($razFab);
                    $row = $arrToString;
                break;
          }

           
         $eject = array('row'=>$row,'function' =>$arrCambio['function']); 
      return $eject;   
  } //fin showNotifica
    
  private function findZonaComerc($nRef){
           
        $db = Database::getInstance();

        $sql = "SELECT d_zona_distri 
                  FROM inclu_pres_zonacomer
                 WHERE id_solicitud =".$nRef.";";
     
       $query   = $db->pgquery($sql);
       $numRows = $db->pgNumRows($query);

       if($numRows > 0){
         for ($k = 0;$k < $numRows;$k++){
             $row      = @pg_fetch_array($query,$k);
             if((int)$row["d_zona_distri"] !== 6 ){
                $zona[$k] = utf8_decode($this->findZona((int)$row["d_zona_distri"]));  
             }
         } 
       }

    return $zona;
  }  

  //Extrae kis ekementos del arreglo to string
    private function getStringArr($arr){
          
         //Declara una variable string
           $sTring = "";  
         for($i=0;$i<count($arr);$i++){
             if($i==0){
                $sTring.=$arr[$i];   
             }else{
               $sTring.= ', '.$arr[$i];
             } 
         }

         return $sTring; 

    } //Fin  


 private function getCambio($typeSol){

                $arrDestino = array(2=>array('table'=>'solicitud_empresa',
                                            'function'=>'writeIncImp'),
                                    3=>array('table'=>'producto_zona',
                                            'function'=>'writeZonas'),         
                                    4=>array('table'=>'solicitud_empresa',
                                            'function'=>'writeIncImp'),
                                    5=>array('table'=>'ajuste_grado','function'       =>'writeAjusteGrado'),
                                    6=>array('table'=>'cambio_denominacion','function'=>'writeCmbDeno'),
                                    7=>array('table'=>'cambio_formula','function'     =>'writeCmbIngre'),
                                    8=>array('table'=>'cambio_fabricante','function'  =>'writeCmbFabri'),
                                    9=>array('table'=>'cambio_marca','function'       =>'writeCmbMarca'),
                                    10=>array('table'=>'cambio_cont_neto','function'  =>'writeCmbCont'),
                                    11=>array('table'=>'cambio_rotulo','function'     =>'writeCmbRotulo'),
                                    12=>array('table'=>'cambio_razon_importador','function'=>'writeCmbRazImp'),
                                    13=>array('table'=>'cambio_razon_fab','function'=>'writeCmbRazFab'),
                                    14=>array('table'=>'cambio_razon_tit','function'  =>'writeCmbRazTit'),
                                    15=>array('table'=>'cambio_titular','function'    =>'writeCmbTit'),
                                    17=>array('table'=>'cambio_lug_fab','function'    =>'writeCmbLugFab'),
                                    18=>array('table'=>'inclu_distribuidor','function'=>'writeIncDist'),
                                    19=>array('table'=>'inclu_importador','function'  =>'writeIncImp'),
                                    20=>array('table'=>'inclu_planta_fabricante','function'=>'writeIncFab'),
                                    21=>array('table'=>'inclu_planta_env','function'=>'writeIncEnv'),
                                    22=>array('table'=>'inclu_cont_neto','function' =>'writeIncCont'),
                                    23=>array('table'=>'inclu_material','function'  =>'writeIncMat'),
                                    24=>array('table'=>'inclu_export','function'    =>'writeIncExp'),
                                    25=>array('table'=>'inclu_promocional','function'=>'writeIncPromo'),
                                    26=>array('table'=>'exclu_distribuidor','function'=>'writeExcDist'),
                                    27=>array('table'=>'exclu_importador','function'=>'writeExcImp'),
                                    28=>array('table'=>'exclu_planta_fabricante','function'=>'writeExcFab'),
                                    29=>array('table'=>'exclu_planta_env','function'=>'writeExcEnv'),
                                    30=>array('table'=>'exclu_cont_neto','function'=>'writeExcCont'),
                                    31=>array('table'=>'exclu_material','function'=>'writeExcMat'),
                                    32=>array('table'=>'renovacion_registro','function'=>'writeRenova'),
                                    33=>array('table'=>'renovacion_registro','function'=>'writeRenova'),
                                    34=>array('table'=>'producto_zona','function'=>'writeZonas'),
                                    35=>array('table'=>'renovacion_registro','function'=>'writeRenova'),
                                    40=>array('table'=>'inclu_pres_zonacomer','function'=>'writeIncLiZona')
                                    );

                             

             $dat = $arrDestino[$typeSol];

           return $dat; 
        }


  /*"INCLUSIÓN DE NUEVO IMPORTADOR"*/

  private function getRecNotifica($table,$sql,$sw){
         
         $query   = $this->dbAux->pgquery($sql);
         
         $numRows = $this->dbAux->pgNumrows($query);
            
         if($numRows > 0){
            if($sw == 1){
              for($k =0;$k<$numRows;$k++){
                  $row[$k] = @pg_fetch_array($query,$k); 
                  
              } 
            }else{
              //Busca la Info de Notificacion
              $row = $this->dbAux->pgfetch($query);  
            }
         }else{
            $row = null;
         }

     return $row;
  }

  /*Get del Tipo de Empresa*/
  private function getTipoEmp($id_empresa,$n_ref){

             
       $sql   = "SELECT id_categoria_solicitud
                   FROM solicitud
                  WHERE id_solicitud =".$n_ref.";";
      
       $query   = $this->dbAux->pgquery($sql);
       $numRows = $this->dbAux->pgNumrows($query);
       
       if($numRows > 0 ){
           $row = $this->dbAux->pgfetch($query);
           $cat = $row['id_categoria_solicitud'];
           
           if($cat == 1 || $cat == 3){
              
              $sql2   = "SELECT id_tipo_empresa
                           FROM empresa_nacional
                          WHERE id_empresa =".$id_empresa.";";
             
              $query2   = $this->dbAux->pgquery($sql2);
              $numRows2 = $this->dbAux->pgNumrows($query2);
              
              if($numRows2 > 0){
                 
                 $row2  = $this->dbAux->pgfetch($query2);
                 $nTipo = $row2["id_tipo_empresa"]; 
                 
              }            
           }else{

              $nTipo = 2;
           } 
       }
          
    return $nTipo;              
  }

  public function incl_importador($nroSol){
       $db  = Database::getInstance();
       $sql ="SELECT * 
                FROM inclu_importador 
               WHERE id_solicitud = ".$nroSol." ;";

       $query = @pg_query($sql);
       $numR  = @pg_num_rows($query);

      if($numR > 0){
         $row = @pg_fetch_array($query);
         $arrSol = array("id_empresa"=>$row["id_empresa"],
                         "id_tipo_empresa"=>$row["id_tipo_empresa"]);
      }
     return  $arrSol;
  }

  /*INCLUSIÓN DE NUEVA PRESENTACIÓN DE CONTENIDO NETO*/
  public function incl_contenido($nroSol){
       $db  = Database::getInstance();
       $sql ="SELECT * 
                FROM inclu_cont_neto 
               WHERE id_solicitud = ".$nroSol." ;";

       $query = @pg_query($sql);
       $numR  = @pg_num_rows($query);

      if($numR > 0){
        for($t=0; $t < $numR;$t++){
          $row   = pg_fetch_array($query,$t);
          $arrSol[$t] = array("n_contenido_neto"=>$row["n_contenido_neto"],
                         "id_unidad_medida"=>$row["id_unidad_medida"],
                         "d_unidad_medida" => $this->unMedida($row["id_unidad_medida"]),
                         "d_observacion"=>$row["d_observacion"]);
        } 
      }
     return  $arrSol;
  }

  /*INCLUSIÓN DE NUEVA PRESENTACIÓN DE MATERIAL DE ENVASE O EMPAQUE*/
  public function incl_envase($nroSol){
       $db  = Database::getInstance();
       $sql ="SELECT * 
                FROM inclu_material 
               WHERE id_solicitud = ".$nroSol." ;";

       $query = @pg_query($sql);
       $numR  = @pg_num_rows($query);

      if($numR > 0){
         $row = @pg_fetch_array($query);
         $arrSol = array("d_material_contenedor"=>$row["d_material_contenedor"],
                         "d_uso"=>$row["d_uso"],
                         "n_otorgado_higiene" =>$row["n_otorgado_higiene"],
                         "f_otorgado_higiene"=>$row["f_otorgado_higiene"]);
      }
     return  $arrSol;
  }

  /*INCLUSIÓN DE NUEVA PRESENTACIÓN EXCLUSIVA PARA EXPORTACIÓN*/
  public function incl_presExp($nroSol){
       $db  = Database::getInstance();
       $sql ="SELECT * 
                FROM inclu_export 
               WHERE id_solicitud = ".$nroSol." ;";

       $query = @pg_query($sql);
       $numR  = @pg_num_rows($query);

      if($numR > 0){
         $row = @pg_fetch_array($query);
         $arrSol = array("d_material_contenedor"=>$row["d_material_contenedor"],
                         "d_nombre_prod"=>$row["d_nombre_prod"],
                         "d_marca_prod" =>$row["d_marca_prod"],
                         "n_contenido_neto"=>$row["n_contenido_neto"],
                         "id_unidad_medida"=>$row["id_unidad_medida"],
                         "d_unidad_medida" => $this->unMedida($row["id_unidad_medida"]),
                         "id_pais"=>$row["id_pais"],
                         "d_pais" => $this->findPais($row["id_pais"]));
      }
     return  $arrSol;
  }

  /*INCLUSIÓN DE NUEVA PRESENTACIÓN PROMOCIONAL*/
  public function incl_promocion($nroSol){
       $db  = Database::getInstance();
       $sql ="SELECT * 
                FROM inclu_promocional 
               WHERE id_solicitud = ".$nroSol." ;";

       $query = @pg_query($sql);
       $numR  = @pg_num_rows($query);

      if($numR > 0){
         $row = @pg_fetch_array($query);
         $arrSol = array("f_promo_desde"=>$row["f_promo_desde"],
                         "f_promo_hasta"=>$row["f_promo_hasta"],
                         "d_nombre_promo" =>$row["d_nombre_promo"],
                         "n_contenido_neto"=>$row["n_contenido_neto"],
                         "id_unidad_medida"=>$row["id_unidad_medida"],
                         "d_unidad_medida" => $this->unMedida($row["id_unidad_medida"]),
                         "id_zona_comer"=>$row["id_zona_comer"]);
      }
     return  $arrSol;
  }

  //Arreglo los Arrays
    private function getStringA($arr){
    $a = "";  
    for ($i=0; $i < count($arr); $i++) { 
      if ($i == 0) {
        $a.= $arr[$i];    
      }else{
        if ($i == count($arr)-1) {
          $a.= " , ".$arr[$i];
        }else{
          $a.= ", ".$arr[$i]; 
        }
      }
    }
  } //Fin Function 

  //////////////////////NUEVOS CODIGO PARA ENVASE Y EMPAQUE
   public function netoEnvaseOficEE($nroSol){ //nuevo
        $db = Database::getInstance();
          $sql = "SELECT * FROM composicion_ee cee,unidad_medida um 
                          WHERE cee.id_unidad_medida = um.id_unidad_medida
                            AND id_solicitud = ".$nroSol.";";

        $query   = $db->pgquery($sql);
        $numRows = $db->pgNumrows($query);

        if($numRows > 0){

           for($i = 0;$i < $numRows;$i++){

               $row = @pg_fetch_array($query,$i);

                $arrComp[$i] = array('id_solicitud' => $row['id_solicitud'],
                            'd_componente'          => $row['d_componente'],
                                'cant_componente'   => $row['cant_componente'],
                               'id_unidad_medida'   => $row['id_unidad_medida'],
                                      'd_funcion'   => $row['d_funcion'],
                                   'id_proveedor'   => $row['id_proveedor'],
                               'id_materia_prima'   => $row['id_materia_prima'],
                                    'id_producto'   => $row['id_producto'],
                                      'd_materia'   => $row['d_materia'],
                                 'id_epresa_prov'   => $row['id_epresa_prov'],
                                'id_tipo_empresa'   => $row['id_tipo_empresa'],
                                     'nro_oficio'   => $row['nro_oficio'],
                                     'd_unidad_medida'   => $row['d_unidad_medida'],
                                     'f_autoriza'   => $row['f_autoriza'],
                                          'simbolo' => $this->unMedida($row['id_unidad_medida'])  
                                   );  
           }
         return $arrComp;    
        }           
   }
 //nuevo codigo para los producto DE ENVASE Y EMPAQU //////////////////////////////////////////////////////
    public function detProducto_ee(){
    $db  = Database::getInstance();

    $sql = "SELECT * FROM producto_ee pee,clase_prod_ee cee,solicitud sol 
                       WHERE  pee.id_clase_ee = cee.id_clase_ee 
                         AND  pee.id_solicitud = sol.id_solicitud
                         AND pee.id_solicitud=".$this->solRefer.";";

      $query = $db->pgquery($sql);
      $numR  = $db->pgNumrows($query);

      if($numR > 0){
         $row = $db->pgfetch($query);
       //Capturo los datos
         $arrProd = array("id_producto_ee" =>$row["id_producto_ee"],
                             "id_solicitud" =>$row["id_solicitud"],
                             "id_tipo_prod" =>$row["id_tipo_prod"],
                             "id_clase_ee" =>$row["id_clase_ee"],
                             "d_denomina" =>$row["d_denomina"],
                             "d_marca" =>$row["d_marca"],
                             "d_uso" =>$row["d_uso"], 
                             "d_clase_prod" =>$row["d_clase_prod"],
                             "id_forma_elaboracion" =>1,
                             "id_categoria_solicitud" =>$row["id_categoria_solicitud"],
                             "d_producto" =>$row["d_producto"], 
                             "id_origen_prod" =>$row["id_origen_prod"]);

      }
     return  $arrProd;
  }

//FUNCIONES PRODUCTOS ENVASES EMPAQUES (NUEVO)

  public function detProductoEnvase($nro){ //Detalles del producto

      $db  = Database::getInstance();
     //Hago La Consulta SQL
      $sql = "SELECT *
              FROM producto_ee pee, clase_prod_ee cpe
              WHERE id_solicitud =".$nro." 
              AND pee.id_clase_ee = cpe.id_clase_ee";

      $query = $db->pgquery($sql);
      $numR  = $db->pgNumrows($query);

      if($numR > 0){
         $row = $db->pgfetch($query);
       //Capturo los datos
         $arrProduct = array("id_solicitud"          =>$row["id_solicitud"],
                             "id_tipo_prod"         =>$row["id_tipo_prod"],
                             "d_tipo_prod"          =>$this->dProducto($row["id_tipo_prod"]),
                             "id_clase_prod"        =>$row["id_clase_prod"],
                             "d_clase_prod"         =>$row["d_clase_prod"],
                             "d_uso"                =>$row["d_uso"],
                             "id_origen_prod"       =>$row["id_origen_prod"],
                             "d_denomina"           =>$row["d_denomina"],
                             "d_marca"              =>$row["d_marca"]);

        if (isset($row["id_forma_elaboracion"])) {
          $arrProduct2 = array("id_forma_elaboracion"=>$row["id_forma_elaboracion"],
                                "d_forma_elaboracion"=>$this->formaElaboracion($row["id_forma_elaboracion"]));
          $arrProduct = array_merge($arrProduct,$arrProduct2);
        }
         //Envio la Respuesta
           return $arrProduct;
      }
  }


  public function ConsulEmpresa($nro){ //Empresa, id y tipo

      $db  = Database::getInstance();
     //Hago La Consulta SQL
      $sql = "SELECT * FROM solicitud_empresa WHERE id_solicitud = ".$nro." ";

      $query = $db->pgquery($sql);
      $numR  = $db->pgNumrows($query);
      $row = $db->pgfetch($query);
      $arrProv = array("id_empresa" =>$row["id_empresa"],
                           "id_tipo_empresa" =>$row["id_tipo_empresa"]); 

         //Envio la Respuesta
           return $arrProv;
      }


  public function ConsulEmpresaEE($nro){ //Empresa, id y tipo

      $db  = Database::getInstance();
     //Hago La Consulta SQL
      $sql = "SELECT * FROM solicitud_empresa WHERE id_solicitud = ".$nro." LIMIT 1 ";

      $query = $db->pgquery($sql);
      $numR  = $db->pgNumrows($query);
      $row = $db->pgfetch($query);
      $arrProv = array("id_empresa" =>$row["id_empresa"],
                           "id_tipo_empresa" =>$row["id_tipo_empresa"]); 

         //Envio la Respuesta
           return $arrProv;
      }

  public function ConsulEmpresaNacional($id){ //Empresa Nacional
      $db  = Database::getInstance();
     //Hago La Consulta SQL
      $sql = "SELECT en.*, e.d_estado FROM empresa_nacional en, estado e
      WHERE en.id_estado = e.id_estado 
      AND id_empresa = ".$id." ";

      $query = $db->pgquery($sql);
      $numR  = $db->pgNumrows($query);
      $row = $db->pgfetch($query);
          $arrProv = array("id_empresa" =>$row["id_empresa"],
                           "d_estado" =>$row["d_estado"],
                           "d_ciudad" =>$row["d_ciudad"],
                           "rif" =>$row["rif"],
                           "d_nombre" =>$row["d_nombre"]); 

         //Envio la Respuesta
           return $arrProv;
      }

  public function ConsulEmpresaExtranjera($id){ //Empresa Extranjera

      $db  = Database::getInstance();
     //Hago La Consulta SQL
      $sql = "SELECT ex.*, p.d_pais FROM empresa_extranjera ex, pais p 
              WHERE ex.id_pais = p.id_pais 
              AND ex.id_empresa_extranjera = ".$id." ";

      $query = $db->pgquery($sql);
      $numR  = $db->pgNumrows($query);

         $row = $db->pgfetch($query);

          $arrProv = array("id_empresa" =>$row["id_empresa"],
                           "id_empresa_extranjera" =>$row["id_empresa_extranjera"],
                           "d_pais" =>$row["d_pais"],
                           "d_ciudad" =>$row["d_ciudad"],
                           "d_nombre" =>$row["d_nombre"]); 

         //Envio la Respuesta

           return $arrProv;
      }

      //nuevo codigo para la relacion de producto_EE  y materia pri
  public function producto_uso($nroSol){

    /*$sql = "SELECT *
            FROM producto_ee
            WHERE id_solicitud =".$nroSol.";";*/
   $sql = "SELECT * FROM producto_ee pee ,materia_prima mp WHERE pee.id_solicitud = mp.id_solicitud 
          AND mp.id_solicitud =".$nroSol."; ";

    $query = pg_query($sql);
    $numR  = pg_num_rows($query);
    $producto_uso = array();
      if($numR > 0){
         for($i = 0; $i < $numR;$i++){
             $row = pg_fetch_array($query,$i);
              $producto_uso[$i] = array("id_producto_ee" => $row["id_producto_ee"],
                               "id_solicitud"   => $row["id_solicitud"],
                               "id_tipo_prod" => $row["id_tipo_prod"],
                               "id_clase_ee" => $row["id_clase_ee"],
                               "d_denomina" => $row["d_denomina"],
                               "d_marca" => $row["d_marca"],
                               "d_uso" => $row["d_uso"],
                               "f_autoriza"=> $this->fSalida($row["f_autoriza"]),
                               "id_origen_prod" => $row["id_origen_prod"],
                               "id_materia_prima" => $row["id_materia_prima"],
                               "id_producto" => $row["id_producto"],
                               "d_materia" => $row["d_materia"],
                               "id_empresa_prov" => $row["id_empresa_prov"],
                               "id_tipo_empresa" => $row["id_tipo_empresa"],
                               "nro_oficio" => $row["nro_oficio"],
                               "d_empresa_prov" =>$row["d_empresa_prov"]
                             );
                  }
      }

      return $producto_uso;

  }
 public function EquipoAlimentos($nroSol){
    /*$sql = "SELECT *
            FROM producto_ee
            WHERE id_solicitud =".$nroSol.";";*/
     $sql = "SELECT * FROM  producto_ee pe,equipo_alimento ea 
                     WHERE pe.id_solicitud = ea.id_solicitud
                       AND ea.id_solicitud =".$nroSol."; ";
    $query = pg_query($sql);
    $numR  = pg_num_rows($query);
   // $producto_uso = array();
      if($numR > 0){
         for($i = 0; $i < $numR;$i++){
             $row = pg_fetch_array($query,$i);
                $producto_uso[$i] = array("id_solicitud" => $row["id_solicitud"],
                                         "d_descripcion" => $row["d_descripcion"],
                                           "id_producto" => $row["id_producto"],
                                                 "d_uso" => $row["d_uso"],
                                             "id_status" => $row["id_status"]
            );
         }
      }

      return $producto_uso;
  } 
//FUNCIONES NUEVAS
 public function BuscarRegistroAli($nroSol){ //Alimentos

       $db  = Database::getInstance();

     $sql ="SELECT s.id_solicitud,s.f_solicitud,s.d_numero_sanitario,s.id_status_solicitud,s.id_categoria_solicitud,ts.d_tipo_solicitud,st.d_status_solicitud,st.d_status_abrev,cat.d_categoria_solicitud
              FROM solicitud s, tipo_solicitud ts, status_solicitud st, categoria_solicitud cat
              WHERE s.id_tipo_solicitud = ts.id_tipo_solicitud
              AND s.id_status_solicitud = st.id_status_solicitud
              AND s.id_tipo_solicitud = cat.id_tipo_solicitud 
              AND s.id_categoria_solicitud = cat.id_categoria_solicitud 
              AND ts.id_tipo_solicitud = cat.id_tipo_solicitud 
              AND s.d_numero_sanitario = '".$nroSol."' 
              ORDER BY id_solicitud ASC";

    $query = pg_query($sql);
    $numR  = pg_num_rows($query);
   // $producto_uso = array();
      if($numR > 0){
         for($i = 0; $i < $numR;$i++){
             $row = pg_fetch_array($query,$i);
                $arrDatos[$i] = array(       "id_solicitud" => $row["id_solicitud"],
                                             "d_numero_sanitario" => $row["d_numero_sanitario"],
                                             "f_solicitud" => $row["f_solicitud"],
                                             "d_tipo_solicitud" => $row["d_tipo_solicitud"],
                                             "d_status_solicitud" => $row["d_status_solicitud"],
                                             "d_status_abrev" => $row["d_status_abrev"],
                                             "d_categoria_solicitud" => $row["d_categoria_solicitud"],
                                             "id_categoria_solicitud" => $row["id_categoria_solicitud"],
                                             "numR" => $numR
            );
         }
      }

      return $arrDatos;
     // return $arreglo;
  } 
  //FUNCIONES NUEVAS
 public function BuscarRegistroEnvase($nroSol){ //Envase

       $db  = Database::getInstance();
     $sql =   "SELECT s.id_solicitud,s.f_solicitud,s.d_numero_sanitario,s.id_status_solicitud,s.id_categoria_solicitud,ts.d_tipo_solicitud,st.d_status_solicitud,st.d_status_abrev,cat.d_categoria_solicitud
              FROM solicitud s, tipo_solicitud ts, status_solicitud st, categoria_solicitud cat
              WHERE s.id_tipo_solicitud = ts.id_tipo_solicitud
              AND s.id_status_solicitud = st.id_status_solicitud
              AND s.id_tipo_solicitud = cat.id_tipo_solicitud 
              AND s.id_categoria_solicitud = cat.id_categoria_solicitud 
              AND ts.id_tipo_solicitud = cat.id_tipo_solicitud 
              AND s.d_numero_sanitario = '".$nroSol."' 
              ORDER BY id_solicitud ASC";

    $query = pg_query($sql);
    $numR  = pg_num_rows($query);
   // $producto_uso = array();
      if($numR > 0){
         for($i = 0; $i < $numR;$i++){
             $row = pg_fetch_array($query,$i);
                $arrDatos[$i] = array("id_solicitud" => $row["id_solicitud"],
                                      "f_solicitud" => $row["f_solicitud"],
                                      "d_numero_sanitario" => $row["d_numero_sanitario"],
                                      "d_tipo_solicitud" => $row["d_tipo_solicitud"],
                                      "d_status_solicitud" => $row["d_status_solicitud"],
                                      "d_status_abrev" => $row["d_status_abrev"],
                                      "d_categoria_solicitud" => $row["d_categoria_solicitud"],
                                      "id_categoria_solicitud" => $row["id_categoria_solicitud"],
                                       "numR" => $numR
            );
         }
      }

      return $arrDatos;

     // return $arreglo;
  } 

 public function Composicion_EE($nroSol){ //Composicion EE

       $db  = Database::getInstance();
     $sql =   "SELECT id_solicitud, d_componente FROM composicion_ee WHERE id_solicitud = ".$nroSol." ";

    $query = pg_query($sql);
    $numR  = pg_num_rows($query);
   // $producto_uso = array();
      if($numR > 0){
         for($i = 0; $i < $numR;$i++){
             $row = pg_fetch_array($query,$i);
             $Componente[$i] = $row["d_componente"]; //Convertimos el arreglo en cadena separados por comaS
             $arrDatos = implode(", ",$Componente);
         }
      }
      return $arrDatos;
  } 





//NUEVOS METODOS PARA ENVASE Y /O ENVASE

public function EmpresasEnv(){

         $db = Database::getInstance();
        //Inicializo la Variable
          $sql = "SELECT id_solicitud_empresa,id_empresa,id_actividad,
                         id_tipo_empresa,n_planta
                    FROM solicitud_empresa
                   WHERE id_solicitud =".$this->solRefer." LIMIT 1;";

            $query = $db->pgquery($sql);
            $numR  = $db->pgNumrows($query);
           
               $row = $db->pgfetch($query);
               $Empresa = $row["id_empresa"];

         return $Empresa; 
      }

      public function findExtranjeraEnva($InfoE){

         $db = Database::getInstance();

             //Inicializo el Arreglo para que guarde
             //Busqueda SQL
             $sql = "SELECT *
                       FROM empresa_extranjera
                      WHERE id_empresa_extranjera =".$InfoE.";";

             $query = pg_query($sql);
             $numR  = pg_num_rows($query);

               $row = $db->pgfetch($query);
               $Empresa = $row["d_nombre"]; 

         return $Empresa;
      }



      public function Extraer_Solicitud($nro){

         $db = Database::getInstance();

             //Inicializo el Arreglo para que guarde
             //Busqueda SQL
             $sql = "SELECT id_solicitud, d_numero_sanitario, f_solicitud
                       FROM solicitud
                      WHERE d_numero_sanitario ='".$nro."';";

             $query = pg_query($sql);
             $numR  = pg_num_rows($query);

               $row = $db->pgfetch($query);
               $Soli = $row["id_solicitud"];


             $sql1 = "SELECT d_denomina
                       FROM producto_ee
                      WHERE id_solicitud =".$Soli.";";

             $query1 = pg_query($sql1);

               $row1 = $db->pgfetch($query1);
               $Deno = $row1["d_denomina"];

               $ArrDatos = array('d_denomina'=>$row1["d_denomina"],'d_numero_sanitario'=>$row["d_numero_sanitario"],'id_solicitud'=>$row["id_solicitud"],'f_solicitud'=>$row["f_solicitud"]);

         return $ArrDatos;
      }


//SOLO PARA ENVASE Y O EMPAQUE

      public function Solicitud_Empresa_EE(){ //OBTENER DATOS DE LA SOLICITUD EMPRESA
      $db   = Database::getInstance();
      $cmll = new formularioRules();
      $sql="INSERT INTO solicitud_empresa
              ( id_solicitud,id_tipo_solicitud,n_solicitud_ref,d_numero_registro,d_denomina_anterior,d_denomina_actual,d_observacion)
      VALUES ((SELECT max(id_solicitud) FROM solicitud),".$this->tipSol.",".$this->nSolRef.",'".$this->numReg."','".$cmll->comilla($this->denom_ant)."','".$cmll->comilla($this->denom_act)."','".$cmll->comilla($this->obser)."');
          "; 
  
      $query   = $db->pgquery($sql);
      return $query;
    }


      public function Cambio_Denominacion_EE($nro){ //OBTENER DATOS CAMBIO DENOMINACION ENVASE EMPAQUE

      $db   = Database::getInstance();
      $sql="SELECT * FROM cambio_denominacion_ee WHERE id_solicitud = ".$nro." "; 

      $query = $db->pgquery($sql);

      $row = $db->pgfetch($query);

      $ArrDatos = array('d_denomina_anterior'=>$row["d_denomina_anterior"],'d_denomina_actual'=>$row["d_denomina_actual"]);

      return $ArrDatos;
     
      }

      public function Cambio_Razon_EE($nro){ //OBTENER CAMBIO RAZON TITULAR ENVASE Y EMPAQUE

      $db   = Database::getInstance();

      $sql="SELECT * FROM cambio_razon_ee WHERE n_solicitud_ref = ".$nro." "; 

      $query = $db->pgquery($sql);
      
      $row = $db->pgfetch($query);

      $ArrDatos = array('d_empresa_anterior'=>$row["d_empresa_anterior"],'d_empresa_actual'=>$row["d_empresa_actual"]);

      return $ArrDatos;
      
      }

       //consultas para los cambio de denominacion de envase y Empaque
    public function Cambio_Deno_ee(){
    $db  = Database::getInstance();
    $sql = "SELECT * FROM cambio_denominacion_ee WHERE n_solicitud_ref=".$this->solRefer." ORDER BY id_cambio_denomina_ee DESC LIMIT 1; ";
    $query = $db->pgquery($sql);
    $numR  = $db->pgNumrows($query);
      if($numR > 0){
         $row = $db->pgfetch($query);
       //Capturo los datos
         $arrProd = array("id_cambio_denomina_ee" =>$row["id_cambio_denomina_ee"],
                          "d_denomina_anterior" =>$row["d_denomina_anterior"],
                          "d_denomina_actual" =>$row["d_denomina_actual"]);

      }
     return  $arrProd;
  }
  public function Cambio_Raz_ee(){
    $db  = Database::getInstance();
    $sql = "SELECT * FROM cambio_razon_ee WHERE n_solicitud_ref=".$this->solRefer." ORDER BY id_cambio_razon_ee DESC LIMIT 1; ";
    $query = $db->pgquery($sql);
    $numR  = $db->pgNumrows($query);
      if($numR > 0){
         $row = $db->pgfetch($query);
       //Capturo los datos
         $arrProd = array("id_cambio_razon_ee" =>$row["id_cambio_razon_ee"],
                          "d_empresa_anterior" =>$row["d_empresa_anterior"],
                          "d_empresa_actual" =>$row["d_empresa_actual"]);

      }
     return  $arrProd;
  }


} //Fin de dataProduct

?>