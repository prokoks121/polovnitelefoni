<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/user/user-fuction.php') ?>
<?php $models = getPhone(); 

   $telefon = getFirmaCena();
   $kuciste = explode('/%/', $models['kuciste']);
   $ekran = explode('/%/', $models['ekran']);
   $kamera = explode('/%/', $models['kamera']);
   $cipovi = explode('/%/', $models['cipovi']);
   $modul = explode('/%/', $models['moduli']);
   $mreze = explode('/%/', $models['mreze']);
   $pix1 = explode(',', $kamera['0']);
   $pix2 = explode(',', $kamera['3']);
   $ekran1 = explode(',', $ekran['2']);
   $ekran2 = explode(',', $ekran['1']);
   $cpu = explode('@',explode(',', $cipovi['0'])['0']);
   $cipovis = explode(',', $cipovi['3']);
  $cpu = explode('(', $cpu['0']);

   $bat = explode(' ', $modul['0']);
   ?>
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
<meta name="description" content="Kupi jeftino & Prodaj brzo <?php echo "\r\n". $models['marka'] . " " . $models['model'] ?>">
  <meta name="keywords" content="kupomobil,mobilni,telefon,polovni,prodaja,kupovina,oglasi,nov,specifikacije,mobilni telefoni,polovni mobilni telefoni,polovni telefoni,<?php echo $models['marka'] . "," . $models['model'] ?>">
<style type="text/css">
    .report_div{
              position: absolute;
    margin-left: 764px;
    border-radius: 30px;
    overflow: hidden;
    float: right;
    margin-right: 20px;
    background-color: #ec202e;
    padding: 10px;
    font-weight: 600;
    transition-duration: 0.2s;
    width: 18px;
    height: 18px;
   }
   .report_a{
     color: white;
    font-size: 16px;
    width: 181px;
    height: 18px;
    position: absolute;
   }
   #report{
      margin-left: 9px;
   }
.report_div:hover{
    margin-left:500px;
}  
.report_div:hover{
    margin-left:601px;
     width: 181px;
}  
table{
  border-collapse: collapse;
    background: white;
    border-radius: 10px;
        border-top-left-radius: 0px;
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
<!--
<script type="text/javascript">

   $(document).ready( function() {
      function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

      var username = getCookie("phone_id");
  if (username != "") {
   alert("Welcome again " + username);
  } 
  

      function setCookie(cname, cvalue) {


var now = new Date();
now.setTime(now.getTime() + 1 * 3600 * 1000);


  var expires = "expires="+ now.toUTCString();


  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";



  var username = getCookie("phone_id");
  if (username != "") {
   alert("Welcome again " + username);
  }
  
}




});
</script>
-->
<title>PolovniTelefoni.net <?php echo $models['marka'] ." ".$models['model']; ?></title>
</head>
<body>
     <?php include(ROOT_PATH . '/includes/errors.php') ?>

   <?php include( ROOT_PATH . '/includes/navbar.php') ?>
   <div class="container">
   <div class="content">
      <div class="comed1">
         <div class="comed2">
          <h1 style="display: none;"><?php echo $models['marka'] ." ".$models['model']; ?></h1>
            <h2><?php echo $models['marka'] ." ".$models['model']; ?></h2>
         </div>
         <div style="display: flex;">
            <div style="float: left;"> <img style="display: block;" alt="<?php echo $models['marka'] ." ".$models['model']; ?>" src="<?php echo '/static/images/modeli/' . $models['photo']; ?>" >
            </div>
            <div class="div_79" >
               <div>
                  <div class="comed3">
                     <i class="fas fa-memory" style="font-size: 50px; color: #454545;"></i>
                     <p style="    font-weight: 600;">
                        <?php echo $cipovis['0']; ?>
                     </p>
                    
                  </div>
                  <div class="comed3">
                     <i class="fas fa-battery-full" style="font-size: 50px;
                        color: #454545;"></i>
                     <p style="    font-weight: 600;">
                        <?php echo $bat['1'] . " ".  $bat['2']." ".  $bat['3']; ?>
                     </p>
                     <p style="    font-size: 13px;">Li-Ion</p>
                  </div>
                  <div class="comed3">
                     <i class="fas fa-camera" style="font-size: 50px;
                        color: #454545;"></i>
                     <p style="    font-weight: 600;">
                        <?php echo $pix1['0']; ?>
                     </p>
                     <p style="    font-size: 13px;">
                        <?php echo $pix2['0']; ?>
                     </p>
                  </div>
               </div>
               <div>
                  <div class="comed3">
                     <i class="fas fa-calendar-alt" style="font-size: 50px;
                        color: #454545;"></i>
                     <p style="    font-weight: 600;">
                        <?php echo date("F, Y", strtotime($models['datum'])); ?>
                     </p>
                     <p style="    font-size: 13px;">Proizvedeno</p>
                  </div>
                  <div class="comed3">
                     <img  alt="<?php echo $models['marka'] ." ".$models['model']; ?>" src="/static/images/icons/touch.png" style="max-height: 50px;max-height: 50px;">
                     <p style="    font-weight: 600;">
                        <?php echo $ekran1['0']; ?>
                     </p>
                     <p style="    font-size: 13px;">
                        <?php echo $ekran2['0']; ?>
                     </p>
                  </div>
                  <div class="comed3">
                     <img alt="<?php echo $models['marka'] ." ".$models['model']; ?>" src="/static/images/icons/cpu.png" style="max-height: 50px;max-height: 50px;">
                     <p style="    font-weight: 600;">
                        <?php echo $cpu['0']; ?>
                     </p>
                     <p style="    font-size: 13px;">
                        <?php echo $cipovi['2']; ?>
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <div class="comed4">
            <a target="_blank" title="Uporedjivac" href="/compare?id_telefona=<?php echo $models['id'] ?>" class="comed5_1" onclick='document.cookie="phone_id=<?php echo $_GET['phone_id'] ?>;"'>
            <i class="fas fa-sliders-h"></i> Uporedi</a>
            <a target="_blank" title="Pretraga" href="/search2?post_id=<?php echo $models['id'] ?>" class="comed5_2">
            <i class="fas fa-search-plus"></i> Oglasi</a>
            <div class="report_div">
                  <a target="_blank" title="Prijavi problem" href="/report?model_id=<?php echo $_GET['phone_id']; ?>" class="report_a"><i class="fas fa-exclamation-triangle"></i><span id="report">Prijavi nepravilnosti</span></a>
               </div>
         </div>
      </div>
         <div class="comed6">
         <table>
          <thead>
            <tr class="table100-head">
               <th class="column1" >
                  <p>Firma</p>
               </th>
               <th class="column2" >
                  <p>Adresa</p>
               </th>
               <th class="column3" >
                  <p>Telefon</p>
               </th>
               <th class="column4" >
                  <p>Cena</p>
               </th>
               <th class="column5" >
                  <p>Objavljeno</p>
               </th>
            </tr>
          </thead>
            <?php if (empty($telefon)): ?>
              <tr>
              <td colspan="5" style="text-align: center;padding: 8px 20px">Nema u prodaji</td>
            </tr>
            <?php endif ?>
            <?php foreach ($telefon as $firm): ?>
            <?php
               global $conns,$errors;
               $ss = $firm['company_id'];
               $id = $firm['phone_id'];
            

                $stm = $conns->prepare("SELECT MIN(cena) as cena1,MAX(cena) as cena2 FROM company_phone WHERE phone_id=? AND company_id=?");
    $stm->execute([$id,$ss]);
     $cena = $stm->fetch(PDO::FETCH_ASSOC);


                      $stm = $conns->prepare("SELECT * FROM company WHERE id=?");
    $stm->execute([$ss]);
      $firme = $stm->fetch(PDO::FETCH_ASSOC);
               $adresa = explode('%', $firme['adresa']);
               $broj = explode('%', $firme['telefon']);
               
                ?>
            <tr style="cursor: pointer" onclick="window.location='/user/company?company_id=<?php echo $firm['company_id'] ?>'" >
               <td class="column1">
                  <p>
                     <?php echo $firme['ime']; ?>
                  </p>
               </td>
               <td class="column2">
                  <p>
                     <?php echo $adresa['0'] .", ". $adresa['2']; ?>
                  </p>
               </td>
               <td class="column3">
                  <p>
                     <?php echo $broj['0']; ?>
                  </p>
               </td>
               <td class="column4">
                  <p>
                     <?php echo $cena['cena1'] . " € - " .$cena['cena2']." €"; ?>
                  </p>
               </td>
               <td class="column5">
                  <p>
                     <?php  echo date("m.Y", strtotime($firm["created_at"])); ?>
                  </p>
               </td>
            </tr>
            <?php endforeach ?>
         </table>
      </div>
      <div class="div-bar" style="margin-top: 50px;
    margin-left: 6px;
   ">
   <a class="bar" id="spec" >Specifikacije</a>

   <a class="bar" id="comm">Komentari</a>

   
</div>

<script type="text/javascript">
   $(document).ready(function(){
        $('#spec').css({"background-color": "white",
    "color": "black",
    "border-top-left-radius": "15px",
    "padding": "17px 45px 14px",
    "margin-top": "-9px",
    "border-top-right-radius": "5px"});
  
   $('#comm').css({"border-top-right-radius": "15px"});
   $('#spec1').css({"display":"block"});
         $('#comms').css({"display":"none"});
          


$('#spec').click(function(){



   $('#spec').css({"background-color": "white",
    "color": "black",
    "border-top-left-radius": "15px",
    "padding": "17px 45px 14px",
    "margin-top": "-9px",
    "border-top-right-radius": "5px"});
 $('#comm').removeAttr('style');
   $('#comm').css({"border-top-right-radius": "15px"});
       
  $('#spec1').css({"display":"block"});
         $('#comms').css({"display":"none"});

});


$('#comm').click(function(){
   $('#comm').css({"background-color": "white",
    "color": "black",
    "border-top-left-radius": "5px",
    "padding": "17px 45px 14px",
    "margin-top": "-9px",
    "border-top-right-radius": "15px"});
  $('#spec').removeAttr('style');
   $('#spec').css({    "border-top-left-radius": "15px",});
  $('#comms').css({"display":"block"});
    $('#spec1').css({"display":"none"});


});
 $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });

   });

</script>

 
      <div id="spec1" style="display: none;padding-bottom: 30px;">
         <?php include( ROOT_PATH . '/includes/specifikacije.php'); ?>
      </div>
      <?php $posts = getCommentsPhone();?>
      <div id="comms" style="display: none;">
      <?php include(ROOT_PATH . '/includes/comm.php') ?>
   </div>
   
   </div>

   <?php include( ROOT_PATH . '/includes/footer.php') ?>