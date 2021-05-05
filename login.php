<?php  include_once('config.php'); ?>
<?php  include_once('includes/registration_login.php'); ?>
<?php if (!isset($_SESSION['user']['id'])) { ?>
<?php  include('includes/header.php'); ?>
<link rel=stylesheet href=/static/css/zas/login.css?v=1.00>
<script src=https://www.google.com/recaptcha/api.js></script>

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
 .logining{
   height: 584px;
 }
 .logining div{
   margin: 0px;
 }
 .rc-anchor-light.rc-anchor-normal{
  border-radius: 10px;
 }
 .login_label{
  display: inline-block;
 }
  .login_label span{
      position: absolute;
    margin-top: -7px;
    margin-left: -178px;
    /* margin: auto; */
    background-color: white;
    border: 1px solid red;
    border-radius: 5px;
    padding: 2px 9px;
    font-family: 'Source Sans Pro';
    font-size: 15px;
 }
 @media only screen and (max-width: 1023px){
.btn {
    margin-left: unset!important;
}
}
</style>

<title>PolovniTelefoni.net | Prijavi se</title>
</head>
<body>
  <div class="background-body"></div>
   <?php include(ROOT_PATH . '/includes/errors.php') ?>
   <div class="div_81">
   <div class="logining">
      <div style="float: left;">
         <form class="form1" method="post" id="login_form" >
          <i class="fas fa-users"></i>
                                              <h1 style="display: none;">Prijavite se</h1>

            <h2 style="color: white;">Prijavite se</h2>
            <label class="login_label" id="koriscko_l">
            <i class="fas fa-user reg"></i>
            <input class="login-input" id="login-input-1" type="text" name="username" placeholder="Korisničko ime"></label></br>
                        <label class="login_label" id="pass_l">

            <i class="fas fa-unlock-alt reg"></i>
            <input class="login-input" id="login-input-2" type="password" name="password" placeholder="Lozinka"></label>
                           <div class="g-recaptcha" data-sitekey="6LdLUI4UAAAAANiuoGnca7bU6Gr1lweB6ChFE4kY"></div>

            <label  style="    width: 100px;
    margin-left: 1px;
    float: left;
    margin-top: 9px;" class="lael">Zapamti me
            <input  id="checkbox2"  class="intcheck" type="checkbox" name="remember" value="1">
            <span style="    height: 17px;
               width: 17px;" id="1dan" class="checkmark"></span>
            </label>
            <a href="/user/pass_recovery" style="    margin-top: 13px;
    font-family: arial;
    color: white;
   float: right;">Zaboravili ste sifru?</a>
<input type="txt" name="login_btn" style="visibility: hidden;display: none;">
            <span  id="login_btn" class="btn" style="width: 260px;
    margin-top: 45px;
    font-size: 14px;
    font-family: 'Source Sans Pro',sans-serif;">Prijavi se</span>



  <p style="position: absolute;
    border-bottom: 1px solid white;
    width: 38%;"></p>
  <p style="position: absolute;
    color: white;
    font-size: 60px;
    margin-left: 142px;
    margin-top: -50px;">.</p>
  <p style="    float: left;
    position: absolute;
    border-bottom: 1px solid white;
    width: 38%;
    margin-left: 170px;"></p>
  <h2 style="    color: white;
    margin-top: 15px;
    margin-bottom: 13px;
    padding-top: 15px;
    width: 227px;">Niste registrovani?</h2>
<p>




    <a href="/register"   class="btn" style="width: 257px;
    font-size: 14px;
    font-family: 'Source Sans Pro',sans-serif;

">Registruj se</a>
         </form>
      </div>
    
 
   </div>
     </div>
     <script src="/static/js/login.js"></script>

</body>
</html>
<?php }else{ header('location:' . BASE_URL . 'user/user.php'); } ?>