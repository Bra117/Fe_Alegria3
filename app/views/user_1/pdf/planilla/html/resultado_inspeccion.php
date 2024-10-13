<?PHP if ( $nro_oficio['row']['id_status_sol'] == 6 || $nro_oficio['row']['id_status_sol'] == 7) {  ?>

<table  class='myTable' border='1px solid #000' style='width:100%;margin:0px;'>
        
         <tr><th colspan="4" style="lef: 0px;" >RESULTADO DE LA INSPECCIÓN</th></tr>   
         <tr><th colspan="4"><center class="colorCelda">ASPECTOS TÉCNICOS DE LA INSPECCIÓN</center></th></tr>
    <tr>
    <?PHP 
        if ($result['numRows']>0) {
        for ($i=0; $i < $result['numRows']; $i++) { 
         $row = pg_fetch_assoc($result['query'], $i);
            echo '
                    <td rowspan="2">'.$row['normativa'].'</td>
                 ';
         }
        }
    ?>
        <td >n° oficio</td>
    </tr>
    <tr>
        <td ><?php  
      echo $nro_oficio['row']['oficio'];//echo $nro_oficio['row']['oficio']; ?></td>
    </tr>

</table>
<table  class='myTable' border='1px solid #000' style='width:100%;margin:0px;'>
        <tr>
            <td colspan="1"><?php echo $nro_oficio['row']['status']; ?></td>
            <td colspan="3">OBSERVACIONES</td>
            <td colspan="4"><?php echo $nro_oficio['row']['observacion'];?></td>
        </tr>
            

</table>

 <?PHP  } ?>

