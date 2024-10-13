<?php
  class relSolicitudModel extends Model{
    public static $solicitud      = "solicitud";
    public static $tipo_solicitud = "tipo_solicitud";
    public static $categoria      = "categoria_solicitud";
    public static $detalle        = "detalle_categoria";
    public static $producto       = "producto";
    public static $status         = "status_solicitud";

    public function __contruct(){
          parent::__construct();
    }

    public function relSolicitudModel(){
      
      $this->area     = "";
      $this->coord    = "";
      $this->idUser   = "";
      $this->dStatus  = "";
      $this->tipCat   = "";
      $this->tipPro   = "";
      $this->oriPro   = "";
      $this->elaPro   = "";
      $this->created_at   = "NOW()";
    }

    //CONSULTAS////////////////////////////////////////////////////////

    public function getByStatus(){
      $db  = Database::getInstance();

           $sql = "SELECT s.f_status,s.id_tipo_solicitud,s.id_solicitud,s.f_solicitud,s.d_numero_sanitario,s.id_status_solicitud,ts.d_tipo_solicitud,st.d_status_solicitud,st.d_status_abrev,cat.d_categoria_solicitud
              FROM ".self::$solicitud." s, ".self::$tipo_solicitud ." ts, ".self::$status." st, ".self::$categoria." cat
              WHERE s.id_tipo_solicitud = ts.id_tipo_solicitud
              AND s.id_status_solicitud = st.id_status_solicitud
              AND s.id_usuario = ".$this->idUser."
              AND s.id_status_solicitud IN( ".$this->dStatus." )
              AND s.id_area = ".$this->area."
              AND s.id_coordinacion = ".$this->coord."
              AND s.id_status = 1
              AND s.id_tipo_solicitud = cat.id_tipo_solicitud 
              AND s.id_categoria_solicitud = cat.id_categoria_solicitud 
              AND ts.id_tipo_solicitud = cat.id_tipo_solicitud 
              ORDER BY id_solicitud ASC;";
      
      $query = array('query'=>$db->pgquery($sql),
                      'row'=>$db->pgfetch($db->pgquery($sql)),
                      'numRows'=>$db->pgNumrows($db->pgquery($sql))
                    );

      return $query;
    }


    /*public function getByStatus(){ codigo original
      $db  = Database::getInstance();

      $sql = "SELECT s.id_solicitud,s.f_solicitud,s.d_numero_sanitario,s.id_status_solicitud,ts.d_tipo_solicitud,st.d_status_solicitud,st.d_status_abrev
              FROM ".self::$solicitud." s, ".self::$tipo_solicitud ." ts, ".self::$status." st
              WHERE s.id_tipo_solicitud = ts.id_tipo_solicitud
              AND s.id_status_solicitud = st.id_status_solicitud
              AND s.id_usuario = ".$this->idUser."
              AND s.id_status_solicitud IN( ".$this->status." )
              AND s.id_area = ".$this->area."
              AND s.id_coordinacion = ".$this->coord."
              AND s.id_status = 1
              ORDER BY id_solicitud ASC;";

      $query = array('query'=>$db->pgquery($sql),
                      'row'=>$db->pgfetch($db->pgquery($sql)),
                      'numRows'=>$db->pgNumrows($db->pgquery($sql))
                    );
      return $query;
    }*/

    public function solByPago(){
      $db  = Database::getInstance();
      $sql = "SELECT * FROM ".self::$solicitud." s, ".self::$categoria." c
                WHERE s.id_status_solicitud ".$this->dStatus."
                 AND s.id_usuario = ".$this->idUser."
                  AND s.id_categoria_solicitud = c.id_categoria_solicitud
                   AND s.id_categoria_solicitud  NOT IN(41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59)
                   ORDER BY s.id_solicitud DESC;";
      $query = array('query'=>$db->pgquery($sql),
                      'row'=>$db->pgfetch($db->pgquery($sql)),
                      'numRows'=>$db->pgNumrows($db->pgquery($sql))
                    );
      return $query; 
    }

    /*  public function solByPago(){ codigo original
      $db  = Database::getInstance();

      $sql = "SELECT * FROM ".self::$solicitud." s, ".self::$categoria." c
                WHERE s.id_status_solicitud ".$this->status."
                 AND s.id_usuario = ".$this->idUser."
                  AND s.id_categoria_solicitud = c.id_categoria_solicitud
                   ORDER BY s.id_solicitud DESC;";
      $query = array('query'=>$db->pgquery($sql),
                      'row'=>$db->pgfetch($db->pgquery($sql)),
                      'numRows'=>$db->pgNumrows($db->pgquery($sql))
                    );
      return $query; 
    }*/

    public function utByPago(){
      $db  = Database::getInstance();

      $sql = "SELECT * FROM detalle_categoria
                    WHERE elaboracion = ".$this->elaPro."
                      AND id_categoria_solicitud = ".$this->tipCat."
                        AND id_tipo_prod = ".$this->tipPro."
                          AND id_origen_prod = ".$this->oriPro."
                            AND id_status = 1;";

      $query = array('query'=>$db->pgquery($sql),
                      'row'=>$db->pgfetch($db->pgquery($sql)),
                      'numRows'=>$db->pgNumrows($db->pgquery($sql))
                    );
      return $query; 
    }

    //Busca tarifa por categoria 
      public function getTarifaSol($cat){
       
          $db  = Database::getInstance();

          $sql = "
                  SELECT cantidad  
                    FROM detalle_categoria
                   WHERE id_categoria_solicitud = ".$cat.";  
                 
          ";

         $query =  $db->pgquery($sql);
         
         if($query){
            $row      = $db->pgfetch($query);
            $tarifa   = $row['cantidad'];

            return $tarifa;
         }else{
           return false;
         }  

      }
//codigo para envase y enpaquw
      public function solByPagoEnv(){
      $db  = Database::getInstance();

      $sql = "SELECT * FROM ".self::$solicitud." s, ".self::$categoria." c
                WHERE s.id_status_solicitud ".$this->dStatus."
                 AND s.id_usuario = ".$this->idUser."
                  AND s.id_categoria_solicitud = c.id_categoria_solicitud
                  AND s.id_categoria_solicitud  IN(41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58)
                   ORDER BY s.id_solicitud DESC;";
      $query = array('query'=>$db->pgquery($sql),
                      'row'=>$db->pgfetch($db->pgquery($sql)),
                      'numRows'=>$db->pgNumrows($db->pgquery($sql))
                    );
      return $query; 
    }

    public function coordDetalle(){
      $db  = Database::getInstance();

      $sql = "SELECT * 
                FROM detalle_categoria dc, categoria_solicitud cs, tipo_producto tp, origen_producto op WHERE dc.id_categoria_solicitud = cs.id_categoria_solicitud 
                 AND cs.id_coordinacion = ".$this->coord."
                 AND dc.id_tipo_prod = tp.id_tipo_prod 
                 AND dc.id_origen_prod = op.id_origen_prod
                 AND dc.id_status = 1
                 ORDER BY dc.id_detalle ASC;";
      $query = array('query'=>$db->pgquery($sql),
                      'row'=>$db->pgfetch($db->pgquery($sql)),
                      'numRows'=>$db->pgNumrows($db->pgquery($sql))
                    );
      return $query; 
    }

    public function f_status_sol($num){
      $db  = Database::getInstance();
      $sql = " SELECT f_status FROM ".self::$solicitud."  WHERE id_solicitud ='$num' AND id_tipo_solicitud IN(1,2,3) ORDER BY id_solicitud DESC LIMIT 1;";

      $query = array('query'=>$db->pgquery($sql),
                      'row'=>$db->pgfetch($db->pgquery($sql)),
                      'numRows'=>$db->pgNumrows($db->pgquery($sql))
                    );

      return $query;
    }

} //Fin Modelo

?>
