<?php require_once('config.php') ?>


<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>


<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
 <?php $user = GetSessionUserPublic(); 
     ?>


	<title>PolovniTelefoni.net | Kontakt</title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>

<div class="container">

		<div class="content" style="background-color: white;border-radius: 15px;">
            <div class="div_65">
                                                  <h1 style="display: none;">Kontaktirajte nas</h1>

		<h2 style="margin: auto;
    display: table;
    padding-bottom: 60px;">Kontaktirajte nas</h2>
        <div>
            <form method="post">
                   <input class="opste-input" type="email" name="mail"  value="<?php
                if (isset($_SESSION['user']['id'])) {echo $user['email'];}else{echo "Email";}?>" style="float:left; "pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">

                 <input class="opste-input" type="text" name="ime"  value="<?php
                if (isset($_SESSION['user']['id'])) {echo $user['ime'];}else{echo "Ime";}?>" style="float:left;">
                <textarea name="txt" placeholder="Unesite vašu prijavu, žalbu ili nas upozorite na nepravilnosti." class="textarea_2"></textarea>
 
                
                
                <button name="sub_kont" class="button" style="margin: 0px;float: right">Pošalji</button>
            </form>
        </div>
		</div>
</div>
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	