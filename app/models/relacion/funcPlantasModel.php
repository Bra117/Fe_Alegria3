<?php
  class funcPlantasModel extends Model{
    public static $planta  = "planta_fabricante";
    public static $estado  = "estado";
    public static $sPlanta = "solicitud_planta";

    public function __contruct(){
          parent::__construct();
    }

    public function planta_fabricanteModel(){
      $this->idPlant = "";
      $this->idEmpr  = "";

      $this->created_at   = "NOW()";
    }

    //CONSULTAS////////////////////////////////////////////////////////

    public function allPlantas(){
      $db  = Database::getInstance();

      $sql ="SELECT p.*,es.d_estado 
              FROM ".self::$planta." p, ".self::$estado." es
                WHERE p.id_empresa = ".$this->idEmpr." 
                 AND p.id_estado = es.id_estado 
                  ORDER BY p.id_planta_fabricante ASC
            ;"; 
      
      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

    public function asigPlantas(){
      $db  = Database::getInstance();

      $sql ="SELECT p.*,es.d_estado
               FROM ".self::$planta." p, ".self::$estado." es
                WHERE p.id_empresa = ".$this->idEmpr." 
                  AND p.id_planta_fabricante IN(".$this->idPlant.")         
                  AND p.id_estado = es.id_estado 
                  ORDER BY p.id_planta_fabricante ASC
            ;"; 
      
      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

    public function othPlantas(){
      $db  = Database::getInstance();

      $sql ="SELECT p.*,es.d_estado
               FROM ".self::$planta." p, ".self::$estado." es
                WHERE p.id_empresa = ".$this->idEmpr." ";
        for ($k=0; $k < count($this->idPlant); $k++) { 
          $sql.="AND p.id_planta_fabricante <> ".$this->idPlant[$k]." ";          
        }        
      $sql.=" AND p.id_estado = es.id_estado 
                ORDER BY p.id_planta_fabricante ASC
            ;"; 
      
      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

    public function insertPlanta(){
      $db  = Database::getInstance();

      $sql ="SELECT *
               FROM ".self::$sPlanta."
               WHERE id_solicitud = (SELECT max(id_solicitud) FROM solicitud)
               AND id_empresa = ".$this->idEmpr."
               AND id_planta_fabricante = ".$this->idPlant."
            ";
      $numRows = $db->pgNumrows($db->pgquery($sql));
      if ($numRows > 0) {
        return false;
      }else{
        return true;
      }
    }

} //Fin Modelo

?>