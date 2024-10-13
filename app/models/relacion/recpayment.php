<?php
 
    class recpayment extends Model{
        
        public $db;

       public function __construct(){

       	    parent::__construct();

       	    //Atributos

       	      $this->db = Database::getInstance();

       }

       

       public function addPayment($data){

            var_dump($data);
             
             $sql = "

                  INSERT INTO regpayment(paymentdate,idletter,idnumber,amount,reference,description,transactionid,paytoken,authcode) VALUES(".$data['paymentdate'].",".$data['idletter'].",".$data['idnumber'].",".$data['amount'].",".$data['reference'].",".$data['description'].",".$data['transactionid'].",".$data['token'].",".$data['authcode'].");";

             
             $result = $this->getResult($sql,$this->db);

             if($result['query']){

             	$val = true;

             	return $val; 
             }

       }
    }//End Class
?>