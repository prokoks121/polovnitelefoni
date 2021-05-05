<?php  include('../config.php'); ?>
	<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
	<?php include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>

	<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>Admin | Dashboard</title>
<?php $prvi_grafik = pcvsmob()?>

</head>
<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		<div class="table-div">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/includes/messages.php') ?>
		<div id="mobvspc"></div>
				<div id="mobvspc1"></div>
				<table>
					<tbody>
						<tr><td>Broj racunara</td></tr>
						<tr>
							<td><?php echo $prvi_grafik['0']; ?></td></td>
						</tr>
						<tr><td>Broj telefona</td></tr>
						<tr><td><?php echo $prvi_grafik['1']; ?></td></tr>
						<tr><td>Ukupno uredjaja</td></tr>
						<tr><td><?php echo $prvi_grafik['3']; ?></td></tr>
						<tr><td>Ukupno linkova</td></tr>
						<tr><td><?php echo $prvi_grafik['2']; ?></td></tr>
					</tbody>
				</table>

		</div>
		<!-- // Display records from DB -->
	</div>
</body>
</html>
