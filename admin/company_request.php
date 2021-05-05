<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>

<!-- Get all admin posts from DB -->
<?php $posts = getAllCompanyRequest(); ?>
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
				<h1 style="text-align: center; margin-top: 20px;">Nema zahteva za izradu naloga za firme.</h1>
			<?php else: ?>
				<table class="table">
						<thead>
						<th>N</th>
						<th>ID</th>
						<th>ID User</th>
						<th>Ime</th>

						<th>PIB</th>

						<th>MBR</th>
						<th>Email</th>
						<th>Telefon</th>

						<th>Objavljeno</th>


					

							<th><small>Napravi nalog</small></th>

						<th><small>Zanemari</small></th>
					</thead>
					<tbody>
					<?php foreach ($posts as $key => $post): ?>
					
							<?php
global $conn;
$now = strtotime("now");

$your_date1 = strtotime($post['created_at']);
$datediff1 = $now - $your_date1;
$razlika1 = round($datediff1 / (60 * 60 * 24));
 ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $post['id']; ?></td>
							<td><?php echo $post['user_id']; ?></td>

							<td><?php echo $post['ime']; ?></td>
							<td>
							
									<?php echo $post['pib']; ?>	
							
							</td>
							<td>
							
									<?php echo $post['mbr']; ?>	
							
							</td>
							<td>
							
									<?php echo $post['email']; ?>	
							
							</td>
							<td>
							
									<?php echo $post['telefon']; ?>	
							
							</td>
							<td><?php echo $post['created_at']; ?> / <?php echo $razlika1; ?> Dan</td>

						
							
<td>
								<a  class="fa fa-check btn unpublish" 
									href="company_request?create-company=<?php echo $post['id'] ?>">
								</a>
							</td>
						
							<td>
								<a  class="fa fa-trash btn delete" 
									href="company_request?delete-company=<?php echo $post['id'] ?>">
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
