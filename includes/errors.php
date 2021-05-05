
<?php
if (count($errors) == 0) {
 $errors =[];

}
if (count($succes) == 0) {
 $succes =[];

}

 if (isset($_GET['errors'])) {
  array_push($errors, str_replace('%20', ' ', $_GET['errors']));

} 
if (isset($_GET['succes'])) {
  array_push($succes, str_replace('%20', ' ', $_GET['succes']));

}
?>
<?php if (count($errors) > 0 || count($succes) > 0) : ?>
  <div  class="message error validation_errors" >
    <ul>
    <?php foreach ($errors as $error) : ?>
  	  <li class="error_li"><i class="fas fa-times i_7"></i><?php echo $error ?></li>
  	<?php endforeach ?>

     <?php foreach ($succes as $succ) : ?>
      <li class="succ_li"><i class="fas fa-times i_7"></i><?php echo $succ ?></li>
    <?php endforeach ?>
  </ul>
  </div>
<?php endif ?>

<script type="text/javascript">
	setTimeout(
  function() 
  {
   $('.validation_errors').fadeOut(1500);
  }, 5000);
</script>

<style type="text/css">
  
.message {
    width: 100%;
    margin: 0 auto;
    padding: 10px 0;
    color: #3c763d;
    border-radius: 5px;
    text-align: center;
}
.error {
    margin-bottom: 20px;
}
.validation_errors {
    width: 1000px;
    position: absolute;
    font-family: arial;
    font-weight: 700;
    left: 50%;
    text-align: left;
    margin-left: -500px;
    z-index: 99
}
.notic {
    color: #a94442;
    background: #f2dede;
    border: 1px solid #a94442;
    margin-bottom: 20px;
}

.error_li {
      margin-left: 10px;
    margin-right: 10px;
    background-color: white;
    color: #d12424;
    border-radius: 2px;
    box-shadow: 1px 0px 5px 1px #ff00005e;
    padding: 10px 50px;
}
.succ_li{
    margin-left: 10px;
    margin-right: 10px;
    background-color: #ffffff;
    color: #15c015;
    border-radius: 2px;
    box-shadow: 1px 1px 5px 1px #15c0156b;
    padding: 10px 50px;
}
</style>