<?php require_once('config.php') ?>


<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/user/user-fuction.php') ?>
<?php
if (!isset($_SESSION['user']['id'])) {
header("location: /register");
}
 ?>

<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>

	<title>Polovni Telefoni | PolovniTelefoni.net</title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
        <?php include(ROOT_PATH . '/includes/errors.php') ?>


<div class="container">

		<div class="content" style="min-height: 426px;background-color: white;border-radius: 15px;">
                                    <h1 style="display: none;">Nemamo vaš model?</h1>

        <h2 style="
    margin: auto;
    width: 244px;
    padding-top: 20px;
">Nemamo vaš model?</h2>
        <h3 class="h3_2" >Model koji tražite biće dodat u najkraćem mogucem roku!!!</h3>
        <div style="
    margin-top: 35px;
">
            <form method="post">
                <label style="
  
    font-family: arial;
    font-size: 18px;
    padding: 8px 0px;
    
    display: block;
    width: 336px;
    margin: auto;
">Proizvođač<input type="text" name="marka" style="
    width: 100%;
  
    padding: 7px;
    font-size: 1em;
    margin: 5px 10px 10px 15px;
    border-radius: 3px;
    box-sizing: border-box;
    background: transparent;
    border: 1px solid #3e606f54;
   
    width: 200px;
"></label>
                <label style="
    font-family: arial;
    font-size: 18px;
    padding: 8px 0px;
 
    display: block;
    width: 337px;
    margin: auto;
">Model<input type="text" name="model" style="
    width: 100%;
  
    padding: 7px;
    font-size: 1em;
    margin: 5px 10px 10px 55px;
    border-radius: 3px;
    box-sizing: border-box;
    background: transparent;
    border: 1px solid #3e606f54;
 
    width: 200px;
"><span style="
    display: block;
    font-size: 12px;
">Možete navesti više različitih modela istovremeno.</span></label>
                <p style="
    font-size: 14px;
    margin: auto;
    width: 487px;
">Bićete obavešteni putem vaše Email adrese kada se vaš yahtev bude obradio. Hvala na strpljenju.</p>
                <button name="new_model" style="
    cursor: pointer;
    -webkit-appearance: none;
    background: #14264e;
    border: none;
    font-weight: bold;
    font-family: 'Source Sans Pro',sans-serif;
    color: white;
    display: block;
    border-radius: 2px;
    margin: 10px auto 20px auto;
    padding: 15px 21px;
">Pošalji zahtev</button>
            </form>
        </div>
        </div>

		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	