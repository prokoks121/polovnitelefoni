<div class="div_7">
<div class="div-wqe">
<?php $posts1=getReklamniPost(); ?>
<?php foreach ($posts1 as $post): ?>
<?php global $conn; $id_telefon=$post['id_telefona']; 
   $stm = $conns->prepare("SELECT * FROM phones WHERE id=?");
    $stm->execute([$id_telefon]);
   $phones = $stm->fetch(PDO::FETCH_BOTH);
 
$link = $phones['marka'] . "-" . $phones['model'];
$link = SplitWrods($link);


 ?>
<div id="imgss-div">
<a href="/single_post/<?php echo $link; ?>/<?php echo $post['id']; ?>">
<img class="imgss" alt="Polovni telefoni , <?php echo $phones['photo']; ?>" src="<?php echo '/static/images/modeli/' . $phones['photo']; ?>" width="145px" height="192px">
<div id="img-div">
<p class="p_2"><?php echo mb_strimwidth($phones['model'], 0, 16, '..');?></p>
<p class="p_3"><?php if ($post['cena'] !='Dogovor') { $r='€'; $r1='Za samo '; }else { $r=''; $r1=''; } echo $r1 . $post['cena'] . $r; ?></p>
</div>
</a>
</div>
<?php endforeach ?>
</div>
<div class="div_8">
<div class="div_9">
<p id="before"><i class="fas fa-angle-left"></i></p>
<p class="p_slider"><i id="swap1" class="fas fa-circle i_3"></i></p>
<p class="p_slider"><i id="swap2" class="fas fa-circle"></i></p>
<p class="p_slider"><i id="swap3" class="fas fa-circle"></i></p>
<p class="p_slider"><i id="swap4" class="fas fa-circle"></i></p>
<p id="next"><i class="fas fa-angle-right"></i></p></div></div>
</div>
<script defer src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">/*<![CDATA[*/var interval;var icon=function(){left=$(".div-wqe").css("left");string=parseFloat(left);if(string==0){$("#swap1").css({color:"#0f6dd0"})}else{$("#swap1").css({color:"#14264e"})}if(string==-991){$("#swap2").css({color:"#0f6dd0"})}else{$("#swap2").css({color:"#14264e"})}if(string==-1982){$("#swap3").css({color:"#0f6dd0"})}else{$("#swap3").css({color:"#14264e"})}if(string==-2973){$("#swap4").css({color:"#0f6dd0"})}else{$("#swap4").css({color:"#14264e"})}};var side=function(){var b=$(".div-wqe").css("left");var a=parseFloat(b);if(a<="-2973"){$(".div-wqe").animate({left:"0px"},2000,"easeInOutQuart",icon)}else{$(".div-wqe").animate({left:"-=991px"},2000,"easeInOutQuart",icon)}};$(window).focus(function(){interval=window.setInterval(side,10000)});$(window).blur(function(){clearInterval(interval);interval=0});$("#next").on("click",function(){var b=$(".div-wqe").css("left");var a=parseFloat(b);clearInterval(interval);if(a<="-2973"){$(".div-wqe").animate({left:"0px"},2000,"easeInOutQuart",icon)}else{$(".div-wqe").animate({left:"-=991px"},2000,"easeInOutQuart",icon)}window.setTimeout(function(){interval=setInterval(side,10000)},0)});$("#before").on("click",function(){var b=$(".div-wqe").css("left");var a=parseFloat(b);clearInterval(interval);if(a>="0"){$(".div-wqe").animate({left:"-2973px"},2000,"easeInOutQuart",icon)}else{$(".div-wqe").animate({left:"+=991px"},2000,"easeInOutQuart",icon)}window.setTimeout(function(){interval=setInterval(side,10000)},0)});$("#swap1").on("click",function(){clearInterval(interval);$(".div-wqe").animate({left:"0px"},2000,"easeInOutQuart",icon);window.setTimeout(function(){interval=setInterval(side,10000)},0)});$("#swap2").on("click",function(){clearInterval(interval);$(".div-wqe").animate({left:"-991px"},2000,"easeInOutQuart",icon);window.setTimeout(function(){interval=setInterval(side,10000)},0)});$("#swap3").on("click",function(){clearInterval(interval);$(".div-wqe").animate({left:"-1982px"},2000,"easeInOutQuart",icon);window.setTimeout(function(){interval=setInterval(side,10000)},0)});$("#swap4").on("click",function(){clearInterval(interval);$(".div-wqe").animate({left:"-2973px"},2000,"easeInOutQuart",icon);window.setTimeout(function(){interval=setInterval(side,10000)},0)});/*]]>*/</script>