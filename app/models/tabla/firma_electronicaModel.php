<?php
  class firma_electronicaModel extends Model{
    public static $tablename = "firma_electronica";

    public function __contruct(){
          parent::__construct();
    }

    public function firma_electronicaModel(){
      $this->cedula = "";

      $this->created_at   = "NOW()";
    }

    //CONSULTAS////////////////////////////////////////////////////////

    public function getByUser(){
      $db  = Database::getInstance();

      $sql = "SELECT * FROM ".self::$tablename."
              WHERE user_firma = '".$this->cedula."'; ";

      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

} //Fin Modelo

?>