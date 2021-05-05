<?php require_once('../config.php') ?>

<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/user/user-fuction.php') ?>
<?php
if (isset($_GET['id_telefona']) AND !empty($_GET['id_telefona'])) {

 $phones = getPhonesbyMaker();
 $id_company = getCompanyUserbyUser()['id'];
              $marke = getModels();

}else{
header("location: /user/company_phones_edit?id_telefona=1");
}
 ?>

<?php include( ROOT_PATH . '/includes/head_section.php') ?>
<script type="text/javascript">
  $('link[href="/static/css/mobile_media.css"]').prop('disabled', true);
</script>
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
.vip_div{
    cursor: pointer;
    position: absolute;
    font-family: Arial;
    
    margin-top: -37px;
    margin-left: 117px;
    background-color: #d1414b;
    border-radius: 5px;
    transition-duration: 0.2s;
}
.vip_div:hover{
    padding: 3px 5px;
    transition-duration: 0.2s;
    margin-left: 112px;
     margin-top: -40px;

}
.vip_div:hover .fa-crown{
    transition-duration: 0.2s;
    margin-top: -32px!important;
    font-size: 24px;
    margin-left: 42px!important;
}
.div-bar{
   margin-left: 16px;
    padding-right: 208px;
    padding-left: 54px;
}
.sub_button_company_edit{
  cursor: pointer;
    -webkit-appearance: none;
    background: #14264e;
    border: none;
    font-weight: bold;
    font-family: 'Source Sans Pro',sans-serif;
    color: white;
    display: block;
    border-radius: 2px;
    padding: 7px 11px;
}

input{
	width: 45px;
}
</style>

	<title>Preduzeća | PolovniTelefoni.net</title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
   <?php include(ROOT_PATH . '/includes/errors.php') ?>

<div class="container">

		<div class="content">
			<div style="overflow-x:auto;">
        <h2 style="margin: auto;
    width: 253px;
    padding: 40px;">Izmenite cene uređaja</h2>
        <div style="float: left;">
          <div >
           <h3 style="margin-left: 30px;padding: 10px">Izaberite proizvođača</h3>
 <select class="custom-select" id="select_edit" style="margin-left: 43px;
    margin-bottom: 20px;
    width: 188px;" onchange="location = this.value;">
              <?php foreach ($marke as $mark): ?>
                <option value="/user/company_phones_edit?id_telefona=<?php echo $mark['id_telefona']; ?>"><?php echo $mark['model']; ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div style="margin-top: 12px">
            <h3 style="margin-left: 30px;padding: 10px">Pronađite vaš model</h3>
             <input style="  margin-left: 43px;
    margin-bottom: 20px;
    width: 156px;
    border: 1px solid #ababab;
    padding: 7px 15px;" type="text" id="pretraga_edit" name="" placeholder="Pretraga">
    <i style="       font-size: 18px;
    margin-left: -25px;
    top: 391px;
    position: absolute;
    color: grey;" class="fas fa-search"></i>
          </div>
           </div>
           <div style="float: left;    width: 768px;">
                        <h3 style="margin-left: 30px;padding: 10px">Upustvo za korišćenje stranice</h3>
                        <div style="font-size: 13px;">
                          

                          <p>Ukoliko želite da unesete cene drugih proizvođača, potrebno je da izabere odgovarajućeg proizvođača u polje pored.</p>
                          <p>Kako biste ubrzali postupak pronalaženja željenog uređaja, koristite pretragu.</p>
                          <p>Kada pronađete vaš željeni uređaj, sve što treba da učinite jeste da unesete cenu u polje koje odgovara memoriji vašeg uređaja, takođe možete istovremeno da popunite sva polja sa cenom samo jednog uređaja i na kraju je potrebno samo jedan klik na izmeni.</p>
                            <p>Kako biste pravilno izvršili izmene, morate da izvršite klik na polje Izmeni u onom redu u kojem ste vršili izmene, u suprotnom neće doći do izmene.</p>
                              <p>Ako želite da neki uređaj uklonite iz prodaje, tj uklonite cenu uređaja, diviljno je samo da izbrisete cenu ili unesete 0 i na kraju jedan klik na izmeni.</p>
                                <p>Ukoliko postoje bilo kakve nedoumice oko korišćenja ove stranice, molimo da nas kontaktirate.</p>
                        </div>

           </div>

     <table id="table_edit">
      <form method="post">
         
         <?php if (isset($_GET['id_telefona'])): ?>
<script type="text/javascript">
    $(document).ready(function(){

  $('#select_edit option[value="/user/company_phones_edit?id_telefona=<?php echo $_GET['id_telefona']; ?>"]').prop("selected", true);



});


                $('#pretraga_edit').keyup(function() {
                  var value = $('#pretraga_edit').val().toLowerCase();


    $("#table_edit tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });


    

 $(".search_p").unmark({
      done: function() {
         $(".search_p").mark(value);
      }
    });
  
   

    $(".search_p").filter(function() {



      
    });


                        
                 


                }); 

          



  
    $("#pretraga").on("click",function(e){
    var value = $(this).val().toLowerCase();

});



</script>

         
            <?php foreach ($phones as $firme): ?>
            	<?php
            	global $conns;
              $mems_array = array('8','16','32','64','128','256','512');
              $mem_array = array('0'=>'','8'=>'','16'=>'','32'=>'','64'=>'','128'=>'','256'=>'','512'=>'','1'=>'');
            	$id_telefona = $firme['id'];
            
               $stm = $conns->prepare("SELECT id,cena,memorija FROM company_phone WHERE company_id=? AND phone_id=?");
    $stm->execute([$id_company,$id_telefona]);
    $cena = $stm->fetchAll(PDO::FETCH_ASSOC);
              for ($i=0; $i < count($cena); $i++) { 
                $mems = $cena[$i]['memorija'];
               $mem_array[$mems] = $cena[$i]['cena'];
              }

$num = count($cena);
            	 ?>
               
                           <tr id="tr-id<?php echo  $firme['id']?>">
<td rowspan="1" style="text-align: center;padding: 8px 20px">
                 
                  <p class="search_p">   <?php echo $firme['model']; ?> </p>
                
               </td>
                 <td id="go-next"  style="text-align: center;padding: 8px 20px">
              
                    <p>Ostalo</p>
<input type="text" name="mem/<?php echo  $firme['id']?>/0" value="0" style="display: none;    text-align: center;">
                    <input type="text"  name="cena/<?php echo  $firme['id']?>/0" value="<?php echo $mem_array['0']; ?>">
                  
               </td>
               <?php foreach ($mems_array as $con => $memss): ?>
                 <td id="go-next"  style="text-align: center;padding: 8px 20px">
              
                    <p><?php echo $memss ?>GB</p>
<input type="text" name="mem/<?php echo  $firme['id']?>/<?php echo ($con+1) ?>" value="<?php echo $memss ?>" style="display: none;    text-align: center;">
                    <input type="text"  name="cena/<?php echo  $firme['id']?>/<?php echo ($con+1) ?>" value="<?php echo $mem_array[$memss]; ?>">
                  
               </td>
               <?php endforeach ?>
                
           <td id="go-next"  style="text-align: center;padding: 8px 20px">
              
                    <p>1TB</p>
<input type="text" name="mem/<?php echo  $firme['id']?>/8" value="1" style="display: none;    text-align: center;">
                    <input type="text"  name="cena/<?php echo  $firme['id']?>/8" value="<?php echo $mem_array['1']; ?>">
                  
               </td>
       
          
                <td rowspan="1" style="text-align: center;padding: 8px 20px">
                 
                   <button class="izmeni_submit sub_button_company_edit" type="submit" name="edit_phone_id" style="padding: 3px 5px" value="<?php echo $firme['id']?>">Izmeni</button>

                 
               </td>
            </tr>
         
            <?php endforeach ?>
        <?php endif?>
      </form>
         </table>
         
		</div>
	</div>

		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	