<?php
  class permEstabModel extends Model{
    public static $solicitud  = "solicitudes";
    public static $estab      = "establecimientos";


    public function __contruct(){
          parent::__construct();
    }

    public function permEstabModel(){
      $this->rif       = "";
      $this->nro       = "";
      $this->estado    = "";
      $this->tipSol    = "";
      $this->condicion = "";
      $this->status    = "";

      $this->created_at   = "NOW()";
    }

    //CONSULTAS////////////////////////////////////////////////////////

    public function getByPermiso(){
      $db  = DatabaseSV::getInstance();

      $sql = "SELECT * 
              FROM ".self::$solicitud." 
              WHERE nro_permiso = '".$this->nro."'
              AND rif_placa = '".$this->rif."' ;";

      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

    public function ubicByPermiso($caso){
      $db  = DatabaseSV::getInstance();

      $sql = "SELECT * 
              FROM ".self::$solicitud." s, ".self::$estab." e
              WHERE s.nro_permiso = '".$this->nro."'
              AND  s.nro_solicitud = e.nro_solicitud ";

      switch ($caso) {
        case 'nroSol':
          $sql.= "AND  s.nro_solicitud = ".$this->nSolRef." ;";
        break;
      }
      
      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

    public function uniSolPerm(){
      $db  = DatabaseSV::getInstance();

      $sql = "SELECT * 
              FROM ".self::$solicitud." s
              WHERE s.cod_tipos_solicitudes ".$this->tipSol."
              AND s.nro_solicitud= (SELECT nro_solicitud FROM solicitudes WHERE nro_permiso='".$this->nro."' AND cod_status >=9
              ORDER BY nro_solicitud ".$this->condicion." LIMIT 1)
              AND s.rif_placa = '".$this->rif."'
              AND s.cod_status ".$this->status."
             ";

      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }
    
} //Fin Modelo

?>