<!DOCTYPE html>
<html>
<style type="text/css">
.contenedor{
    position: relative;
    display: inline-block;
    text-align: center;
}
li {
  margin:20px;
  font-size:30px;
}
</style>

<body>
<?php
  $nacionalidad = substr($row['id_ciudadano'],0,1);  
  $id_ciudadano = substr($row['id_ciudadano'],-8);
  $id_ciudadano = intval($id_ciudadano); 
?>
  

    <img  style = "width:108%; left:-40 px;top: -43px; z-index:-1; position:absolute;" src="<?php echo FONDO; ?>">
    <img style="position:absolute;left: 370px;top:-40px;width: 65%;" src="<?php echo BANNER; ?>">

    <div class=" contenedor mg-top" style="margin-top:80px; font-size:18px;">
      <p>El servicio Autónomo de Contraloría Sanitaria, otorga al ciudadano</p>
      <p class=""><h3><strong> <?php echo $row['nombres']; ?> <?php echo $row['apellidos']; ?></strong></h3></p>  
      <p style="font-size:18px;"><h3><strong> <?php echo $nacionalidad.'-'.number_format($id_ciudadano, 0, '.', '.'); ?> </strong></h3></p>
      <p >El presente Certificado, por haber participado en el</p>
    </div>  


    <br>
    <div class=""  style="font-size:35px;text-align: center;" style="margin-top:-10px;">
      <h2 style="color:#790c0d;">Curso de Manipulación de Alimentos</h2>
    </div>
    <div class="  " style="font-size:18px;text-align: center;">
      <p>De acuerdo a lo establecido en la Providencia Administrativa N° 070-2015 de fehca de 15 de julio de 2015.</p>
   <p>En Caracas, a los <?php echo date('d',strtotime($row['fecha_curso'])). " días del mes de " .ucfirst(strtolower($mes['row'][0]))." del ".date('Y',strtotime($row['fecha_curso'])); ?></p>    </div> 
    
    <div class="" style="position:absolute;margin-top:40px;text-align: center;margin-right:400px;">
      <p>_____________________________________</p>
      <p><strong><?php echo $row['fac_sacs']; ?></strong></p>
      <p><?php echo $row['cargo']; ?></p>
      <p>Servicio Autónomo de Contraloría Sanitaria</p>
            <p>(SACS)</p>

    </div> 


    <div class="" style="margin-left:500px;margin-top:5px;text-align:center;">
      <p>_____________________________________</p>
      <p><strong><?php echo $row['fac_otro']; ?></strong></p>
      <p>Facilitador</p>
    </div> 
            <img style="position:absolute;top:640px;left:-50px;" src="<?php echo LOGO; ?>">

            <div class="" style="position: absolute; margin-left:600px;margin-top:-20px;">

                      <p style="margin-top:30px;"><strong>Duración:06 horas</strong></p>
              </div> 
              <div style="position: absolute;left:-85px; margin:85px;" >Valido Solo Para Funcionarios del Sacs </div>
  <div class="" style="page-break-after:always;">
     
              </div> 
    
  <div class="" style="page-break-after:always;">

<!-- <link href="<?php echo ROOT;?>app/plugins/bootstrap5/bootstrap.min.css" rel="stylesheet"> -->

</body>
</html>


