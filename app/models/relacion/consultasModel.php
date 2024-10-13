<?php

class consultasModel extends Model{
  /************************************************************************
  *
  *
  *   DATOS DEL PRODUCTO
  *
  *
  *************************************************************************/

  public static $table  = "solicitud";
  //public $numReg;
 // public $categ;
  //public $solRefer;

  public function __contruct(){
          parent::__construct();
  }


 public function detProducto1($sol){

      $db  = Database::getInstance();
     //Hago La Consulta SQL
      $sql = "SELECT *
              FROM producto
              WHERE id_solicitud =".$sol.";";
         
         //return $sql;

      $query = $db->pgquery($sql);
      $numR  = $db->pgNumrows($query);

      if($numR > 0){
         $row = $db->pgfetch($query);
       //Capturo los datos

         //Envio la Respuesta
        return $row;

      }
  }

    public function dProducto1($id_tipo_prod){

       $sql = "SELECT d_tipo_prod
                 FROM tipo_producto
                WHERE id_tipo_prod =".$id_tipo_prod.";";
      $d_tipo_prod = "";
      $query = pg_query($sql);
      $numR  = pg_num_rows($query);
      if($numR > 0){
         $row = pg_fetch_array($query);
         $d_tipo_prod  = $row["d_tipo_prod"];
      }

       return $d_tipo_prod;
  }


      /*FUNCIONES NUEVAS GENERAR PDF*/

      public function Armar_Pdf($arrDat,$arrDat1){

           $db  = Database::getInstance();

           $consulta = new consultasModel(); //instancio la clase consultasModel
           $model  = new dataProductModel(); //instancio la clase dataProductModel

            switch ($arrDat1['statusS']) {
            case 2: //Recibido por el SACS (recepcionista)
            case 6: // Analista aprobar
            case 9: // Director aprobar
            case 8: // Coordinador aprobar
            case 10: // Coordinador aprobar
            case 11: // Coordinador aprobar y director general

             for ($i=0; $i <count($arrDat1['statusS']) ; $i++) { 
             $arrConsul = $consulta->tipo_sql($arrDat,$arrDat1); //Enviamos el arreglo a la funcion tipo_sql (si es nuevo o notificacion)

             return $arrConsul;

             }

            break;

            case 5: // Analista rechazar
            case 12: // Coordinador rechazar
            case 13: // Director rechazar
            case 14: // Contralor rechazar

             for ($i=0; $i <count($arrDat1['statusS']) ; $i++) { 

             $arrConsul = $consulta->tipo_sql($arrDat,$arrDat1); //Enviamos el arreglo a la funcion tipo_sql (si es nuevo o notificacion)

            return $arrConsul;

            }

            break;

            return $consul;
        
          }

        }

        //FUNCION TIPO SQL
        public function tipo_sql($arrDat,$arrDat1){

          $db  = Database::getInstance();

          $consulta = new consultasModel(); //instancio la clase consultasModel
          $model  = new dataProductModel(); //instancio la clase dataProductModel
         
          $arrFunc = $consulta->id_func($arrDat); //Mando la ci del func 

        switch ($arrDat1['tipoS']) { //Evaluamos los tipos de solicitudes

        case 1: //Nuevo Registro

        for ($i=0; $i < 1; $i++) { 

        $sql = "SELECT * FROM  solicitud AS s 
                INNER JOIN transaccion_solicitud AS trs ON trs.id_solicitud = s.id_solicitud
                INNER JOIN categoria_solicitud AS cs ON s.id_categoria_solicitud = cs.id_categoria_solicitud
                INNER JOIN producto AS p ON p.id_solicitud = trs.id_solicitud
                INNER JOIN tipo_producto AS tp ON p.id_tipo_prod = tp.id_tipo_prod
                WHERE s.id_area = ".$arrDat['area']."
                AND s.f_solicitud >= '".$arrDat['desde']."'
                AND s.f_solicitud <= '".$arrDat['hasta']."'
                AND trs.id_funcionario_ini = ".$arrFunc['id_funcionario']."
                AND s.id_status_solicitud = ".$arrDat['statusS']."
                AND s.id_tipo_solicitud = ".$arrDat['tipoS']."
                ORDER BY s.id_solicitud ASC";
       
          //echo $sql;

            }

            $query   = $db->pgquery($sql);
            $numRows = $db->pgNumrows($query);

            if($numRows >0){

            for ($i=0; $i < $numRows; $i++) {             

              $row = pg_fetch_array($query,$i);

              $motivo = $consulta->rechazo_solicitud($row['id_solicitud']); //Enviamos el arreglo a la funcion tipo_sql (si es nuevo o notificacion)

              //Arreglo Consulta 

              $arrConsul[$i]=array('id_solicitud' =>$row['id_solicitud'],'d_numero_sanitario'=>$row['d_numero_sanitario'],
              'd_categoria_solicitud'=>utf8_decode($row['d_categoria_solicitud']),
              'd_tipo_prod'=>utf8_decode($row['d_tipo_prod']),
              'd_denomina'=>utf8_decode($row['d_denomina']),
              'd_marca'=>utf8_decode($row['d_marca']),
              'f_solicitud'=>$row['f_solicitud'],'id_tipo_solicitud'=>$row['id_tipo_solicitud'],
              'id_status_solicitud'=>$row['id_status_solicitud'],'numRows'=>$numRows,'motivo'=>$motivo['motivo'],
              'coord' =>$arrFunc['coord'],'area' =>$arrFunc['area'],'d_nombre'=>$arrFunc['d_nombre'],
              'd_apellido'=>$arrFunc['d_apellido']);
        
          //    echo $arrConsul[$i]['numRows'];
            


            }

          }

        return $arrConsul;

        break;

        case 2: //Notificaciones

            $sql ="SELECT trs.*, s.id_solicitud, s.id_tipo_solicitud, s.id_categoria_solicitud, s.id_categoria_solicitud, 
                  s.id_funcionario, s.f_solicitud, s.d_numero_sanitario, s.id_tipo_solicitud,cs.d_categoria_solicitud
                  FROM transaccion_solicitud trs, solicitud s, categoria_solicitud cs
                  WHERE trs.id_solicitud = s.id_solicitud
                  AND s.id_categoria_solicitud = cs.id_categoria_solicitud
                  AND s.id_area = ".$arrDat['area']."
                  AND s.f_solicitud >= '".$arrDat['desde']."'
                  AND s.f_solicitud <= '".$arrDat['hasta']."'
                  AND trs.id_funcionario_ini = ".$arrFunc['id_funcionario']."
                  AND trs.id_status_solicitud = ".$arrDat['statusS']."
                  AND s.id_categoria_solicitud NOT IN(1,2,3,4)
                  AND s.id_tipo_solicitud =  ".$arrDat['tipoS']."
                  ORDER BY s.id_solicitud ASC";

            //   echo $sql;


            $query   = $db->pgquery($sql);
            $numRows = $db->pgNumrows($query);


            if($numRows >0){

            for($j = 0; $j < $numRows;$j++){

              $row   = pg_fetch_array($query,$j);

              $sol  = $row['id_solicitud']; 
              $cate = $row['id_categoria_solicitud'];

              $consulta = new consultasModel(); //instancio la clase consultasModel
              $model  = new dataProductModel(); //instancio la clase dataProductModel

              $nRef = $model->getReferencia($sol,$cate); //Mando al metodo getReferencia de la clase DataProducto

              $prod = $consulta->detProducto1($nRef); //Mando al metodo detProducto1 de la clase ConsultaModel

              $tipo = $consulta->dProducto1($prod['id_tipo_prod']); //Mando al metodo dProducto1 de la clase ConsultaModel

              $motivo = $consulta->rechazo_solicitud($row['id_solicitud']); //Enviamos el arreglo a la funcion tipo_sql (si es nuevo o notificacion)

              $arrConsul[$j] = array('id_solicitud' =>$row['id_solicitud'],
                                     'd_numero_sanitario' =>$row['d_numero_sanitario'],
                                     'd_categoria_solicitud'  =>utf8_decode($row['d_categoria_solicitud']),
                                     'd_denomina' =>utf8_decode($prod['d_denomina']),
                                     'd_marca' =>utf8_decode($prod['d_marca']),
                                     'f_solicitud'=>$row['f_solicitud'],
                                     'id_tipo_solicitud' =>$row['id_tipo_solicitud'],
                                     'id_status_solicitud'=>$row['id_status_solicitud'],
                                     'd_nombre'=>$arrFunc['d_nombre'],
                                     'd_apellido'=>$arrFunc['d_apellido'],
                                     'area' =>$arrFunc['area'],
                                     'd_tipo_prod' =>$tipo,
                                     'numRows'=>$numRows,
                                     'coord' =>$arrFunc['coord'],
                                     'motivo'=>$motivo['motivo']);
             
         //     echo $arrConsul[$j]['id_solicitud'];

            }
         }

        return $arrConsul;

        break;


        }

       
        } // fin funcion


        public function id_func($arrDat){
        
        $db  = Database::getInstance();

        for ($i=0; $i < 1; $i++) { 
        
        $sql_func = "SELECT * FROM funcionario WHERE cedula_pasaporte = '".$arrDat['resp']."'";

        }

        $query_func = $db->pgquery($sql_func);
        $row_func   = $db->pgfetch($query_func);
        //$func = $row_func['id_funcionario'];

        $consulta = new consultasModel(); //instancio la clase consultasModel
         
        $area = $consulta->areas($row_func['id_area']); //Mando la ci del func 
        $coordinacion = $consulta->coordinaciones($row_func['id_coordinacion']);

        $arrFunc = array('id_funcionario' =>$row_func['id_funcionario'],'d_nombre' =>$row_func['d_nombre'],'d_apellido' =>$row_func['d_apellido'],'d_apellido' =>$row_func['d_apellido'],'id_area' =>$row_func['id_area'],'id_coordinacion' =>$row_func['id_coordinacion'],'area'=>$area,'coord'=>$coordinacion);

        return $arrFunc;

        }


        public function areas($id_area){

        $db  = Database::getInstance();

        $sql_area = "SELECT * FROM area WHERE id_area = ".$id_area." ";

        $query_area = $db->pgquery($sql_area);
        $row_area   = $db->pgfetch($query_area);
        $area = $row_area['d_area'];

        return $area;

        }

        public function coordinaciones($id_coord){
        $db  = Database::getInstance();
        $sql_coord = "SELECT * FROM coordinacion WHERE id_coordinacion = ".$id_coord." ";

        $query_coor = $db->pgquery($sql_coord);
        $row_coord   = $db->pgfetch($query_coor);
        $coord = $row_coord['d_coordinacion'];

         return $coord;

        }


        public function rechazo_solicitud($arrConsul){
        $db  = Database::getInstance();
       /// echo $arrConsul;
        for ($i=0; $i < count($arrConsul['id_solicitud']); $i++) { 
        $sql_recha = "SELECT * FROM desc_rechazo WHERE id_solicitud = ".$arrConsul." ";
       // echo $sql_recha;
        }

        $query_recha = $db->pgquery($sql_recha);
        $row_recha   = $db->pgfetch($query_recha);
        $motivo = $row_recha['motivo'];

        $arrMotivo = array('motivo' =>$motivo);

       // echo $arrMotivo['motivo'];


         return $arrMotivo;


        }





} //Fin de dataProduct

?>