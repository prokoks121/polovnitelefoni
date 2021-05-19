<?php require_once( ROOT_PATH . '/includes/header.php') ?>
<link rel=stylesheet href=/static/css/zas/search-dek.css?v=1.00>
<?php if (!empty($_GET['roew'])) { if ($_GET['roew']=="first") {echo "<style>

.content .post{height:301px!important;padding:5px;font-family:Source Sans Pro, sans-serif;width:480px!important;margin:9px 9px 0;float:left;border-radius:2px;border:1px solid #dedede;background-color:white;border-radius:10px;}
.post:hover{box-shadow:-2px 2px 10px 1px #636363;border:1px solid #14264e;}
.post{margin-left:0!important;z-index:-1;}
.post-right p{margin:5px 0;}
.post-left{font-weight:550;font-size:20px;margin-top:10px;width:160px;float:left;}
.post-right{position:unset!important;margin-top:10px!important;color:#000;font-size:16px;width:312px!important;float:right;}
.post-right p{margin:5px 0;}
.info{color:#000;width:100%;height:50px;display:inline-table;}
.cena_p{-webkit-clip-path:polygon(100% 0, 100% 49%, 100% 100%, 25% 100%, 0 50%, 25% 0);clip-path:polygon(100% 0, 100% 49%, 100% 100%, 25% 100%, 0 50%, 25% 0);background-color:#14264e;padding:5px 10px 5px 25px;float:right;color:#fff;margin:6px;margin-top:-16px;} </style>"; } }?>
<script type="text/javascript">

	      $('#mobile_media_css').remove();


</script>


	<title>PolovniTelefoni.net | Pretraga</title>
</head>
<body>


		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
			   <?php include(ROOT_PATH . '/includes/errors.php') ?>
<div class="container">

	<div class="novo_1">

     <div style="width: 1024px;
    margin: auto;">
    <h1 class="h1_111">
        Najpovoljniji novi i polovni<br/>telefoni na jednom mestu
    </h1>
    <a href="#" class="a_111">Pogledajt oglase</a>
    <div class="krug_img">
         <div class="krug_img1">
            <p style="padding-top: 33px;">Iphone 8</p>
            <p style="font-weight: 800;
    padding-top: 6px;">od 799.99 €</p>

    </div>
    </div>
         <img src="\static\images\local\img_ind.png" style="height: 405px;
    position: absolute;
    margin-left: 670px;
    margin-top: 50px;">
     </div>




    </div>
	<div>
	<?php include(ROOT_PATH . '/includes/search.php') ?>
</div>
<div class="content">
			   <?php include(ROOT_PATH . '/includes/sort.php') ?>
    <div class="post1" style="    margin-top: 10px;">
<?php
if ($postss == 0) {
 ?>

 <p style="margin: 30px auto;
    width: 329px;
    font-size: 30px;
    font-family: arial;">Nema ponude za traženi filter.</p>

 <img src="/static/images/icons/sad.png" alt="sad" style="margin: auto;
    display: block;">

 <?php
}

 ?>
    	<?php if (!empty($_GET['roew'])) {
    		if ($_GET['roew'] == "three") {
    			include(ROOT_PATH . '/includes/post_three.php');
    		}if ($_GET['roew'] == "first") {
    			include(ROOT_PATH . '/includes/posts.php');
    		}
    	}else{ 	include(ROOT_PATH . '/includes/post_three.php');} ?></div>
<div class="paginate1"><?php include( ROOT_PATH . '/includes/paginate_search.php') ?></div>

		</div>
		</div>


		<?php include( ROOT_PATH . '/includes/footer.php') ?>
