<!-- DATOS DE LA MERCANCIA A INSPECCIONAR-->
<tr>
   <th colspan="11" ><center class="colorCelda">DATOS DEL PRODUCTO</center></th>   
</tr>
<tr>
   <th>DENOMINACIÓN</th>
   <th>REGISTRO SANITARIO</th>
   <th>P.S</th>
   <th>CÓDIGO ARANCELARIO</th>
   <th>CANTIDAD</th>
   <th>PRESENTACIÓN</th>
   <th>UNIDADES</th>
   <th>PESO UNITARIO</th>
   <th>U.M</th>
   <th>N° LOTE</th>
   <th>FECHA VENCIMIENTO</th>
</tr>

<?php



for ($i=0; $i < $result['numRows']; $i++) { 
   $row = pg_fetch_assoc($result['query'], $i);
   echo '<tr>
            <td>'.$row['denominacion'].'</td>
            <td>'.$row['registro_sanitario'].'</td>
            <td>'.$row['permiso_sanitario'].'</td>
            <td>'.$row['cod_arancelario'].'</td>
            <td>'.$row['cantidad_producto'].'</td>
            <td>'.$row['embalaje'].'</td>
            <td>'.$row['und_medida'].'</td>
            <td>'.$row['cont_neto'].'</td>
            <td>'.$row['cont_und_medida'].'</td>
            <td>'.$row['lote_producto'].'</td>
            <td>'.$row['f_vencimiento'].'</td>
         </tr>';
}

?>
</table>
    <!---->
