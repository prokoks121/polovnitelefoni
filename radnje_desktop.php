
<?php require_once( ROOT_PATH . '/includes/header.php') ?>
<link rel=stylesheet href=/static/css/zas/radnje-dek.css?v=1.00>

  <meta name="description" content="Želite da kupite novi telefon ili prodate stari? Kupomobil je pravo mesto za Vas. Najpovoljniji novi i polovni telefoni na jednom mestu.">
  <meta name="keywords" content="kupomobil,mobilni,telefon,polovni,prodaja,kupovina,oglasi,nov,specifikacije,mobilni telefoni,polovni mobilni telefoni,polovni telefoni">
<link rel="stylesheet" href="/static/js/maps/leaflet.css" />
<script type="text/javascript">
    

          $('#mobile_media_css').remove();


</script>


	<title>PolovniTelefoni.net | Najpovoljniji novi i polovni telefoni</title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>

<div class="container">
<div class="novo_1">
     
     <div style="width: 1024px;
    margin: auto;">
    <h1 class="h1_111">
        Najpovoljniji novi i polovni<br/>telefoni na jednom mestu
    </h1>
    <a href="#" class="a_111">Pogledajt oglase</a>
    <div class="krug_img">
         <div class="krug_img1">
            <p style="padding-top: 33px;">Iphone 8</p>
            <p style="font-weight: 800;
    padding-top: 6px;">od 799.99 €</p>
        
    </div>
    </div>
         <img src="\static\images\local\img_ind.png" style="height: 405px;
    position: absolute;
    margin-left: 670px;
    margin-top: 50px;">
     </div>




    </div>
		<div class="content">
		
			<?php include(ROOT_PATH . '/includes/search.php') ?>
            <!--
		<p class="wqe1"></p>
    <p class="wqe12">Promocije</p>
			<?php //include(ROOT_PATH . '/includes/reklamno.php') ?>
<p class="wqe"></p>
    <p class="wqe01">Radnje</p>
      -->
  <div id="leaflet"></div>

<script src="/static/js/maps/leaflet.js"></script>
    <script type="text/javascript">
  var map = new L.Map('leaflet', {
    center: [0, 0],
    zoom: 0,
    layers: [
        new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            'attribution': 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
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

   <?php foreach ($radnje as $lok): ?>
 
markerArray.push(L.marker([<?php echo $lok['lokacija']; ?>]).addTo(map).bindPopup("<?php echo $lok['ime']; ?>"));
<?php endforeach ?>

var group = L.featureGroup(markerArray).addTo(map);
map.fitBounds(group.getBounds());




</script>
<div style="margin-top:40px;">



        <?php foreach ($radnje as $lok): ?>
        <?php
        $adresa1 = explode("%", $lok['adresa']);
$radno1 = explode("/%/", $lok['r_dani']);?>
       <div class="map_left">

    <p style="    padding: 5px;
    font-size: 25px;
    font-weight: 600;text-align: center;"><?php echo $lok['ime'];?></p>
 
    <p style="
    color: #313131;
    padding: 3px;border-bottom: 1px solid #d0d0d0;"><i style="color: #d1414b; font-size: 23px;" class="fas fa-map-marked-alt"></i> <?php echo $adresa1[0] .", ". $adresa1[2];?></p>
    <p style="
    color: #313131;
    padding: 3px;border-bottom: 1px solid #d0d0d0;"><i style="color: #d1414b; font-size: 23px;" class="far fa-envelope"></i> <?php echo $lok['e_cont'];?></p>
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
		</div>

		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	