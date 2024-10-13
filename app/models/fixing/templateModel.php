<?php

  class Template extends Model{
    
     //Atributos de la Clase 
  	   private $db; 
  	   public $array;  
       public $html  = "";
       public $tipo  = "";
       public $dato  = "";
     
     public function __contruct(){
         
         $this->html  = $html;
         $this->tipo  = $tipo;
         $this->dato  = $dato;
         $this->array = $array; 
     } 

     public function Template(){

     	$this->db = Database::getInstance(); 
     }

     //Metodo para verificar si existe el Registro 
       public function findReg(){
       	   //Inicializo el Objeto db
       	     
           //Evaluo el tipo 
             if($this->tipo == 1){
             	$condicion = "id_solicitud =".$this->dato;  
             }else{
             	$condicion = "d_numero_sanitario=".$this->dato; 
             }  

          //Evalua si existe el Registro 
            $sql = "SELECT * 
                      FROM solicitud 
                     WHERE ".$condicion."
                     AND id_tipo_solicitud = 1;";
             
            $this->array = $this->getResult($sql,$this->db);
                     
            if($this->array['numRows'] > 0){
            	return $this->array;
            }else{
            	return 0;
            }
       } //End Method
 
     public function ajusteFecha(){

      //Crea codigo HTML para mostrar 
  	  $this->html='
             <form id="ajustaFecha" name="ajustaFecha" class="form" 
             role="form">
             <input type="hidden" id="id_solicitud" name="id_solicitud" value="'.$this->array['row']['id_solicitud'].'">
                 <div class="row">
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Fecha Solicitud:</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="f_solicitud" name="f_solicitud" value="'.date("d-m-Y",strtotime($this->array['row']['f_solicitud'])).'">
                    </div>  
                 </div>
                 </div>
                 <div class="row">
                   <div class="form-group">
                    <label class="col-md-2 control-label">Fecha Status:</label>
                     <div class="col-md-2">
                      <input type="text" class="form-control" id="f_status" name="f_status" value="'.date("d-m-Y",strtotime($this->array['row']['f_status'])).'">
                     </div>
                    </div>  
                 </div>
                 <div class="row">
                   <div class="col-md-2" style="margin-top:10px;">
                     <button type="button" class="btn btn-primary btn-sm btn-block" id="btnAjuste" onclick="xajax_setFecha(xajax.getFormValues(ajustaFecha))">Actualizar</button>
                 </div>
                 </div>
             </form>';
  	  //retorna la variable
  	    return $this->html;    
     }	

     //Actualizar los datos de la Fecha

     public function setDataFecha($id_solicitud,$f_solicitud,$f_status){

     	  $sql = "UPDATE solicitud 
     	             SET f_solicitud='".$f_solicitud."',f_status='".$f_status."' 
     	             WHERE id_solicitud =".$id_solicitud.";";

          
     	  $query = $this->db->pgquery($sql);
          
     	  if($query){

     	  	 return true;
     	  }else{
     	  	return false;
     	  }           
     }  

  //AJUSTE DE DATOS DEL PRODUCTO 
      public function ajusteProd(){
     
      //Busca la Informacion del Producto
        $data = $this->getProducto($this->array['row']['id_solicitud']);
        if($data != NULL){
         
           $this->html='
                  <form id="ajustaProd" name="ajustaProd" class="form" 
             role="form">
             <input type="hidden" id="id_solicitud" name="id_solicitud" value="'.$this->array['row']['id_solicitud'].'">
                 <div class="row">
                 <div class="form-group">
                    <label class="col-md-3 control-label">Denominaci&oacute;n del Producto:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="d_denomina" name="d_denomina" value="'.$data['row']['d_denomina'].'">
                    </div>  
                 </div>
                 </div>
                 <div class="row">
                   <div class="form-group">
                    <label class="col-md-3 control-label">Nombre de Fantasia:</label>
                     <div class="col-md-8">
                      <input type="text" class="form-control" id="d_fantasia" name="d_fantasia" value="'.$data['row']['d_fantasia'].'">
                     </div>
                    </div>  
                 </div>
                 <div class="row">
                   <div class="form-group">
                    <label class="col-md-3 control-label">Marca:</label>
                     <div class="col-md-8">
                      <input type="text" class="form-control" id="d_marca" name="d_marca" value="'.$data['row']['d_marca'].'">
                     </div>
                    </div>  
                 </div>
                 <div class="row">
                   <div class="col-md-2" style="margin-top:10px;">
                     <button type="button" class="btn btn-primary btn-sm btn-block" id="btnAjuste2" onclick="xajax_setProducto(xajax.getFormValues(ajustaProd))">Actualizar</button>
                 </div>
                 </div>
             </form>';

         //retorna la variable
  	       return $this->html;
        }   
     }

     //Obtener los datos del Producto
       private function getProducto($id_solicitud){

       	     $sql = "SELECT * 
       	               FROM producto 
       	              WHERE id_solicitud =".$id_solicitud.";";

       	     $dat = $this->getResult($sql,$this->db);         

       	     if($dat["numRows"] > 0){

       	     	return $dat;
       	     }else{
       	     	return NULL;
       	     }
       }

       //Actualiza la BD Producto
         public function setDataProd($form){

         	    $sql ="UPDATE producto 
         	              SET d_denomina='".$form['d_denomina']."'
         	              ,d_fantasia ='".$form['d_fantasia']."',
         	              d_marca ='".$form['d_marca']."'
         	           WHERE id_solicitud =".$form['id_solicitud'].";";
         	 $query = $this->db->pgquery($sql);
             
     	    if($query){
     	  	   return true;
     	    }else{
     	      return false;
     	   }                   
         } //End Method

      //DATOS DE ENVASE Y/O EMPAQUE
        public function ajuste_envase(){
     
      //Busca la Informacion del Producto
        $data = $this->getEnvase($this->array['row']['id_solicitud']);
        if($data != NULL){
           $this->html='
                  <form id="ajustaEnv" name="ajustaEnv" class="form-horizontal" 
             role="form">
             <input type="hidden" id="id_solicitud" name="id_solicitud" value="'.$this->array['row']['id_solicitud'].'">
                  <div class="row">
                     <div class="col-md-6">
                       <table class="table table-bordered table-condensed">
                          <caption><span style="font-weight:bold;">Informaci&oacute;n de los Envases Registrados</span></caption>
                          <thead>
                            <tr>
                              <th>Sel</th>
                              <th>Nro. Auto.</th>
                              <th>Descripci&oacute;n</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>';
                          /*Codigo PHP*/
                            //Define valor para j
                              $j = 1;
                            for($i=0;$i<count($data['numRows']);$i++){
                            	$this->html.='
                                       <tr>
                                       <td>
                                        <input type="radio" id="tOption$j" name="tOption" value="'.$data["row"]["id_prod_envase"].'" onclick="javascript:setAction("'.$j.'")"></td>
                                       <td>'.$data["row"]["id_autorizacion_envase"].'</td>
                                       <td>'.$data["row"]["d_desc_envase"].'</td>
                                       <td><div id="accion$i">
                                          <div class="col-md-5">
                                          <button type="button" class="btn btn-success " id="btnEdit$i" onclick=""><span class="glyphicon glyphicon-edit"></span></button>
                                          </div>
                                          <div class="col-md-5">
                                          <button type="button" class="btn btn-danger" id="btnRemove$i" onclick=""><span class="glyphicon glyphicon-remove"> </span></button></div>
                                       </div></td>
                                       </tr>
                            	';
                            	//Contador de Fila
                            	  $j = $j + 1;
                            }
                       $this->html.='</table> 
                     </div>
                     <div class="col-md-6">
                      <div class="form-group">
                       <label class="col-sm-4">
                             N&deg; de Autorizaci&oacute;n
                       </label>    
                       <div class="col-sm-8">
                          <input class="form-control" id="id_autorizacion_envase" name="id_autorizacion_envase" type="text">
                       </div>  
                      </div>
                      <div class="form-group">
                       <label class="col-sm-4">
                          Descripci&oacute;n del Envase/Empaque   
                       </label>    
                       <div class="col-sm-8">
                          <input class="form-control" id="d_desc_envase" name="d_desc_envase" type="text">
                       </div>  
                      </div>
                      <div class="form-group">
                       <label class="col-sm-4">
                          Fecha:   
                       </label>    
                       <div class="col-sm-8">
                         <input class="form-control" name="f_autorizacion"  id="f_autorizacion" type ="text">
                       </div>
                       </div>  
                      <div class="form-group">
                       <label class="col-sm-4">
                          Uso del Envase/Empaque:   
                       </label>    
                       <div class="col-sm-8">
                          <input class="form-control" id="d_uso_envase" name="d_uso_envase" type="text">
                       </div>  
                      </div>
                     </div>
                 </div>
             </form>';
         //retorna la variable
  	       return $this->html;
        }   
     }//End Metodo    


     //Busca los envases del producto
        private function getEnvase($id_solicitud){

       	     $sql = "SELECT * 
       	               FROM producto_envase 
       	              WHERE id_solicitud =".$id_solicitud.";";

       	     $dat = $this->getResult($sql,$this->db);         

       	     if($dat["numRows"] > 0){

       	     	return $dat;
       	     }else{
       	     	return NULL;
       	     }
       } //End getEnvase

  } //End Class
   
  

?>