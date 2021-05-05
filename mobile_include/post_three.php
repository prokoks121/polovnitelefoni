<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.min.js"></script>

<script type="text/javascript">
	$(function($) {
	
        $('img.leyzi').lazy({

            imageBase: "/static/images/modeli/",
        	            placeholder: "data:image/gif;base64,R0lGODlhEALAPQAPzl5uLr9Nrl8e7..."

        });


    });
</script>
<style type="text/css" amp-custom>

	.leyzi{
text-indent: 100%;
    white-space: nowrap;
    overflow: hidden;

        
        display: block;
          background-image: url('/static/images/icons/loading.gif');
        background-repeat: no-repeat;
        background-position: 50% 50%;
    }
.post{width:180px!important;height:300px!important}.post-right{width:183px!important;margin-left:8px!important;position:absolute!important;margin-top:93px!important}.post_right p{margin:0!important}.cena_p_comp{background-color:#0f6dd0}.cena_p{transition-duration:.5s;margin-top:-1px!important}.img_12{margin-left:10px!important}.right_three{position:absolute!important;margin-top:231px!important;margin-left:8px!important}.post-left{width:192px!important;margin-top:3px!important}.price_left{transition-duration:.6s;position:absolute;margin-top:59px;margin-left:5px;font-weight:600;font-size:15px;color:#2f2f2f}.post:hover .price_left,.price_left.hover_effect{transition-duration:.4s;margin-left:-80px;visibility:hidden;rule:properties}.post:hover .cena_p,.cena_p.hover_effect{transition-duration:.5s;max-width:60px!important;margin-right:20px;rule:properties}.post:hover #indigo,#indigo.hover_effect{transition-duration:.8s;height:255px;box-shadow:0 15px 20px -5px black;margin-top:41px;margin-left:-6px;background-color:#ffffffd4;rule:properties}#indigo{overflow:hidden;white-space:nowrap;transition-duration:.8s;width:192px;position:absolute;height:90px;border-top-right-radius:3px;border-top-left-radius:3px;margin-top:210px;margin-left:-5px}.post{-webkit-user-select:none;-webkit-touch-callout:none}</style>
<script type="text/javascript">$(document).ready(function(){$(".post").on("touchstart touchend",".link",function(a){if(a.type=="touchend"){a.preventDefault?a.preventDefault():a.returnValue=false}$(this).toggleClass("hover_effect")})});</script>
<?php foreach ($posts as $post): ?>
<?php $id_telefona = $post['id_telefona'];

global $conns, $errors;


   $stm = $conns->prepare("SELECT photo,marka,model FROM phones WHERE id=?");
    $stm->execute([$id_telefona]);
    $models = $stm->fetch(PDO::FETCH_ASSOC);




$user_id = $post['user_id'];


  $stm = $conns->prepare("SELECT telefon,telefon2 FROM users WHERE id=?");
    $stm->execute([$user_id]);
    $users = $stm->fetch(PDO::FETCH_ASSOC);




if ($post['starost'] != "Kao nov" and $post['starost'] != "Nov")
{
    $starost = "Polovan";
}
else
{
    $starost = $post['starost'];
}
if ($post['garancija'] == "")
{
    $garancija = "Nema";
}
else
{
    $garancija = $post['garancija_tip'];
}
if ($post['mreza'] == 1)
{
    $mreza = "Otključan za sve mreže";
}
if ($post['mreza'] == 2)
{
    $mreza = "Zaključan u mts-u";
}
if ($post['mreza'] == 3)
{
    $mreza = "Zaključan u vip-u";
}
if ($post['mreza'] == 4)
{
    $mreza = "Zaključan u telenor-u";
}
if (isset($_COOKIE['zoom']))
{
    $zoom = $_COOKIE['zoom'] . "%";
}
else
{
    $zoom = '83%';
}

$link = $models['marka'] . "-" . $models['model'];
$link = SplitWrods($link);

?>
<a href="/single_post/<?php echo $link; ?>/<?php echo $post['id']; ?>">

<div class="post <?php if($post['reklamno'] == 1){echo"post_rek";} ?>" style="zoom:<?php echo $zoom; ?>" >
<div class="img_12">
<img alt="Polovni telefoni , <?php echo $models['photo']; ?>" class="leyzi" data-src="<?php echo  $models['photo']; ?>" width="160px" height="212px" />
</div>
<div id="indigo">
<div class="post-right">
<p class="p_6"></p>
<h4 class="disab">Polovni telefoni</h4>
<p class="disab">Polovni</p>
<p class="disab">Telefoni</p>

<p>Boja: <?php echo $post['boja'] ?></p>
<p>Memorija: <?php echo $post['kapacitet'] ?></p>
<p>Stanje: <?php echo $starost;?></p>
<p>Garan: <?php echo $garancija ?></p>
<p><?php echo $mreza ?></p>
</div>
<div class="info <?php if($post['reklamno'] == 1){echo"info_rek";} ?>">
<div class="post-left">
<p class="p_7"><?php echo $models['marka'];?></p>
<p class="p_7"><?php echo mb_strimwidth($models['model'], 0, 18, '..');?></p>
</div>
<div class="price_left">
<p><?php echo getPostOldDays(strtotime($post["created_at"])); ?></p>
</div>
<div class="right_three">
<p class="p_8"></p>
<p class="p_9"><?php echo date("d.m.Y H:i", strtotime($post["created_at"])); ?></p>
</div>
</div>
<p class="cena_p <?php if($post['reklamno'] == 1){echo"cena_p_rek";}elseif($post['reg_check']==2){echo "cena_p_comp";} ?>"><?php $cena=$post['cena']; if ($cena !="Dogovor") { $cena=mb_strimwidth($cena, 0, 4, '')." " . "€"; } echo $cena; ?> </p>
</div>

</div>
</a>

<?php endforeach ?>