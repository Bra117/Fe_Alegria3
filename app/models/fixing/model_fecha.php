<?php

/*

NOMBRE DEL MODELO: model_fecha.php

DESCRIPCION: Busca y edita el campo de la fecha del registro original 

*/

  class model_fecha extends Model{

    public function __contruct(){
          parent::__construct();

    }


   //Ejecuta las variables 

   public function model_fecha(){

      $db  = Database::getInstance();

   } 

   //Busca los datos del Registro 

    public function getFecha($val){ //Hacemos la busqueda completa

      $sql  = "SELECT * 
                 FROM solicitud 
                WHERE d_numero_sanitario ='".$val."';";

     $query = $db->pgquery->($sql);
     $row   = $db->pgfetch->($query);

     $fecha = $row['f_status'];         
           
      return $fecha;

     } //Fin del Metodo 



     function MostrarUnidadEsp($val1){ //Mostramos las unidades de medidas especificas

        $db  = Database::getInstance();
        
        $sql_uni = "SELECT * FROM unidad_medida WHERE id_unidad_medida = ".$val1." ";

        $query_uni = $db->pgquery($sql_uni);
       
        $numRows = $db->pgNumrows($query_uni);

        $row_uni    = $db->pgfetch($query_uni);

        $arrDat = array('id_unidad_medida' =>$row_uni['id_unidad_medida'],'d_unidad_medida' =>$row_uni['d_unidad_medida'],'numRows' =>$numRows);

        return $arrDat;

     }

     function MostrarUnidad(){ //Mostramos las unidades de medidas

        $db  = Database::getInstance();
        
        $sql_uni = "SELECT * FROM unidad_medida ";

        $query_uni = $db->pgquery($sql_uni);
       
        $numRows = $db->pgNumrows($query_uni);

        for($j=0;$j<$numRows;$j++){

        $row_uni  = pg_fetch_array($query_uni,$j);

        $arrDat[$j] = array('id_unidad_medida' =>$row_uni['id_unidad_medida'],'d_unidad_medida' =>$row_uni['d_unidad_medida'],'numRows' =>$numRows);

        }

        return $arrDat;

     }



     function MostrarFormas($id){ //Mostramos las formas de envase

        $db  = Database::getInstance();
        
        $sql_form = "SELECT d_desc_envase, id_prod_envase FROM producto_envase WHERE  id_solicitud = ".$id." ";

        $query_form = $db->pgquery($sql_form);
       
        $numRows = $db->pgNumrows($query_form);

        for($j=0;$j<$numRows;$j++){

        $row_form  = pg_fetch_array($query_form,$j);

        $arrDat[$j] = array('id_prod_envase' =>$row_form['id_prod_envase'],'d_desc_envase' =>$row_form['d_desc_envase'],'numRows' =>$numRows);

        }

        return $arrDat;

     }

    function MostrarFormaEsp($val){ //Mostramos las formas de envase

        $db  = Database::getInstance();
        
        $sql_form = "SELECT d_desc_envase, id_prod_envase FROM producto_envase WHERE  id_prod_envase = ".$val." ";

        $query_form = $db->pgquery($sql_form);
       
        $numRows = $db->pgNumrows($query_form);

        $row_form    = $db->pgfetch($query_form);

        $arrDat = array('id_prod_envase' =>$row_form['id_prod_envase'],'d_desc_envase' =>$row_form['d_desc_envase'],'numRows' =>$numRows,'sql_form'=>$sql_form);

        return $arrDat;

     }


    function ExtraerAuto($val){ //Mostramos las formas de envase

        $db  = Database::getInstance();
        
        $sql_form = "SELECT id_autorizacion_envase FROM producto_envase WHERE  id_prod_envase = ".$val." ";

        $query_form = $db->pgquery($sql_form);
       
        $row_form  = pg_fetch_array($query_form);

        $auto = $row_form['id_autorizacion_envase'];

        return $auto;

     }


    public function EditarDatos($prod){ //Editamos los datos de presentacion del producto

      $db  = Database::getInstance();

     $sql ="UPDATE producto_presentacion SET contenido_neto = ".$prod[4].", id_unidad_medida = ".$prod[5]." WHERE id_prod_presentacion = ".$prod[0]." ";
     $sql1 =" UPDATE presentacion_envase SET id_prod_envase = ".$prod[3]." WHERE id_prod_presentacion = ".$prod[0]."";
     $query = $db->pgquery($sql);
     $query1 = $db->pgquery($sql1);

     $mensaje = "Registro modificado exitosamente";

      $arrConser = array(

      'sql'=>$sql,'sql1'=>$sql1,'mensaje'=>$mensaje);

      return $arrConser;

     } //Fin del Metodo */



     public function RegistrarDatos($prod){ //Editamos los datos de presentacion del producto

     $db  = Database::getInstance();

    $sqlP ="SELECT * FROM producto WHERE id_solicitud = ".$prod[0]." ORDER BY id_solicitud DESC LIMIT 1";

     $queryP = $db->pgquery($sqlP);

     $rowP    = $db->pgfetch($queryP);

     $idproducto = $rowP["id_producto"];

     $sql = "INSERT INTO producto_presentacion(
                         id_solicitud,id_producto,id_unidad_medida,contenido_neto)
              VALUES (".$prod[0].",".$idproducto.",".$prod[4].",'".$prod[3]."');";


     $sql.= "INSERT INTO presentacion_envase(
                         id_solicitud,id_prod_envase,id_prod_presentacion)
              VALUES (".$prod[0].",".$prod[2].",(SELECT max(id_prod_presentacion) FROM producto_presentacion));";


    $query = $db->pgquery($sql);


     $mensaje = "Registro exitoso";

      $arrConser = array(

      'sql'=>$sql,'sql1'=>$sql1,'mensaje'=>$mensaje);

      return $arrConser;

     } //Fin del Metodo */


    public function EliminarDatos($id,$id1){ //Editamos los datos de presentacion del producto

     $db  = Database::getInstance();

     $sql = "DELETE FROM producto_presentacion WHERE id_prod_presentacion = ".$id." ";

     $sql1 = "DELETE FROM presentacion_envase WHERE id_prod_presentacion = ".$id." ";

     $sql2 = "DELETE FROM producto_envase WHERE id_prod_envase = ".$id1." ";

     $query = $db->pgquery($sql);

     $query1 = $db->pgquery($sql1);

     //$query2 = $db->pgquery($sql2);

     $mensaje = "Eliminado exitosamente";

      $arrConser = array(

      'sql'=>$sql,'sql1'=>$sql1,'sql2'=>$sql2,'mensaje'=>$mensaje);

      return $arrConser;

     } //Fin del Metodo */
     

  } //Fin Modelo

?>