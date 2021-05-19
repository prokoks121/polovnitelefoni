<?php require_once('../config.php') ?>

<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/user/user-fuction.php') ?>
<?php $cmp = getCompanyUserbyUser();
$radno = explode("%", $cmp['r_dani']);
$adresa = explode("%", $cmp['adresa']);
$loks = getCompanyLocationbyUser();
$posts = getCompanyPostbyUser();

if ($cmp == '') {
  header('location: ../403');
 }


 ?>

<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
<link rel="stylesheet" href="/static/js/maps/leaflet.css" />
<style type="text/css">
   #map {
        height: 200px;
      }


      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #myMap{
        float: right;
            margin: 20px;
                margin-left: 0px;

      }
   .MicrosoftMap .NavBar_Container.Light .NavBar_MapTypeButtonContainer.withBackground{
    display: none;
   }
   #MicrosoftNav{
    margin-top: 30px;
   }
      .bm_LocateMeControl{
         display: none!important;
      }

      .bm_bottomLeftOverlay{
        display: none!important;
      }
      .bm_bottomRightOverlay{
         display: none!important;
      }
      canvas{
        border: 0px!important;
      }
      .company_post{
        float: left;
    padding: 10px;
    width: 160px;
    border: 1px solid #14264e;
    box-shadow: -4px 4px 17px -2px #585858eb;    color: #292929;
    border-radius: 2px;
    margin: 7px;    text-align: center;height: 287px;
    font-weight: 700;
        transition-duration: 0.2s;

      }

      .company_location_hidden{
         display: none;
            position: absolute;
    background-color: #14264eed;
    width: 290px;
 transition-duration: 0.2s;
    height: 244px;
    z-index: 5;
      }
       .map_left:hover   .company_location_hidden{
        display:  block;
            transition-duration: 0.2s;

      }
      .company_post:hover  .company_post_hidden{
        display:  block;
            transition-duration: 0.2s;

      }
      .company_post_hidden_div:hover{
        background-color: #d1414b;
        cursor: pointer;
            transition-duration: 0.2s;

      }
       .company_post_hidden_div:hover p{
        color:  #14264e!important;
            transition-duration: 0.2s;

      }
      #company_post_hidden_div1:hover{
        background-color: #d1414b;
        cursor: pointer;
            transition-duration: 0.2s;

      }
       #company_post_hidden_div1:hover button{
        color:  #14264e!important;
            transition-duration: 0.2s;

      }
     #leaflet{top: 10px;
        height: 320px;
        z-index: 1;
      }
</style>

	<title>Firme | PolovniTelefoni.net</title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
     <?php include(ROOT_PATH . '/includes/errors.php') ?>

<div class="container">

		<div class="content" style="    min-height: 710px;">
<div class="div_63" >
  <div id="map_left" style="float: left;margin: 20px;
    margin-left: 12px;    margin-right: 12px;">

    <p style="    padding: 5px;
    font-size: 25px;
    font-weight: 600;
    text-align: center;
    border-bottom: 1px solid #35353585;
    margin-bottom: 8px;"><?php echo $cmp['ime'];?></p>

    <form method="post" >
    <p style="font-size: 17px;
    color: #313131;
    padding: 3px;"><i style="color: #d1414b; font-size: 23px;" class="fas fa-map-marked-alt"></i>
    <input class="lokacija_check" style="padding: 4px 7px;margin-left: 5px;width: 144px ;   border-radius: 3px;
    border: 1px solid #a5a4a4;" type="text" name="adresa" value="<?php echo $adresa[0];?>" id="loc_1">, <input id="loc_2" class="lokacija_check" style="    border-radius: 3px;
    border: 1px solid #a5a4a4;padding: 4px 7px;
    margin-left: 5px;
    width: 146px;" type="text" name="adresa1" value="<?php echo $adresa[1];?>" ></p>
       <p style="margin-left:31px;font-size: 17px;
    color: #313131;
    padding: 3px;border-bottom: 1px solid #d0d0d0;"><input style="padding: 4px 7px;    border-radius: 3px;
    border: 1px solid #a5a4a4;
    margin-left: 5px;
    width: 144px" type="text" name="adresa2" value="<?php echo $adresa[2];?> "id="loc_3" class="lokacija_check">, <input id="loc_4" class="lokacija_check" style="padding: 4px 7px;
    margin-left: 5px;    border-radius: 3px;
    border: 1px solid #a5a4a4;
    width: 146px;" type="text" name="adresa3" value="<?php echo $adresa[3];?>"></p>
    <p style="font-size: 17px;
    color: #313131;
    padding: 3px;border-bottom: 1px solid #d0d0d0;"><i style="color: #d1414b; font-size: 23px;" class="far fa-envelope"></i><input style="    border-radius: 3px;
    border: 1px solid #a5a4a4;padding: 4px 7px;
    margin-left: 12px;
    width: 216px;" type="email" name="email" value=" <?php echo $cmp['e_cont'];?>"></p>
       <p style="font-size: 17px;
    color: #313131;
    padding: 3px;border-bottom: 1px solid #d0d0d0;"><i style="color: #d1414b; font-size: 23px;" class="fas fa-phone"></i><input  style="padding: 4px 7px;
   margin-left: 12px;    border-radius: 3px;
    border: 1px solid #a5a4a4;
    width: 216px;" type="text" name="telefon" value="<?php echo $cmp['telefon'];?>"> </p>
    <div style="margin-top: 15px;">
<p style="text-align: center;"><i style="color: #d1414b; font-size: 20px;" class="fas fa-shopping-cart"></i> Radno vreme</p>
<div style="margin-top: 10px;">
<p style="font-size: 15px;
    color: #313131;
    padding: 2px;border-bottom: 1px solid #d0d0d0;">Ponedeljak - Petak:<span style="float: right;"><input style="width: 87px;
    text-align: center;    border-radius: 3px;
    border: 1px solid #a5a4a4;" type="text" name="rad1" value="<?php echo $radno[0];?>"></span></p>
<p style="font-size: 15px;
    color: #313131;
    padding: 2px;border-bottom: 1px solid #d0d0d0;">Subota: <input style="      border-radius: 3px;
    border: 1px solid #a5a4a4;  width: 87px;
    text-align: center;
    float: right;" type="text" name="rad2" value="<?php echo $radno[1];?>"></p>
<p style="font-size: 15px;
    color: #313131;
    padding: 2px;border-bottom: 1px solid #d0d0d0;">Nedelja: <input style="     border-radius: 3px;
    border: 1px solid #a5a4a4;   width: 87px;
    text-align: center;
    float: right;" type="text" name="rad3" value="<?php echo $radno[2];?>">
   </p>
</div>
</div>
<button class="button" style="    margin-top: 5px;
    padding: 10px 20px;
    margin-bottom: 0px;" name="company_change">Sačuvaj</button>
</form>










  </div>














        <div id="leaflet"></div>

<script src="/static/js/maps/leaflet.js"></script>
     <script type="text/javascript">
  var map = new L.Map('leaflet', {
    center: [0, 0],
    zoom: 0,
    layers: [
        new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            'attribution': 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        })
    ]
});
  L.Map = L.Map.extend({
    openPopup: function(popup) {
        //        this.closePopup();  // just comment this
        this._popup = popup;

        return this.addLayer(popup).fire('popupopen', {
            popup: this._popup
        });
    }
});
    var markerArray = [];

markerArray.push(L.marker([<?php echo $cmp['lokacija']; ?>]).addTo(map).bindPopup("<?php echo $cmp['ime']; ?>"));
   <?php foreach ($loks as $lok): ?>

markerArray.push(L.marker([<?php echo $lok['geocode']; ?>]).addTo(map).bindPopup("<?php echo $lok['ime']; ?>"));
<?php endforeach ?>

var group = L.featureGroup(markerArray).addTo(map);
map.fitBounds(group.getBounds());





var map_width = $('#map_left').width();
var map_height = $('#map_left').height();
var width1 = 990 - parseInt(map_width);
var height1 = 10 + parseInt(map_height);

var width = width1 + "px";
var height = height1 + "px";
$('#leaflet').css({"width": width,"height": height});
</script>
</div>

<div class="div-bar" style="      padding-bottom: 0px;
    height: 43px;
    border:unset;
    margin-left: 0px;
    padding-right: 569px;
    padding-left: 0px;
    margin-top: 40px;
    display: inline-block;
    width: 413px;    margin-bottom: -4px;">
    <p style="border-top-left-radius: 15px;" class="bar" id="mob" >Mobilni uređaji</a>

    <p style="border-top-right-radius: 15px;" class="bar" id="add" >Prodajna mesta</a>


</div>
    <div  class="add_post" >
       <div class="map_left" id="add_company_location" style="cursor:pointer; float: left;
    margin: 20px;
    width: 288px;
    height: 241px;
    border: 1px solid black;">
<p style=" font-size: 209px;
    color: #292929;
    margin-top: -25px;
    text-align: center;">+</p>
    <p style="    margin-top: -69px;
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    color: #292929;">Dodaj prodajno mesto</p>









  </div>
      <?php foreach ($loks as $lok): ?>
        <?php
        $adresa1 = explode("%", $lok['adresa']);
$radno1 = explode("%", $lok['vreme']); ?>

       <div class="map_leftt">
    <div class="company_location_hidden">

<form method="post">
  <div id="company_location_hidden_div1" class="<?php echo $lok['id'] ?>" style="    height: 244px;">
<button  name="company_location_delete" value="<?php echo $lok['id'];?>" style="      color: white;
    background-color: #d1414b;
    font-size: 20px;
    padding-top: 110px;
    padding-bottom: 111px;
    padding-right: 87px;
    padding-left: 87px;
    border: none;
    font-weight: bold;
    cursor: pointer;" onclick="return confirm('Da li sigurni da želite da obrišete vašu lokaciju?\n*Ok--Da, želim da izbrišem lokaciju\n*Cancle--Ne želim da izbrišem lokaciju')">Obriši oglas</button>

    </div>

</form>

    </div>
    <p style="    padding: 5px;
    font-size: 25px;
    font-weight: 600;margin-left: 10px;"><?php echo $lok['ime'];?></p>

    <p style="
    color: #313131;
    padding: 3px;border-bottom: 1px solid #d0d0d0;"><i style="color: #d1414b; font-size: 23px;" class="fas fa-map-marked-alt"></i> <?php echo $adresa1[0] .", ". $adresa1[2];?></p>
    <p style="
    color: #313131;
    padding: 3px;border-bottom: 1px solid #d0d0d0;"><i style="color: #d1414b; font-size: 23px;" class="far fa-envelope"></i> <?php echo $lok['email'];?></p>
       <p style="
    color: #313131;
    padding: 3px;border-bottom: 1px solid #d0d0d0;"><i style="color: #d1414b; font-size: 23px;" class="fas fa-phone"></i> <?php echo $lok['telefon'];?></p>
    <div style="margin-top: 15px;">
<p style="text-align: center;"><i style="color: #d1414b; font-size: 20px;" class="fas fa-shopping-cart"></i> Radno vreme</p>
<div style="margin-top: 10px;">
<p style="font-size: 15px;
    color: #313131;
    padding: 2px;border-bottom: 1px solid #d0d0d0;">Ponedeljak - Petak:<span style="float: right;"><?php echo $radno1[0];?></span></p>
<p style="font-size: 15px;
    color: #313131;
    padding: 2px;border-bottom: 1px solid #d0d0d0;">Subota: <span style="float: right;"><?php echo $radno1[1];?></span></p>
<p style="font-size: 15px;
    color: #313131;
    padding: 2px;border-bottom: 1px solid #d0d0d0;">Nedelja: <span style="float: right;"><?php echo $radno1[2];?></span></p>
</div>
</div>










  </div>
      <?php endforeach ?>





    </div>
    <div class="mob_post">
         <div class="div_64">
    <a style="    cursor: pointer;
    overflow: hidden;
    height: 283px;
    width: 154px;
    display: block;" target="_blank" href="/user/company_phones_edit?id_telefona=1">
  <p style="    color: #292929;
    font-size: 300px;
    height: 266px;
    margin-top: -62px;">+</p>
   <p style="color:#292929;">Dodajte oglas</p>
 </a>
  </div>
<?php foreach ($posts as $post): ?>

  <?php
global $conns;
  $phone_id = $post['phone_id'];


 $stm = $conns->prepare("SELECT * FROM phones WHERE id=? LIMIT 1");
    $stm->execute([$phone_id]);
    $phone = $stm->fetch(PDO::FETCH_ASSOC);

  ?>
  <div class="company_post" >

    <img style="    width: 160px;
    height: 212px;" src="/static/images/modeli/<?php echo $phone['photo'] ?>">
    <p><?php echo $phone['marka'] ?></p>
    <p style="    width: 160px;
    height: 20px;
    overflow: hidden;
    display: block;"><?php echo $phone['model']; ?></p>
    <p style="float: left;    margin-top: 8px;"><?php echo date("d.m.y", strtotime($post["created_at"])); ?></p>

    <p   style="    -webkit-clip-path: polygon(100% 0%, 100% 49%, 100% 100%, 25% 100%, 0% 50%, 25% 0%);
    clip-path: polygon(100% 0%, 100% 49%, 100% 100%, 25% 100%, 0% 50%, 25% 0%);
    background-color: #14264e;
    padding: 5px 10px 5px 25px;
    float: right;
    color: white;
    margin-top: 5px;
    font-size: 15px;"><?php echo $post['cena'] ?>€</p>
  </div>
<?php endforeach ?>
    </div>

		</div>

   <script type="text/javascript">
      $(document).ready(function(){


                $('.come1').on('change',function() {
                  $('#phones_div').empty();
                    var sel_stud = $('.come1').val();
                    $.ajax({
                        type: "POST",
                        url: "/user/phones_add.php",
                        data: 'search_val=' + sel_stud,
                        success: function(whatigot) {
                            $('#phones_div').html(whatigot);


                        }
                    });



                });




$('#mob').css({ "background-color": "white","color": "black"});
$(".add_post").hide();
$(".mob_post").show(200);

$('#mob').on('click',function(){
$(this).css({ "background-color": "white","color": "black" });
$('#add').css({"background-color": "#14264e",
    "color": "white"});
$(".add_post").hide();
$(".mob_post").show(200);



});

$('#add').on('click',function(){
$(this).css({  "background-color": "white", "color": "black"});
$('#mob').css({"background-color": "#14264e",
    "color": "white"});
$(".mob_post").hide();
$(".add_post").show(200);


});
$('#add_company_post').on('click',function(){

$("#add_company_post_div").show(200);

});
$('#exit1').on('click',function(){

$("#add_company_location_div").hide(200);
});

$('#exit').on('click',function(){

$("#add_company_post_div").hide(200);

});
$('#add_company_location').on('click',function(){

$("#add_company_location_div").show(200);

});

$('.company_post_hidden_div').on('click',function(){
var clas_id = '.comse1 option[value="' +$(this).attr('id') + '"]';
var cena = $(this).find('#val_cena').attr('class');

$(clas_id).css({'display':'block'});

$(clas_id).prop('selected', true);
$('#cena_add').val(cena);
$("#add_company_post_div").show(200);

});


});
      <?php
   global $conns;


$stm = $conns->prepare("SELECT * FROM phones");
    $stm->execute();
    $tel1 = $stm->fetchAll(PDO::FETCH_ASSOC);
$num = $stm->rowCount();


   $stm = $conns->prepare("SELECT * FROM modeli");
    $stm->execute();
    $tel = $stm->fetchAll(PDO::FETCH_ASSOC);


       ?>
   </script>
<div id="add_company_location_div" style="
    background: rgba(0, 0, 0, 0.87);
    width: 100%;
    height: 100%;
    top: 50% !important;
    position: fixed;
    display: none;
    left: 49.99999%;
    transform: translate(-50%, -50%);
    z-index: 2;">
    <div style="
    width: 413px;
    margin: 20px auto;
    background-color: #d1414b;
    border-radius: 5px;
    " >
  <form  method="post" style="width: 394px;
    margin: auto;
       height: 374px;
    margin-top: 314px;
    background-color: #d1414b;
    border-radius: 7px;">
     <a id="exit1" style="cursor: pointer;"><i style="    margin-left: 360px;
    margin-top: 10px;" class="far fa-times-circle"></i></a>
    <h3 style="text-align: center;
    padding: 20px;
    color: white;">Kreiraj lokaciju</h3>
    <p style="font-size: 17px;
    color: #313131;
    padding: 3px;"><i style="color: white; font-size: 23px;" class="fas fa-map-marked-alt"></i>
    <input style="padding: 4px 7px;margin-left: 5px;width: 144px" type="text" name="adresa" placeholder="<?php echo $adresa[0];?>">, <input style="padding: 4px 7px;
    margin-left: 5px;
    width: 146px;" type="text" name="adresa1" placeholder="<?php echo $adresa[1];?>"></p>
       <p style="margin-left:31px;font-size: 17px;
    color: #313131;
    padding: 3px;border-bottom: 1px solid #d0d0d0;"><input style="padding: 4px 7px;
    margin-left: 5px;
    width: 144px" type="text" name="adresa2" placeholder="<?php echo $adresa[2];?>">, <input style="padding: 4px 7px;
    margin-left: 5px;
    width: 146px;" type="text" name="adresa3" placeholder="<?php echo $adresa[3];?>"></p>

    <p style="font-size: 17px;
    color: #313131;
    padding: 3px;border-bottom: 1px solid #d0d0d0;"><i style="color: white; font-size: 23px;" class="far fa-envelope"></i><input style="padding: 4px 7px;
    margin-left: 12px;
    width: 216px;" type="email" name="email" placeholder=" <?php echo $cmp['e_cont'];?>"></p>
       <p style="font-size: 17px;
    color: #313131;
    padding: 3px;border-bottom: 1px solid #d0d0d0;"><i style="color: white; font-size: 23px;" class="fas fa-phone"></i><input  style="padding: 4px 7px;
   margin-left: 12px;
    width: 216px;" type="text" name="telefon" placeholder="<?php echo $cmp['telefon'];?>"> </p>
    <div style="    margin-top: 15px;
    color: white;
    font-family: Roboto;">
<p style="text-align: center;"><i style="color: white; font-size: 20px;" class="fas fa-shopping-cart"></i> Radno vreme</p>
<div style="margin-top: 10px;">
<p style="    margin: 0px 42px;
    font-size: 15px;
    color: white;
    padding: 2px;
    border-bottom: 1px solid #d0d0d0;">Ponedeljak - Petak:<span style="float: right;"><input style="width: 87px;
    text-align: center;" type="text" name="rad1" placeholder="<?php echo $radno[0];?>"></span></p>
<p style="    margin: 0px 42px;
    font-size: 15px;
    color: white;
    padding: 2px;
    border-bottom: 1px solid #d0d0d0;">Subota: <input style="    width: 87px;
    text-align: center;
    float: right;" type="text" name="rad2" placeholder="<?php echo $radno[1];?>"></p>
<p style="    margin: 0px 42px;
    font-size: 15px;
    color: white;
    padding: 2px;
    border-bottom: 1px solid #d0d0d0;">Nedelja: <input style="    width: 87px;
    text-align: center;
    float: right;" type="text" name="rad3" placeholder="<?php echo $radno[2];?>">
   </p>
</div>
</div>
<button class="button" style="    margin-top: 5px;
    padding: 10px 20px;
    margin-bottom: 0px;" name="company_location_add">Sačuvaj</button>
</form>
</div>
</div>




<div id="add_company_post_div" style="
    background: rgba(0, 0, 0, 0.87);
    width: 100%;
    height: 100%;
    top: 50% !important;
    position: fixed;
    display: none;
    left: 49.99999%;
    transform: translate(-50%, -50%);">
    <div style="width: 339px;
    margin: 20px auto;" >
  <form  method="post" style="margin-top: 314px;
    width: 258px;
    height: 259px;
    background-color: #d1414b;
    border-radius: 7px;">
    <a id="exit" style="cursor: pointer;"><i style="margin-left: 214px;
    margin-top: 10px;" class="far fa-times-circle"></i></a>
    <h3 style="color: white;
    font-family: 'Source Sans Pro',sans-serif;
    margin: auto;
    text-align: center;
    padding: 29px;">Kreiraj oglas</h3>
    <select class="come1" name="model" style="padding: 5px 105px 5px 5px;

    margin-left: 23px;
    margin-bottom: 10px;">
      <option value="0" disabled="disabled" selected>Izaberi marku</option>
      <?php foreach ($tel as $tels): ?>
        <option value="<?php echo $tels['id_telefona'] ?>"><?php echo $tels['model']; ?></option>
      <?php endforeach ?>
    </select>
<div id="phones_div"></div>



    <input id="cena_add" type="txt" value="" name="cena" placeholder="Cena" style="    padding: 5px 35px 5px 5px;
    margin-left: 23px;">
    <button name="create_post_company" style="    margin-left: 60px;" class="btn">Kreiraj oglas</button>
  </form>
</div>
</div>
<script type="text/javascript">
     $(document).ready(function(){
   $('.a1').css({"display" : "none"});

    $('.come1').on('change',function(){
   $('.a1').css({"display" : "none"});
   $('.comse1 option:first').prop('selected',true);

   var num = '.a1.a0' + $('.come1 option:selected').val();
   $(num).css({"display" : "block"});
   });
     });
</script>
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
