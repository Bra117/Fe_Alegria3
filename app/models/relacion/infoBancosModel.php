<?php
  class infoBancosModel extends Model{
    public static $banco  = "banco"; 
    public static $cuenta = "cuenta_bancaria";

    public function __contruct(){
          parent::__construct();
    }

    public function infoBancosModel(){
      $this->idBan = "";
      $this->idCue = "";
      $this->tipo = "";
      $this->created_at   = "NOW()";
    }

    //CONSULTAS////////////////////////////////////////////////////////

    public function bancosUso(){
      $db  = Database::getInstance();

      $sql = "SELECT DISTINCT b.id_banco, b.d_banco 
              FROM ".self::$banco."  b, ".self::$cuenta."  c
              WHERE c.id_status = 1
              AND b.id_banco = c.id_banco
              AND id_tipo_pago = ".$this->tipo."
              ORDER BY b.d_banco ASC;";

      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

    public function cuentasbyBanco(){
      $db  = Database::getInstance();

      $sql = "SELECT * FROM ".self::$cuenta." 
              WHERE id_banco = ".$this->idBan."
              AND id_status = 1
              ORDER BY id_cuenta_bancaria ASC;";

      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

} //Fin Modelo

?>