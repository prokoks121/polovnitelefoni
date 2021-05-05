<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php 
  
   	$post = getPost();   
   if (empty($post)) {
    header('location: /404');
   }else{
       $_SESSION['url']['id'] = $post['id'];

   
   $id_telefona = $post['id_telefona'];
   $id_modela = $post['model_id'];
   global $conns,$errors;


   $stm = $conns->prepare("SELECT * FROM phones WHERE id=?");
    $stm->execute([$id_telefona]);
     $models = $stm->fetch(PDO::FETCH_ASSOC);



                $url = $_SERVER['REQUEST_URI'];

                   $stm = $conns->prepare("SELECT id FROM track WHERE url=?");
    $stm->execute([$url]);
     $num_track =$stm->rowCount();
   $kuciste = explode('/%/', $models['kuciste']);
   $ekran = explode('/%/', $models['ekran']);
   $kamera = explode('/%/', $models['kamera']);
   $cipovi = explode('/%/', $models['cipovi']);
   $modul = explode('/%/', $models['moduli']);
   $mreze = explode('/%/', $models['mreze']);
   
   $user_id = $post['user_id'];

  $stm = $conns->prepare("SELECT * FROM users WHERE id=?");
    $stm->execute([$user_id]);
        $users = $stm->fetch(PDO::FETCH_ASSOC);

   $post_id = $post['id'];


  $stm = $conns->prepare("SELECT * FROM follow WHERE id_user=? AND id_post=? AND 1");
    $stm->execute([$user_id,$post_id]);
         $folow =$stm->rowCount();





   
   if ($post['starost'] != "Kao nov" && $post['starost'] != "Nov") {
   $starost = "Polovan, Aktiviran: " . $post['starost'];
   
   }else{$starost = $post['starost'];
   }
   if ($post['garancija'] == ""){
   $garancija = "Nema";
   }else{
   $garancija = $post['garancija_tip'] . ", ". $post['garancija'];
   }
   
   if ($post['kabl'] == 0) {
   $kabal = "Ne";
   }else{$kabal = "Da";}
   if ($post['adapter'] == 0) {
   $adapter = "Ne";
   }else {
   $adapter = "Da";
   }
   if ($post['slusalice'] == 0) {
   $slusalice = "Ne";
   }else{$slusalice = "Da";}
   if ($post['kutija'] == 0) {
   $kutija = "Ne";
   }else{$kutija = "Da";}
   if ($post['maska'] == 0) {
   $maska = "Ne";
   }else{$maska = "Da";}
   if ($post['fiksna'] == 0) {
   $fiksna = "Ne";
   }else{$fiksna = "Da";}
   
   if ($post['licno'] == 0) {
   $licno = "Ne";
   }else{$licno = "Da";}
   if ($post['zamena'] == 0) {
   $zamena = "Ne";
   }else{$zamena = "Da";}
   if ($post['slanje'] == 0) {
   $slanje = "Ne";
   }else{$slanje = "Da";}
   
   if ($post['mreza'] == 1) {
   $mreza = "Telefon je<b> otključan na svim mrežama</b>";
   }
   if ($post['mreza'] == 2) {
   $mreza = "Telefon je zaključan u<b> mts-u</b>";
   }
   if ($post['mreza'] == 3) {
   $mreza = "Telefon je zaključan u<b> vip-u</b>";
   }
   if ($post['mreza'] == 4) {
   $mreza = "Telefon je zaključan u<b> telenor-u</b>";
   }
   if ($post['zamena'] == 1) {
   $zamena = "Da";
   }else{
   $zamena = "Ne";
   }
   if ($post['vlasnik'] == 0) {
   $vlasnik = "Da";
   }else{
   $vlasnik = "Ne";
   }
   if ($post['body'] == '') {
   $text12 = "Nema opisa";
   }else{$text12 = $post['body'];}

   ?>
<?php include('includes/head_section.php'); ?>
<meta name="description" content="Kupi jeftino & Prodaj brzo <?php echo "\r\n". $models['marka'] . " " . $models['model'] ." " .  $post['body'] ?>">
  <meta name="keywords" content="kupomobil,mobilni,telefon,polovni,prodaja,kupovina,oglasi,nov,specifikacije,mobilni telefoni,polovni mobilni telefoni,polovni telefoni,<?php echo $models['marka'] . "," . $models['model'] ?>">
<style type="text/css">
   .content .post-wrapper {
   border-left: none !important;
   margin-top: 20px;
   margin-bottom: 20px;
   }
   .full-post-div {
   padding-top: 20px;
   }
   .report_div{
    margin-top: -8px;
              position: absolute;
    margin-left: 616px;
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
    width: 123px;
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
    margin-left:509px;
     width: 123px;
}  
#cena{
  margin-top: 12px;
}



table{
  border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    border-top-left-radius: 0px;
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
<script src="/static/js/single_post.js"></script>

<script type="text/javascript">
   $(document).ready(function() {

    <?php if ($post['reg_check'] == 2): ?>
      $(".messages").remove();
    <?php endif ?>
       var heart = 1;
       $.ajax({
           type: "POST",
           url: "/hearts.php",
           data: 'options=' + heart,
           success: function(whatigot) {
               $('#LaDIV').html(whatigot);
           }
       });
       <?php if (isset($_SESSION['user']['id'])): ?>
       $('#wtf').click(function() {
           $('.fsts').css({
               "display": "none"
           });
           $.ajax({
               type: "POST",
               url: "/heart.php",
               data: 'option=' + heart,
               success: function(whatigot) {
                   $('#LaDIV').html(whatigot);
               }
           });
       });
       <?php endif ?>
      
   });
</script>
<title>PolovniTelefoni.net | <?php echo $models['marka'] . " " . $models['model'] ?></title>
</head>
<body>
   <div class="container">
      <div id="imgdiv">
         <img style="    max-width: 100%;
    max-height: 100%;display: none" id="img1" alt="Slika 1" src="<?php echo '/static/images/' . $post['img1']; ?>" alt="">
         <img style="    max-width: 100%;
    max-height: 100%;display: none" id="img2" alt="Slika 2" src="<?php echo '/static/images/' . $post['img2']; ?>" alt="">
         <img style="    max-width: 100%;
    max-height: 100%;display: none" id="img3" alt="Slika 3" src="<?php echo '/static/images/' . $post['img3']; ?>" alt="">
         <img style="    max-width: 100%;
    max-height: 100%;display: none" id="img4" alt="Slika 4" src="<?php echo '/static/images/' . $post['img4']; ?>" alt="">
      </div>
      <?php include( ROOT_PATH . '/includes/navbar.php'); ?>
      <div class="content">
         <div class="post-wrapper">
            <div class="full-post-div">
              <div class="div_80">
                <p>Viđeno: <span><?php echo $num_track;?></span> puta</p>
              </div>
               <div class="report_div">
                  <a target="_blank" title="Prijavi problem" href="/report?post_id=<?php echo $post['id']; ?>" class="report_a"><i class="fas fa-exclamation-triangle"></i><span id="report">Prijavi oglas</span></a>
               </div>
               <?php if ($post['published'] == false): ?>
               <h2 class="post-title">Sorry... This post has not been published</h2>
               <?php else: ?>
                 <h1 style="display: none;"><?php echo $models['marka'] . " " . $models['model'] ?></h1>
               <h2 class="post-title"><?php echo $models['marka'] . " " . $models['model'] ?></h2>
               <div style="margin-top: 0px;" class="post-left">
                  <a target="_blank" title="Pronađi model" href="/single-phone/<?php echo $models['marka']?>/<?php echo(str_replace(' ','-',$models['model'])) ?>?phone_id=<?php echo $models['id']?>" >
                  <img alt="<?php echo $models['marka'] . " " . $models['model'] ?>" src="<?php echo '/static/images/modeli/' . $models['photo']; ?>" alt="">
               </a>
               </div>
               <div class="picture">
                  <div>
                     <div class="imgfour">
                        <a id="slika1" style="cursor: pointer;">
                        <img alt="Slika 1" src="<?php echo '/static/images/' . $post['img1']; ?>" class="post_image" alt="">
                        </a>
                     </div>
                     <div class="imgfour">
                        <a id="slika2" style="cursor: pointer;">
                        <img alt="Slika 2" src="<?php echo '/static/images/' . $post['img2']; ?>" class="post_image" alt="">
                        </a>
                     </div>
                     <div class="imgfour">
                        <a id="slika3" style="cursor: pointer;">
                        <img alt="Slika 3" src="<?php echo '/static/images/' . $post['img3']; ?>" class="post_image" alt="">
                        </a>
                     </div>
                     <div class="imgfour"><a id="slika4" style="cursor: pointer;">
                        <img alt="Slika 4" src="<?php echo '/static/images/' . $post['img4']; ?>" class="post_image" alt="">
                        </a>
                     </div>
                  </div>
               </div>
               <div class="rightet" style="width: 240px;float: right;">
                  <div class="rightet-div">
                     <h3>Informacije o prodavcu</h3>
                     <p style="margin: 3px 0px;
    height: 18px;
    overflow: hidden;">Oglas kreirao:
                      <?php
                                              global $conns;
                                               $stm = $conns->prepare("SELECT * FROM company WHERE user_id=? LIMIT 1");
        $stm->execute([$user_id]);
    $company = $stm->fetch(PDO::FETCH_ASSOC);

                                              $grad = explode('%', $company['adresa']);

                                               ?>
                      <?php if ($post['reg_check'] == 1 || $company == ''): ?>
                        
                      
                        <a style="color: #007cff;" title="Pronadji korisnika" href="/custom_user?code_id=<?php echo $users['code_id']; ?>&user_id=<?php echo $users['id']; ?>">
                        <?php echo $users['ime'] . " " .  $users['prezime'] ; ?>
                        </a>
                     </p>
                     <p style="margin: 3px 0px;">Grad/Opština:
                        <?php echo $users['grad'];?>
                     </p>
                     <p style="margin: 3px 0px;"> Član od:
                        <?php echo date("F j. Y ", strtotime($users["created_at"])); ?>
                     </p>
                     <?php if ($users['telefon2'] != "") { echo '<p style="margin: 3px 0px;">Kontakt telefon:</br> ' . $users['telefon'] . ' || ' . $users['telefon2'] . '</p>';} else {echo '<p style="margin: 3px 0px;">Kontakt telefon: <p>' . $users['telefon'] . '</p>';}?>
                     <a target="_blank" title="Pronadji korisnika" href="/custom_user?code_id=<?php echo $users['code_id']; ?>&user_id=<?php echo $users['id']; ?>">
                        <div class="rightet-hover">
                           <i style="    font-size: 63px;
                              margin-top: 20px;
                              color: #d1414b;" class="fas fa-user"></i>
                           <p style="font-weight: bold;
                              color: #d1414b;
                              margin-top: 5px;
                              font-size: 18px;">PROFIL KORISNIKA</p>
                        </div>
                     </a>
                     <?php endif ?>

                                           <?php if ($post['reg_check'] == 2 && $company != ''): ?>

                      
                        <a style="color: #007cff;" title="pronadji korisnika" href="/user/company?company_id=<?php echo $company['id']; ?>">
                        <?php echo $company['ime']?>
                        </a>
                     </p>
                     <p style="margin: 3px 0px;">Grad:
                        <?php echo $grad['2'];?>
                     </p>
                     <p style="margin: 3px 0px;"> Adresa:
                        <?php echo $grad['0']; ?>
                     </p>
                     <?php echo '<p style="margin: 3px 0px;">Kontakt telefon: <p>' . $company['telefon'].'</p>';?>
                     <a target="_blank" title="Pronadji korisnika" href="/user/company?company_id=<?php echo $company['id']; ?>">
                        <div class="rightet-hover">
                           <i style="    font-size: 63px;
                              margin-top: 20px;
                              color: #d1414b;" class="fas fa-user"></i>
                           <p style="font-weight: bold;
                              color: #d1414b;
                              margin-top: 5px;
                              font-size: 18px;">PROFIL KORISNIKA</p>
                        </div>
                     </a>

                     <?php endif ?>

                  </div>
                  <?php if (isset($_SESSION['user']['id'])): ?>
                  <div><a class="messages" title="Posalji poruku" href="/user/send_message?post_id=<?php echo $users['code_id'] ?>&user_id=<?php echo $users['id'] ?>"><i class="fas fa-envelope"></i> Pošalji poruku</a></div>
                  <?php else : ?>
                  <div><a class="messages" href="#"><i class="fas fa-envelope"></i> Pošalji poruku</a></div>
                  <?php endif ?>
                  <a href="#" id="wtf">
                     <div id="LaDIV"></div>
                  </a>
               </div>
               <div class="div_59">
                 <a style="padding: 10px 40px;" target="_blank" title="Uporedjivac" href="/compare?id_telefona=<?php echo $post['id_telefona'] ?>" class="btn_1 comed5">
            <i class="fas fa-sliders-h"></i> Uporedi</a>
               </div>
               <div class="post_cena">
                  <p id="cena">
                     <?php $cena = $post['cena'];
                        if ($cena != "Dogovor") {
                        	$cena = $cena . "€";
                        }
                        echo $cena;
                        
                        ?>
                  </p>
               </div>
               <div class="div_60">
                  <h3 class="dodatno" style="text-align: center;font-size: 25px;">Dodatne informacije</h3>
                  <div class="infos">
                     <p >Garancija: <b><?php echo $garancija ?></b></p>
                     <p >Stanje:<b> <?php echo  $starost ?></b></p>
                     <p ><?php echo $mreza ?></p>
                     <p >Lično preuzimanje:<b> <?php echo $licno ?></b></p>
                     <p >Slanje poštom:<b> <?php echo $slanje ?></b></p>
                     <p>Fiksna cena:<b> <?php echo $fiksna ?></b></p>
                     <p>Boja uređaja:<b> <?php echo $post['boja'] ?></b></p>
                     <p>Interna memorja uređaja:<b> <?php echo $post['kapacitet'] ?></b></p>

                  </div>
                  <div class="oprema">
                     <p>Zamena:<b> <?php echo $zamena ?></b></p>
                     <p>Prvi vlasnik:<b> <?php echo $vlasnik ?></b></p>
                     <p>USB kabl:<b> <?php echo  $kabal;?></b></p>
                     <p>Adapter:<b> <?php echo  $adapter;?></b></p>
                     <p>Slušalice: <b><?php echo  $slusalice;?></b></p>
                     <p>Originalna kutija:<b> <?php echo  $kutija;?></b></p>
                     <p>Maska:<b> <?php echo  $maska;?></b></p>
                     <p>Sim:<b> <?php echo  $post['num_sim'];?></b></p>

                  </div>
               </div>
               <div style="float: left; width: 100%; ">
                  <div class="div_61">
                     <h3 id="opis1" class="ntt">Opis</h3>
                     <h3 id="spec" class="nt2">Specifikacije</h3>
                  </div>
                  <p class="coment" style="display: none;"><?php echo $text12 ?></p>
               </div>

              
               <script type="text/javascript">
                  $(document).ready(function(){
                  $('.coment').css({"display":"block"});
                  $('#opis1').click(function(){

$(this).removeClass("ntt2");
$('#spec').removeClass("nt");


                    $(this).addClass("ntt");
$('#spec').addClass("nt2");
                  	$('.coment').css({"display":"block"});
                  	$('#spec1').css({"display":"none"});
                  
                  });
                  $('#spec').click(function(){
$(this).removeClass("nt2");
$('#opis1').removeClass("ntt");


                    $(this).addClass("nt");
$('#opis1').addClass("ntt2");



                  	$('.coment').css({"display":"none"});
                  	$('#spec1').css({"display":"block"});
                  
                  });
                  });
                  
               </script>
              
            </div>
             <div id="spec1" class="div_62" >
                  <?php include( ROOT_PATH . '/includes/specifikacije.php'); ?>
               </div>
               <?php endif ?>
            <div>
            </div>
            <div id="offest" ></div>
         </div>
         <div class="sidebarr">
            <?php include( ROOT_PATH . '/includes/sidebar.php'); ?>
         </div>
      </div>
   </div>
 
   <?php include( ROOT_PATH . '/includes/footer.php'); }?>