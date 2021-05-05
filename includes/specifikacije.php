

<style type="text/css">
	
	td{
	box-shadow: -2px 3px 20px #00000042;
	}
	table{
		border-collapse: collapse;
	}
	.td1{    
    color: #d1414b;
    font-weight: bold;
 
    font-size: 22px;
    padding: 15px;
    padding-left: 40px;
	}
	.td2{padding:3px;
		 font-weight: bold;
    text-align: center;
	}
	.td3{
		padding:3px;
		 text-align: center;
	}
	.td4{
		    padding: 6px;
    padding-left: 20px;
	}
</style>
<div style="
    margin-top: 10px;">
				

	<table style="width: 100%;">
<tr>
	<td class="td1" colspan="3"><i class="fas fa-industry"></i>   Proizvođač i model</td>
	
</tr>
<tr>
	<td style="text-transform: capitalize;" class="td3">Marka</td>
	<td class="td4"><?php echo $models['marka'] ?></td></tr>
<tr>
	<td class="td3">Model</td>
	<td class="td4"><?php echo $models['model'] ?></td>
</tr>
<tr>
	<td class="td3">Gordina proizvodnje</td>
	<td class="td4"><?php echo date("F, Y", strtotime($models['datum'])); ?></td>
</tr>
<tr>
	
	<td class="td1" colspan="3"><i class="fas fa-stream"></i>   Kućište</td>

</tr>
<tr>
	<td class="td3">Dimenzije</td>
	<td class="td4"><?php echo $kuciste['0'] ?></td>
</tr>
<tr>
	
	<td class="td3">Masa</td>
	<td class="td4"><?php echo $kuciste['4'] ?></td>
</tr>

<tr>
	
	
	<td class="td3">Boje</td>
	<td class="td4"><?php echo $kuciste['2'] ?></td>
</tr>

<tr>
	
	
	<td class="td3">Izrada</td>
	<td class="td4"><?php echo $kuciste['3'] ?></td>
</tr>
<tr>
	
	<td class="td1" colspan="3"><i class="fas fa-microchip"></i>   Procesor</td>
	
</tr>
<tr>
	

	<td class="td3">Procesor</td>
	<td class="td4"><?php echo $cipovi['0'] ?></td>
</tr>
<tr>

	
	<td class="td3">Čipset</td>
	<td class="td4"><?php echo $cipovi['1'] ?></td>
</tr>
<tr>

	
	<td class="td3">Grafička</td>
	<td class="td4"><?php echo $cipovi['2'] ?></td>
</tr>
<tr>
	
	<td class="td1" colspan="3"><i class="fas fa-battery-three-quarters"></i>   Baterija</td>


</tr>
<tr>
	
	<td class="td3">Vrsta</td>
	<td class="td4"><?php echo $modul['0'] ?></td>

</tr>


<tr>
	<td class="td1" colspan="3"><i class="fas fa-mobile"></i>   Displej</td>

</tr>
<tr>
	
	<td class="td3">Tip</td>
	<td class="td4"><?php echo $ekran['0'] ?></td>
</tr>
<tr>
	
	<td class="td3">Dimenzije</td>
	<td class="td4"><?php echo $ekran['1'] ?></td>
</tr>
<tr>
	
	<td class="td3">Rezolucija</td>
	<td class="td4"><?php echo $ekran['2'] ?></td>
</tr>
<tr>

	<td class="td3">Zaštita</td>
	<td class="td4"><?php echo $ekran['3'] ?></td>
</tr>
<tr>
	
	<td class="td1" colspan="3"><i class="fas fa-camera"></i>   Kamera (zadnja)</td>
	
</tr>

<tr>
	
	<td class="td3">Rezolucija</td>
	<td class="td4"><?php echo $kamera['0'] ?></td>
</tr>
<tr>

	<td class="td3">Video</td>
	<td class="td4"><?php echo $kamera['2'] ?></td>
</tr>
<tr>

	<td class="td3">Blic</td>
	<td class="td4"><?php echo $kamera['1'] ?></td>
</tr>

<tr>

	<td class="td1" colspan="3"><i class="fas fa-camera"></i>   Kamera (prednja)</td>
	
</tr>
<tr>
	
	<td class="td3">Rezolucija</td>
	<td class="td4"><?php echo $kamera['3'] ?></td>
</tr>
<tr>

	<td class="td3">Video</td>
	<td class="td4"><?php echo $kamera['5'] ?></td>
</tr>
<tr>

	<td class="td3">Blick</td>
	<td class="td4"><?php echo $kamera['4'] ?></td>
</tr>

<tr>
	<td class="td1" colspan="3"><i class="fas fa-memory"></i>   Memorija</td>

</tr>
<tr>
	<td class="td3">Interna memorija</td>
	<td class="td4"><?php echo $cipovi['3'] ?></td>
</tr>

<tr>
	
	<td class="td3">SD kartica</td>
	<td class="td4"><?php echo $cipovi['4'] ?></td>
</tr>
<tr>
	<td class="td1" colspan="3"><i class="fas fa-terminal"></i>   Softver</td>

</tr>
<tr>

	<td class="td3" >Operativni sistem</td>
	
	<td class="td4"><?php echo $modul['1'] ?></td>
</tr>
<tr>

	<td class="td3" >Senzori</td>
	
	<td class="td4"><?php echo $modul['2'] ?></td>
</tr>

<tr>
	<td class="td1" colspan="3"><i class="fas fa-satellite-dish"></i>   Komunikacija</td>

</tr>
<tr>
	<td class="td3">GPS</td>
	<td class="td4"><?php echo $mreze['4'] ?></td>
</tr>
<tr>
	<td class="td3">Wifi</td>
	<td class="td4"><?php echo $mreze['0'] ?></td>
</tr>
<tr>
	
	<td class="td3">Bluetooth</td>
	<td class="td4"><?php echo $mreze['1'] ?></td>
</tr>
<tr>

	<td class="td3">USB</td>
	<td class="td4"><?php echo $mreze['2'] ?></td>
</tr>
<tr>

	<td class="td3">FM radio</td>
	<td class="td4"><?php echo $mreze['3'] ?></td>
</tr>
</table>
</div>