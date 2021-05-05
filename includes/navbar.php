<?php if (isset($_SESSION['user']['id'])){

 $user_get_4 = GetSessionUserPublic(); 
}
      ?>
<div class="navbar"><div class="navbarr">
<div class="logo_div">
<a href="/index"><img alt="Polovni telefoni , Logo" class="logo_img" src="/static/images/logo.png"></a>
</div>
<ul class="ul_1">
<li id="login"><div class="div_1">






























	<input class="input_1" type="text" name="" id="pretraga"><i class="i_1 fas fa-search" ></i>
<div id="pretrazeno_div">
</div>
</div></li>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js" integrity="sha256-4HLtjeVgH0eIB3aZ9mLYF6E8oU5chNdjU6p6rrXpl9U=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){

$(document).mouseup(function(e) 
{
    var container = $(".input_1_1");
    var ss = $("#pretrazeno_div");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0 && !ss.is(e.target) && ss.has(e.target).length === 0) 
    {
      container.addClass("input_1");

container.removeClass("input_1_1");
$(".i_1").css({"color":"white"});

    }
});




$(".i_1").click(function(){
	$(".input_1").addClass("input_1_1");

$(".input_1").removeClass("input_1");
$(".input_1_1").removeClass("hover_1");
$(".i_1").css({"color":"#6974e8"});
});

$(".div_1").hover(function(){
$(".input_1").addClass("hover_1");

},function(){
	$(".input_1").removeClass("hover_1");

});






	/*<![CDATA[*/$("#pretraga").keyup(function(){var a=$("#pretraga").val();$.ajax({type:"POST",url:"/includes/search_navbar.php",data:"search_val="+a,success:function(c){$("#pretrazeno_div").html(c);var b=$("#pretraga").val().toLowerCase();$("#pretrazeno_div").unmark({done:function(){$("#pretrazeno_div").mark(b)}});if(b!=""){$("#pretrazeno_div").show()}else{$("#pretrazeno_div").hide()}$(".pretrazeno").filter(function(){})}})});$("body").on("click",function(a){if(a.target.id!="pretrazeno_div"&&$(a.target).attr("class")!="pretrazeno"&&$(a.target).attr("class")!="fa-search"&&a.target.id!="pretraga"){$("#pretrazeno_div").hide()}});$("#pretraga").on("click",function(b){var a=$(this).val().toLowerCase();if(a!=""){$("#pretrazeno_div").show()}else{$("#pretrazeno_div").hide()}})});/*]]>*/</script>
<?php if (!isset($_SESSION['user']['id'])){

      ?>
<li id="logins"><a href="/login">Prijavi se</a></li>
<li id="register"><a href="/register">Registruj se</a></li>
<?php }else{ if ($user_get_4['ime'] !=="" && $user_get_4['prezime'] !=="") { $imeprezime=$user_get_4['ime'] . " " . $user_get_4['prezime']; }else { $imeprezime="Moj nalog"; } ?>
<li class="userrs"><a class="users" href="#"><span class="check_size"><?php echo $imeprezime ?></span><span class="check_size span_1"><?php echo $user_get_4['email']; ?></span></a>
<ul class="navbarli">
<li id="creater"><a href="/user/create_post">Okači oglas</a></li>
<li><a class="a_2" style="border-top-right-radius: 19px!important;border-top-left-radius: 19px!important;" href="/user/user?my=true">Moji oglasi</a></li>
<li><a class="a_2" href="/user/user?follow=true">Oglasi koje pratim</a></li>
<li><a class="a_2" href="/user/user?message=true">Poruke</a></li>
<li><a class="a_2" href="/user/user?pass=true">Promeni lozinku</a></li>
<li><a class="a_2" href="/user/user">Podesavanje</a></li>
<?php global $conns; $user_id=$_SESSION['user']['id'];  $stm = $conns->prepare("SELECT * FROM company WHERE user_id=? LIMIT 1");
    $stm->execute([$user_id]);
   $company=  $stm->fetch(PDO::FETCH_ASSOC);
 if ($company !='') { echo ' <li><a class="a_3" href="/user/user_company">Prof. preduzeća</a></li>';


  
}
?>
<?php $user_id=$_SESSION['user']['id'];

 $stm = $conns->prepare("SELECT * FROM users WHERE role='Admin' AND id=? LIMIT 1");
    $stm->execute([$user_id]);
    $result=  $stm->fetch(PDO::FETCH_ASSOC);


  if ($result !=0) { echo ' <li><a class="a_4" href="/admin/dashboard">Admin</a></li>';
}
?>
<span id="linija"></span>
<li></br><a class="logout" href="/logout">Odjavi se</a></li>
</ul>
</li>
<?php }?>
<li id="create"><a id="checkedss" href="/user/create_post">Okači oglas</a></li>
</ul>
</div>
</div>