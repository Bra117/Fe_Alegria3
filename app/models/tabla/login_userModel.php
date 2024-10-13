<?php
  class login_userModel extends Model{

    public function __contruct(){
          parent::__construct();

    }

    public function login_userModel(){

      $this->db = DatabaseCon::getInstance();

    }

    public function getLoginUser($cedula,$password){


      ///$sql = "SELECT * FROM personas WHERE cedula = '".$cedula."' ";


      $sql = " Select CONCAT (per.nombre, ' ', per.apellido) AS full_name, per.id_rol, rol.d_rol,  per.contrasena, per.cedula from personas per
        Inner Join roles rol  ON rol.id_rol = per.id_rol
        WHERE per.cedula = '".$cedula."'
        AND per.contrasena = '".$password."'
     UNION ALL
        Select CONCAT (adm.nombre, ' ', adm.apellido) AS full_name1, adm.id_rol, rol.d_rol,  adm.contrasena, adm.cedula_pasaporte from administradores adm
        Inner Join roles rol  ON rol.id_rol = adm.id_rol
        WHERE adm.cedula_pasaporte = '".$cedula."'
        AND adm.contrasena = '".$password."'; ";

      /*$sql = "SELECT * FROM  administradores adm 
      INNER JOIN rol_funcionario rfun ON rfun.id_admin =adm.id_admin
      INNER JOIN roles rol ON rol.id_rol =rfun.id_rol
      WHERE adm.cedula_pasaporte = '".$cedula."' 
      AND contrasena ='".$pass."' ";*/
      //var_dump($sql);
     // var_dump($sql);
      $arrData   = $this->getResult($sql,$this->db);
    return $arrData;                          
    }
} //Fin Modelo
?>