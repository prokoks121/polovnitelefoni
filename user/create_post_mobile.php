<?php 
 if (isset($_SESSION['user']['id'])) { 
 require_once( ROOT_PATH . '/includes/public_functions.php') ;
require_once( ROOT_PATH . '/user/user-fuction.php');
 $user = GetSessionUserPublic(); 

include( ROOT_PATH . '/includes/head_section.php'); ?>
<script src="/static/js/create_post.js"></script>

<style type="text/css">
  .fa-check{
    color:green;
  }
  .post_rek{
    border: 1px solid #d1414b!important;
  }

  .info_rek{
    color: #d1414b;
  }
  .cena_p_rek{
    background-color: #d1414b;
  }
  .cena_p_comp{
    background-color: rgb(15, 109, 208);
  }
  .leyzi{
text-indent: 100%;
    white-space: nowrap;
    overflow: hidden;
  }
  .leyzi.lazy {
        
        display: block;
          background-image: url('/static/images/icons/loading.gif');
        background-repeat: no-repeat;
        background-position: 50% 50%;
    }
.post{width:180px!important;height:291px!important;
    padding: 5px;
    font-family: 'Source Sans Pro',sans-serif;

    margin: 9px 9px 0;
    float: left;
    border-radius: 2px;
    border: 1px solid #14264e9e;}.post-right{width:183px!important;margin-left:8px!important;position:absolute!important;margin-top:93px!important}.post_right p{margin:0!important}.cena_p_comp{background-color:#0f6dd0}.cena_p{transition-duration:.5s;margin-top:-1px!important}.img_12{margin-left:10px!important}.right_three{position:absolute!important;margin-top:231px!important;margin-left:8px!important}.post-left{width:192px!important;margin-top:3px!important}.price_left{transition-duration:.6s;position:absolute;margin-top:59px;margin-left:5px;font-weight:600;font-size:15px;color:#2f2f2f}.post:hover .price_left,.price_left.hover_effect{transition-duration:.4s;margin-left:-80px;visibility:hidden;rule:properties}.post:hover .cena_p,.cena_p.hover_effect{transition-duration:.5s;max-width:60px!important;margin-right:20px;rule:properties}.post:hover #indigo,#indigo.hover_effect{transition-duration:.8s;height:255px;box-shadow:0 15px 20px -5px black;margin-top:41px;margin-left:-6px;background-color:#ffffffd4;rule:properties}#indigo{overflow:hidden;white-space:nowrap;transition-duration:.8s;width:192px;position:absolute;height:90px;border-top-right-radius:3px;border-top-left-radius:3px;margin-top:210px;margin-left:-5px}.post{-webkit-user-select:none;-webkit-touch-callout:none}
#user_select{
      margin: auto;
    margin-top: 11px;
    display: table;
    padding: 5px;
    cursor: pointer;
}
#user_select:hover{
      background-color: #d1414b;
    color: white;
    font-weight: bold;
    border-radius: 5px;
}
#company_select:hover{
      background-color: #d1414b;
    color: white;
    font-weight: bold;
    border-radius: 5px;
}

#company_select{
    display: table;
    margin: auto;
    margin-top: 5px;
    padding: 5px;
    cursor: pointer;
}
  .sendss{
    float: right;
    overflow: hidden;
    width: 60px;
    border: 1px solid #00000054;
    padding: 4px 0px 4px 7px;
    font-size: 13px;
    font-family: 'Source Sans Pro',sans-serif;
        position: absolute;
    margin-left: 371px;
    margin-top: -26px;
  }
  .sends{
        width: 256px;
  }
  #send{
    margin-left: 10px;
  }
  .sendess{

    margin-left: 10px;
 margin-right: 20px;
    float: right;
    overflow: hidden;
    width: 58px;
    border: 1px solid #00000054;
    padding: 4px 0px 4px 7px;
    font-size: 13px;
    font-family: 'Source Sans Pro',sans-serif;
  }
 
  .podesavanja{
    background-color: white;
    border-radius: 15px;
  }
  .sector-2{
    margin-top: 341px;
  }
</style>

<?php
global $conns,$errors;
 $models = getModels();
$company = getCompanyUserbyUser();
$user_id=$_SESSION['user']['id'];
$stm = $conns->prepare("SELECT id FROM posts WHERE user_id=? AND delete_check='false' AND reg_check='1'");
    $stm->execute([$user_id]);
$num =$stm->rowCount();
if ($num > 19) {
 array_push($errors, "Imate maksimalan istovremeno aktivnih oglasa ".$num."/20");
}


$stm = $conns->prepare("SELECT id FROM posts WHERE user_id=? AND delete_check='false' AND reg_check='2'");
    $stm->execute([$user_id]);
$num1 =$stm->rowCount();
if ($num1 > 19) {
 array_push($errors, "Imate maksimalan istovremeno aktivnih oglasa ".$num1."/20");
}
 ?>

	<title>PolovniTelefoni.net | Kreiraj oglas</title>
  
</head>
<body>
        <?php include( ROOT_PATH . '/includes/navbar.php') ?>

	<div class="container">
</div>
<div class="div_38" >
					<?php include(ROOT_PATH . '/includes/errors.php') ?>
				</div>

<div class="podesavanja">
  <h1 class="h1_1">Kreirajte vaš oglas</h1>
      <p class="p_14" ></p>


    <div id="telefon" >
	<form  method="post" enctype="multipart/form-data" runat="server" id="mainform">
	<div><p class="p_15" >Broj aktivnih oglasa: <?php echo $num ?>/20</p>
    <?php if (!empty($company)): ?>
      <p class="p_29">Broj aktivnih oglasa (preduzeće): <?php echo $num1 ?>/20</p>
    <?php endif ?>
  </div>
	<div class="div_36">
    <?php if (!empty($company)): ?>
      
<div class="div_37"><p class="p_16" >Predstavljate se kao:</p><div id="user_select"><p class="p_17">Korisnik</p><p class="p_17"><?php echo $user['ime'] ." ". $user['prezime']; ?></p></div>
<div id="company_select"><p class="p_17">Preduzeće</p><p class="p_17"><?php echo $company['ime']; ?></p></div>

</div>
    <?php endif ?>

<style type="text/css">
  .div_39{
<?php if (!empty($company)){echo "width: 46%;";}else{echo "width: 86%;";} ?>
  }
  .div_40{
<?php if (!empty($company)){echo "float:none;";}else{echo "float:left;";} ?>
  }
</style>

	<div class="div_39" >
    <p class="p_18" >1. Izaberite Proizvođača i Model telefona</p>
	<div class="sends div_40" >
				<select name="id_telefona" id="send" class="send" >
					<option value="" selected disabled>Izaberi Proizvođača</option>
						<?php foreach ($models as $model): ?>
							<option value="<?php echo $model['id_telefona']; ?>">
							<?php echo $model['model']; ?>
							</option>
						<?php endforeach ?>
				</select>
				</div>
				<div class="sends" >
    <div id="LaDIV"></div>
   
</div>
<div id="LaDIV1" class="div_41" ></div>

    <div class="model_request"><a class="a_7" target="_blank" href="/model_request" >Nemamo vaš model?</a></div>
</div>
<div class="sector-2">
  <div class="div_42">
        <h2 class="h2_3">Opšte informacije</h2>
        <div class="div_43">
  
<p class="p_19" ></p></div>


<div>
<div class="div_44" >
    <p class="p_20" >2. Unesite starost telefona</p>
    <div  class="div_45">
	<label   class="lael label_3">Polovan
    <input id="checkbox1"  class="intcheck" type="checkbox" name="checkbox1" value="1">
      <span id="1dan" class="checkmark"></span>
</label>
<div>
 <select  class="send select_3" name="godina" >
         <?php 
$godina = date('Y');
$godina1 = $godina - 20;
         for ($i=$godina; $i >= $godina1 ; $i--) { 
           echo "<option value='". $i ."'>".$i ."</option>";
         } ?>
      </select>
 <select  class="send select_4" name="mesec">
          <option value="Januar">Januar</option>
          <option value="Februar">Februar</option>
          <option value="Mart">Mart</option>
          <option value="April">April</option>
          <option value="Maj" >Maj</option>
          <option value="Jun" >Jun</option>
          <option value="Jul" >Jul</option>
          <option value="Avgust">Avgust</option>
          <option value="Semptembar">Semptembar</option>
          <option value="Oktobar">Oktobar</option>
          <option value="Novembar" >Novembar</option>
          <option value="Decembar" >Decembar</option>

      </select>
      
</div>
</div>
<label   class="lael label_4">Kao nov
    <input id="checkbox2"  class="intcheck" type="checkbox" name="checkbox2" value="1">
      <span id="1dan" class="checkmark"></span>
</label>
   
   <label   class="lael label_4">Nov
    <input id="checkbox3"  class="intcheck" type="checkbox" name="checkbox3" value="1" disabled="disabled">
      <span id="1dan" class="checkmark"></span>
      <p class="p_21" >Ovu opciju mogu da koriste samo preduzeća</p>
</label>
   </div>
   <div class="div_46">
    <p class="p_22">3. Unesite cenu uređaja </p>
  
       <label class="lael label_5">Dogovor
       <input id="checkbox4" class="intcheck" type="checkbox" name="checkbox4" value="Licno preuzimanje">
         <span class="checkmark"></span>

       </label>
       <label class="lael label_5" >Fiksna cena
       <input id="checkbox5" class="intcheck" type="checkbox" name="checkbox5" value="Licno preuzimanje">
         <span class="checkmark"></span>

       </label>
         <label class="laell label_6"  >
       <input maxlength="4" id="cenaa" class="input_4" type="number" name="cenaa" placeholder="cena telefona" >
       <span  class="span_3 fas fa-euro-sign"></span>
       
       </label>
       </div>
    
    
</div>
<div class="div_47">
  <div class="div_48">
 <p class="p_23">4. Unesi trajanje garancije </p>
    
       <label class="lael label_7">Garancija
       <input id="checkbox6" class="intcheck" type="checkbox" name="checkbox6" value="Garancija3" >
         <span class="checkmark"></span>

       </label>
       <label class="lael label_8"  >Ovlašćenog servisa
       <input id="checkbox7" class="intcheck" type="checkbox" name="checkbox7" value="Garancija">
         <span class="checkmark"></span>

       </label>
       <label class="lael label_8"  >Servisa
       <input id="checkbox8" class="intcheck" type="checkbox" name="checkbox8" value="Garancija1" >
         <span class="checkmark"></span>

       </label>
       <label class="lael label_8"  >Prodavca
       <input id="checkbox9" class="intcheck" type="checkbox" name="checkbox9" value="Garancija2" >
         <span class="checkmark"></span>

       </label>
      
  </div>
   <label class="laell label_9" >
       <input maxlength="10"  id="trajanje" class="inttxt input_5" type="text" name="trajanje" placeholder="npr: '1 Godinu'">
       
       </label>
       <div class="div_49" class="sends">
         <p class="p_24">5. Izaberite mrežu uređaja</p>
    <label class="lael label_10"  >Uređaj je:</label>
        <select class="send select_5" name="mreza">

          <option value="1" >Otključan na svim mrežama</option>
          <option value="2">Zaključan u Mts-u</option>
          <option value="3">Zaključan u Vip-u</option>
        <option value="4">Zaključan u Telenor-u</option>
      </select>
    </div>
    </div>
</div>
  <h2 class="h2_4">Napredne informacije</h2>
        <div class="div_54" >
  
<p class="p_25"></p></div>

    <div class="div_50">
      <div class="div_51">
    	
    <label class="lael label_11" >Zamena
     <input class="intcheck" type="checkbox" name="zamena" value="Zamena">
       <span class="checkmark"></span>
		</label>
    	<label class="lael label_11" >Slanje poštom
     	<input class="intcheck" type="checkbox" name="posta" value="Slanje postom">
     	  <span class="checkmark"></span>
     	</label>
     	  <label class="lael label_11" >Lično preuzimanje
     	 <input class="intcheck" type="checkbox" name="preuzimanje" value="Licno preuzimanje">
     	   <span class="checkmark"></span>

     	 </label>
        <label class="lael label_11" >Prvi vlasnik
       <input class="intcheck" type="checkbox" name="vlasnik" value="Prvi vlasnik">
         <span class="checkmark"></span>

       </label>
     	 <label class="label_12" >Boja uređaja
         <input maxlength="10" id="boja_txt" class="input_6" type="text" name="boja" placeholder="npr: Crna" >

       </label>

        <label class="label_13" >Interna memorija
         <select class="sendess" name="cap">
           <option>1</option>
           <option>2</option>
           <option>4</option>
           <option>8</option>
           <option>16</option>
           <option>32</option>
           <option>64</option>
           <option>128</option>
           <option>512</option>
         </select>
   
           </label>
 <select class="sendss select_7" name='cap_nm'>
      <option>GB</option>
      <option>TB</option>
    </select>

     	 
</div>


   		 
    
    	<label class="lael label_14"><p class="p_28" >Prateća oprema:</p>
         <label class="lael" >Kutija
		<input  class="intcheck" type="checkbox" name="kutija" value="Kutija">
		  <span class="checkmark"></span>

		</label>
       <label class="lael">USB kabl
 		<input class="intcheck" type="checkbox" name="usbkabal" value="USB kabl">
 		  <span class="checkmark"></span>

 		</label>
 		<label class="lael" >Adapter
   		 <input class="intcheck" type="checkbox" name="adapter" value="Adapter">
   		   <span class="checkmark"></span>

   		 </label>
  		 <label class="lael" >Slušalice
		<input class="intcheck" type="checkbox" name="slusalice" value="Slusalice">
		  <span class="checkmark"></span>

		</label>
  		  <label class="lael" >Maska
		<input class="intcheck" type="checkbox" name="maska" value="Maska">
		  <span class="checkmark"></span>

		</label>
  

    </label>
<div><select class="select_6" name="num_sim">
  <option selected value="Single SIM">Single SIM</option>
    <option value="Dual SIM">Dual SIM</option>

</select></div>
    
  </div>


    <div class="div_52">
      <div class="div_53">
      <div class="div_55">
      <h2 class="h2_5" >Izaberite slike</h2>
<p class="p_26"></p></div>

     <div class="div-fa-times-circle" >
      <div id="icon-img1" class="div-icon div_56"  >
         <i  id="imageClear1" class="far fa-times-circle i_6"></i>
</div>
       <label for="file--input" class="img1" >
        <div class="div-icon1 div_57" > <img class="div-icon1-img" id="preview-img1"  src="/static/images/upload.png" /></div>
</label>
  <input id="file--input" class="img1 input_7" type="file" name="img[]"/>
   
   </div>
     
        
   
      <div class="div-fa-times-circle" >
        <div class="div-icon div_56"   id="icon-img2" >
            <i  id="imageClear2" class="far fa-times-circle i_6" ></i>
</div>
       <label for="file--input1"  >
        <div class="div-icon1" > <img class="div-icon1-img"  id="preview-img2"  src="/static/images/upload.png" /></div>
</label>
  <input  id="file--input1" class="img2 input_7" type="file" name="img[]"/>
   
   </div>

        
    <input type="text" name="crtsubmit" class="div_56"  value="true">
    <div class="div-fa-times-circle">
      <div class="div-icon div_56"   id="icon-img3">
          <i  id="imageClear3" class="far fa-times-circle i_6"></i>
</div>
       <label for="file--input2" >
        <div class="div-icon1" > <img class="div-icon1-img" id="preview-img3"  src="/static/images/upload.png" /></div>
</label>
  <input  id="file--input2" class="img3 input_7" type="file" name="img[]"/>
   
   </div>
       
    
     <div class="div-fa-times-circle" >
      <div class="div-icon div_56"  id="icon-img4">
          <i  id="imageClear4" class="far fa-times-circle i_6" ></i>
</div>
       <label for="file--input3"  >
        <div class="div-icon1" > <img class="div-icon1-img" id="preview-img4"  src="/static/images/upload.png" /></div>
</label>
  <input  id="file--input3" class="img4 input_7" type="file" name="img[]"/>
   
   </div>    
        
</div>


<input type="text" name="reg_check" id="reg_check" class="input_8" value="1">
   
<div id="image_preview"></div>

    	<div class="div_58" >
    	<h2 class="h2_6">Opis telefona</h2>
<p class="p_27"></p></div>


<textarea class="textarea_1" name="opis"></textarea>
    <div class="div_58_1" >
      <h2 class="h2_6_1">Način oglašavanja</h2>
<p class="p_27"></p></div>

<div style="display: table;
    margin: auto;">
  <div class="istaknuti_oglasi"><h4>Besplatan oglas</h4> 

<div class="post " style="zoom:83%">
<div class="img_12">
<img alt="Polovni telefoni , apple-iphone-xs-max-new1.jpg" class="leyzi" width="160px" height="212px" src="/static/images/modeli/apple-iphone-xs-max-new1.jpg">
</div>
<div id="indigo">
<div class="post-right">
<p class="p_6"></p>
<h4 class="disab">Polovni telefoni</h4>
<p class="disab">Polovni</p>
<p class="disab">Telefoni</p>

<p>Boja: Crna</p>
<p>Memorija: 128 GB</p>
<p>Stanje: Polovan</p>
<p>Garan: Nema</p>
<p>Otključan za sve mreže</p>
</div>
<div class="info ">
<div class="post-left">
<p class="p_7">Apple</p>
<p class="p_7">iPhone XS Max</p>
</div>
<div class="price_left">
<p>1 Dana</p>
</div>
<div class="right_three">
<p class="p_8"></p>
<p class="p_9">24.08.2019 17:21</p>
</div>
</div>
<p class="cena_p ">Dogovor </p>

</div>
</div>

  </div>
  <div class="istaknuti_oglas"><h4>Istaknuti oglas</h4> 





<div class="post post_rek" style="zoom:83%">
<div class="img_12">
<img alt="Polovni telefoni , apple-iphone-5s-ofic.jpg" class="leyzi" width="160px" height="212px" src="/static/images/modeli/apple-iphone-xs-max-new1.jpg">
</div>
<div id="indigo">
<div class="post-right">
<p class="p_6"></p>
<h4 class="disab">Polovni telefoni</h4>
<p class="disab">Polovni</p>
<p class="disab">Telefoni</p>

<p>Boja: Crna</p>
<p>Memorija: 128 GB</p>
<p>Stanje: Polovan</p>
<p>Garan: Nema</p>
<p>Otključan za sve mreže</p>
</div>
<div class="info info_rek">
<div class="post-left">
<p class="p_7">Apple</p>
<p class="p_7">iPhone XS Max</p>
</div>
<div class="price_left">
<p>1 Dana</p>
</div>
<div class="right_three">
<p class="p_8"></p>
<p class="p_9">24.08.2019 17:21</p>
</div>
</div>
<p class="cena_p cena_p_rek">Dogovor </p>

</div>
</div>

<div class="div_tekst_s">
  <p><i class="fas fa-check"></i> Uvek na vrhu prilikom pretrage.</p>
  <p><i class="fas fa-check"></i> Uvećana vidljivost oglasa.</p>
  <p><i class="fas fa-check"></i> Oglas će biti vidljiv i kao preporučen oglas.</p>



</div>
<div style="font-family: 'Source Sans Pro',sans-serif;margin-top: 155px;">
  <label>Unesite promo kod: <input style="width: 136px;
    margin-left: 0;
    padding: 5px;
    font-family: 'Source Sans Pro',sans-serif;" type="text" name="promocode"  class="input_promo"></label>
</div>

  </div>


</div>
<span class="button span_4" id="create_post_button">Postavi oglas</span>
</div>
</div>
</div>
</form>
</div>
</div>
  <script type="text/javascript">
    $(document).ready(function(){
      var ista_check = false;
      $('.input_promo').attr("disabled", true);

      $('.istaknuti_oglasi').css({'border-color': '#14264e'});

      $('.istaknuti_oglasi').click(function(){
      $(this).css({'border-color': '#14264e'});
      $('.istaknuti_oglas').css({'border-color': 'white'});
      ista_check = false;
      $('.input_promo').attr("disabled", true);


      });
       $('.istaknuti_oglas').click(function(){
      $(this).css({'border-color': '#d1414b'});
      $('.istaknuti_oglasi').css({'border-color': 'white'});
      ista_check = true;
      $('.input_promo').attr("disabled", false);


      });

$('#user_select').css({ 'background-color': '#d1414b',
    'color': 'white',
    'font-weight':' bold',
    'border-radius': '5px'});


$('#user_select').click(function(){

if($("#checkbox3").prop("checked") == true){

                               $('#checkbox3').not(this).prop('checked', false);

                $('#checkbox2').not(this).prop('checked', true);
                                $('#checkbox1').not(this).prop('checked', false);  
                                  $(this).attr("disabled", true);
           $("#checkbox2").attr("disabled", true);
           $("#checkbox1").attr("disabled", false);
             $('#checkbox3').attr("disabled", true);


}




  $('#reg_check').val('1');
$(this).css({ 'background-color': '#d1414b',
    'color': 'white',
    'font-weight':' bold',
    'border-radius': '5px'});
$('#company_select').css({ 'background-color': 'white',
    'color': 'black',
    'font-weight':' normal',
   });
});
$('#company_select').click(function(){
    $('#reg_check').val('2');
$('#checkbox3').attr("disabled", false);

$(this).css({ 'background-color': '#d1414b',
    'color': 'white',
    'font-weight':' bold',
    'border-radius': '5px'});
$('#user_select').css({ 'background-color': 'white',
    'color': 'black',
    'font-weight':' normal',
   });
});

});

$('#create_post_button').on("click", function() {
  var check = 0;

if ($('#id_send').val() == 0 || $('#id_send').val() == "" || $('#send').val() == 0 || $('#send').val() == "") {
check = 1;
$('#send').css({'border' : '1px solid red'});
$('#id_send').css({'border' : '1px solid red'});
}else{
  $('#send').css({'border' : '1px solid darkgrey'});
$('#id_send').css({'border' : '1px solid darkgrey'});
}


if ($('#checkbox4').prop("checked") == false && $('#cenaa').val() == "") {
  check = 1;

  $('#cenaa').css({'border' : '1px solid red'});
}else{
  $('#cenaa').css({'border' : '1px solid darkgrey'});

}
if ($('#checkbox4').prop("checked") == false && $('#cenaa').val().length > 4) {
  check = 1;

  $('#cenaa').css({'border' : '1px solid red'});
}else{
  $('#cenaa').css({'border' : '1px solid darkgrey'});

}

if ($('#checkbox6').prop("checked") == true && $('.inttxt').val() == "") {
check = 1;
$('.inttxt').css({'border' : '1px solid red'});
}else{
  $('.inttxt').css({'border' : '1px solid darkgrey'});
}



if ($('#boja_txt').val() == "") {
check = 1;
$('#boja_txt').css({'border' : '1px solid red'});
}else{
  $('#boja_txt').css({'border' : '1px solid darkgrey'});
}
datas = new Array();
var promo_code = $('.input_promo').val();
if ($('.input_promo').is(':disabled') == false) {
$.ajax({ url: '/user/check_promo',
 data: {code: promo_code},
 type: 'post',
 dataType : "json",
 success: function(output) {
              datas = output;
              data = datas[0];
              if (typeof datas[1] !== "undefined") {
                alert(datas[1]);
                 check = 1;
              }else{
               if (data) {
              
    check = data;
    $('.input_promo').css({'border-color':'red'});
   }}

          }
 });
}
if (check == 0) {

 $("#checkbox8").attr("disabled", false);
           $("#checkbox7").attr("disabled", false);
           $("#checkbox9").attr("disabled", false);
            $("#checkbox1").attr("disabled", false);
           $("#checkbox2").attr("disabled", false);
           $("#checkbox3").attr("disabled", false);
if (check == 0) {
           $('#mainform').submit();
         }


}
});


  </script>
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
<?php }else{ header('location: /login'); } ?>