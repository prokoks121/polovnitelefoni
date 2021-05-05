<?php $models=getModelss(); ?>

<style type="text/css">.lael .checkmark:after{left:7px!important;top:2px!important}.custom-select-option{padding:0!important}</style>
<script type="text/javascript">/*<![CDATA[*/$(document).ready(function(){var check=<?php if(!empty($_GET['mreza'])){echo $_GET['mreza'];}else{echo"0";}?>;if(check==1||check==2||check==3){$('.send option[value='+check+']').attr('selected','selected');}});/*]]>*/</script>
<div class="search"><div class="div_2" id="formes">
<div class="search12">
<div class="div_3">
	<div class="nav_ser">
<a href="/index" class="indx">Telefoni</a>
<a href="/marke_modeli" class="mrkmd">Proizvođači i Modeli</a>
<a href="/radnje" class="prod">Prodavnice</a>
</div>
<div>
<h1 class="disab">Najpovoljniji novi i polovni telefoni</h1>
<h2 class="disab">Polovni telefoni</h2>

</div>
<div id="checkbox-dropdown-container">
<div>
<div class="custom-select" id="custom-select">Izaberi Proizvođača</div><i class="fas fa-caret-down  img_6"></i>
<div id="custom-select-option-box">
<?php foreach ($models as $model): ?>
<div class="custom-select-option">
<label class="lael label_1"><p class="search-p p_1"><?php echo $model['model']; ?></p>
<input id="datum3" class="intcheck custom-select-option-checkbox" type="checkbox" name="toys[]" onchange="toggleFillColor(this)" value="<?php echo $model['id_telefona']; ?>">
<span id="datum3" class="checkmark span_2"></span>
</label></div>
<?php endforeach ?>
</div>
</div>
</div>
<div id="checkbox-dropdown-containers">
<div>
<div class="custom-selects" id="custom-selects">Izaberi Model</div><i class="fas fa-caret-down  img_6"></i>
<div id="custom-select-option-boxs" class="customess">
</div>
</div>
</div>

<select class="send select_1" name="mreza">
<div class="div_5">
<option value="0" disabled="disabled" selected="selected">Izaberi mrežu</option>
<option value="1">Otključan na svim mrežama</option>
<option value="2">Otključan u mts-u</option>
<option value="3">Otključan u Vip-u</option>
<option value="4">Otključan u Telenor-u</option>
</div>
</select>
<i class="fas fa-caret-down  img_6_1"></i>
</div>
<div class="sends div_4">

	<h4 class="h4Cena">Cena</h4>
	<select class="cenaSelect">
		<option>€</option>
		<option>RSD</option>
	</select>
	<i class="fas fa-caret-down  img_6"></i>
<input type="number" class="input_2" id="cena_pl" name="cena" placeholder="0 - 1500"  value="<?php if(!empty($_GET['cena'])){echo($_GET['cena']);} ?>">

</div>
<button id="search-but" class="button_4" type="submit" name="submit" value="Pretrazi">Pretraži</button>
</div>
</div>
<!--
<div class="search-right" style="display: none;"><a href="/search2?model_id=3">
<img alt="Polovni telefoni" class="marka img_1" src="/static/images/marke/3.png">
</a><a href="/search2?model_id=17">
<img alt="Polovni telefoni" class="marka" src="/static/images/marke/17.png">
</a>
<a href="/search2?model_id=4">
<img alt="Polovni telefoni" class="marka" src="/static/images/marke/4.png">
</a>
<a href="/search2?model_id=7">
<img alt="Polovni telefoni" class="marka img_2" src="/static/images/marke/7.png">
</a>
<a href="/search2?model_id=10">
<img alt="Polovni telefoni" class="marka" src="/static/images/marke/10.png">
</a>
<a href="/search2?model_id=1">
<img alt="Polovni telefoni" class="marka img_3" src="/static/images/marke/1.png">
</a>
<a href="/search2?model_id=12">
<img alt="Polovni telefoni" class="marka" src="/static/images/marke/12.png">
</a>
<a href="/search2?model_id=13">
<img alt="Polovni telefoni" class="marka" src="/static/images/marke/13.png">
</a>
<a href="/search2?model_id=11">
<img alt="Polovni telefoni" class="marka" src="/static/images/marke/11.png">
</a>
<a href="/search2?model_id=9">
<img alt="Polovni telefoni" class="marka" src="/static/images/marke/9.png">
</a>
<a href="/search2?model_id=15">
<img alt="Polovni telefoni" class="marka" src="/static/images/marke/15.png">
</a>
<a href="/search2?model_id=18">
<img alt="Polovni telefoni" class="marka img_4" src="/static/images/marke/18.png">
</a>
<a href="/search2?model_id=6">
<img alt="Polovni telefoni" class="marka img_5" src="/static/images/marke/6.png">
</a>
</div>

-->

</div>
<script>/*<![CDATA[*/$('#det-pretraga').on("click",function(){$('#napredno').animate({height:"toggle"},"slow");$('.wqe1').animate({marginTop:"225px"},"slow");$('#det-pretraga1').css({"display":"block"});$(this).css({"display":"none"});});$('#det-pretraga1').on("click",function(){$('#napredno').animate({height:"toggle"},"slow");$('.wqe1').animate({marginTop:"34px"},"slow");$('#det-pretraga').css({"display":"block"});$(this).css({"display":"none"});});$("#custom-select").on("click",function(){$("#custom-select-option-box").toggle();});function toggleFillColor(obj){$("#custom-select-option-box").show();if($(obj).prop('checked')==true){$(obj).parent().css("background",'#c6e7ed');}else{$(obj).parent().css("background",'#FFF');}}
$('.custom-select-option-checkbox').change(function(){window.ids='1';var sel_stud=[];var tags=[];$('.custom-select-option-checkbox:checked').each(function(i){sel_stud[i]=$(this).val();});$.ajax({type:"POST",url:"user/selector2.php",data:'theOption='+sel_stud,success:function(whatigot){$('#custom-select-option-boxs').html(whatigot);}});});$("#search-but").on('click',function(){var href=window.location.href.substring(0,window.location.href.indexOf('?'));var qs=window.location.href.substring(window.location.href.indexOf('?')+1,window.location.href.length);var id1=window.ids;var search=window.location.href.indexOf('search2');if(search==-1){href=window.location.href.substring(0,window.location.href.indexOf('/'))+'/search2';}
if(window.location.href.indexOf('?')==-1){qs='';}
if(id1=='1'){var sel_studs=[];$('.custom-select-option-checkbox:checked').each(function(i){sel_studs[i]=$(this).val();});var model_id="model_id="+sel_studs;if(qs.indexOf("model_id=")==-1){qs=qs+'&'
qs=qs+model_id;}
else{var start=qs.indexOf("model_id=");var end=qs.indexOf("&",start);if(end==-1){end=qs.length;}
var curParam=qs.substring(start,end);qs=qs.replace(curParam,model_id);}
var sel_studs=[];$('.custom-select-option-checkboxs:checked').each(function(i){sel_studs[i]=$(this).val();});var model_id="post_id="+sel_studs;if(qs.indexOf("post_id=")==-1){qs=qs+'&'
qs=qs+model_id;}
else{var start=qs.indexOf("post_id=");var end=qs.indexOf("&",start);if(end==-1){end=qs.length;}
var curParam=qs.substring(start,end);qs=qs.replace(curParam,model_id);}}
if($("input[name='cena']")!="undefined"&&$("input[name='cena']")!=null&&$("input[name='cena']").val()!=""&&$("input[name='cena']").val()!=0){var cena=$("input[name='cena']").val();var model_id1="cena="+cena;if(qs.indexOf("cena=")==-1){qs=qs+'&'
qs=qs+model_id1;}
else{var start=qs.indexOf("cena=");var end=qs.indexOf("&",start);if(end==-1){end=qs.length;}
var curParam=qs.substring(start,end);qs=qs.replace(curParam,model_id1);}}
if($(".send option:selected").val()!=0){var mreza=$(".send option:selected").val();var model_id12="mreza="+mreza;if(qs.indexOf("mreza=")==-1){qs=qs+'&'
qs=qs+model_id12;}
else{var start=qs.indexOf("mreza=");var end=qs.indexOf("&",start);if(end==-1){end=qs.length;}
var curParam=qs.substring(start,end);qs=qs.replace(curParam,model_id12);}}
window.location.replace(href+'?'+qs);});$("#custom-selects").on("click",function(){$("#custom-select-option-boxs").toggle();});function toggleFillColor(obj){$("#custom-select-option-boxs").show();if($(obj).prop('checked')==true){$(obj).parent().css("background",'#c6e7ed');}else{$(obj).parent().css("background",'#FFF');}}
$("body").on("click",function(e){if(e.target.id!="custom-selects"&&$(e.target).attr("class")!="custom-select-options"){$("#custom-select-option-boxs").hide();}
if(e.target.id!="custom-select"&&$(e.target).attr("class")!="custom-select-option"){$("#custom-select-option-box").hide();}});/*]]>*/</script>