<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>

<!-- Get all admin posts from DB -->
<?php $posts = getAllPhoneRequest(); ?>
	<title>Admin | Manage Posts</title>
</head>
<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		<!-- Display records from DB-->
		<div class="table-div"  style="width: 80%;">


			<?php if (empty($posts)): ?>
				<h1 style="text-align: center; margin-top: 20px;">Nema zahteva za novi telefon.</h1>
			<?php else: ?>
				<table class="table">
						<thead>
						<th>N</th>
						<th>ID</th>
						<th>ID User</th>
						<th>Model</th>

						<th>Marka</th>

						<th>Datum</th>
				

					


						<th><small>Obrisi</small></th>
					</thead>
					<tbody>
					<?php foreach ($posts as $key => $post): ?>
					
							<?php
global $conn;
$now = strtotime("now");

$your_date1 = strtotime($post['created_at']);
$datediff1 = $now - $your_date1;
$razlika1 = round($datediff1 / (60 * 60 * 24));
$marka = explode('/%/', $post['sta']);
 ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $post['id']; ?></td>
							<td><?php echo $post['user_id']; ?></td>

							<td><?php echo $marka['0']; ?></td>
							<td>
							
									<?php echo $marka['1']; ?>	
							
							</td>
							
						
							<td><?php echo $post['created_at']; ?> / <?php echo $razlika1; ?> Dan</td>

							<td>
								<a  class="fa fa-trash btn delete" 
									href="request_phone?delete-phone-request=<?php echo $post['id'] ?>">
								</a>
							</td>
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
