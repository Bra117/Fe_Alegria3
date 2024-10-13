
<!-- ABRE LA ETIQUETA PARA REAR LA TABLA-->

<!-- MUESTRA LAS FECHAS DE LAS EMPRESAS-->

<table  class='myTable' border='1px solid #000' style='width:100%;margin:0px;'>
    <tr>
        <th colspan="11" ><center class="colorCelda">BOLETA SANITARIAS SACS</center></th>
    </tr>
    <tr>
        <th colspan="11" ><center class="colorCelda"><?php echo $row['d_area'] ?></center></th>
    </tr>
    <tr>
        <th colspan="2"><center class="colorCelda">OPERACIÓN ADUANAERA</center></th>
        <th colspan="9" class="colorCelda" >IMPORTACION</th>
    </tr>

    <tr>
        <th colspan="2">N° SOLICITUD</th>
        <th colspan="2" rowspan="2">FECHA SOLICITUD</th>
        <th colspan="2">DIA/MES/AÑO</th>
        <th colspan="2" rowspan="2">FECHA DE VERIFICACIÓN</th>
        <th colspan="1">DIA/MES/AÑO</th>
        <th rowspan="2">FECHA DE EMISIÓN</th>
        <th colspan="1">DIA/MES/AÑO</th>
    </tr>

    <tr>
        <td colspan="2"><?php echo  str_pad($row['id_solicitud'], 10, "0", STR_PAD_LEFT);  ?></td>
        <td colspan="2"><?php echo $row['fecha_sol'] ?></td>
        <td colspan="1"><?php echo date('Y-m-d',strtotime($row['fecha_veri'])); ?></td>
        <td colspan="1"><?php echo $row['fecha_sol'] ?></td>
    </tr>
   