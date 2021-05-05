<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<!-- Get all topics -->
	<title>Admin | Create Post</title>
	<?php 

global $conn;
$phones = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM phones"), MYSQLI_ASSOC);
$phones1 = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM modeli"), MYSQLI_ASSOC);
$none = " /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/ ";

if (isset($_GET['id']) && $_GET['id'] != '') {
	$id = $_GET['id'];
	$models = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM phones WHERE id=$id LIMIT 1"));

   if ($models != '') {
   $kuciste = explode('/%/', $models['kuciste']);
   $ekran = explode('/%/', $models['ekran']);
   $kamera = explode('/%/', $models['kamera']);
   $cipovi = explode('/%/', $models['cipovi']);
   $modul = explode('/%/', $models['moduli']);
   $mreze = explode('/%/', $models['mreze']);
   }else{
   $models['model'] = "";
      $models['id_telefona'] = "";

   $models['datum'] = "";

   $models['marka'] = "";
   $models['photo'] = "";
   $kuciste = explode('/%/', $none);
   $ekran = explode('/%/', $none);
   $kamera = explode('/%/', $none);
   $cipovi = explode('/%/', $none);
   $modul = explode('/%/', $none);
   $mreze = explode('/%/', $none);
   }


}else{
   $models['model'] = "";
   $models['marka'] = "";
   $models['photo'] = "";
     $models['id_telefona'] = "";
      
   $models['datum'] = "";

   $kuciste = explode('/%/', $none);
   $ekran = explode('/%/', $none);
   $kamera = explode('/%/', $none);
   $cipovi = explode('/%/', $none);
   $modul = explode('/%/', $none);
   $mreze = explode('/%/', $none);
   }

	 ?>
	 <style type="text/css">
	 	 .all {
         display: none;
         }
         .a11{
         display: block; 
         }
	 </style>
</head>
<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		
	<h2>Specifikacije telefona</h2>


 <div>
                     <div style="width: 160px;
                        height: 213px;
                        margin: auto;
                        padding: 10px;"><?php if (isset($_GET['id'])): ?>
                        <img src="/static/images/modeli/<?php echo $models['photo'] ?>">
                        <?php endif ?>
                     </div>
                     <select style="display: block;margin: 10px auto; padding: 2px;" class="com1">
                       <option value="0"  disabled="disabled" selected>Izaberi Proizvođača</option>

                        <?php foreach ($phones1 as $tels): ?>
                        <option value="<?php echo $tels['id_telefona'] ?>"><?php echo $tels['model'] ?></option>
                        <?php endforeach ?>
                     </select>
                     <select style="display: block;margin: 10px auto; padding: 2px;" class="coms1">
                        <option value="0" disabled="disabled" selected>Izaberi Model</option>
                        <?php foreach ($phones as $tels1): ?>
                        <option value="<?php echo $tels1['id'] ?>" class="a1 a0<?php echo $tels1['id_telefona'] ?> all"><?php echo $tels1['model'] ?></option>
                        <?php endforeach ?>
                     </select>
                  </div>
<div >
<form method="post">
	

<style type="text/css">
	input{
		width: 450px;
		padding: 10px;
	}
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
				

	<table>
<tr>
	<td class="td1" colspan="3"><i class="fas fa-industry"></i>   Proizvodjac i model</td>
	
</tr>
<tr>
	<td class="td3">Marka</td>
	<td class="td4"><input type="text" name="a1" value="<?php echo $models['marka'] ?>"></td></tr>
	<tr>
	<td class="td3">Marka_id</td>
	<td class="td4"><input type="text" name="a0" value="<?php echo $models['id_telefona'] ?>"></td>
</tr>
<tr>
	<td class="td3">Model</td>
	<td class="td4"><input type="text" name="a2" value="<?php echo $models['model'] ?>"></td>
</tr>
<tr>
	<td class="td3">Slika</td>
	<td class="td4"><input type="text" name="a3" value="<?php echo $models['photo'] ?>"></td>
</tr>
<tr>
	<td class="td3">Napravljen</td>
	<td class="td4"><input type="text" name="a4" value="<?php echo $models['datum'] ?>"></td>
</tr>
<tr>
	
	<td class="td1" colspan="3"><i class="fas fa-stream"></i>   Kuciste</td>

</tr>
<tr>
	<td class="td3">Dimenzije</td>
	<td class="td4"><input type="text" name="b1" value="<?php echo $kuciste['0'] ?>"></td>
</tr>
<tr>
	
	<td class="td3">Masa</td>
	<td class="td4"><input type="text" name="b2" value="<?php echo $kuciste['1'] ?>"></td>
</tr>
<tr>
	
	
	<td class="td3">Oblik</td>
	<td class="td4"><input type="text" name="b3" value="<?php echo $kuciste['2'] ?>"></td>
</tr>
<tr>
	
	
	<td class="td3">Boje</td>
	<td class="td4"><input type="text" name="b4" value="<?php echo $kuciste['3'] ?>"></td>
</tr>
<tr>
	
	
	<td class="td3">Zastita</td>
	<td class="td4"><input type="text" name="b5" value="<?php echo $kuciste['4'] ?>"></td>
</tr>
<tr>
	
	
	<td class="td3">Izrada</td>
	<td class="td4"><input type="text" name="b6" value="<?php echo $kuciste['5'] ?>"></td>
</tr>
<tr>
	
	<td class="td1" colspan="3"><i class="fas fa-microchip"></i>   Procesor</td>
	
</tr>
<tr>
	

	<td class="td3">Procesor</td>
	<td class="td4"><input type="text" name="c1" value="<?php echo $cipovi['0'] ?>"></td>
</tr>
<tr>

	
	<td class="td3">Cipset</td>
	<td class="td4"><input type="text" name="c2" value="<?php echo $cipovi['1'] ?>"></td>
</tr>
<tr>

	
	<td class="td3">Graficka</td>
	<td class="td4"><input type="text" name="c3" value="<?php echo $cipovi['2'] ?>"></td>
</tr>
<tr>
	
	<td class="td1" colspan="3"><i class="fas fa-battery-three-quarters"></i>   Baterija</td>


</tr>
<tr>
	
	<td class="td3">Vrsta</td>
	<td class="td4"><input type="text" name="d1" value="<?php echo $modul['0'] ?>"></td>

</tr>
<tr>

	<td class="td3">Kapacitet</td>
	<td class="td4"><input type="text" name="d2" value="<?php echo $modul['1'] ?>"></td>
</tr>

<tr>
	<td class="td1" colspan="3"><i class="fas fa-mobile"></i>   Displej</td>

</tr>
<tr>
	
	<td class="td3">Tip</td>
	<td class="td4"><input type="text" name="e1" value="<?php echo $ekran['0'] ?>"></td>
</tr>
<tr>
	
	<td class="td3">Velicina</td>
	<td class="td4"><input type="text" name="e2" value="<?php echo $ekran['1'] ?>"></td>
</tr>
<tr>
	
	<td class="td3">Rezolucija</td>
	<td class="td4"><input type="text" name="e3" value="<?php echo $ekran['2'] ?>"></td>
</tr>
<tr>

	<td class="td3">Ostalo</td>
	<td class="td4"><input type="text" name="e4" value="<?php echo $ekran['3'] ?>"></td>
</tr>
<tr>
	
	<td class="td1" colspan="3"><i class="fas fa-camera"></i>   Kamera (zadnja)</td>
	
</tr>

<tr>
	
	<td class="td3">Rezolucija</td>
	<td class="td4"><input type="text" name="q1" value="<?php echo $kamera['0'] ?>"></td>
</tr>
<tr>

	<td class="td3">Video</td>
	<td class="td4"><input type="text" name="q2" value="<?php echo $kamera['1'] ?>"></td>
</tr>
<tr>

	<td class="td3">Blick</td>
	<td class="td4"><input type="text" name="q3" value="<?php echo $kamera['2'] ?>"></td>
</tr>

<tr>

	<td class="td1" colspan="3"><i class="fas fa-camera"></i>   Kamera (prednja)</td>
	
</tr>
<tr>
	
	<td class="td3">Rezolucija</td>
	<td class="td4"><input type="text" name="w1" value="<?php echo $kamera['3'] ?>"></td>
</tr>
<tr>

	<td class="td3">Video</td>
	<td class="td4"><input type="text" name="w2" value="<?php echo $kamera['4'] ?>"></td>
</tr>
<tr>

	<td class="td3">Blick</td>
	<td class="td4"><input type="text" name="w3" value="<?php echo $kamera['5'] ?>"></td>
</tr>
<tr>

	<td class="td3">Ostalo</td>
	<td class="td4"><input type="text" name="w4" value="<?php echo $kamera['6'] ?>"></td>
</tr>
<tr>
	<td class="td1" colspan="3"><i class="fas fa-memory"></i>   Memorija</td>

</tr>
<tr>
	<td class="td3">RAM</td>
	<td class="td4"><input type="text" name="r1" value="<?php echo $cipovi['3'] ?>"></td>
</tr>
<tr>
	
	<td class="td3">Kapacitet</td>
	<td class="td4"><input type="text" name="r2" value="<?php echo $cipovi['4'] ?>"></td>
</tr>
<tr>
	
	<td class="td3">SD kartica</td>
	<td class="td4"><input type="text" name="r3" value="<?php echo $cipovi['5'] ?>"></td>
</tr>
<tr>
	<td class="td1" colspan="3"><i class="fas fa-terminal"></i>   Softver</td>

</tr>
<tr>

	<td class="td3" >Operativni sistem</td>
	
	<td class="td4"><input type="text" name="y1" value="<?php echo $modul['2'] ?>"></td>
</tr>

<tr>
	<td class="td1" colspan="3"><i class="fas fa-satellite-dish"></i>   Komunikacija</td>

</tr>
<tr>
	<td class="td3">Wifi</td>
	<td class="td4"><input type="text" name="u1" value="<?php echo $mreze['0'] ?>"></td>
</tr>
<tr>
	
	<td class="td3">Bluetooth</td>
	<td class="td4"><input type="text" name="u2" value="<?php echo $mreze['1'] ?>"></td>
</tr>
<tr>

	<td class="td3">USB</td>
	<td class="td4"><input type="text" name="u3" value="<?php echo $mreze['2'] ?>"></td>
</tr>
<tr>

	<td class="td3">FM radio</td>
	<td class="td4"><input type="text" name="u4" value="<?php echo $mreze['3'] ?>"></td>
</tr>
</table>
</div>
<button name="changePhone">Sacuvaj</button>





</form>
</div>

	</div>

</body>

</html>

<script>
		$(".coms1").on('change',function() {
var id = $(this).val();
 var href = window.location.href.substring(0, window.location.href.indexOf('?'));
       
        window.location.replace(href + '?id=' + id);
    });

		 $('.com1').on('change',function(){
   $('.a1').css({"display" : "none"});
   $('.coms1 option:first').prop('selected',true);
   
   var num = '.a1.a0' + $('.com1 option:selected').val();
   $(num).css({"display" : "block"});
   });
   
</script>
