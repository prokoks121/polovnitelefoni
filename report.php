<?php require_once('config.php') ?>
<?php if (!isset($_GET['post_id']) && !isset($_GET['model_id']) && !isset($_GET['user_id']) && !isset($_GET['comm_id'])) {
   header('location: /index');
} ?>

<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>


<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>


	<title>Izveštaj | PolovniTelefoni.net</title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>

<div class="container">

		<div class="content" style="border-radius: 15px;background-color: white;">
            <div style="    padding-top: 30px;
    margin: auto;
   
    width: 550px;">
              <h1 style="display: none;">Prijavi problem ili nepravilnosti</h1>

		<h2 style="margin: auto;
    display: table;
    padding-bottom: 60px;">Prijavi problem ili nepravilnosti</h2>
        <div>
            <form method="post">
                  <input class="opste-input" type="email" name="mail"  value="<?php
                if (isset($_SESSION['user']['id'])) {echo GetSessionUserPublic()['email'];}else{echo "Email";}?>" style="float:left; "pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">

                 <input class="opste-input" type="text" name="ime" value="<?php
                if (isset($_SESSION['user']['id'])) {echo GetSessionUserPublic()['ime'];}else{echo "Ime";}?>" style="float:left;">
                <textarea name="txt" placeholder="Unesite vašu prijavu, žalbu ili nas upozorite na nepravilnosti." style=" padding: 7px;
    width: 535px;
    min-height: 150px;
    border-radius: 5px;"></textarea>
  
                <button name="sub_report" class="button" style="margin: 0px;float: right">Pošalji</button>
            </form>
        </div>
		</div>
</div>
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	