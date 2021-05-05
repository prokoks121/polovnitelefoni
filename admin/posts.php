<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>

<!-- Get all admin posts from DB -->
<?php $posts = getAllPosts(); ?>
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

<div>
	<?php
$obrisanih = 0;
$ukupno = count($posts);
for ($i=0; $i < $ukupno; $i++) { 
	if ($posts[$i]['delete_check'] == 'true') {
		$obrisanih++;
	}
}


	 ?>
	<p>Ukupno</p>
	<p>Oglasa:<?php echo count($posts); ?></p>
	<p>Obrisanih:<?php echo $obrisanih; ?></p>
	<p></p>
</div>
			<?php if (empty($posts)): ?>
				<h1 style="text-align: center; margin-top: 20px;">No posts in the database.</h1>
			<?php else: ?>
				<table class="table">
						<thead>
						<th>N</th>
						<th>ID</th>
						<th>ID User</th>

						<th>Marka</th>

						<th>Model</th>
						<th>Azurirano</th>
						<th>Objavljeno</th>
						<th>Ip adresa</th>


						<!-- Only Admin can publish/unpublish post -->
						<?php if ($_SESSION['user']['role'] == "Admin"): ?>
						<th><small>Reklamno</small></th>
													<th><small>Obrisano</small></th>

							<th><small>Publish</small></th>

						<?php endif ?>
						<th><small>Delete</small></th>
					</thead>
					<tbody>
					<?php foreach ($posts as $key => $post): ?>
						<?php
global $conn;
$id = $post['id_telefona'];
$phone = mysqli_fetch_assoc(mysqli_query($conn,"SELECT marka,model FROM phones WHERE id=$id LIMIT 1"));
$now = strtotime("now");
$your_date = strtotime($post['updated_at']);
$datediff = $now - $your_date;
$razlika = round($datediff / (60 * 60 * 24));

$your_date1 = strtotime($post['created_at']);
$datediff1 = $now - $your_date1;
$razlika1 = round($datediff1 / (60 * 60 * 24));
 ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $post['id']; ?></td>
							<td><?php echo $post['user_id']; ?></td>

							<td><?php echo $phone['marka']; ?></td>
							<td>
							
									<?php echo $phone['model']; ?>	
							
							</td>
							<td><?php echo $post['created_at']; ?> / <?php echo $razlika1; ?> Dan</td>
														<td><?php echo $post['updated_at']; ?> / <?php echo $razlika; ?> Dan</td>
							<td><?php echo $post['ip_addres']; ?></td>

							<!-- Only Admin can publish/unpublish post -->
							<td>
								<?php if ($post['reklamno'] == true): ?>

								<a    class="fa fa-check btn unpublish" 
									href="create_post.php?reklamno_false=<?php echo $post['id'] ?>">
								</a>
									<?php else: ?>
										<a  class="fa fa-times btn publish"
									href="create_post.php?reklamno_true=<?php echo $post['id'] ?>">
								</a>
								<?php endif ?>

							</td>
								<td>
								<?php if ($post['delete_check'] == 'true'): ?>

								<a   class="fa fa-check btn unpublish"
									href="create_post.php?delete_false=<?php echo $post['id'] ?>">
								</a>
									<?php else: ?>
										<a   class="fa fa-times btn publish"
									href="create_post.php?delete_true=<?php echo $post['id'] ?>">
								</a>
								<?php endif ?>

							</td>
							<?php if ($_SESSION['user']['role'] == "Admin" ): ?>
								<td>
								<?php if ($post['published'] == true): ?>
									<a class="fa fa-check btn unpublish"
										href="posts.php?unpublish=<?php echo $post['id'] ?>">
									</a>
								<?php else: ?>
									<a class="fa fa-times btn publish"
										href="posts.php?publish=<?php echo $post['id'] ?>">
									</a>
								<?php endif ?>
								</td>
							<?php endif ?>

						
							<td>
								<a  class="fa fa-trash btn delete" 
									href="create_post.php?delete-post=<?php echo $post['id'] ?>">
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
