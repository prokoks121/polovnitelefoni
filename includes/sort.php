<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<?php if (!empty($_GET['roew'])) { $roew=$_GET['roew']; }else{ $roew='three'; } if (!empty($_GET['sort'])) { $sort=$_GET['sort']; }else{ $sort=''; } $a1=array('54','102','150','198'); $a[0]=array('54','108','144','198'); $a[1]=array('56','104','152','200'); $a[2]=array('56','98','154','196'); $a[3]=array('54','102','150','198'); $a[4]=array('50','100','150','200'); if (isset($_COOKIE['zoom'])) { $zoom=$_COOKIE['zoom']; }else{ $zoom='83';} $ids=array('55.1', '62', '70.9', '83', '100'); $vals=""; for ($i=0; $i < 5 ; $i++) { if ($ids[$i]==$zoom) { $vals=$i; $a1=$a[$i]; } } if (isset($_GET['num_post'])) { $num_post=$_GET['num_post']; }else{ $num_post=$a1[2]; } ?>
<div class="div_10">
<div class="div_11">
<p class="p_4">Sortiraj </p>
<select id="sort" class="select_2">
<option value="dateup" <?php if ($sort=='dateup'){echo "selected";} ?>
>Datum objave &#xf139; </option>
<option value="datedown"<?php if ($sort=='datedown'){echo "selected";} ?>>Datum objave &#xf13a;</option>
<option value="priceup"<?php if ($sort=='priceup'){echo "selected";} ?>>Cena &#xf139;</option>
<option value="pricedown"<?php if ($sort=='pricedown'){echo "selected";} ?>>Cena &#xf13a;</option>
</select>
</div>
<div class="div_12">
<?php if ($roew=='three'): ?>
<input id="slider1" class="sliders" type="range" min="0" max="4" value="<?php echo $vals ?>">
<script type="text/javascript">$(document).ready(function(){var a=[55.1,62,70.9,83,100];$("#slider1").change(function(){$(".post").css({zoom:a[this.value]+"%"});var b=a[this.value];document.cookie="zoom="+b+";0;path=/"})});</script>
<?php endif ?>
</div>
<div class="div_13">
<p>Broj aktivnih oglasa <i class="fas fa-angle-right"></i> <?php

    $stm = $conns->prepare("SELECT * FROM posts WHERE published=true AND delete_check= false");
        $stm->execute();
       $num =$stm->rowCount();


  echo $num; ?></p>
</div>
<div class="div_14"><p class="p_5">Broj oglasa po stranici:</p>
<select id="num_post">
<option value="0" <?php if ($num_post==0){echo "selected";} ?>><?php echo $a1[0] ?></option>
<option value="1" <?php if ($num_post!=0 && $num_post!=2 && $num_post!=3){echo "selected";} ?>><?php echo $a1[1] ?></option>
<option value="2" <?php if ($num_post==2){echo "selected";} ?>><?php echo $a1[2] ?></option>
<option value="3" <?php if ($num_post==3){echo "selected";} ?>><?php echo $a1[3] ?></option>
</select><i class="fas fa-caret-down  img_6_12"></i></div>
<div class="div_15">
<button class="rooew button_2 <?php if ($roew =="first"){echo "button_12";} ?>" id="roew" value="first" >
<i class="i_4 <?php if ($roew=='first'){echo"i_41";} ?> fas fa-th-large" ></i>
</button>
<button class="rooew button_2 <?php if ($roew=='three'){echo"button_12";} ?>" id="roew" value="three" >
<i class="i_4 <?php if ($roew=='three'){echo"i_41";} ?> fas fa-th" ></i></button>
</div>
</div>
<script type="text/javascript">/*<![CDATA[*/$(document).ready(function(){$("#sort").change(function(){var c=window.location.href.substring(0,window.location.href.indexOf("?"));var a=window.location.href.substring(window.location.href.indexOf("?")+1,window.location.href.length);var f=$(this).attr("id")+"="+$(this).val();if(a.indexOf($(this).attr("id")+"=")==-1){if(window.location.href.indexOf("?")==-1){a=""}else{a=a+"&"}a=a+f}else{var e=a.indexOf($(this).attr("id")+"=");var b=a.indexOf("&",e);if(b==-1){b=a.length}var d=a.substring(e,b);a=a.replace(d,f)}window.location.replace(c+"?"+a)});$("#num_post").change(function(){var c=window.location.href.substring(0,window.location.href.indexOf("?"));var a=window.location.href.substring(window.location.href.indexOf("?")+1,window.location.href.length);var f=$(this).attr("id")+"="+$(this).val();if(a.indexOf($(this).attr("id")+"=")==-1){if(window.location.href.indexOf("?")==-1){a=""}else{a=a+"&"}a=a+f}else{var e=a.indexOf($(this).attr("id")+"=");var b=a.indexOf("&",e);if(b==-1){b=a.length}var d=a.substring(e,b);a=a.replace(d,f)}window.location.replace(c+"?"+a)});$(".rooew").on("click",function(){var c=window.location.href.substring(0,window.location.href.indexOf("?"));var a=window.location.href.substring(window.location.href.indexOf("?")+1,window.location.href.length);var f=$(this).attr("id")+"="+$(this).val();if(a.indexOf($(this).attr("id")+"=")==-1){if(window.location.href.indexOf("?")==-1){a=""}else{a=a+"&"}a=a+f}else{var e=a.indexOf($(this).attr("id")+"=");var b=a.indexOf("&",e);if(b==-1){b=a.length}var d=a.substring(e,b);a=a.replace(d,f)}window.location.replace(c+"?"+a)})});/*]]>*/</script>
