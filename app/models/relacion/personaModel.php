<?php
  class personaModel extends Model{
    public static $estado    = "estado";
    public static $municipio = "municipio";
    public static $parroquia = "parroquia";

    public function __contruct(){
          parent::__construct();
    }

    public function personaModel(){
      $this->db    = Database::getInstance();


    }

    function getPersonByCed($cedula){


    }

    function insertPersona($arrPerson){


    }

    function getallPerson(){


    }

    function updatePersona($arrPerson){


    }

    


    
} //Fin Modelo

?>