<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php
   global $conns,$errors;
   if (isset($_GET['id_telefona'])) {
   $id_telefona = $_GET['id_telefona'];



 $stm = $conns->prepare("SELECT * FROM phones WHERE id=? LIMIT 1");
    $stm->execute([$id_telefona]);
      $models = $stm->fetch(PDO::FETCH_ASSOC);




   }
   if (isset($_GET['id_telefona2'])) {
   $id_telefona2 = $_GET['id_telefona2'];


 $stm = $conns->prepare("SELECT * FROM phones WHERE id=? LIMIT 1");
    $stm->execute([$id_telefona2]);
      $models1  = $stm->fetch(PDO::FETCH_ASSOC);

   }
   if (isset($_GET['id_telefona3'])) {
   $id_telefona3 = $_GET['id_telefona3'];


    $stm = $conns->prepare("SELECT * FROM phones WHERE id=? LIMIT 1");
    $stm->execute([$id_telefona3]);
      $models2  = $stm->fetch(PDO::FETCH_ASSOC);

   }
   
   
 

   $stm = $conns->prepare("SELECT * FROM phones");
    $stm->execute();
      $tel1  = $stm->fetchAll(PDO::FETCH_ASSOC);



   $num = $stm->rowCount();

      $stm = $conns->prepare("SELECT * FROM modeli");
    $stm->execute();
      $tel  = $stm->fetchAll(PDO::FETCH_ASSOC);

   
   
   $none = " /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/  /%/ ";
   if (isset($models) && !empty($models)) {
   $kuciste = explode('/%/', $models['kuciste']);
   $ekran = explode('/%/', $models['ekran']);
   $kamera = explode('/%/', $models['kamera']);
   $cipovi = explode('/%/', $models['cipovi']);
   $modul = explode('/%/', $models['moduli']);
   $mreze = explode('/%/', $models['mreze']);
   }else{
   $models['model'] = "";
   $models['marka'] = "";
   $models['photo'] = "";
   $models['datum'] = "";
   $kuciste = explode('/%/', $none);
   $ekran = explode('/%/', $none);
   $kamera = explode('/%/', $none);
   $cipovi = explode('/%/', $none);
   $modul = explode('/%/', $none);
   $mreze = explode('/%/', $none);
   }
   
   
   
   
   if (isset($models1) && !empty($models1)) {
   $kuciste1 = explode('/%/', $models1['kuciste']);
   $ekran1 = explode('/%/', $models1['ekran']);
   $kamera1 = explode('/%/', $models1['kamera']);
   $cipovi1 = explode('/%/', $models1['cipovi']);
   $modul1 = explode('/%/', $models1['moduli']);
   $mreze1 = explode('/%/', $models1['mreze']);
   }else{
   $models1['model'] = "";
   $models1['marka'] = "";
   $models1['photo'] = "";
   $models1['datum'] = "";

   $kuciste1 = explode('/%/', $none);
   $ekran1 = explode('/%/', $none);
   $kamera1 = explode('/%/', $none);
   $cipovi1 = explode('/%/', $none);
   $modul1 = explode('/%/', $none);
   $mreze1 = explode('/%/', $none);
   }
   
   
 
   
   
   if (isset($models2) && !empty($models2)) {
   $kuciste2 = explode('/%/', $models2['kuciste']);
   $ekran2 = explode('/%/', $models2['ekran']);
   $kamera2 = explode('/%/', $models2['kamera']);
   $cipovi2 = explode('/%/', $models2['cipovi']);
   $modul2 = explode('/%/', $models2['moduli']);
   $mreze2 = explode('/%/', $models2['mreze']);
   }else{
   $models2['model'] = "";
   $models2['marka'] = "";
   $models2['photo'] = "";
   $models2['datum'] = "";
   $kuciste2 = explode('/%/', $none);
   $ekran2 = explode('/%/', $none);
   $kamera2 = explode('/%/', $none);
   $cipovi2 = explode('/%/', $none);
   $modul2 = explode('/%/', $none);
   $mreze2 = explode('/%/', $none);
   }
   
   
   
   
    ?>
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
<script type="text/javascript">
   $(document).ready(function(){
   var href = window.location.href.substring(0, window.location.href.indexOf('?'));
          var qs = window.location.href.substring(window.location.href.indexOf('?') + 1, window.location.href.length);
          var id1= window.ids;
   $('.com1').on('change',function(){
   $('.a1').css({"display" : "none"});
   $('.coms1 option:first').prop('selected',true);
   
   var num = '.a1.a0' + $('.com1 option:selected').val();
   $(num).css({"display" : "block"});
   });
   
   
   
   
   $('.com2').on('change',function(){
   $('.a2').css({"display" : "none"});
   $('.coms2 option:first').prop('selected',true);
   
   var num = '.a2.a0' + $('.com2 option:selected').val();
   $(num).css({"display" : "block"});
   });
   
   
   
   
   $('.com3').on('change',function(){
   $('.a3').css({"display" : "none"});
   $('.coms3 option:first').prop('selected',true);
   
   var num = '.a3.a0' + $('.com3 option:selected').val();
   $(num).css({"display" : "block"});
   });
   $('.coms1').on('change',function(){
   if ($(".coms1 option:selected").val() != 0) {
              var mreza = $(".coms1 option:selected").val();
            
          var model_id12 = "id_telefona=" + mreza;
          if (qs.indexOf("id_telefona=") == -1) {
               if (window.location.href.indexOf('?') == -1) {
                  qs = ''
              }
              else {
                  qs = qs + '&'
              }
              qs = qs + model_id12;
   
          }
          else {
              var start = qs.indexOf("id_telefona=");
              var end = qs.indexOf("&", start);
              if (end == -1) {
                  end = qs.length;
              }
              var curParam = qs.substring(start, end);
              qs = qs.replace(curParam, model_id12);
          }
          window.location.replace(href + '?' + qs);
            }
   });
   
   $('.coms2').on('change',function(){
   if ($(".coms2 option:selected").val() != 0) {
              var mreza = $(".coms2 option:selected").val();
            
          var model_id12 = "id_telefona2=" + mreza;
          if (qs.indexOf("id_telefona2=") == -1) {
               if (window.location.href.indexOf('?') == -1) {
                  qs = ''
              }
              else {
                  qs = qs + '&'
              }
              qs = qs + model_id12;
   
          }
          else {
              var start = qs.indexOf("id_telefona2=");
              var end = qs.indexOf("&", start);
              if (end == -1) {
                  end = qs.length;
              }
              var curParam = qs.substring(start, end);
              qs = qs.replace(curParam, model_id12);
          }
          window.location.replace(href + '?' + qs);
            }
   });
   $('.coms3').on('change',function(){
   if ($(".coms3 option:selected").val() != 0) {
              var mreza = $(".coms3 option:selected").val();
            
          var model_id12 = "id_telefona3=" + mreza;
          if (qs.indexOf("id_telefona3=") == -1) {
               if (window.location.href.indexOf('?') == -1) {
                  qs = ''
              }
              else {
                  qs = qs + '&'
              }
              qs = qs + model_id12;
   
          }
          else {
              var start = qs.indexOf("id_telefona3=");
              var end = qs.indexOf("&", start);
              if (end == -1) {
                  end = qs.length;
              }
              var curParam = qs.substring(start, end);
              qs = qs.replace(curParam, model_id12);
          }
          window.location.replace(href + '?' + qs);
            }
   });
   
      });
   
   
        $('#mobile_media_css').remove();

   
</script>

<title>PolovniTelefoni.net | Upoređivač</title>
</head>
<body>
   <?php include( ROOT_PATH . '/includes/navbar.php') ?>
   <div class="container">
   <div class="content">
      <style type="text/css">
         td{
         box-shadow: -2px 3px 20px #00000024;
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
         padding:7px;
         text-align: center;
         }
         .td4{
         width: 300px;
         padding: 6px;
         padding-left: 20px;
         }
         .all {
         display: none;
         }
         .a11{
         display: block; 
         }







         
table{
  border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    width: 100%;
    margin: 0 auto;
    position: relative;
}
.table100-head{
  height: 60px;
    background: #6974e8;
}
.column1{
text-align: center;padding: 5px 10px;
width: 260px;
    padding-left: 40px;
}
.column2{
text-align: center;padding: 5px 10px;
width: 260px;
  
}
.column3{
text-align: center;padding: 5px 10px;
width: 260px;
  
}
.column4{
text-align: center;padding: 5px 10px;
width: 260px;
  
}
.column5{
text-align: center;padding: 5px 10px;
width: 260px;
  
}
table tbody tr{
      height: 50px;
}
tbody tr {
    font-family: Source Sans Pro;
    font-size: 15px;
    color: #808080;
    line-height: 1.2;
    font-weight: unset;
}
.table100-head th{
      font-family: Source Sans Pro;
    font-size: 18px;
    color: #fff;
    line-height: 1.2;
    font-weight: unset;
}
tbody tr:nth-child(even) {
    background-color: #f5f5f5;
}
tbody tr:hover {
    color: #555555;
    background-color: #f5f5f5;
    cursor: pointer;
}
td{ box-shadow: unset!important; }
      </style>
      <div style="
         width: 950px;
         margin: auto;
         padding-top: 20px;
         padding-right: 8px;
         padding-bottom: 40px;">
         <table>
            <tr>
               <td class="td1">Specifikacije</td>
               <td>
                  <div>
                     <div style="width: 160px;
                        height: 213px;
                        margin: auto;
                        padding: 10px;"><?php if (isset($_GET['id_telefona'])): ?>
                        <img src="/static/images/modeli/<?php echo $models['photo'] ?>">
                        <?php endif ?>
                     </div>
                     <select style="display: block;margin: 10px auto;" class="com1 custom-select">
                       <option value="0"  disabled="disabled" selected>Izaberi Proizvođača</option>

                        <?php foreach ($tel as $tels): ?>
                        <option value="<?php echo $tels['id_telefona'] ?>"><?php echo $tels['model'] ?></option>
                        <?php endforeach ?>
                     </select>
                     <select style="display: block;margin: 10px auto;width: 240px;" class="coms1 custom-select">
                        <option value="0" disabled="disabled" selected>Izaberi Model</option>
                        <?php foreach ($tel1 as $tels1): ?>
                        <option value="<?php echo $tels1['id'] ?>" class="a1 a0<?php echo $tels1['id_telefona'] ?> all"><?php echo $tels1['model'] ?></option>
                        <?php endforeach ?>
                     </select>
                  </div>
               </td>
               <td>
                  <div>
                     <div style="width: 160px;
                        height: 213px;
                        margin: auto;
                        padding: 10px;"><?php if (isset($_GET['id_telefona2'])): ?>
                        <img src="/static/images/modeli/<?php echo $models1['photo'] ?>">
                        <?php endif ?>
                     </div>
                     <select style="display: block;margin: 10px auto; " class="com2 custom-select">
                                             <option value="0"  disabled="disabled" selected>Izaberi Proizvođača</option>

                        <?php foreach ($tel as $tels): ?>
                        <option value="<?php echo $tels['id_telefona'] ?>"><?php echo $tels['model'] ?></option>
                        <?php endforeach ?>
                     </select>
                     <select style="display: block;margin: 10px auto;width: 240px;" class="coms2 custom-select">
                        <option value="0" disabled="disabled" selected>Izaberi Model</option>
                        <?php foreach ($tel1 as $tels1): ?>
                        <option value="<?php echo $tels1['id'] ?>" class="a2 a0<?php echo $tels1['id_telefona'] ?> all"><?php echo $tels1['model'] ?></option>
                        <?php endforeach ?>
                     </select>
                  </div>
               </td>
               <td>
                  <div>
                     <div style="width: 160px;
                        height: 213px;
                        margin: auto;
                        padding: 10px;"><?php if (isset($_GET['id_telefona3'])): ?>
                        <img src="/static/images/modeli/<?php echo $models2['photo'] ?>">
                        <?php endif ?>
                     </div>
                     <select style="display: block;margin: 10px auto;" class="com3 custom-select">
                                             <option value="0"  disabled="disabled" selected>Izaberi Proizvođača</option>

                        <?php foreach ($tel as $tels): ?>
                        <option value="<?php echo $tels['id_telefona'] ?>"><?php echo $tels['model'] ?></option>
                        <?php endforeach ?>
                     </select>
                     <select style="display: block;margin: 10px auto;width: 240px;" class="coms3 custom-select">
                        <option value="0" disabled="disabled" selected>Izaberi Model</option>
                        <?php foreach ($tel1 as $tels1): ?>
                        <option value="<?php echo $tels1['id'] ?>" class="a3 a0<?php echo $tels1['id_telefona'] ?> all"><?php echo $tels1['model'] ?></option>
                        <?php endforeach ?>
                     </select>
                  </div>
               </td>
            </tr>
            <tr>
               <td class="td1" colspan="4"><i class="fas fa-industry"></i>   Proizvođač i Model</td>
            </tr>
            <tr>
               <td class="td3">Marka</td>
               <td class="td4"><?php echo $models['marka'] ?></td>
               <td class="td4"><?php echo $models1['marka'] ?></td>
               <td class="td4"><?php echo $models2['marka'] ?></td>
            </tr>
            <tr>
               <td class="td3">Model</td>
               <td class="td4"><?php echo $models['model'] ?></td>
               <td class="td4"><?php echo $models1['model'] ?></td>
               <td class="td4"><?php echo $models2['model'] ?></td>
            </tr>
            <tr>
                <td class="td3">Gordina proizvodnje</td>
                <td class="td4"><?php if ($models['datum'] != '') {echo date("F, Y", strtotime($models['datum']));} ?></td>
                <td class="td4"><?php if ($models1['datum'] != '') {echo date("F, Y", strtotime($models1['datum']));} ?></td>
                <td class="td4"><?php if ($models2['datum'] != '') {echo date("F, Y", strtotime($models2['datum']));} ?></td>

            </tr>
            <tr>
               <td class="td1" colspan="4"><i class="fas fa-stream"></i>   Kućište</td>
            </tr>
            <tr>
               <td class="td3">Dimenzije</td>
               <td class="td4"><?php echo $kuciste['0'] ?></td>
               <td class="td4"><?php echo $kuciste1['0'] ?></td>
               <td class="td4"><?php echo $kuciste2['0'] ?></td>
            </tr>
            <tr>
               <td class="td3">Masa</td>
               <td class="td4"><?php echo $kuciste['4'] ?></td>
               <td class="td4"><?php echo $kuciste1['4'] ?></td>
               <td class="td4"><?php echo $kuciste2['4'] ?></td>
            </tr>
          
            <tr>
               <td class="td3">Boje</td>
               <td class="td4"><?php echo $kuciste['2'] ?></td>
               <td class="td4"><?php echo $kuciste1['2'] ?></td>
               <td class="td4"><?php echo $kuciste2['2'] ?></td>
            </tr>

            <tr>
               <td class="td3">Izrada</td>
               <td class="td4"><?php echo $kuciste['3'] ?></td>
               <td class="td4"><?php echo $kuciste1['3'] ?></td>
               <td class="td4"><?php echo $kuciste2['3'] ?></td>
            </tr>
            <tr>
               <td class="td1" colspan="4"><i class="fas fa-microchip"></i>   Procesor</td>
            </tr>
            <tr>
               <td class="td3">Procesor</td>
               <td class="td4"><?php echo $cipovi['0'] ?></td>
               <td class="td4"><?php echo $cipovi1['0'] ?></td>
               <td class="td4"><?php echo $cipovi2['0'] ?></td>
            </tr>
            <tr>
               <td class="td3">Čipset</td>
               <td class="td4"><?php echo $cipovi['1'] ?></td>
               <td class="td4"><?php echo $cipovi1['1'] ?></td>
               <td class="td4"><?php echo $cipovi2['1'] ?></td>
            </tr>
            <tr>
               <td class="td3">Grafička</td>
               <td class="td4"><?php echo $cipovi['2'] ?></td>
               <td class="td4"><?php echo $cipovi1['2'] ?></td>
               <td class="td4"><?php echo $cipovi2['2'] ?></td>
            </tr>
            <tr>
               <td class="td1" colspan="4"><i class="fas fa-battery-three-quarters"></i>   Baterija</td>
            </tr>
            <tr>
               <td class="td3">Vrsta</td>
               <td class="td4"><?php echo $modul['0'] ?></td>
               <td class="td4"><?php echo $modul1['0'] ?></td>
               <td class="td4"><?php echo $modul2['0'] ?></td>
            </tr>

            <tr>
               <td class="td1" colspan="4"><i class="fas fa-mobile"></i>   Displej</td>
            </tr>
            <tr>
               <td class="td3">Tip</td>
               <td class="td4"><?php echo $ekran['0'] ?></td>
               <td class="td4"><?php echo $ekran1['0'] ?></td>
               <td class="td4"><?php echo $ekran2['0'] ?></td>
            </tr>
            <tr>
               <td class="td3">Dimenzije</td>
               <td class="td4"><?php echo $ekran['1'] ?></td>
               <td class="td4"><?php echo $ekran1['1'] ?></td>
               <td class="td4"><?php echo $ekran2['1'] ?></td>
            </tr>
            <tr>
               <td class="td3">Rezolucija</td>
               <td class="td4"><?php echo $ekran['2'] ?></td>
               <td class="td4"><?php echo $ekran1['2'] ?></td>
               <td class="td4"><?php echo $ekran2['2'] ?></td>
            </tr>
            <tr>
               <td class="td3">Zaštita</td>
               <td class="td4"><?php echo $ekran['3'] ?></td>
               <td class="td4"><?php echo $ekran1['3'] ?></td>
               <td class="td4"><?php echo $ekran2['3'] ?></td>
            </tr>
            <tr>
               <td class="td1" colspan="4"><i class="fas fa-camera"></i>   Kamera (zadnja)</td>
            </tr>
            <tr>
               <td class="td3">Rezolucija</td>
               <td class="td4"><?php echo $kamera['0'] ?></td>
               <td class="td4"><?php echo $kamera1['0'] ?></td>
               <td class="td4"><?php echo $kamera2['0'] ?></td>
            </tr>
            <tr>
               <td class="td3">Video</td>
               <td class="td4"><?php echo $kamera['2'] ?></td>
               <td class="td4"><?php echo $kamera1['2'] ?></td>
               <td class="td4"><?php echo $kamera2['2'] ?></td>
            </tr>
            <tr>
               <td class="td3">Blic</td>
               <td class="td4"><?php echo $kamera['1'] ?></td>
               <td class="td4"><?php echo $kamera1['1'] ?></td>
               <td class="td4"><?php echo $kamera2['1'] ?></td>
            </tr>
            <tr>
               <td class="td1" colspan="4"><i class="fas fa-camera"></i>   Kamera (prednja)</td>
            </tr>
            <tr>
               <td class="td3">Rezolucija</td>
               <td class="td4"><?php echo $kamera['3'] ?></td>
               <td class="td4"><?php echo $kamera1['3'] ?></td>
               <td class="td4"><?php echo $kamera2['3'] ?></td>
            </tr>
            <tr>
               <td class="td3">Video</td>
               <td class="td4"><?php echo $kamera['5'] ?></td>
               <td class="td4"><?php echo $kamera1['5'] ?></td>
               <td class="td4"><?php echo $kamera2['5'] ?></td>
            </tr>
            <tr>
               <td class="td3">Blic</td>
               <td class="td4"><?php echo $kamera['4'] ?></td>
               <td class="td4"><?php echo $kamera1['4'] ?></td>
               <td class="td4"><?php echo $kamera2['4'] ?></td>
            </tr>
         
            <tr>
               <td class="td1" colspan="4"><i class="fas fa-memory"></i>   Memorija</td>
            </tr>
            <tr>
               <td class="td3">Interna memorija</td>
               <td class="td4"><?php echo $cipovi['3'] ?></td>
               <td class="td4"><?php echo $cipovi1['3'] ?></td>
               <td class="td4"><?php echo $cipovi2['3'] ?></td>
            </tr>
 
            <tr>
               <td class="td3">SD kartica</td>
               <td class="td4"><?php echo $cipovi['4'] ?></td>
               <td class="td4"><?php echo $cipovi1['4'] ?></td>
               <td class="td4"><?php echo $cipovi2['4'] ?></td>
            </tr>
            <tr>
               <td class="td1" colspan="4"><i class="fas fa-terminal"></i>   Softver</td>
            </tr>
            <tr>
               <td class="td3" >Operativni sistem</td>
               <td class="td4"><?php echo $modul['1'] ?></td>
               <td class="td4"><?php echo $modul1['1'] ?></td>
               <td class="td4"><?php echo $modul2['1'] ?></td>
            </tr>
              <tr>
               <td class="td3" >Senzori</td>
               <td class="td4"><?php echo $modul['2'] ?></td>
               <td class="td4"><?php echo $modul1['2'] ?></td>
               <td class="td4"><?php echo $modul2['2'] ?></td>
            </tr>
            <tr>
               <td class="td1" colspan="4"><i class="fas fa-satellite-dish"></i>   Komunikacija</td>
            </tr>
              <tr>
               <td class="td3">GPS</td>
               <td class="td4"><?php echo $mreze['4'] ?></td>
               <td class="td4"><?php echo $mreze1['4'] ?></td>
               <td class="td4"><?php echo $mreze2['4'] ?></td>
            </tr>
            <tr>
               <td class="td3">Wifi</td>
               <td class="td4"><?php echo $mreze['0'] ?></td>
               <td class="td4"><?php echo $mreze1['0'] ?></td>
               <td class="td4"><?php echo $mreze2['0'] ?></td>
            </tr>
            <tr>
               <td class="td3">Bluetooth</td>
               <td class="td4"><?php echo $mreze['1'] ?></td>
               <td class="td4"><?php echo $mreze1['1'] ?></td>
               <td class="td4"><?php echo $mreze2['1'] ?></td>
            </tr>
            <tr>
               <td class="td3">USB</td>
               <td class="td4"><?php echo $mreze['2'] ?></td>
               <td class="td4"><?php echo $mreze1['2'] ?></td>
               <td class="td4"><?php echo $mreze2['2'] ?></td>
            </tr>
            <tr>
               <td class="td3">FM radio</td>
               <td class="td4"><?php echo $mreze['3'] ?></td>
               <td class="td4"><?php echo $mreze1['3'] ?></td>
               <td class="td4"><?php echo $mreze2['3'] ?></td>
            </tr>
         </table>
      </div>
   </div>
   <?php include( ROOT_PATH . '/includes/footer.php') ?>