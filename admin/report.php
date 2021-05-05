<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<!-- Get all topics from DB -->
<?php $topics = getAllReports();	?>
	<title>Admin | Manage Topics</title>
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
			<?php if (empty($topics)): ?>
				<h1>Nema zalbi/prijava</h1>
			<?php else: ?>
				<table class="table">
					<thead>
						<th>N</th>
						<th>ID</th>
						<th>Vrsta</th>

						<th>Ime</th>
						<th>Email</th>
						<th>Tekst</th>
					</thead>
					<tbody>
					<?php foreach ($topics as $key => $topic): ?>
						<?php
						$vrsta = explode('/%/', $topic['vrsta']);
						if ($vrsta['0'] == 1) {
							$vrsta1 = 'Oglas';
						}elseif ($vrsta['0'] == 3) {
							$vrsta1 = 'Telefon';
						}elseif ($vrsta['0'] == 4) {
							$vrsta1 = 'Komentar';
						}elseif ($vrsta['0'] == 2) {
							$vrsta1 = 'Korisnik';
						}

						 ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $topic['id']; ?></td>
							<td><?php echo $vrsta1 ." / ". $vrsta['1']; ?></td>

							<td><?php echo $topic['ime']; ?></td>

							<td><?php echo $topic['email']; ?></td>
							<td><?php echo $topic['txt']; ?></td>
						
						
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
		<!-- // Display records from DB -->
	</div>
</body>
</html>