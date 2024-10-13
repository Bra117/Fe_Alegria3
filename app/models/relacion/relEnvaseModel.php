<?php
  class relEnvaseModel extends Model{
    public static $envase       = "producto_envase";
    public static $presentacion = "producto_presentacion";
    public static $presentEnv   = "presentacion_envase";
    public static $unidad       = "unidad_medida";

    public function __contruct(){
          parent::__construct();
    }

    public function relEnvaseModel(){
      $this->idEnv   = "";
      $this->idPre   = "";
      $this->nSolRef = "";

      $this->created_at   = "NOW()";
    }

    //CONSULTAS////////////////////////////////////////////////////////

    public function getByAutEnv(){
      $db  = Database::getInstance();

      $sql = "SELECT * 
              FROM ".self::$envase." e, ".self::$presentacion ." p
              WHERE e.id_solicitud = (SELECT max(id_solicitud) FROM solicitud)
              AND e.id_solicitud = p.id_solicitud  
              AND e.id_autorizacion_envase = ".$this->idEnv.";";

      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

    public function getBySolEnv($caso){
      $db  = Database::getInstance();

      switch ($caso) {
        case 'noID':
          $sql = "SELECT DISTINCT pp.id_prod_presentacion,pp.contenido_neto,um.d_unidad_medida
              FROM ".self::$presentEnv." pe,".self::$presentacion." pp,".self::$unidad." um
               WHERE pe.id_solicitud = ".$this->nSolRef."
                AND pe.id_prod_presentacion = pp.id_prod_presentacion
                 AND pp.id_unidad_medida = um.id_unidad_medida;";
        break;
        case 'ID':
          $sql     = "SELECT pe.id_pres_envase,pp.contenido_neto,um.d_unidad_medida
                FROM ".self::$presentEnv." pe ,".self::$presentacion." pp,".self::$unidad." um
                WHERE pe.id_solicitud = ".$this->nSolRef."
                 AND pe.id_prod_envase = ".$this->idEnv." 
                  AND pe.id_prod_presentacion = pp.id_prod_presentacion
                   AND pp.id_unidad_medida = um.id_unidad_medida
                    ORDER BY pe.id_pres_envase ASC;
              ";
        break;
      }

      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

    public function getByEnvPre(){
      $db  = Database::getInstance();

      $sql = "SELECT pe.id_pres_envase,pp.contenido_neto,pp.id_unidad_medida
                 FROM ".self::$presentEnv." pe , ".self::$presentacion ." pp
                 WHERE pe.id_solicitud = ".$this->nSolRef."
                 AND pe.id_prod_envase = ".$this->idEnv." 
                 AND pe.id_pres_envase = ".$this->idPre."
                 AND pe.id_prod_presentacion = pp.id_prod_presentacion
                 ORDER BY pe.id_pres_envase ASC;";

      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

    public function getByEnv(){
      $db  = Database::getInstance();

      $sql = "SELECT pp.contenido_neto,um.d_unidad_medida
           FROM ".self::$envase." pv,".self::$presentEnv." pe,".self::$presentacion ." pp,".self::$unidad." um
              WHERE pe.id_solicitud = ".$this->nSolRef." 
               AND pv.id_prod_envase = ".$this->idEnv."
                AND pe.id_prod_presentacion = pp.id_prod_presentacion
                 AND pv.id_prod_envase = pe.id_prod_envase
                  AND pp.id_unidad_medida = um.id_unidad_medida;";

      $array   = array(   'query'=>$db->pgquery($sql),
                          'row'=>$db->pgfetch($db->pgquery($sql)),
                          'numRows'=>$db->pgNumrows($db->pgquery($sql))
                      );
      return $array;
    }

    
} //Fin Modelo

?>