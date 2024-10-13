<?php
  class exonerar_Model extends Model{
    public static $tablename = "unidad_medida";

    public function __contruct(){
          parent::__construct();
    }

    public function setExonera($nroSol){
      $db  = Database::getInstance();
      //Busca los Datos Requeridos
      $sql = "SELECT * FROM ".self::$tablename." 
              WHERE id_status = 1
              ORDER BY id_unidad_medida ASC;";

      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

} //Fin Modelo

?>