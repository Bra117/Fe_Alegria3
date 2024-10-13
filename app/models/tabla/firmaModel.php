<?php
  class firmaModel extends Model{
    public static $tablename = "firma";

    public function __contruct(){
          parent::__construct();
    }

    public function firmaModel(){
      $this->idSol = "";

      $this->created_at   = "NOW()";
    }

    //CONSULTAS////////////////////////////////////////////////////////

    public function getById(){
      $db  = Database::getInstance();

      $sql = "SELECT * FROM ".self::$tablename."
              WHERE id_solicitud = ".$this->idSol."; ";

      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

} //Fin Modelo

?>