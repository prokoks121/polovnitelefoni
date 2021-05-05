
<?php require_once( ROOT_PATH . '/includes/header.php') ?>
<link rel=stylesheet href=/static/css/zas/mark-dek.css?v=1.00>
<meta name="description" content="Kupi jeftino & Prodaj brzo <?php echo "\r\n";?> Acer, Alcatel, Apple, Samsung, Huawei, Xiaomi, Nokia, Microsoft, Tesla, Oppo, Lenovo, Asus, Sony, BlackBerry, Motorola, OnePlus, Cat, Lg, Prestigio, ZTE">
  <meta name="keywords" content="kupomobil,mobilni,telefon,polovni,prodaja,kupovina,oglasi,nov,specifikacije,mobilni telefoni,polovni mobilni telefoni,polovni telefoni, Acer, Alcatel, Apple, Samsung, Huawei, Xiaomi, Nokia, Microsoft, Tesla, Oppo, Lenovo, Asus, Sony, BlackBerry, Motorola, OnePlus, Cat, Lg, Prestigio, ZTE">



<title>Marke i Modeli | PolovniTelefoni.net</title>
<script type="text/javascript">
     
        $('#mobile_media_css').remove();



</script>
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
   <!--<p class="wqe1"></p>
   <p class="wqe12">Promocije</p>
   <?php // include(ROOT_PATH . '/includes/reklamno.php') ?>
   <p class="wqe"></p>
   <p class="wqe01"  style=" width: 144px;">Marke i Modeli</p>
 -->
   <div style="padding-bottom: 20px;
      padding-right: 8px;">
      <div style="display:block;">
         <?php if ($check): ?>
         <div class="marked1" >
            <img class="marked2" alt="Marke" src="/static/images/marke/<?php echo $mm ?>.png">
         </div>
         <?php foreach ($date as $datest): ?>
         <div style="display: table;">
            <p class="marked4">Proizvedeno <?php echo $datest ?></p>
            <?php
               global $conns;
               
               $stm = $conns->prepare("SELECT * FROM phones WHERE id_telefona=? AND datum LIKE ?  ORDER BY datum DESC ");
        $stm->execute([$mm,"%$datest%"]);
                 $mod = $stm->fetchAll(PDO::FETCH_ASSOC);
               
               		 ?>
            <?php foreach ($mod as $modes1): ?>
            <a href="/single-phone/<?php echo $modes1['marka']?>/<?php echo(str_replace(' ','-',$modes1['model'])) ?>?phone_id=<?php echo $modes1['id']?>" class="marked50">
               <div>
                  <img alt="<?php echo ($modes1['marka'] . ' ' . $modes1['model']); ?> " src="<?php echo '/static/images/modeli/' . $modes1['photo'] ?>" style="width: 155px;height: 212px;">
                  <div class="marked5" >
                     <p><?php echo $modes1['marka']; ?></p>
                     <p><?php echo $modes1['model']; ?></p>
                  </div>
               </div>
            </a>
            <?php endforeach ?>
         </div>
         <?php endforeach ?>
         <?php endif ?>
      </div>
      <div style="padding-top: 56px;

    display: -webkit-box;">
         <?php foreach ($modelis as $mode){ 
$strings = $mode['model'];
          ?>
         <a id="img<?php echo $mode['id_telefona'] ?>" href="/marke_modeli/<?php echo SplitWrods($strings) ?>/<?php echo $mode['id_telefona'] ?>" style="    width: 155px;
    height: 252px;">
            <div class="marked7">
               <img class="marked8" src="/static/images/marke/<?php echo $mode['id_telefona'] ?>.png">
            </div>
         </a>
         <?php } ?>
      </div>
   </div>
   <?php if ($check): ?>
   <script type="text/javascript">
      var num = "#img"+<?php echo $mm; ?>;
      $(num).remove();
   </script>
   <?php endif ?>
   <?php include( ROOT_PATH . '/includes/footer.php') ?>