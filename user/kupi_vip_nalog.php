<?php require_once('../config.php') ?>
<?php if (!isset($_SESSION['user']['id'])) {
    header('location: /login.php');             
                    exit(0);
}
?>

<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>

<?php require_once( ROOT_PATH . '/user/user-fuction.php') ?>

<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>


	<title>Kupi VIP nalog| PolovniTelefoni.net</title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>

<div class="container">

		<div class="content">
		<h2 style="    padding-top: 40px;
    margin: auto;
    display: table;"><i style="    font-size: 32px;
    position: absolute;
    margin-left: 59px;
    margin-top: -29px;
    color: #c1c145;" class="fas fa-crown"></i> Kupi VIP nalog</h2>
			<div>
       



       <table>
           <tr>
            <td></td>
            <td><i style="    font-size: 32px;
    position: absolute;
    margin-left: 59px;
    margin-top: -29px;
    color: #c1c145;" class="fas fa-crown"></i> VIP </td>
            <td>Besplatan</td>
           </tr>
           <tr>
            <td>Neogranicen broj oglasa</td>
            <td><i class="fas fa-check"></i></td>
            <td><i class="fas fa-check"></i></td>
           </tr>

            <tr>
            <td>10 reklamnih oglasa istovremeno</td>
            <td><i class="fas fa-check"></i></td>
            <td><i class="fas fa-check"></i></td>
           </tr>
            <tr>

            <td>Automacko obnavljanje oglasa na svakih 24h</td>
            <td><i class="fas fa-check"></i></td>
            <td><i class="fas fa-check"></i></td>
           </tr>
            <tr>

            <td>Oglas ostaje aktivan 30 dana</td>
            <td><i class="fas fa-check"></i></td>
            <td><i class="fas fa-check"></i></td>
           </tr>
            <tr>

            <td>Vize pregleda oglasa</td>
            <td><i class="fas fa-check"></i></td>
            <td><i class="fas fa-check"></i></td>
           </tr>
            <tr>

            <td>Vise pratioca</td>
            <td><i class="fas fa-check"></i></td>
            <td><i class="fas fa-check"></i></td>
           </tr>

       </table>         
            </div>

		</div>

		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	