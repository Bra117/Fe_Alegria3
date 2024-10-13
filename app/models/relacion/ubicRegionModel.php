<?php
  class ubicRegionModel extends Model{
    public static $estado    = "estado";
    public static $municipio = "municipio";
    public static $parroquia = "parroquia";

    public function __contruct(){
          parent::__construct();
    }

    public function ubicRegionModel(){
      $this->id_e    = "";
      $this->id_m    = "";
      $this->id_p    = "";

      $this->created_at   = "NOW()";
    }

    //CONSULTAS////////////////////////////////////////////////////////

    public function MunParrEst($val){
      $db  = Database::getInstance();

      $sql = "SELECT e.id_estado,e.d_estado,m.id_municipio,
                m.d_municipio,p.id_parroquia,p.d_parroquia 
              FROM ".self::$estado." e, ".self::$municipio." m, ".self::$parroquia." p
              WHERE e.id_estado = ".$this->id_e."
              AND m.id_municipio = ".$this->id_m."
              AND p.id_parroquia = ".$this->id_p."
              AND e.id_estado = m.id_estado
              AND m.id_municipio = p.id_municipio
              ";

      $query   = $db->pgquery($sql);
      $row     = $db->pgfetch($query);
      $numRows = $db->pgNumrows($query);
      switch ($val) {
        case 'row':
          return $row;
        break;
        case 'numRows':
          return $numRows;
        break;
        case 'query':
          return $query;
        break;
      }
    }

    
} //Fin Modelo

?>