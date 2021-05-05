<?php  include('config.php'); ?>
<?php  include('includes/registration_login.php'); ?>
<?php if (!isset($_SESSION['user']['id'])) { ?>
<?php  include('includes/header.php'); ?>
<link rel=stylesheet href=/static/css/zas/register.css?v=1.00>
<style type="text/css">
   .lael {
   padding-left: 28px;
   color: white;
   font-size: 17px;
   }
   .lael .checkmark:after {
   left: 5px!important;
   top: 1px!important;
   width: 4px!important;
   height: 9px!important;
   }
   .btn{
   background: #f26261!important;
   }
   html{
   height: 0px !important;
   }

 .logining{
height: 663px;width: 636px!important;}
 .logining div{
   margin: 0px;
 }
 .logining div{
  width: auto!important;

 }
    .background-body{
   background-position: center;
   background-image: url(/static/images/background.jpg);
   background-position-y: 0px;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
   padding-bottom: 0rem !important;
       filter: blur(5px);
    width: 100%;
    height: 100%;
    position: fixed;   }
     .login_label{
  display: block;
 }
  .login_label span{
      position: absolute;
    margin-top: -75px;
    margin-left: 100px;
    /* margin: auto; */
    background-color: white;
    border: 1px solid red;
    border-radius: 5px;
    padding: 2px 9px;
    font-family: 'Source Sans Pro';
    font-size: 15px;
 }
</style>

<title>PolovniTelefoni.net | Registruj se</title>
</head>
<body>
    <div class="background-body"></div>

   <?php include(ROOT_PATH . '/includes/errors.php') ?>
   <div style="min-width: 800px;  
   min-height: 250px;  
    position: absolute;
    display: table;">
   <div class="logining">
      <div style="float: left;">
        <form class="form2" id="register_form" method="post" >
                    <i class="fas fa-users"></i>

                        <h1 style="display: none;">Registrujte se</h1>

            <h2 style="color: white;">Registrujte se</h2>
            <div style="float: left"> 
                          <label class="login_label" id="ime_l">

              <i class="fas fa-user-circle reg"></i>
              <input class="login-input" type="text" id="login-input-7" name="ime" pattern="^[A-Za-z]{2,15}$"   placeholder="Ime"></br>
                               </label>  <label class="login_label" id="grad_l">

              <i class="fas fa-city reg"></i>
               <input class="login-input" type="text" id="login-input-10" name="grad" pattern="^[A-Za-z ]{2,25}$"   placeholder="Grad"></br>
                              </label>    <label class="login_label" id="telefon1_l">

<i class="fas fa-mobile reg"></i>
               <input class="login-input" type="text" id="login-input-11" name="br1" pattern="[0-9]{13,16}"   placeholder="Broj telefona"></br>
                                </label>  <label class="login_label" id="koriscko_l">

            <i class="fas fa-user reg"></i>

              <input class="login-input" type="text" id="login-input-3" name="username" pattern="^[A-Za-z0-9_]{5,15}$"   placeholder="Korisničko ime"></br>
                              </label>   <label class="login_label" id="lozinka1_l">

                          <i class="fas fa-unlock-alt reg"></i>

             <input class="login-input" type="password" id="login-input-5" name="password_1" pattern="{6}" placeholder="Lozinka"></br>
       </label>
</div>
            <div  style="float: left">   
                          <label class="login_label" id="prezime_l">

              <i class="fas fa-user-circle reg"></i>
               <input class="login-input" type="text" id="login-input-8" name="prezime" pattern="^[A-Za-z]{2,15}$"   placeholder="Prezime"></br>
                                </label>  <label class="login_label" id="adresa_l">

               <i class="fas fa-location-arrow reg"></i>
               <input class="login-input" type="text" id="login-input-9" name="adresa" pattern="^[A-Za-z-0-9 ]{3,25}$"   placeholder="Adresa"></br>
                                </label>  <label class="login_label" >

               <i class="fas fa-mobile reg"></i>
               <input class="login-input" type="text" id="login-input-12" name="br2" pattern="^[0-9]{6,16}$"   placeholder="Broj telefona 2/ Polje nije obavezno"></br>
                                </label>  <label class="login_label" id="mail_l">

               <i class="fas fa-envelope reg"></i>
             <input class="login-input" type="email" id="login-input-4" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Email"></br>
                             </label>   <label class="login_label" id="pass2_l">

                         <i class="fas fa-unlock-alt reg"></i>

               <input class="login-input" type="password" id="login-input-6" name="password_2" pattern="{6}" placeholder="Potvrdite lozinku"></br>
             </label>

</div>
<input type="txt" name="reg_user" style="visibility: hidden;display: none;" value="111">

            <span class="btn" id="reg_user" style="width: 257px;
    margin-left: 142px!important;
   margin-top: 377px;
    font-size: 16px;
    font-family: 'Source Sans Pro',sans-serif;">Registruj se</span>
      


  <p style="position: absolute;
    border-bottom: 1px solid #ffffff99;
    width: 43.5%;
    margin-left: 11px;
    margin-top: 10px;"></p>
  <p style="    position: absolute;
    color: #ffffff99;
    font-size: 60px;
    margin-left: 290px;
    margin-top: -40px;">.</p>
  <p style="
    float: left;
    position: absolute;
    border-bottom: 1px solid #ffffff99;
    width: 43.5%;
    margin-left: 308px;
    margin-top: 10px;"></p>
    <div style="width: 305px!important;
    margin: auto;
">
  <h2 style="    color: white;
    margin-top: 15px;
    padding-top: 15px;
    width: 227px;">Imate nalog?</h2>



    <a href="/login"   class="btn_2" >Prijavi se</a>
</div>
         </form>
      </div>
    
 
   </div>
     </div>
     <script src="/static/js/login.js"></script>

</body>
</html>
<?php }else{ header('location:' . BASE_URL . 'user/user.php'); } ?>