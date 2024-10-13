<!--DATOS DE LA OPERACIÓN ADUANERA-->
    <tr>
        <th colspan="11" ><center class="colorCelda">DATOS DE OPERACIÓN ADUANERA</center></th>
    </tr>
    <tr>
        <th colspan="3" ><center class="colorCelda">PAÍS DE ORIGEN</center></th>
        <th colspan="4" ><center class="colorCelda">NAVIERA/LÍNEA ÁEREA/TRANSPORTISTA</center></th>
        <th colspan="4" ><center class="colorCelda">N° BL/GUIA/CRT-PLACA VEHÍCULO</center></th>
    </tr>
    <tr>
        <td colspan="3" ><center class="colorCelda"><?php echo $row['pais_origen'] ?></center></td>
        <td colspan="4" ><center class="colorCelda"><?php echo $row['tipos_traslados'] ?></center></td>
        <td colspan="4" ><center class="colorCelda"><?php echo $row['medio_ingreso'] ?></center></td>
    </tr>
    <tr>
        <th colspan="3" ><center class="colorCelda">FECHA DE LLEGADA</center></th>
        <th colspan="4" ><center class="colorCelda">ADUANA DE INGRESO</center></th>
        <th colspan="4" ><center class="colorCelda">AGENCIA DE ADUANA</center></th>
    </tr>
    <tr>
        <td colspan="3" ><center class="colorCelda"><?php echo $row['f_llegada'] ?></center></td>
        <td colspan="4" ><center class="colorCelda"><?php echo $row['d_aduana'] ?></center></td>
        <td colspan="4" ><center class="colorCelda"><?php echo $row['agencia_aduanal'] ?></center></td>
    </tr>
    <tr>
        <th  colspan="1"><center class="colorCelda">VOLUMEN CARGA</center></th>
        <th colspan="2" ><center class="colorCelda">ALMACENADORA</center></th>
        <th colspan="2" ><center class="colorCelda">N° FACTURA</center></th>
        <th colspan="2" ><center class="colorCelda">FECHA</center></th>
        <th colspan="2" ><center class="colorCelda">DUA</center></th>
        <th colspan="2" ><center class="colorCelda">FECHA (DUA)</center></th>
    </tr>
    <tr>
        <td colspan="1"> <center class="colorCelda"><?php echo $row['volumen_carga'] ?></center></td>
        <td colspan="2" ><center class="colorCelda"><?php echo $row['almacenadora'] ?></center></td>
        <td colspan="2" ><center class="colorCelda"><?php echo $row['numero_factura'] ?></center></td>

        <td colspan="2" ><center class="colorCelda"><?php echo $row['f_factura'] ?></center></td>
        <td colspan="2" ><center class="colorCelda"><?php echo $row['declaracion_unica'] ?></center></td>
        <td colspan="2" ><center class="colorCelda"><?php echo $row['f_dua'] ?></center></td>
    </tr>