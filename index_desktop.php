

<?php require_once( ROOT_PATH . '/includes/header.php') ?>
<link rel=stylesheet href=/static/css/zas/index-dek.css?v=1.00>

<?php if (!empty($_GET['roew'])) { if ($_GET['roew']=="first") {echo "<style>

.content .post{height:301px!important;padding:5px;font-family:Source Sans Pro, sans-serif;width:480px!important;margin:9px 9px 0;float:left;border-radius:2px;border:1px solid #dedede;background-color:white;border-radius:10px;}
.post:hover{box-shadow:-2px 2px 10px 1px #636363;border:1px solid #14264e;}
.post{margin-left:0!important;z-index:-1;}
.post-right p{margin:5px 0;}
.post-left{font-weight:550;font-size:20px;margin-top:10px;width:160px;float:left;}
.post-right{position:unset!important;margin-top:10px!important;color:#000;font-size:16px;width:312px!important;float:right;}
.post-right p{margin:5px 0;}
.info{color:#000;width:100%;height:50px;display:inline-table;}
.cena_p{background-color: #535fe3;
    padding: 5px 15px 5px 15px;
    float: right;
    border-radius: 11px;
    color: #fff;
    margin: 6px;} </style>"; } }?>




<script type="text/javascript">
	   
	      $('#mobile_media_css').remove();



</script>
<meta name="description" content="Želite da kupite novi telefon ili prodate stari? Kupomobil je pravo mesto za Vas. Najpovoljniji novi i polovni telefoni na jednom mestu.">
<meta name="keywords" content="kupomobil,mobilni,telefon,polovni,prodaja,kupovina,oglasi,nov,specifikacije,mobilni telefoni,polovni mobilni telefoni,polovni telefoni">

<title>Najpovoljniji novi i polovni telefoni | PolovniTelefoni.net</title>

</head>
<body>

<?php include( ROOT_PATH . '/includes/navbar.php') ?>
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
    <!--
<p class="wqe1"></p>
<p class="wqe12">Promocije</p>
<?php //include(ROOT_PATH . '/includes/reklamno.php') ?>
<p class="wqe"></p>
<p class="wqe01">Oglasi</p>
-->
<?php include(ROOT_PATH . '/includes/sort.php') ?>
<div class="post1" style="margin-top:10px">
<?php if (!empty($_GET['roew'])) { if ($_GET['roew']=="three") { include(ROOT_PATH . '/includes/post_three.php'); }if ($_GET['roew']=="first") {include(ROOT_PATH . '/includes/posts.php'); } }else{ include(ROOT_PATH . '/includes/post_three.php');} ?></div>
<div class="paginate1"><?php include(ROOT_PATH . '/includes/paginate_insert.php') ?></div>
</div>
<?php include( ROOT_PATH . '/includes/footer.php') ?>
