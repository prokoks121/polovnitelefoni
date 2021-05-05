<?php $user_get_2 = GetSessionUserPublic(); 
     ?>
<div class="navbar"><div class="navbarr">
<div class="logo_div">
<a href="/index"><img alt="Polovni telefoni , Logo" class="logo_img" src="/static/images/logo.png"></a>
</div>
<ul class="ul_1">
<li id="login"><div class="div_1"><input class="input_1" type="text" name="" placeholder="Pretraga" id="pretraga"><i class="i_1" class="fas fa-search"></i>
<div id="pretrazeno_div">
</div>
</div></li>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js" integrity="sha256-4HLtjeVgH0eIB3aZ9mLYF6E8oU5chNdjU6p6rrXpl9U=" crossorigin="anonymous"></script>
<script type="text/javascript">/*<![CDATA[*/$(document).ready(function(){$("#pretraga").keyup(function(){var a=$("#pretraga").val();$.ajax({type:"POST",url:"/includes/search_navbar.php",data:"search_val="+a,success:function(c){$("#pretrazeno_div").html(c);var b=$("#pretraga").val().toLowerCase();$("#pretrazeno_div").unmark({done:function(){$("#pretrazeno_div").mark(b)}});if(b!=""){$("#pretrazeno_div").show()}else{$("#pretrazeno_div").hide()}$(".pretrazeno").filter(function(){})}})});$("body").on("click",function(a){if(a.target.id!="pretrazeno_div"&&$(a.target).attr("class")!="pretrazeno"&&$(a.target).attr("class")!="fa-search"&&a.target.id!="pretraga"){$("#pretrazeno_div").hide()}});$("#pretraga").on("click",function(b){var a=$(this).val().toLowerCase();if(a!=""){$("#pretrazeno_div").show()}else{$("#pretrazeno_div").hide()}})});/*]]>*/</script>
<?php if (!isset($_SESSION['user']['id'])){ ?>
<li id="login"><a href="/login">Prijavi se</a></li>
<li id="register"><a href="/register">Registruj se</a></li>
<?php }else{ if ($user_get_2['ime'] !=="" && $user_get_2['prezime'] !=="") { $imeprezime=$user_get_2['ime'] . " " . $user_get_2['prezime']; }else { $imeprezime="Moj nalog"; } ?>
<li class="userrs"><a class="users" href="#"><span class="check_size"><?php echo $imeprezime ?></span><span class="check_size span_1"><?php echo $user_get_2['email']; ?></span></a>
<ul class="navbarli">
<li><a class="a_2" style="border-top-right-radius: 19px!important;
    border-top-left-radius: 19px!important;" href="/user/user?my=true">Moji oglasi</a></li>
<li><a class="a_2" href="/user/create_post">Okači oglas</a></li>
<li><a class="a_2" href="/user/user?follow=true">Oglasi koje pratim</a></li>
<li><a class="a_2" href="/user/user?message=true">Poruke</a></li>
<li><a class="a_2" href="/user/user?pass=true">Promeni lozinku</a></li>
<li><a class="a_2" href="/user/user">Podesavanje</a></li>
<?php global $conn; $user_id=$_SESSION['user']['id'];  $stm = $conns->prepare("SELECT * FROM company WHERE user_id=? LIMIT 1");
    $stm->execute([$user_id]);
   $company=  $stm->fetch(PDO::FETCH_ASSOC);
if ($company !='') { echo ' <li><a class="a_3" href="/user/user_company">Prof. preduzeća</a></li>';
}
?>
<?php global $conn; $user_id=$_SESSION['user']['id']; $stm = $conns->prepare("SELECT * FROM users WHERE role='Admin' AND id=? LIMIT 1");
    $stm->execute([$user_id]);
    $result=  $stm->fetch(PDO::FETCH_ASSOC); if ($result !=0) { echo ' <li><a class="a_4" href="/admin/dashboard">Admin</a></li>';
}
?>
<span id="linija"></span>
<li ></br><a class="logout" href="/logout">Odjavi se</a></li>
</ul>
</li>
<?php }?>
</ul>
</div>
</div>