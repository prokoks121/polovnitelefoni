<?php require_once('../config.php') ?>

<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/user/user-fuction.php') ?>

<?php
if (!isset($_GET['company_id'])) {
  header("Location: /index");

}


 $cmp = getCompanyUser();
 if ($cmp == '') {
   header("Location: /404");
 }
$radno = explode("%", $cmp['r_dani']);
$adresa = explode("%", $cmp['adresa']);
$loks = getCompanyLocation();
$posts = getCompanyPost();



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
#leaflet{width: 675px;
    top: 10px;
    height: 320px;
    z-index: 1;
      }
      .list_mem{
        position: absolute;
    margin-top: 32px;
      }
      .company_posts:hover .list_mems, .list_mems.hover_effect{
        margin-left: -10px;
    padding-top: 4px;
    margin-top: -228px;
    height: 304px;
    width: 180px;
    background-color: #ffffffde;
    transition-duration: 0.7s;
      }
     .list_mems {
    margin-left: -10px;
    padding-top: 5px;
    height: 235px;
    width: 180px;
    background-color: #ffffffc2;
    overflow: hidden;
    position: absolute;
    transition-duration: 0.5s;
      }
      .company_posts{
    float: left;
    overflow: hidden;
    position: relative;
    padding: 10px;
    background-color: white;
    width: 160px;
    border: 1px solid #dedede;
    box-shadow: -2px 7px 3px -2px #58585852;
    color: #292929;
    border-radius: 15px;
    margin: 7px;
    text-align: center;
    height: 287px;
    font-weight: 700;}
    .list_mem_p{
        -webkit-clip-path: polygon(100% 0%, 100% 49%, 100% 100%, 25% 100%, 0% 50%, 25% 0%);
    clip-path: polygon(100% 0%, 100% 49%, 100% 100%, 25% 100%, 0% 50%, 25% 0%);
    background-color: #14264e;
    padding: 5px 10px 5px 25px;
    float: right;
    color: white;
   margin-right: 6px;
    margin-top: 4px;
    font-size: 15px;
    }
</style>
<script type="text/javascript">
$(document).ready(function() {
$('.company_posts').on('touchstart touchend', '.link', function (e) {

    // If event is 'touchend' then...
    if (e.type == 'touchend') {
        // Ensuring we event prevent default in all major browsers
        e.preventDefault ? e.preventDefault() : e.returnValue = false;
    }

    // Add class responsible for :hover effect
    $(this).toggleClass('hover_effect');
});
});
</script>
	<title>PolovniTelefoni.net | Prodajno mesto | <?php echo $cmp['ime'];?></title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>

<div class="container">

		<div class="content" style="    min-height: 710px;">
<div class="div_63">
  <div id="map_lefts">

    <p style="    padding: 5px;
    font-size: 25px;
    font-weight: 600;
    text-align: center;
    border-bottom: 1px solid #35353585;
    margin-bottom: 8px;"><?php echo $cmp['ime'];?></p>
  
    <p style="font-size: 17px;
    color: #313131;
   
    padding: 3px; padding-right: 17px;"><i style="    color: #d1414b;
    font-size: 23px;
    margin-right: 10px;" class="fas fa-map-marked-alt"></i>
 <?php echo $adresa[0];?>, <?php echo $adresa[1];?></p>
       <p style="    margin-left: 42px;
    font-size: 17px;
    color: #313131;
    padding: 3px;
    padding-right: 17px;"><?php echo $adresa[2];?>, <?php echo $adresa[3];?></p>

    <p style="font-size: 17px;
    
    color: #313131;
    padding: 3px;
    border-bottom: 1px solid #d0d0d0;
    border-top: 1px solid #d0d0d0;padding-right: 17px;"> <i style="color: #d1414b;
    font-size: 23px;
    margin-right: 19px;" class="far fa-envelope"></i><?php echo $cmp['e_cont'];?></p>
       <p style="font-size: 17px;
    color: #313131;
   
    padding: 3px;
     padding-right: 17px;
    border-bottom: 1px solid #d0d0d0;"><i style="    color: #d1414b;
    font-size: 23px;
    margin-right: 19px;" class="fas fa-phone"></i><?php echo $cmp['telefon'];?> </p>
    <div style="margin-top: 15px;">
<p style="text-align: center;"><i style="color: #d1414b; font-size: 20px;" class="fas fa-shopping-cart"></i> Radno vreme</p>
<div style="margin-top: 10px;">
<p style="font-size: 15px;
    color: #313131;
    padding: 2px;border-bottom: 1px solid #d0d0d0;">Ponedeljak - Petak:<span style="float: right;"><?php echo $radno[0];?></span></p>
<p style="font-size: 15px;
    color: #313131;
    padding: 2px;border-bottom: 1px solid #d0d0d0;">Subota: <span style="float: right;"><?php echo $radno[1];?></span></p>
<p style="font-size: 15px;
    color: #313131;
    padding: 2px;border-bottom: 1px solid #d0d0d0;">Nedelja: <span style="float: right;"><?php echo $radno[2];?></span>
   </p>
</div>
</div>






  </div>
        
      



<script type="text/javascript">
  $(document).ready(function(){
var countt1 = <?php
$loc = array($cmp['lokacija']);
for ($i=0; $i < count($loks); $i++) { 
  $loc[] = $loks[$i]['geocode'];
}

 echo(count( $loc)); ?>;
if (!(countt1 > 1)) {

$('#add').remove();
$('.div-bar').css({"padding-right":"842px"});
$('.add_post').remove();

}
   });
</script>





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
 
markerArray.push(L.marker([<?php echo $lok['lokacija']; ?>]).addTo(map).bindPopup("<?php echo $lok['ime']; ?>"));
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

<div class="div-bar" style="   padding-bottom: 0px;
    height: 43px;
    margin-left: 12px;
    padding-right: 660px;
    padding-left: 19px;
    width: 322px;">
    <p style="
    float: left;
    padding: 14px 25px 13px;
    cursor: pointer;
    background-color: #14264e;
    color: white;
    border-top-left-radius: 13px;
    width: 103px;"  id="mob" >Mobilni uređaji</a>

    <p style="float: left;
    padding: 14px 25px 13px;
    cursor: pointer;
    background-color: white;
    color: #14264e;
    border-top-right-radius: 13px;
    width: 117px;"  id="add" >Prodajna mesta</a>


</div>
    <div  class="add_post">
      <?php foreach ($loks as $lok): ?>
        <?php
        $adresa1 = explode("%", $lok['adresa']);
$radno1 = explode("%", $lok['vreme']); ?>
       <div class="map_leftt">

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
       
<?php foreach ($posts as $post): ?>
  
  <?php 
global $conns;
  $phone_id = $post['phone_id'];
  $id=$post['company_id'];
 

   $stm = $conns->prepare("SELECT id,marka,model,photo FROM phones WHERE id=? LIMIT 1");
            $stm->execute([$phone_id]);
            $phone = $stm->fetch(PDO::FETCH_ASSOC);


 


   $stm = $conns->prepare("SELECT * FROM company_phone WHERE company_id=? AND phone_id=?");
            $stm->execute([$id,$phone_id]);
            $phoce_list = $stm->fetchAll(PDO::FETCH_ASSOC);

 if (count($phoce_list) > 1) {


   $stm = $conns->prepare("SELECT MAX(cena) as cena_max,MIN(cena) as cena_min FROM company_phone WHERE company_id=? AND phone_id=? GROUP BY phone_id");
            $stm->execute([$id,$phone_id]);
            $cena_max = $stm->fetch(PDO::FETCH_ASSOC);



   $cena = $cena_max['cena_min'] . '€ - ' .$cena_max['cena_max']. '€';
 }else{
$cena = $phoce_list['0']['cena']. '€';
 }


 ?>
  <a target="_blank" href="/single-phone/<?php echo  $phone['marka']; ?>/<?php echo  $phone['model']; ?>?phone_id=<?php echo  $phone['id']; ?>">
  <div class="company_posts" >
    <img style="    width: 160px;
    height: 212px;" src="/static/images/modeli/<?php echo $phone['photo'] ?>">
    <div class='list_mems'>
    <p><?php echo $phone['marka'] ?></p>
    <p><?php echo $phone['model']; ?></p>

    <p class="list_mem_p"><?php echo $cena ?></p>
    <div class="list_mem">
     <?php foreach ($phoce_list as $list): ?>
       <?php if ($list['memorija'] == '0') {
         $list['memorija'] = 'min';
       } ?>
    <div style="    display: flow-root;
    height: 33px;
    width: 181px;"><p style="float: left;padding: 7.5px;"><i style="margin-right: 4px;" class="far fa-hdd"></i><?php echo $list['memorija'] ?> GB</p><p style="margin-right: 7px;" class="list_mem_p"><?php echo $list['cena']?>€</p></div>
        
      <?php endforeach ?>
    </div>
  </div>

  </div>
</a>
<?php endforeach ?>
    </div>
		</div>

   <script type="text/javascript">
      $(document).ready(function(){

$(".add_post").hide();
$(".mob_post").show(200);


$('#mob').on('click',function(){
$(this).css({ "color":"#14264e","background-color":"white"});
$('#add').css({"color":"white","background-color":"#14264e"});
$(".add_post").hide();
$(".mob_post").show(200);



});

$('#add').on('click',function(){
$(this).css({ "color":"#14264e","background-color":"white"});
$('#mob').css({"color":"white","background-color":"#14264e"});
$(".mob_post").hide();
$(".add_post").show(200);


});
});
   </script>

		<?php include( ROOT_PATH . '/includes/footer.php') ?>
   
<!-- https://dev.virtualearth.net/REST/v1/Locations?q=Goce%20Delceva%2011%20Kaludjerica&key=AgHRct6VCWsXPU2p7Y7mI8wsjY5zmWObaXLmBEeN20Tow_w0Q8VmeQSV3TvK_81y&o=json -->
