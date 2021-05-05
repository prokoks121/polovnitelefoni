$(document).ready(function(){



   $('#login_btn').click(function(){
var check = 0;
if ($('#login-input-1').val() == "") {
  check = 1;
$('#koriscko_l').append("<span> Unesite korisničko ime </span>");
fadeNotic($('#koriscko_l span'));


  $('#login-input-1').addClass("borderCrveno");
}else{
  $('#login-input-1').removeClass("borderCrveno");
}
if ($('#login-input-2').val() == "") {
  check = 1;
$('#pass_l').append("<span> Unesite lozinku </span>");
fadeNotic($('#pass_l span'));
  $('#login-input-2').addClass("borderCrveno");
}else{
  $('#login-input-2').removeClass("borderCrveno");
}
var response = grecaptcha.getResponse();

if(response.length == 0){
    check = 1;
    alert("Potvrdite da niste robot");
}

if (check == 0) {
     $('#login_form').submit();


}

 });

function fadeNotic(a) {
    setTimeout(
  function() 
  {
   a.fadeOut(1500, function () {
a.remove();   });
  }, 5000);
}


$('#login-input-4').on('input',function (){
var email = $(this).val();
        if(email != '')
        {
            if(isValidEmailAddress(email))
            {
                 $(this).removeClass("borderCrveno");
            } else {
                 $(this).addClass("borderCrveno");
            }
        } else {
             $(this).addClass("borderCrveno");
        }

});


$('#login-input-5').bind("keypress click",function (){
var pass1 = $(this).val();
        if(pass1 != '')
        {
            if(pass1.length > 6)
            {
                 $(this).removeClass("borderCrveno");
            } else {
                 $(this).addClass("borderCrveno");
            }
        } else {
             $(this).addClass("borderCrveno");
        }

});

$('#login-input-6').bind("keyup click",function (){

var pass2 = $(this).val();
var pass1 = $('#login-input-5').val();
        if(pass2 != '')
        {
            if(pass2 == pass1)
            {
                 $(this).removeClass("borderCrveno");
            } else {
                 $(this).addClass("borderCrveno");
            }
        } else {
             $(this).addClass("borderCrveno");
        }

});




$('#login-input-3').on('input',function (){
var username = $(this).val();
        if(username != '')
        {
            if(username.length > 4)
            {

                 $(this).removeClass("borderCrveno");
            } else {
                 $(this).addClass("borderCrveno");

            }
        } else {
             $(this).addClass("borderCrveno");  
    
        }

});





function isValidEmailAddress(email) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(email);
};


$('#reg_user').click(function(){
var check = 0;
if ($('#login-input-3').val() == "") {
  check = 1;
$('#koriscko_l').append("<span> Unesite korisničko ime </span>");
fadeNotic($('#koriscko_l span'));


  $('#login-input-3').addClass("borderCrveno");
}else{
  $('#login-input-3').removeClass("borderCrveno");

}
if ($('#login-input-4').val() == "") {
  check = 1;
$('#mail_l').append("<span> Unesite Email adresu </span>");
fadeNotic($('#mail_l span'));
  $('#login-input-4').addClass("borderCrveno");
}else{
  $('#login-input-4').removeClass("borderCrveno");

}
if ($('#login-input-5').val() == "") {
  check = 1;
$('#lozinka1_l').append("<span> Unesite lozinku </span>");
fadeNotic($('#lozinka1_l span'));
  $('#login-input-5').addClass("borderCrveno");
}else{
  $('#login-input-5').removeClass("borderCrveno");

}
if ($('#login-input-6').val() == "") {
  check = 1;
$('#pass2_l').append("<span> Unesite lozinku </span>");
fadeNotic($('#pass2_l span'));
  $('#login-input-6').addClass("borderCrveno");
}else{
  $('#login-input-6').removeClass("borderCrveno");

}
if ($('#login-input-7').val() == "") {
  check = 1;
$('#ime_l').append("<span> Unesite ime </span>");
fadeNotic($('#ime_l span'));

  $('#login-input-7').addClass("borderCrveno");
}else{
  $('#login-input-7').removeClass("borderCrveno");

}
if ($('#login-input-8').val() == "") {
  check = 1;
$('#prezime_l').append("<span> Unesite prezime </span>");
fadeNotic($('#prezime_l span'));
  $('#login-input-8').addClass("borderCrveno");
}else{
  $('#login-input-8').removeClass("borderCrveno");

}
if ($('#login-input-9').val() == "") {
  check = 1;
$('#adresa_l').append("<span> Unesite adresu </span>");
fadeNotic($('#adresa_l span'));
  $('#login-input-9').addClass("borderCrveno");
}else{
  $('#login-input-9').removeClass("borderCrveno");

}
if ($('#login-input-10').val() == "") {
  check = 1;
$('#grad_l').append("<span> Unesite grad </span>");
fadeNotic($('#grad_l span'));

  $('#login-input-10').addClass("borderCrveno");
}else{
  $('#login-input-10').removeClass("borderCrveno");

}
if ($('#login-input-11').val() == "") {
  check = 1;
$('#telefon1_l').append("<span> Unesite broj telefona </span>");
fadeNotic($('#telefon1_l span'));
  $('#login-input-11').addClass("borderCrveno");
}else{
  $('#login-input-11').removeClass("borderCrveno");

}
var username = $('#login-input-3').val();
check_user = 1;
        
            if(username.length > 4){ check_user = 0;} else{
              $('#koriscko_l').append("<span> Minimum 5 karaktera </span>");
fadeNotic($('#koriscko_l span'));
            }

        


var pass2 = $('#login-input-6').val();
var passe1 = $('#login-input-5').val();
var check_pass2 = 1;
       
            if(pass2 == passe1) {check_pass2 = 0; } else{
              $('#pass2_l').append("<span> Lozinke se ne poklapaju</span>");
fadeNotic($('#pass2_l span'));
            }
        

var pass1 = $('#login-input-5').val();
var check_pass1 = 1;
       
            if(pass1.length > 6){check_pass1 = 0;} else{
              $('#lozinka1_l').append("<span> Minimum 7 karaktera </span>");
fadeNotic($('#lozinka1_l span'));
            }
      

var email = $('#login-input-4').val();
var check_mail = 1;
       
            if(isValidEmailAddress(email))
            {
              check_mail = 0;
                
            } else{
              $('#mail_l').append("<span> Email adresa nije ispravna </span>");
fadeNotic($('#mail_l span'));
            }
       

if (check == 0 && check_user == 0 && check_pass1 == 0 && check_pass2 == 0 && check_mail == 0) {
     $('#register_form').submit();


}







   });



  });