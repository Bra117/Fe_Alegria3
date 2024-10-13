<?php
 
    class recpayment extends Model{
        
        public $db;

       public function __construct(){

       	    parent::__construct();

       	    //Atributos

       	      $this->db = Database::getInstance();

       }

       

       public function addPayment($data){


             
             $sql = "

                  INSERT INTO regpayment(paymentdate,idletter,idnumber,amount,reference,description,transactionid,paytoken,authcode) VALUES('".$data['paymentdate']."','".$data['idletter']."','".$data['idnumber']."',".$data['amount'].",'".$data['reference']."','".$data['description']."','".$data['transactionid']."','".$data['token']."','".$data['authcode']."');";
             
             //Inserta los Datos 
             
             $result = $this->getResult($sql,$this->db);

             if($result['query']){

             	$val = true;

             	return $val; 
             }

       }

       //Activa las solicitudes para Impresion

         public function setActivate($arr){

            $sql="
                UPDATE solicitud 
                SET id_status_solicitud = 18
                where id_solicitud IN(".$arr.")"; 
                //Ejecuta el query
                  $result = $this->getResult($sql,$this->db);

             if($result['query']){
                
                $sw = true;
                return $sw;
             }     
       
         }

    }//End Class
?>