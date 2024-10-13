<!DOCTYPE html>
<html>
<style type="text/css">
.contenedor{
    position: relative;
    display: inline-block;
    text-align: center;
}
li {
  font-size:12px;
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
      <p>El servicio Autónomo de Contraloría Sanitaria, otorga al ciudadano(a)</p>
      <p class=""><h3><strong> <?php echo $row['nombres']; ?>, <?php echo $row['apellidos']; ?></strong></h3></p>  
      <p style="font-size:18px;"><h3><strong><?php echo $nacionalidad.'-'.number_format($id_ciudadano, 0, '.', '.'); ?> </strong></h3></p>
      <p >El presente Certificado, por haber participado en el</p>
    </div>  


    <br>
    <div class=""  style="font-size:35px;text-align: center;" style="margin-top:-10px;">
      <h2 style="color:#790c0d;">Curso de Manipulación de Alimentos</h2>
    </div>
    <div class="  " style="font-size:18px;text-align: center;">
      <p>De acuerdo a lo establecido en la Providencia Administrativa N° 070-2015 de fehca de 15 de julio de 2015.</p>
      <p>En Caracas, a los <?php echo date('d',strtotime($row['fecha_curso'])). " días del mes de " .ucfirst(strtolower($mes['row'][0])) ." del ".date('Y',strtotime($row['fecha_curso'])); ?></p>
    </div> 
    
    <div class="" style="position:absolute;margin-top:40px;text-align: center;margin-right:400px;">
      <p>_____________________________________</p>
      <p><strong><?php echo $row['fac_sacs']; ?></strong></p>
      <p><?php echo $row['cargo']; ?></p>
      <p >Servicio Autónomo de Contraloría Sanitaria</p>
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
                <div class="" style="position: absolute;margin-top:85px;">
                    <p><div>Válido Solo Para Funcionarios del Sacs</div></p>
              </div> 

        <p>CONTENIDO</p>
        <p>MÓDULO I</p>

          <li>Responsabilidad de la salud familiar y de la población en el
              manejo higiénico de los alimentos Responsabilidad del
              manipulador.
          </li>

          <li >
            Incuidad en toda la cadena alimentaria. Alimentos: concepto y
            tipos de alimentos. Peligros en los alimentos.
          </li>

          <li >Tipo de contaminación.</li>

          <li >Nociones generales de los paros biológicos. ETA: Intoxicación
e infecciones.</li>
            <li>Factores que favorecen la contaminación química.</li>


            <p>MÓDULO II</p>

           <li> Alergias e Intolerancias Alimentarias</li>

<li>Sensibilidad los almentos</li>

<li>Diferencia entre alergias e intolerancia alimentarias. Inocuidad,
peligros y alérgenos.</li>

<li>Aspectos fundamentales en un plan de control de alérgeno:
información y evitar contaminación cruzada.</li>

<li>Puntos críticos an un plan de control de alérgenos</li>

<li>Las 5 claves de a inocuidad de los alimentos, incluyendo alérgenas.</li>

<p>MÓDULO III</p>

<li>Manejo higiénico en el proceso de elaboración de alimentos.</li>

<li>Manejo higiénico de los alimentos. Puntos eiticos de control
Recepción de materia prima.</li>

<li>almecenamiento y transporte de los alimentos y productos de
limpieza.</li>

<li>Contaminación guzada. Descongelación de los alimentos.
Temperaturas de cocción.</li>

<li>Manejo de algunos productos alimenticios. Calidad del agua y
del hilo</li>



<p>MÓDULO IV</p>

<li>Condiciones del establecimiento</li>

<li>ubicación da lugar de elaboración e higiene.</li>

<li>Materiales de construción: iluminacón y ventilació. Áreas de lavado y
desinfección de equipos</li>

<li>areas de recepción y almacenamiento. Áreas de proceso o preparación
Areas de conservacion y  almacenamiento de productos terminados. Área de
servio y consumo
Area de servicios del personaal
Desechos
procedimiento de limpieza y desinfeccón control de plagas</li>

<p>MÓDULO V</p>

<li>Condiciones del personal y normativa legal</li>

<li>Salud</li>

<li>Higiene persoral. Vestimenta.</li>

<li>Hábitos higiénicos. Hábitos no deseables</li>

<li>Normativa legal: Reglamento general de alimentos, buenas prácticas
de fabricación almacenamiento y transporte de alimentos para
consumo humano.</li>

<b>COVID-19 E INOCUIDAD DE LOS ALIMENTOS: ORIENTACIONES PARA.
EL SECTOR ALIMENTARIO</b>

<li>Las empresas alimentarias deben educar e intensificar las medidas
de higiene personal, evitar o reducir el riesgo de que contaminen la
superficie de los alimentos o los envases con el virus. El equipo de
protección personal, incluidas las mascaras y los guantes, puede reducir eficazmente la propagación de los virus y las enfermedades
en las empresas alimentarias</li>





    

<!-- <link href="<?php echo ROOT;?>app/plugins/bootstrap5/bootstrap.min.css" rel="stylesheet"> -->

</body>
</html>


