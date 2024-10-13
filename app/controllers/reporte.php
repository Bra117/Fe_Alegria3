<?php
  class reporte extends Controller {

    function __construct(){
    	   parent:: __construct();
         require (PLUGINS.'fpdf181/fpdf.php');
         Reports::autoload();
         Reports::exists('oficio');
         Reports::exists('planilla_inocuidad');
         Reports::exists('reportePDF'); // Nuevo
    }

    /************************************************************************
    *
    *
    *   DIRECCIÓN DE INOCUIDAD E INSPECCIÓN DE ALIMENTOS Y BEBIDAS 
    *
    *
    *************************************************************************/
    
     public function nreg_alimento(){
         $pdfReport = new pdfReport();
         extract($_REQUEST);
         $pdfReport->origen  =  $_REQUEST['origen'];
         $pdfReport->tipo    =  $_REQUEST['tipo'];
         $pdfReport->elab    =  $_REQUEST['elab'];
         ///var_dump("expression"); 15 de octubre 2021 

         if ($_REQUEST['origen'] == 1) {
            
            if ($_REQUEST['elab'] == 3) {
               
              $pdfReport->marco     =  "ii";
              $pdfReport->total_ano =  utf8_decode("dos (2) años");
            }else{
              $pdfReport->marco     =  "i";
              $pdfReport->total_ano =  utf8_decode("cinco (5) años");
            }
         }else{
            $pdfReport->marco     =  "i";
            $pdfReport->total_ano =  utf8_decode("cinco (5) años");
         }
         $pdfReport->nroSol     =  $_REQUEST['nroSol'];
         $pdfReport->impNR      =  false; 
         $pdfReport->zona       =  false;

         $pdfReport->ofAlimBeb();
 
     }

     public function nreg_bebida(){
         $pdfReport = new pdfReport();
         extract($_REQUEST);
         $pdfReport->origen  =  $_REQUEST['origen'];

         $pdfReport->tipo    =  $_REQUEST['tipo'];
         $pdfReport->elab    =  $_REQUEST['elab'];
         
         
         if ($_REQUEST['origen'] == 1) {
            if ($_REQUEST['elab'] == 3) {
              $pdfReport->marco     =  "iiii";
              $pdfReport->total_ano =  utf8_decode("dos (2) años");
            }else{
              $pdfReport->marco     =  "iii";
              $pdfReport->total_ano =  utf8_decode("cinco (5) años");
            }
         }else{
            $pdfReport->marco     =  "iii";
            $pdfReport->total_ano =  "cinco (5) años";
         }

         $pdfReport->nroSol     =  $_REQUEST['nroSol'];
         $pdfReport->impNR      =  false; 
         $pdfReport->zona       =  false;
         $pdfReport->ofAlimBeb();

     }

     public function inclusion(){
        $pdfReport = new pdfReport();
        extract($_REQUEST);
        $pdfReport->origen    =  $_REQUEST['origen'];

        $pdfReport->tipo      =  $_REQUEST['tipo'];

        $pdfReport->elab      =  $_REQUEST['elab'];

        $pdfReport->marco     =  "inclusion";
        $pdfReport->nroSol    =  $_REQUEST['nroSol'];

        if (isset($_REQUEST['import'])) {
            
          $pdfReport->impNR   =  true;
        }else{
          $pdfReport->impNR   =  false; 
        }
        $pdfReport->zona        =  false;
        $pdfReport->total_ano = $this->defVigencia($_REQUEST['origen'],$_REQUEST['elab']);
        $pdfReport->ofAlimBeb();
     }

     public function zonas(){

        $pdfReport = new pdfReport();

        extract($_REQUEST);
        $pdfReport->origen    =  $_REQUEST['origen'];
        $pdfReport->tipo      =  $_REQUEST['tipo'];
        $pdfReport->elab      =  $_REQUEST['elab'];
        if ($_REQUEST['elab'] == 3) {
              $pdfReport->marco     =  "iiii";
              $pdfReport->total_ano =  utf8_decode("dos (2) años");
        }else{
              $pdfReport->marco     =  "iii";
              $pdfReport->total_ano =  utf8_decode("cinco (5) años");
        }
        
        if ($_REQUEST['zona'] == true) {
          $pdfReport->zona    =  true;
        }else{
          $pdfReport->zona    =  false; 
        }
        $pdfReport->impNR     =  false; 
        $pdfReport->nroSol    =  $_REQUEST['nroSol'];
        $pdfReport->ofAlimBeb();
     }

     public function renov_alimento(){
         $pdfReport = new pdfReport();
         extract($_REQUEST);
         $pdfReport->origen  =  $_REQUEST['origen'];
         $pdfReport->tipo    =  $_REQUEST['tipo'];
         $pdfReport->elab    =  $_REQUEST['elab'];

         if ($_REQUEST['origen'] == 1) {
            if ($_REQUEST['elab'] == 3) {
              $pdfReport->marco     =  "renov_ii";
              $pdfReport->total_ano =  utf8_decode("dos (2) años");
            }else{
              $pdfReport->marco     =  "renov_i";
              $pdfReport->total_ano =  utf8_decode("cinco (5) años");
            }
         }else{
            $pdfReport->marco     =  "renov_i";
            $pdfReport->total_ano =  utf8_decode("cinco (5) años");
         }

         $pdfReport->nroSol     =  $_REQUEST['nroSol'];

          
         $pdfReport->impNR      =  false;
         $pdfReport->zona       =  false;
         $pdfReport->ofAlimBeb();
 
     }

     public function renov_bebida(){
         $pdfReport = new pdfReport();

         extract($_REQUEST);
         $pdfReport->origen  =  $_REQUEST['origen'];
         $pdfReport->tipo    =  $_REQUEST['tipo'];
         $pdfReport->elab    =  $_REQUEST['elab'];
         if ($_REQUEST['origen'] == 1) {
            if ($_REQUEST['elab'] == 3) {
              $pdfReport->marco     =  "renov_ii";
              $pdfReport->total_ano =  utf8_decode("dos (2) años");
            }else{
              $pdfReport->marco     =  "renov_i";
              $pdfReport->total_ano =  utf8_decode("cinco (5) años");
            }
         }else{
            $pdfReport->marco     =  "renov_i";
            $pdfReport->total_ano =  utf8_decode("cinco (5) años");
         }
         $pdfReport->nroSol     =  $_REQUEST['nroSol'];
         $pdfReport->impNR      =  false;
         $pdfReport->zona       =  false;
         
         $pdfReport->ofAlimBeb();
     }

     public function pdf_consulta(){
        //Capturo los Datos Enviados
            extract($_REQUEST); 
            $numSol    = $_REQUEST['nroSol'];
            
        //Instanciar el Objeto
            $pdfReport  = new pdfReport();
            $pdfReport->planilla($numSol);
     }


    //Define la Vigencia de los Oficios 
      public function defVigencia($origen,$elab){

        if ($origen == 1) {
            
            if ($elab == 3) {
              $total_ano =  utf8_decode("dos (2) años");
            }else{
              $total_ano =  utf8_decode("cinco (5) años");
            }
         }else{
            $total_ano =  utf8_decode("cinco (5) años");
         }

        //Retorna la respuesta
          return $total_ano; 
      } //End 

     //NUEVA FUNCION PDF*/
     public function Genera_Consulta(){
        //Capturo los Datos Enviados
            extract($_REQUEST); 
            $resp     = $_REQUEST['responsable'];
            $area     = $_REQUEST['area'];
            $coord    = $_REQUEST['coord'];
            $rol      = $_REQUEST['rol'];
            $tipoS    = $_REQUEST['d_tipo_solicitud'];
            $statusS  = $_REQUEST['d_status_solicitud'];
            $desde    = $_REQUEST['desde'];
            $hasta    = $_REQUEST['hasta'];  

            $arrDat = array('resp' =>$resp,'area' =>$area,
                            'coord' =>$coord,'rol' =>$rol,
                            'tipoS' =>$tipoS,'statusS' =>$statusS,
                            'desde' =>$desde,'hasta' =>$hasta);

            $arrDat1 = array('coord' =>$coord,'area' =>$area,
                            'tipoS' =>$tipoS,'statusS' =>$statusS,
                            'desde' =>$desde,'hasta' =>$hasta);


        //Instanciar el Objeto
            //$pdfReport  = new pdfReport();
          //  $pdfReport->Genere_Consultas_Pdf($arrDat,$arrDat1);
     }



//NUEVO PRODUCTO ENVASE EMPAQUE MIGUEL


     public function Prod_Envase_Empaque(){ //OFICIO NUEVO ENVASE EMPAQUE
        //Capturo los Datos Enviados
            extract($_REQUEST); 
            $pdfReport->numSol  =  $_REQUEST['nroSol'];
            $pdfReport->catSol  =  $_REQUEST['catSol'];

        //Instanciar el Objeto
           $pdfReport  = new pdfReport();
           $pdfReport->oficEnvase($_REQUEST['nroSol']);
     }


     public function Cambio_Envase_Empaque(){ //OFICIOS CAMBIOS ENVASE Y EMPAQUE
        //Capturo los Datos Enviados
            extract($_REQUEST); 
            $pdfReport->numSol  =  $_REQUEST['nroSol'];
            $pdfReport->catSol  =  $_REQUEST['catSol'];

        //Instanciar el Objeto
           $pdfReport  = new pdfReport();
           $pdfReport->CambiosOficEnvase($_REQUEST['nroSol']);
     }


  } //Fin de la Clase

?>