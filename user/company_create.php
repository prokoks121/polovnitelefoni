<?php require_once('../config.php') ?>

<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>

<?php require_once( ROOT_PATH . '/user/user-fuction.php') ?>
<?php
$errors = [];
global $conns,$errors;
if (isset($_SESSION['user']['id'])) {
  $user_id = $_SESSION['user']['id'];

$stm = $conns->prepare("SELECT * FROM company WHERE user_id = ? LIMIT 1");
    $stm->execute([$user_id]);



  if($stm->rowCount() == 1){
header("Location: /user/user_company");

  }}else{
    
  header("Location: /register?errors=Prvo morate da napravite korisnicki nalog, potom nalog za predzeca");
}



 ?>
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
<style type="text/css">
    .opste-label{
        width: 148px!important;
    margin-top: 9px;
    padding: 11px 0px;
    }
    .form3{
            margin: auto;
    width: 915px;
    }
    .smal_input{
        width: 50px;
        padding:2px;
    }
    td{
        padding: 3px;
    }
</style>

	<title>Izveštaj | PolovniTelefoni.net</title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>

<div class="container">

		<div class="content" style="background-color: white;border-radius: 15px;">
            <div style="    padding-top: 30px;
    margin: auto;
   
   ">
		<h2 style="margin: auto;
    display: table;
    padding-bottom: 60px;">Predstavljajte vašu preduzeće na našem sajtu</h2>
        <div>
        <form  class="form3" id="register_form" method="post" >
            <div style="float: left"> 
<label class="opste-label">MBR</label>

              <input class="login-input" type="text" id="login-input-1" name="mbr" pattern="^[0-9]{8}$"   placeholder="12345678"></br>
              <label class="opste-label">Ime preduzeća</label>

                            <input class="login-input" type="text" id="login-input-2" name="ime" pattern="^[A-Za-z ]{2,20}$"   placeholder="Ime preduzeća"></br>
                            <label class="opste-label">Grad</label>


               <input class="login-input" type="text" id="login-input-3" name="grad" pattern="^[A-Za-z ]{2,25}$"   placeholder="Beograd"></br>
                    <label class="opste-label">Opština/Naselje</label>


               <input class="login-input" type="text" id="login-input-9" name="opstina" pattern="^[A-Za-z ]{2,25}$"   placeholder="Vinča"></br>
               <label class="opste-label">Broj telefona</label>


               <input class="login-input" type="text" id="login-input-4" name="telefon" pattern="[0-9]{13,16}"   placeholder="0651234567"></br>


</div>
            <div  style="float: left">  
                <label class="opste-label">PIB</label>

               <input class="login-input" type="text" id="login-input-5" name="pib" pattern="^[0-9]{9}$"   placeholder="123456789"></br>
               <label class="opste-label">Email preduzeća</label>

             <input class="login-input" type="email" id="login-input-6" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="preduzece@preduzece.com"></br>
<label class="opste-label">Adresa</label>


               <input class="login-input" type="text" id="login-input-7" name="adresa" pattern="^[A-Za-z-0-9 ]{3,25}$"   placeholder="Adresa"></br>
                <label class="opste-label">Poštanski broj</label>


               <input class="login-input" type="text" id="login-input-8" name="pos_br"    placeholder="11120"></br>

</div>
<div style="float: left;">
    <div>
        <h3>Radno vreme</h3>
    <table>
        <tbody>
            <tr>
                <td colspan="4">Radnim danima</td>
            </tr>
            <tr>
                <td >od:</td>
                <td><input class="smal_input" type="text" name="rad1"></td>
                <td>do:</td>
                <td><input class="smal_input" type="text" name="rad2"></td>
            </tr>
            <tr>
                <td colspan="4">Subota <div style="float: right;"><input type="checkbox" name="sub_ne"> Ne radimo</div></td>
            </tr>
            
            <tr>
                <td>od:</td>

                <td><input class="smal_input" type="text" name="sub1"></td>
                <td>do:</td>
                <td><input class="smal_input" type="text" name="sub2"></td>
            </tr>
            <tr>
                <td colspan="4">Nedelja <div style="float: right;"><input type="checkbox" name="ned_ne"> Ne radimo</div></td>
            </tr>
 
            <tr>
                <td >od:</td>
                <td><input class="smal_input" type="text" name="ned1"></td>
                <td>do:</td>
                <td><input class="smal_input" type="text" name="ned2"></td>
            </tr>
        </tbody>
    </table>
    </div>
    
<input type="txt" name="reg_company" style="visibility: hidden;display: none;" value="111">

            <span class="btn" id="reg_company" style="    width: 120px;
    margin-left: 453px;
    margin-top: -42px;
    font-size: 14px;
    font-family: 'Source Sans Pro',sans-serif;">Pošalji zahtev</span>
      

         </form>
        </div>
		</div>
        <script type="text/javascript">
            $(document).ready(function(){



  


$('#login-input-6').on('input',function (){
var email = $(this).val();
        if(email != '')
        {
            if(isValidEmailAddress(email))
            {
                 $(this).css({'border' : '1px solid darkgrey'});
            } else {
                 $(this).css({'border' : '1px solid red'});
            }
        } else {
             $(this).css({'border' : '1px solid red'}); 
        }

});


$('#login-input-1').bind("keypress click",function (){
var pass1 = $(this).val();
        if(pass1 != '')
        {
            if(pass1.length == 8)
            {
                 $(this).css({'border' : '1px solid darkgrey'});
            } else {
                 $(this).css({'border' : '1px solid red'});
            }
        } else {
             $(this).css({'border' : '1px solid red'}); 
        }

});
$('#login-input-5').bind("keypress click",function (){
var pass1 = $(this).val();
        if(pass1 != '')
        {
            if(pass1.length == 9)
            {
                 $(this).css({'border' : '1px solid darkgrey'});
            } else {
                 $(this).css({'border' : '1px solid red'});
            }
        } else {
             $(this).css({'border' : '1px solid red'}); 
        }

});






$('#login-input-4').on('input',function (){
var username = $(this).val();
        if(username != '')
        {
            if(username.length > 7)
            {

                 $(this).css({'border' : '1px solid darkgrey'});
            } else {
                 $(this).css({'border' : '1px solid red'});

            }
        } else {
             $(this).css({'border' : '1px solid red'});   
    
        }

});





function isValidEmailAddress(email) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(email);
};


$('#reg_company').click(function(){
var check = 0;
if ($('#login-input-3').val() == "") {
  check = 1;

  $('#login-input-3').css({'border' : '1px solid red'});
}else{
  $('#login-input-3').css({'border' : '1px solid darkgrey'});

}
if ($('#login-input-4').val() == "") {
  check = 1;

  $('#login-input-4').css({'border' : '1px solid red'});
}else{
  $('#login-input-4').css({'border' : '1px solid darkgrey'});

}
if ($('#login-input-5').val() == "") {
  check = 1;

  $('#login-input-5').css({'border' : '1px solid red'});
}else{
  $('#login-input-5').css({'border' : '1px solid darkgrey'});

}
if ($('#login-input-6').val() == "") {
  check = 1;

  $('#login-input-6').css({'border' : '1px solid red'});
}else{
  $('#login-input-6').css({'border' : '1px solid darkgrey'});

}
if ($('#login-input-7').val() == "") {
  check = 1;

  $('#login-input-7').css({'border' : '1px solid red'});
}else{
  $('#login-input-7').css({'border' : '1px solid darkgrey'});

}
if ($('#login-input-8').val() == "") {
  check = 1;

  $('#login-input-8').css({'border' : '1px solid red'});
}else{
  $('#login-input-8').css({'border' : '1px solid darkgrey'});

}
if ($('#login-input-9').val() == "") {
  check = 1;

  $('#login-input-9').css({'border' : '1px solid red'});
}else{
  $('#login-input-9').css({'border' : '1px solid darkgrey'});

}

if ($('#login-input-2').val() == "") {
  check = 1;

  $('#login-input-2').css({'border' : '1px solid red'});
}else{
  $('#login-input-2').css({'border' : '1px solid darkgrey'});

}
if ($('#login-input-1').val() == "") {
  check = 1;

  $('#login-input-1').css({'border' : '1px solid red'});
}else{
  $('#login-input-1').css({'border' : '1px solid darkgrey'});

}
var username = $('#login-input-1').val();
var check_user = 1;
        
            if(username.length == 8){ check_user = 0;} 
        




var pass1 = $('#login-input-5').val();
var check_pass1 = 1;
       
            if(pass1.length == 9){check_pass1 = 0;} 
      

var email = $('#login-input-6').val();
var check_mail = 1;
       
            if(isValidEmailAddress(email))
            {
              check_mail = 0;
                
            } 
       

if (check == 0 && check_user == 0 && check_pass1 == 0 && check_mail == 0) {
     $('#register_form').submit();


}







   });



  });
        </script>
</div>
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	